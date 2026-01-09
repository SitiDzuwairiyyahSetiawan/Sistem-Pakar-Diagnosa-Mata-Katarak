<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use App\Models\Symptom;
use App\Models\DiagnosisHistory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    // Dashboard dengan chart
    public function dashboard()
    {
        // Statistics
        $totalDiseases = Disease::count();
        $totalSymptoms = Symptom::count();
        $totalHistories = DiagnosisHistory::count();
        $todayHistories = DiagnosisHistory::whereDate('created_at', today())->count();
        
        // Chart data - Penyakit terbanyak didiagnosa
        $diseaseStats = DiagnosisHistory::select('disease_name', DB::raw('COUNT(*) as count'))
            ->groupBy('disease_name')
            ->orderBy('count', 'desc')
            ->limit(5)
            ->get();
        
        // Chart data - Diagnosa per hari (7 hari terakhir)
        $weeklyStats = DiagnosisHistory::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        
        // Recent histories
        $recentHistories = DiagnosisHistory::with([])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalDiseases', 
            'totalSymptoms', 
            'totalHistories',
            'todayHistories',
            'diseaseStats',
            'weeklyStats',
            'recentHistories'
        ));
    }
    
    // Diseases Management
    public function diseases()
    {
        $diseases = Disease::withCount('symptoms')->get();
        return view('admin.diseases.index', compact('diseases'));
    }
    
    public function createDisease()
    {
        return view('admin.diseases.create');
    }
    
    public function storeDisease(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:diseases|max:10',
            'name' => 'required|max:100',
            'description' => 'required',
            'symptoms_description' => 'required',
            'recommendation' => 'required',
        ]);
        
        Disease::create($validated);
        
        return redirect()->route('admin.diseases')
            ->with('success', 'Penyakit berhasil ditambahkan.');
    }
    
    public function editDisease($id)
    {
        $disease = Disease::findOrFail($id);
        return view('admin.diseases.edit', compact('disease'));
    }
    
    public function updateDisease(Request $request, $id)
    {
        $disease = Disease::findOrFail($id);
        
        $validated = $request->validate([
            'code' => 'required|max:10|unique:diseases,code,' . $id,
            'name' => 'required|max:100',
            'description' => 'required',
            'symptoms_description' => 'required',
            'recommendation' => 'required',
        ]);
        
        $disease->update($validated);
        
        return redirect()->route('admin.diseases')
            ->with('success', 'Penyakit berhasil diperbarui.');
    }
    
    public function destroyDisease($id)
    {
        $disease = Disease::findOrFail($id);
        $disease->delete();
        
        return redirect()->route('admin.diseases')
            ->with('success', 'Penyakit berhasil dihapus.');
    }
    
    // Symptoms Management
    public function symptoms()
    {
        $symptoms = Symptom::with('disease')->orderBy('code')->get();
        $diseases = Disease::orderBy('name')->get();
        return view('admin.symptoms.index', compact('symptoms', 'diseases'));
    }
    
    public function createSymptom()
    {
        $diseases = Disease::orderBy('name')->get();
        return view('admin.symptoms.create', compact('diseases'));
    }
    
    public function storeSymptom(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:symptoms,code',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'disease_id' => 'nullable|exists:diseases,id'
        ]);

        Symptom::create($validated);

        return redirect()->route('admin.symptoms')
            ->with('success', 'Gejala berhasil ditambahkan');
    }
    
    public function editSymptom($id)
    {
        $symptom = Symptom::findOrFail($id);
        $diseases = Disease::orderBy('name')->get();
        return view('admin.symptoms.edit', compact('symptom', 'diseases'));
    }
    
    public function updateSymptom(Request $request, $id)
    {
        $symptom = Symptom::findOrFail($id);
        
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:symptoms,code,' . $symptom->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'disease_id' => 'nullable|exists:diseases,id'
        ]);

        $symptom->update($validated);

        return redirect()->route('admin.symptoms')
            ->with('success', 'Gejala berhasil diperbarui');
    }
    
    public function destroySymptom($id)
    {
        $symptom = Symptom::findOrFail($id);
        $symptom->delete();

        return redirect()->route('admin.symptoms')
            ->with('success', 'Gejala berhasil dihapus');
    }
    
    // Diagnosis Histories
    public function histories()
    {
        $histories = DiagnosisHistory::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.histories.index', compact('histories'));
    }
    
    public function destroyHistory($id)
    {
        $history = DiagnosisHistory::findOrFail($id);
        $history->delete();
        
        return redirect()->route('admin.histories')
            ->with('success', 'Riwayat diagnosa berhasil dihapus.');
    }

    public function showHistory($id)
    {
        $history = DiagnosisHistory::findOrFail($id);
        return view('admin.histories.show', compact('history'));
    }
    
    // Export to CSV
    public function exportHistoriesCSV()
    {
        $histories = DiagnosisHistory::orderBy('created_at', 'desc')->get();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="diagnosis-histories-' . date('Y-m-d') . '.csv"',
        ];
        
        $callback = function() use ($histories) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Tanggal', 'Nama Pasien', 'Usia', 'Penyakit', 'Kode', 'Tingkat Kecocokan', 'Gejala Terpilih']);
            
            foreach ($histories as $history) {
                fputcsv($file, [
                    $history->id,
                    $history->created_at->format('Y-m-d H:i:s'),
                    $history->patient_name ?? 'Anonim',
                    $history->age ?? '-',
                    $history->disease_name,
                    $history->disease_code,
                    $history->confidence_level . '%',
                    substr($history->symptoms_selected ?? '', 0, 100) . '...'
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    // Profile
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
    
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);
        
        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        // Update password if provided
        if ($request->filled('current_password') && $request->filled('new_password')) {
            if (!\Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            
            $user->password = bcrypt($validated['new_password']);
        }
        
        $user->save();
        
        return redirect()->route('admin.profile')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}