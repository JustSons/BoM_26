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

    .new-gradient-button {
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
    z-index: 1;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.4s ease;
}

.new-gradient-button::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 150%; 
    height: 300%; 
    background: conic-gradient(
        transparent, 
        rgba(255, 255, 255, 0.8), 
        transparent 30%
    );
    animation: rotate-light 3s linear infinite;
    z-index: -2;
}

.new-gradient-button::after {
    content: '';
    position: absolute;
    inset: 3px;
    background: #75a2dd;
    border-radius: 9999px;
    z-index: -1;
    transition: background 0.4s ease;
}

@keyframes rotate-light {
    from {
        transform: translate(-50%, -50%) rotate(0deg);
    }
    to {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}

.new-gradient-button:hover {
    transform: translateY(-2px) scale(1.05);
    color: #75a2dd;
}

.new-gradient-button:hover::after {
    background: white;
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

    <!-- Hero Content -->
    <div class="hero-content">
        <h2 class="font-raleway text-2xl md:text-5xl font-bold text-white  drop-shadow-[0_0_15px_rgba(211,213,215,0.9)]"
            style="" data-aos="fade-down" data-aos-duration="800">
            OPEN RECRUITMENT
        </h2>
        <h1
            class="font-raleway text-6xl md:text-7xl font-extrabol mt-1 sm:mt-3 md:mt-3 lg:mt-6 text-white drop-shadow-[0_0_15px_rgba(211,213,215,0.9)] tracking-wider"
            data-aos="fade-down" data-aos-duration="800" data-aos-delay="200">
            BATTLE OF MINDS
        </h1>
        <h2 class="font-raleway text-3xl md:text-5xl font-extrabold -mt-5 md:-mt-10 text-white  drop-shadow-[0_0_15px_rgba(211,213,215,0.9)]"
            style="" data-aos="fade-down" data-aos-duration="800" data-aos-delay="400">2026</h2>
        <p class="font-raleway mt-4 text-2xl
            md:text-4xl font-bold text-white mb-4 italic"
            style="text-shadow: 0 0 15px rgba(255,255,255,0.8);" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
            Expedition Search Of Oracle Artifact
        </p>
        <a href="{{ route('applicant.registerNow') }}" class="new-gradient-button mt-2" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
            Register Here
        </a>
    </div>
</section>
