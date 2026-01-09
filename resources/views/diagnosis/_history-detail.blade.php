<div>
    <!-- Header -->
    <div class="mb-6 pb-4 border-b">
        <div class="flex flex-col md:flex-row justify-between items-start gap-4">
            <div>
                <h4 class="text-2xl font-bold text-gray-800">{{ $history->disease_name }} ({{ $history->disease_code }})</h4>
                <p class="text-gray-600 mt-1">{{ $history->created_at->format('d F Y, H:i') }}</p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold {{ $history->confidence_level >= 80 ? 'text-green-600' : ($history->confidence_level >= 50 ? 'text-yellow-600' : 'text-red-600') }}">
                    {{ number_format($history->confidence_level, 1) }}%
                </div>
                <div class="text-sm text-gray-500">Tingkat Kecocokan</div>
            </div>
        </div>
        
        <!-- Patient Info -->
        @if($history->patient_name || $history->age)
        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
            <div class="flex flex-wrap gap-6">
                @if($history->patient_name)
                <div>
                    <span class="text-gray-600 font-medium">Nama:</span>
                    <span class="ml-2 text-gray-800">{{ $history->patient_name }}</span>
                </div>
                @endif
                @if($history->age)
                <div>
                    <span class="text-gray-600 font-medium">Usia:</span>
                    <span class="ml-2 text-gray-800">{{ $history->age }} tahun</span>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
    
    <!-- Symptoms -->
    <div class="mb-8">
        <h5 class="text-xl font-semibold text-gray-800 mb-4">Gejala yang Dilaporkan:</h5>
        @if($history->symptoms_selected)
        <div class="space-y-3">
            @foreach(explode('; ', $history->symptoms_selected) as $symptom)
            @if(trim($symptom))
            <div class="flex items-start bg-green-50 p-4 rounded-lg border border-green-200">
                <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="text-gray-700">{{ $symptom }}</span>
            </div>
            @endif
            @endforeach
        </div>
        @else
        <div class="bg-gray-50 p-4 rounded-lg border">
            <p class="text-gray-500 italic">Data gejala tidak tersedia</p>
        </div>
        @endif
    </div>
    
    <!-- All Answers -->
    @if($history->answers && count($history->answers) > 0)
    <div class="mb-8">
        <h5 class="text-xl font-semibold text-gray-800 mb-4">Jawaban Lengkap ({{ count($history->answers) }} gejala):</h5>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            @foreach($history->answers as $code => $answer)
            <div class="bg-white border rounded-lg p-3 hover:shadow-sm transition-shadow">
                <div class="flex justify-between items-center mb-2">
                    <div class="font-medium text-gray-700">{{ $code }}</div>
                    <div class="{{ $answer === 'true' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} 
                                px-2 py-1 rounded-full text-xs font-semibold">
                        {{ $answer === 'true' ? 'YA' : 'TIDAK' }}
                    </div>
                </div>
                @php
                    $symptomDescription = '';
                    try {
                        $symptom = \App\Models\Symptom::where('code', $code)->first();
                        if ($symptom) {
                            $symptomDescription = \Illuminate\Support\Str::limit($symptom->description, 60);
                        }
                    } catch (\Exception $e) {}
                @endphp
                @if($symptomDescription)
                <div class="text-sm text-gray-600 mt-1 leading-tight">{{ $symptomDescription }}</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif
    
    <!-- Recommendation -->
    <div class="p-6 bg-blue-50 rounded-lg border border-blue-200">
        <h5 class="text-xl font-semibold text-blue-700 mb-3">Rekomendasi:</h5>
        <p class="text-gray-700 leading-relaxed">
            {{ $history->recommendation ?? 'Konsultasikan dengan dokter spesialis mata untuk pemeriksaan lebih lanjut.' }}
        </p>
    </div>
    
    <!-- Footer -->
    <div class="mt-8 pt-6 border-t text-center">
        <p class="text-sm text-gray-500">
            Hasil ini berdasarkan sistem pakar forward chaining. Hasil diagnosa tidak menggantikan pemeriksaan medis profesional.
        </p>
    </div>
</div>