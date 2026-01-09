@extends('layouts.app')

@section('title', 'Diagnosa Penyakit Mata')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-800 mb-2">Diagnosa Penyakit Mata</h1>
            <p class="text-gray-600">Jawab setiap gejala untuk hasil diagnosa yang akurat</p>
        </div>

        <!-- Progress Bar -->
        <div class="mb-8">
            <div class="flex justify-between mb-2">
                <span class="font-medium text-blue-700">Progress</span>
                <span class="font-semibold text-blue-800">{{ $currentIndex + 1 }}/{{ $totalSymptoms }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-3">
                <div class="bg-blue-600 h-3 rounded-full transition-all duration-300" 
                     style="width: {{ (($currentIndex + 1) / $totalSymptoms) * 100 }}%">
                </div>
            </div>
            <div class="text-center mt-1">
                <span class="text-sm text-gray-600">
                    {{ round((($currentIndex + 1) / $totalSymptoms) * 100, 1) }}% Selesai
                </span>
            </div>
        </div>

        @if($currentSymptom)
        <form id="diagnosisForm" method="POST" action="{{ route('diagnosis.answer') }}">
            @csrf
            
            <!-- Patient Info (hanya di gejala pertama) -->
            @if($currentIndex == 0)
            <div class="mb-8 p-6 bg-blue-50 rounded-xl border border-blue-200">
                <h2 class="text-xl font-semibold text-blue-700 mb-4">Informasi Pasien</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 mb-2">Nama (opsional)</label>
                        <input type="text" name="patient_name" 
                               value="{{ $patient['name'] ?? '' }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Masukkan nama Anda">
                    </div>
                    <div>
                        <label class="block text-gray-700 mb-2">Usia (opsional)</label>
                        <input type="number" name="age"
                               value="{{ $patient['age'] ?? '' }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Masukkan usia">
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-3">
                    <i class="fas fa-info-circle mr-1"></i> Informasi ini akan disimpan di riwayat diagnosa
                </p>
            </div>
            @endif

            <!-- Current Disease Info -->
            <div class="mb-6 p-5 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl border border-blue-200">
                <div class="flex items-start gap-4">

                    <!-- KODE PENYAKIT (P1) -->
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-full 
                                flex items-center justify-center 
                                font-bold text-lg shrink-0 mt-1">
                        {{ $currentDisease->code }}
                    </div>

                    <!-- INFO -->
                    <div>
                        <h2 class="text-xl font-bold text-blue-800">
                            {{ $currentDisease->name }}
                        </h2>
                        <p class="text-gray-600 mt-1">
                            <i class="fas fa-clipboard-list mr-1"></i>
                            Gejala {{ $currentSymptom->order }} dari {{ $currentDisease->symptoms->count() }}
                        </p>
                    </div>

                </div>
            </div>

            <!-- Symptom Question -->
            <div class="mb-8">
                <input type="hidden" name="symptom_code" value="{{ $currentSymptom->code }}">
                <input type="hidden" name="current_index" value="{{ $currentIndex }}">
                
                @php
                    $answers = session('diagnosis_answers', []);
                    $currentAnswer = $answers[$currentSymptom->code] ?? null;
                @endphp

                <!-- Question Box -->
                <div class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 text-blue-800 rounded-lg flex items-center justify-center font-bold mr-3">
                            {{ $currentSymptom->code }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-700">Gejala {{ $currentSymptom->order }}</h3>
                        </div>
                    </div>
                    <p class="text-lg text-gray-800 leading-relaxed pl-13">
                        {{ $currentSymptom->description }}
                    </p>
                </div>

                <!-- Answer Options -->
                <div class="grid md:grid-cols-2 gap-4 mb-8">
                    <!-- Ya Option -->
                    <button type="button" 
                            onclick="selectAnswer('true')"
                            class="answer-option {{ $currentAnswer === 'true' ? 'bg-green-50 border-green-500 text-green-700' : 'bg-white border-gray-300 hover:bg-gray-50' }}"
                            id="btn-true">
                        <div class="flex items-center justify-center p-6">
                            <div class="w-8 h-8 rounded-full {{ $currentAnswer === 'true' ? 'bg-green-500' : 'bg-gray-200' }} flex items-center justify-center mr-3">
                                @if($currentAnswer === 'true')
                                <i class="fas fa-check text-white"></i>
                                @endif
                            </div>
                            <div class="text-left">
                                <div class="font-semibold text-lg">Ya</div>
                                <div class="text-sm opacity-80">Saya mengalami gejala ini</div>
                            </div>
                        </div>
                    </button>

                    <!-- Tidak Option -->
                    <button type="button" 
                            onclick="selectAnswer('false')"
                            class="answer-option {{ $currentAnswer === 'false' ? 'bg-red-50 border-red-500 text-red-700' : 'bg-white border-gray-300 hover:bg-gray-50' }}"
                            id="btn-false">
                        <div class="flex items-center justify-center p-6">
                            <div class="w-8 h-8 rounded-full {{ $currentAnswer === 'false' ? 'bg-red-500' : 'bg-gray-200' }} flex items-center justify-center mr-3">
                                @if($currentAnswer === 'false')
                                <i class="fas fa-times text-white"></i>
                                @endif
                            </div>
                            <div class="text-left">
                                <div class="font-semibold text-lg">Tidak</div>
                                <div class="text-sm opacity-80">Saya tidak mengalami</div>
                            </div>
                        </div>
                    </button>
                </div>

                <input type="hidden" name="answer" id="selectedAnswer" value="{{ $currentAnswer }}">

                <!-- Navigation -->
                <div class="flex justify-between items-center pt-8 border-t">
                    <div>
                        @if($currentIndex > 0)
                        <a href="{{ route('diagnosis.create', ['current' => $currentIndex - 1]) }}"
                           class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                        @else
                        <a href="{{ route('diagnosis.reset') }}"
                           class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                            <i class="fas fa-redo mr-2"></i>Reset
                        </a>
                        @endif
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">
                            {{ $totalSymptoms - $currentIndex - 1 }} gejala tersisa
                        </span>
                        
                        @if($currentIndex == $totalSymptoms - 1)
                        <button type="submit" 
                                id="submitBtn"
                                class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                {{ !$currentAnswer ? 'disabled' : '' }}>
                            Selesai & Lihat Hasil
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                        @else
                        <button type="submit" 
                                id="submitBtn"
                                class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                                {{ !$currentAnswer ? 'disabled' : '' }}>
                            Lanjut ke Gejala Berikutnya
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Answer Preview -->
            @if(count($answers) > 0)
            <div class="mt-8 p-6 bg-blue-50 rounded-xl border border-blue-200">
                <h3 class="font-semibold text-blue-700 mb-4 flex items-center">
                    <i class="fas fa-history mr-2"></i>
                    Gejala yang Sudah Dijawab ({{ count($answers) }})
                </h3>
                <div class="grid grid-cols-6 gap-2">
                    @foreach($answers as $code => $answer)
                    <div class="px-3 py-2 rounded-lg {{ $answer === 'true' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        <span class="font-medium">{{ $code }}</span>
                        <span class="ml-2">{{ $answer === 'true' ? '✓' : '✗' }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </form>
        @else
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak Ada Gejala</h3>
            <p class="text-gray-500 mb-6">Data gejala tidak ditemukan dalam sistem.</p>
            <a href="{{ route('diagnosis.index') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                <i class="fas fa-home mr-2"></i>Kembali ke Beranda
            </a>
        </div>
        @endif
    </div>
</div>

<script>
let selectedAnswer = "{{ $currentAnswer }}";

function selectAnswer(answer) {
    selectedAnswer = answer;

    // set value ke hidden input
    document.getElementById('selectedAnswer').value = answer;

    // ambil tombol
    const btnTrue  = document.getElementById('btn-true');
    const btnFalse = document.getElementById('btn-false');

    // reset class dulu
    btnTrue.classList.remove(
        'bg-green-50','border-green-500','text-green-700'
    );
    btnFalse.classList.remove(
        'bg-red-50','border-red-500','text-red-700'
    );

    btnTrue.classList.add('bg-white','border-gray-300');
    btnFalse.classList.add('bg-white','border-gray-300');

    // aktifkan sesuai jawaban
    if (answer === 'true') {
        btnTrue.classList.remove('bg-white','border-gray-300');
        btnTrue.classList.add(
            'bg-green-50','border-green-500','text-green-700'
        );
    } else {
        btnFalse.classList.remove('bg-white','border-gray-300');
        btnFalse.classList.add(
            'bg-red-50','border-red-500','text-red-700'
        );
    }

    // enable submit
    document.getElementById('submitBtn').disabled = false;
}
</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
