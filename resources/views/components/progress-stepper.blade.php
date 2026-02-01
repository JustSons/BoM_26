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
            'text-[#26392d]' => $currentStep >= $biodataStep,
            'text-gray-400' => $currentStep < $biodataStep,
        ])>
            <div @class([
                'rounded-full h-10 w-10 flex items-center justify-center text-white font-bold text-lg',
                'bg-[#26392d]', 
                'ring-4 ring-[#26392d]/30' => $currentStep == $biodataStep, 
            ])>
                @if ($currentStep > $biodataStep) ✓ @else {{ $biodataStep }} @endif
            </div>
            <div class="absolute top-12 text-xs sm:text-sm font-semibold text-[#26392d]">Biodata</div>
        </a>

        <div @class([
            'flex-auto border-t-2 transition-colors duration-500',
            'border-[#26392d]' => $currentStep > $biodataStep,
            'border-gray-600' => $currentStep <= $biodataStep,
        ])></div>

        <a href="{{ $currentStep > $biodataStep ? route('applicant.berkas') : '#' }}" @class([
            'relative flex flex-col items-center transition-transform duration-200',
            'hover:scale-105' => $currentStep > $biodataStep,
            'cursor-default' => $currentStep <= $biodataStep,
            'text-[#26392d]' => $currentStep >= $berkasStep,
            'text-gray-400' => $currentStep < $berkasStep,
        ])>
            <div @class([
                'rounded-full h-10 w-10 flex items-center justify-center text-white font-bold text-lg',
                'bg-[#26392d]' => $currentStep >= $berkasStep,
                'bg-gray-700' => $currentStep < $berkasStep,
                'ring-4 ring-[#26392d]/30' => $currentStep == $berkasStep,
            ])>
                @if ($currentStep > $berkasStep) ✓ @else {{ $berkasStep }} @endif
            </div>
            <div class="absolute top-12 text-xs sm:text-sm font-semibold text-[#26392d]">Berkas</div>
        </a>

        <div @class([
            'flex-auto border-t-2 transition-colors duration-500',
            'border-[#26392d]' => $currentStep > $berkasStep,
            'border-gray-600' => $currentStep <= $berkasStep,
        ])></div>

        <a href="{{ $currentStep > $berkasStep ? route('applicant.jadwal') : '#' }}" @class([
            'relative flex flex-col items-center transition-transform duration-200',
            'hover:scale-105' => $currentStep > $berkasStep,
            'cursor-default' => $currentStep <= $berkasStep,
            'text-[#26392d]' => $currentStep >= $jadwalStep,
            'text-gray-400' => $currentStep < $jadwalStep,
        ])>
            <div @class([
                'rounded-full h-10 w-10 flex items-center justify-center text-white font-bold text-lg',
                'bg-[#26392d]' => $currentStep >= $jadwalStep,
                'bg-gray-700' => $currentStep < $jadwalStep,
                'ring-4 ring-[#26392d]/30' => $currentStep == $jadwalStep,
            ])>
                @if ($currentStep > $jadwalStep) ✓ @else {{ $jadwalStep }} @endif
            </div>
            <div class="absolute top-12 text-xs sm:text-sm font-semibold text-[#26392d]">Jadwal</div>
        </a>
    </div>
</div>