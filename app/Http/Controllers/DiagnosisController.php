<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\DiagnosisHistory;
use Illuminate\Support\Facades\Log;

class DiagnosisController extends Controller
{
    public function index()
    {
        return view('diagnosis.index');
    }

    public function create()
    {
        $symptoms = Symptom::with('disease')
            ->orderBy('disease_id')
            ->orderBy('order')
            ->get();

        $totalSymptoms = $symptoms->count();
        $currentIndex = request('current', 0);
        if ($currentIndex >= $totalSymptoms) $currentIndex = 0;

        $currentSymptom = $symptoms[$currentIndex] ?? null;
        $currentDisease = $currentSymptom?->disease;

        $patient = session('diagnosis_patient', ['name' => null, 'age' => null]);
        $answers = session('diagnosis_answers', []);

        return view('diagnosis.form', compact(
            'symptoms',
            'currentSymptom',
            'currentDisease',
            'currentIndex',
            'totalSymptoms',
            'patient',
            'answers'
        ));
    }

    public function answer(Request $request)
    {
        $request->validate([
            'symptom_code'  => 'required|string|max:10',
            'answer'        => 'required|in:true,false',
            'current_index' => 'required|integer|min:0',
            'patient_name'  => 'nullable|string|max:100',
            'age'           => 'nullable|integer|min:0|max:120',
        ]);

        $answers = session('diagnosis_answers', []);

        if ($request->current_index == 0) {
            $patient = [
                'name' => $request->patient_name ?: 'Anonim',
                'age'  => $request->age ?: null
            ];
            session(['diagnosis_patient' => $patient]);
        } else {
            $patient = session('diagnosis_patient', ['name' => 'Anonim', 'age' => null]);
        }

        $answers[$request->symptom_code] = $request->answer;
        session(['diagnosis_answers' => $answers]);

        $nextIndex = $request->current_index + 1;
        $totalSymptoms = Symptom::count();

        if ($nextIndex >= $totalSymptoms) {
            return $this->processDiagnosis($request);
        }

        return redirect()->route('diagnosis.create', ['current' => $nextIndex]);
    }

    /**
     * =======================
     * PROSES DIAGNOSA (FIX)
     * =======================
     */
    private function processDiagnosis(Request $request)
    {
        $answers = session('diagnosis_answers', []);
        $patient = session('diagnosis_patient', ['name' => 'Anonim', 'age' => null]);

        $diseases = Disease::with('symptoms')->orderBy('id')->get();

        $diagnosedDisease = null;
        $matchedSymptoms = [];
        $confidence = 0; 

        foreach ($diseases as $disease) {

            $allMatched = true;
            $currentMatchedSymptoms = [];

            foreach ($disease->symptoms as $symptom) {
                if (($answers[$symptom->code] ?? 'false') !== 'true') {
                    $allMatched = false;
                    break;
                }
                $currentMatchedSymptoms[] = $symptom->description;
            }

            // FORWARD CHAINING: semua gejala terpenuhi
            if ($allMatched) {
                $diagnosedDisease = $disease;
                $matchedSymptoms = $currentMatchedSymptoms;

                // ==========================
                // HITUNG CONFIDENCE LEVEL
                // ==========================
                $totalSymptoms = $disease->symptoms->count();
                $matchedCount = count($matchedSymptoms);

                if ($totalSymptoms > 0) {
                    $confidence = round(($matchedCount / $totalSymptoms) * 100, 2);
                }

                break;
            }
        }

        // Jika tidak ada rule terpenuhi
        if (!$diagnosedDisease) {
            $diagnosedDisease = (object)[
                'code' => 'UNKNOWN',
                'name' => 'Tidak Terdeteksi',
                'description' => 'Tidak ada aturan yang terpenuhi berdasarkan gejala yang dipilih.',
                'recommendation' => 'Disarankan untuk berkonsultasi langsung dengan dokter spesialis mata.'
            ];

            $matchedSymptoms = [];
            $confidence = 0; 
        }

        // ==========================
        // SIMPAN RIWAYAT (FIX)
        // ==========================
        $history = DiagnosisHistory::create([
            'patient_name'      => $patient['name'],
            'age'               => $patient['age'],
            'disease_code'      => $diagnosedDisease->code,
            'disease_name'      => $diagnosedDisease->name,
            'confidence_level'  => $confidence,
            'symptoms_selected' => implode('; ', $matchedSymptoms),
            'answers'           => $answers,
            'recommendation'    => $diagnosedDisease->recommendation
        ]);

        session()->forget(['diagnosis_answers', 'diagnosis_patient']);

        return view('diagnosis.result', [
            'disease'          => $diagnosedDisease,
            'matchedSymptoms'  => $matchedSymptoms,
            'patientName'      => $patient['name'],
            'age'              => $patient['age'],
            'historyId'        => $history->id,
            'confidence'       => $confidence // opsional kalau mau ditampilin
        ]);
    }

    public function reset()
    {
        session()->forget(['diagnosis_answers', 'diagnosis_patient']);
        return redirect()->route('diagnosis.create');
    }

    public function history()
    {
        $histories = DiagnosisHistory::orderBy('created_at', 'desc')->get();
        return view('diagnosis.history', compact('histories'));
    }

    public function showHistory($id)
    {
        $history = DiagnosisHistory::findOrFail($id);
        return view('diagnosis.history-detail', compact('history'));
    }
}
