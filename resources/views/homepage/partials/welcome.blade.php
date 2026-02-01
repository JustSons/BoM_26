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
    }

    .register-button {
        position: relative;
        overflow: hidden;
        padding: 1rem 2.5rem;
        font-size: 1.2rem;
        color: #26392d;
        cursor: pointer;
        z-index: 1;
        transition: all 0.5s ease;
        animation: pulse-shadow 2s ease-in-out infinite;
    }

    .register-button::before {
        content: "";
        position: absolute;
        inset: 0;
        background: url('{{ asset('assets/sign.webp') }}') no-repeat center center;
        background-size: cover;
        transform: scale(1);
        transition: transform 0.15s ease;
        z-index: -1;
    }

    /* Pause pulse on hover */
    .register-button:hover {
        font-size: 1.5rem;
        animation-play-state: paused;
        filter: drop-shadow(0 8px 16px rgba(204, 116, 52, 0.75));
        transition: all 0.5s ease;
    }

    /* Shrink both text and bg on click, pause pulse */
    .register-button:active {
        animation-play-state: paused;
        font-size: 1rem;
        transform: scale(1);
        filter: drop-shadow(0 2px 4px rgba(204, 116, 52, 0.4));
        transition: all 0.1s ease;
    }

    .register-button:active::before {
        transform: scale(1);
        transition: transform 0.1s ease;
    }

    /* Pulse keyframes: shadow grows and shrinks */
    @keyframes pulse-shadow {

        0%,
        100% {
            filter:
                drop-shadow(0 4px 8px rgba(204, 116, 52, 0.7)) drop-shadow(0 0 12px rgba(204, 116, 52, 0.6));
        }

        50% {
            filter:
                drop-shadow(0 6px 14px rgba(204, 116, 52, 0.95)) drop-shadow(0 0 22px rgba(204, 116, 52, 0.85));
        }
    }
</style>

<section id="hero"
    class="relative w-screen h-screen flex flex-col justify-center items-center text-center text-black px-4">
    <!-- Hero Content -->
    <div class="hero-content">
        <h2 class="font-raleway text-2xl md:text-5xl font-bold text-[#26392d] drop-shadow-[0_0_15px_rgba(38,57,45,0.6)]"
            data-aos="fade-down" data-aos-duration="800">
            OPEN RECRUITMENT
        </h2>
        <h1 class="font-raleway text-6xl md:text-7xl font-extrabold mt-1 sm:mt-3 md:mt-3 lg:mt-6 text-[#26392d] drop-shadow-[0_0_15px_rgba(38,57,45,0.6)] tracking-wider"
            data-aos="fade-down" data-aos-duration="800" data-aos-delay="200">
            BATTLE OF MINDS
        </h1>
        <h2 class="font-raleway text-3xl md:text-5xl font-extrabold text-[#26392d] drop-shadow-[0_0_15px_rgba(38,57,45,0.6)]"
            data-aos="fade-down" data-aos-duration="800" data-aos-delay="400">2026</h2>
        <p class="font-raleway mt-4 text-2xl md:text-4xl font-bold text-[#26392d] mb-4 italic drop-shadow-[0_0_15px_rgba(38,57,45,0.6)]"
            data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
            Expedition Search Of Oracle Artifact
        </p>
        <div class="relative mt-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="800">
            <a href="{{ route('applicant.registerNow') }}" class="register-button font-bold">
                REGISTER HERE
            </a>
        </div>
    </div>
</section>