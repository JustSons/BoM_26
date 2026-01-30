{{-- resources/views/components/progress-stepper.blade.php --}}
@props(['currentStep' => 1])

@php
    // Definisikan setiap langkah untuk perbandingan
    $biodataStep = 1;
    $berkasStep = 2;
    $jadwalStep = 3;
@endphp

<div class="w-full max-w-3xl mx-auto mb-10 sm:mb-12">
    <div class="flex items-center">

        <a href="{{ route('applicant.biodata') }}" @class([
            'relative flex flex-col items-center transition-transform duration-200 hover:scale-105',
            'text-[#596c48]' => $currentStep >= $biodataStep,
            'text-gray-400' => $currentStep < $biodataStep,
        ])>
            <div @class([
                'rounded-full h-10 w-10 flex items-center justify-center text-white font-bold text-lg',
                'bg-[#596c48]', 
                'ring-4 ring-[#596c48]/30' => $currentStep == $biodataStep, 
            ])>
                @if ($currentStep > $biodataStep) ✓ @else {{ $biodataStep }} @endif
            </div>
            <div class="absolute top-12 text-xs sm:text-sm font-semibold text-white">Biodata</div>
        </a>

        <div @class([
            'flex-auto border-t-2 transition-colors duration-500',
            'border-[#596c48]' => $currentStep > $biodataStep,
            'border-gray-600' => $currentStep <= $biodataStep,
        ])></div>

        <a href="{{ $currentStep > $biodataStep ? route('applicant.berkas') : '#' }}" @class([
            'relative flex flex-col items-center transition-transform duration-200',
            'hover:scale-105' => $currentStep > $biodataStep,
            'cursor-default' => $currentStep <= $biodataStep,
            'text-[#596c48]' => $currentStep >= $berkasStep,
            'text-gray-400' => $currentStep < $berkasStep,
        ])>
            <div @class([
                'rounded-full h-10 w-10 flex items-center justify-center text-white font-bold text-lg',
                'bg-[#596c48]' => $currentStep >= $berkasStep,
                'bg-gray-700' => $currentStep < $berkasStep,
                'ring-4 ring-[#596c48]/30' => $currentStep == $berkasStep,
            ])>
                @if ($currentStep > $berkasStep) ✓ @else {{ $berkasStep }} @endif
            </div>
            <div class="absolute top-12 text-xs sm:text-sm font-semibold text-white">Berkas</div>
        </a>

        <div @class([
            'flex-auto border-t-2 transition-colors duration-500',
            'border-[#596c48]' => $currentStep > $berkasStep,
            'border-gray-600' => $currentStep <= $berkasStep,
        ])></div>

        <a href="{{ $currentStep > $berkasStep ? route('applicant.jadwal') : '#' }}" @class([
            'relative flex flex-col items-center transition-transform duration-200',
            'hover:scale-105' => $currentStep > $berkasStep,
            'cursor-default' => $currentStep <= $berkasStep,
            'text-[#596c48]' => $currentStep >= $jadwalStep,
            'text-gray-400' => $currentStep < $jadwalStep,
        ])>
            <div @class([
                'rounded-full h-10 w-10 flex items-center justify-center text-white font-bold text-lg',
                'bg-[#596c48]' => $currentStep >= $jadwalStep,
                'bg-gray-700' => $currentStep < $jadwalStep,
                'ring-4 ring-[#596c48]/30' => $currentStep == $jadwalStep,
            ])>
                @if ($currentStep > $jadwalStep) ✓ @else {{ $jadwalStep }} @endif
            </div>
            <div class="absolute top-12 text-xs sm:text-sm font-semibold text-white">Jadwal</div>
        </a>
    </div>
</div>