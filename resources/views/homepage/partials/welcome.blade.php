<style>
    body {
        overflow-x: hidden;
    }

    #hero {
        position: relative;
        overflow: visible;
    }


    .hero-content {
        position: relative;
        z-index: 10;
        /* padding-bottom: 10rem; */

    }

    .gradient-button {
        position: relative;
        display: inline-block;
        padding: 1rem 2.5rem;
        font-size: 1.125rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: #75a2dd;
        border: none;
        border-radius: 9999px;
        color: white;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        box-shadow: 0 4px 15px rgba(77, 127, 193, 0.4),
            0 0 0 0 rgba(16, 185, 129, 0.5);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        cursor: pointer;
    }

    .gradient-button::before {
        content: '';
        position: absolute;
        inset: -3px;
        border-radius: 9999px;
        padding: 3px;
        background: linear-gradient(135deg, #bed0e8, #75a2dd, #4d7fc1);
        -webkit-mask: linear-gradient(#d19537 0 0) content-box, linear-gradient(#d19537 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .gradient-button::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }

    .gradient-button:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 25px rgba(255, 255, 255, 0.6),
            0 0 0 8px rgba(255, 255, 255, 0.3);
        background: white;
        color: #75a2dd;
    }

    .gradient-button:hover::before {
        opacity: 1;
    }

    .gradient-button:hover::after {
        width: 300px;
        height: 300px;
    }

    .gradient-button:active {
        transform: translateY(0) scale(0.98);
    }

    .gradient-button span {
        position: relative;
        z-index: 1;
    }

    /* Shimmer effect */
    .gradient-button-shimmer {
        position: relative;
        overflow: hidden;
    }

    .gradient-button-shimmer::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent);
        transition: left 0.5s ease;
    }

    .gradient-button-shimmer:hover::before {
        left: 100%;
    }

    /* @media (max-width: 768px) {
        .hero-content {
            position: relative;
            z-index: 10;
            padding-bottom: 10rem;
        }

    }

    @media (max-width: 480px) {

        .hero-content {
            padding-bottom: 6rem;
        }

    }

    @media (min-width: 1200px) {

        .hero-content {
            padding-bottom: 8rem;
        }

    } */
</style>

<section id="hero"
    class="relative w-screen h-screen flex flex-col justify-center items-center text-center text-black px-4">

    <!-- Background Buildings & Land -->
    {{-- <img src="{{ asset('assets/welcome-left-building.webp') }}" alt="Left Building" class="building-left">
    <img src="{{ asset('assets/welcome-full-Kincir.webp') }}" alt="Left Building" class="building-left">
    <img src="{{ asset('assets/welcome-land.webp') }}" alt="Land" class="land-center">
    <img src="{{ asset('assets/CLOUD-SEGARIS-02.webp') }}" alt="Cloud" class="cloud-bottom cloud-bottom-1">
    <img src="{{ asset('assets/welcome-pohon-pinggirnya.webp') }}" alt="Land" class="land-center"
        id="left-right-tree">
    <img src="{{ asset('assets/welcome-the-left-of-right-building.webp') }}" alt="Middle Right Building"
        class="the-left-of-right-building">
    <img src="{{ asset('assets/welcome-right-building.webp') }}" alt="Right Building" class="building-right">
    <img src="{{ asset('assets/PLANE-CUT.webp') }}" alt="Plane" class="plane">
    <img src="{{ asset('assets/welcome-awan.webp') }}" alt="cloud" class="cloud-bg"> --}}

    <!-- Hero Content -->
    <div class="hero-content">
        <h2 class="font-raleway text-2xl md:text-5xl font-bold text-white  drop-shadow-[0_0_15px_rgba(211,213,215,0.9)]"
            style="">
            OPEN RECRUITMENT
        </h2>
        <h1
            class="font-raleway text-6xl md:text-7xl font-extrabol mt-1 sm:mt-3 md:mt-3 lg:mt-6 text-white drop-shadow-[0_0_15px_rgba(211,213,215,0.9)] tracking-wider">
            BATTLE OF MINDS
        </h1>
        <h2 class="font-raleway text-3xl md:text-5xl font-extrabold -mt-5 md:-mt-10 text-white  drop-shadow-[0_0_15px_rgba(211,213,215,0.9)]"
            style="">2026</h2>
        <p class="font-raleway mt-4 text-2xl
            md:text-4xl font-bold text-white mb-4 italic"
            style="text-shadow: 0 0 15px rgba(255,255,255,0.8);">
            Expedition Search Of Oracle Artifact
        </p>
        <a href="{{ route('applicant.registerNow') }}" class="gradient-button gradient-button-shimmer mt-2">
            Register Here
        </a>
    </div>
</section>
