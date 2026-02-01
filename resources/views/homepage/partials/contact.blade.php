<style>
    .contact-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.2;
        animation: orbFloat 25s infinite ease-in-out;
    }

    /* .orb-1 {
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, #60a5fa, #3b82f6);
        top: -10%;
        left: -10%;
        animation-delay: 0s;
    }

    .orb-2 {
        width: 350px;
        height: 350px;
        background: linear-gradient(135deg, #a78bfa, #8b5cf6);
        bottom: -10%;
        right: -10%;
        animation-delay: 8s;
    }

    .orb-3 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #ec4899, #d946ef);
        top: 50%;
        left: 50%;
        animation-delay: 16s;
    } */

    @keyframes orbFloat {

        0%,
        100% {
            transform: translate(0, 0) scale(1);
        }

        25% {
            transform: translate(50px, -50px) scale(1.1);
        }

        50% {
            transform: translate(-30px, 30px) scale(0.9);
        }

        75% {
            transform: translate(40px, 40px) scale(1.05);
        }
    }

    @keyframes ping-slow {
        0% {
            transform: scale(1);
            opacity: 0.2;
        }

        50% {
            transform: scale(1.5);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 0.2;
        }
    }

    @keyframes ping-slower {
        0% {
            transform: scale(1);
            opacity: 0.15;
        }

        50% {
            transform: scale(2);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 0.15;
        }
    }

    .animate-ping-slow {
        animation: ping-slow 4s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    .animate-ping-slower {
        animation: ping-slower 6s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    /* Contact Grid Layout */
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        align-items: center;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    @media (min-width: 1024px) {
        .contact-grid {
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
        }
    }

    .contact-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 300px;
    }

    /* Social Links Grid */
    .social-links-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        justify-items: center;
        align-items: center;
        width: 100%;
        max-width: 300px;
        margin: 0 auto;
    }

    @media (min-width: 640px) {
        .social-links-grid {
            gap: 2rem;
            max-width: 350px;
        }
    }

    /* Social Icons Responsive Sizing */
    .social-icon {
        width: 2.5rem;
        height: 2.5rem;
        object-fit: contain;
        drop-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    @media (min-width: 640px) {
        .social-icon {
            width: 3rem;
            height: 3rem;
        }
    }

    @media (min-width: 1024px) {
        .social-icon {
            width: 3.5rem;
            height: 3.5rem;
        }
    }

    .social-tooltip {
        position: absolute;
        bottom: -2.5rem;
        left: 50%;
        transform: translateX(-50%);
        font-family: 'Raleway', sans-serif;
        font-size: 0.875rem;
        color: #d3d5d2;
        opacity: 0;
        transition: opacity 0.3s ease;
        white-space: nowrap;
        font-weight: 600;
    }

    .social-link:hover .social-tooltip {
        opacity: 1;
    }

    /* Logos Section */
    .logos-section {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        align-items: center;
        width: 100%;
    }

    .main-logos {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        align-items: center;
        justify-items: center;
        width: 100%;
        max-width: 400px;
    }

    @media (min-width: 640px) {
        .main-logos {
            gap: 1.5rem;
            max-width: 450px;
        }
    }

    .faculty-logos {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        align-items: center;
        justify-items: center;
        width: 100%;
        max-width: 350px;
    }

    @media (min-width: 640px) {
        .faculty-logos {
            gap: 2rem;
            max-width: 400px;
        }
    }

    .logo-item {
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .logo-item:hover {
        transform: scale(1.05);
    }

    /* Main Logos Sizing */
    .main-logo {
        width: 100%;
        max-width: 120px;
        height: auto;
        object-fit: contain;
        filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.2));
    }

    @media (min-width: 640px) {
        .main-logo {
            max-width: 140px;
        }
    }

    @media (min-width: 1024px) {
        .main-logo {
            max-width: 160px;
        }
    }

    .bom-logo {
        transform: scale(0.8);
    }

    /* Faculty Logos Sizing */
    .faculty-logo {
        width: 100%;
        max-width: 100px;
        height: auto;
        object-fit: contain;
        filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.15));
    }

    @media (min-width: 640px) {
        .faculty-logo {
            max-width: 120px;
        }
    }

    @media (min-width: 1024px) {
        .faculty-logo {
            max-width: 140px;
        }
    }

    .fti-logo {
        transform: scale(0.9);
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .contact-orb {
            filter: blur(70px);
        }
    }

    @media (max-width: 768px) {
        .contact-orb {
            filter: blur(60px);
        }

        .orb-1,
        .orb-2,
        .orb-3 {
            width: 250px;
            height: 250px;
        }
    }

    @keyframes sonar-pulse {
    0% {
        transform: scale(1);
        opacity: 0.5;
    }
    100% {
        transform: scale(1.1);
        opacity: 0;
    }
}

.animate-sonar {
    position: absolute;
    inset: 0;
    z-index: -1; 
    border: 2px solid #d3d5d2; 
    border-radius: 1.5rem; 
    animation: sonar-pulse 2s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
}
</style>

<section id="contact" class="relative flex w-screen min-h-screen py-20 overflow-hidden">

    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="contact-orb orb-1"></div>
        <div class="contact-orb orb-2"></div>
        <div class="contact-orb orb-3"></div>
    </div>

    <div class="absolute inset-0 opacity-10"
        style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 50px 50px;"></div>

    <div class="relative z-10 flex flex-col w-full justify-center items-center px-4 md:px-8">
        <div class="w-full max-w-7xl" data-aos="zoom-in" data-aos-duration="1000">
            <div
                class="relative bg-[#26392d] backdrop-blur-xl border-2 border-[#6f8c55] rounded-3xl p-8 md:p-12 lg:p-16 shadow-2xl hover:shadow-[0_0_60px_rgba(0,0,0,0.3)] transition-all duration-500">
                <div class="animate-sonar"></div>
                <!-- Contact Grid Container -->
                <div class="contact-grid">
                    <!-- Left Section: Contact Info & Social Links -->
                    <div class="contact-section contact-info" data-aos="fade-left" data-aos-duration="800" data-aos-delay="400">
                        <div class="text-center mb-8">
                            <h2 class="font-raleway font-extrabold text-3xl md:text-4xl lg:text-5xl mb-3 bg-gradient-to-r from-[#ffffff] via-[#d3d5d2] to-[#a8aca7] bg-clip-text text-transparent">
                                Contact Us
                            </h2>
                            <p class="font-raleway font-bold text-[#d19537] text-sm md:text-base lg:text-lg">
                                Have questions? Feel Free to Ask Us!
                            </p>
                        </div>

                        <div class="social-links-grid">
                            <a href="https://www.instagram.com/bom.pcu/" target="_blank" class="social-link group relative" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="600">
                                <div class="absolute -inset-2 bg-gradient-to-br from-pink-400 via-purple-400 to-indigo-500 rounded-2xl blur-lg opacity-0 group-hover:opacity-70 transition-all duration-500"></div>
                                <div class="relative bg-gradient-to-br from-pink-400 via-purple-400 to-indigo-500 p-4 md:p-5 rounded-2xl shadow-xl hover:shadow-2xl transform hover:scale-110 hover:-rotate-6 transition-all duration-500">
                                    <img src="{{ asset('assets/instagram-1-svgrepo-com.png') }}" alt="Instagram" class="social-icon">
                                </div>
                                <span class="social-tooltip">Follow us</span>
                            </a>
                            
                            <a href="https://line.me/R/ti/p/@092sqzfy" target="_blank" class="social-link group relative" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="700">
                                <div class="absolute -inset-2 bg-gradient-to-br from-green-400 to-green-500 rounded-2xl blur-lg opacity-0 group-hover:opacity-70 transition-all duration-500"></div>
                                <div class="relative bg-gradient-to-br from-green-400 to-green-500 p-4 md:p-5 rounded-2xl shadow-xl hover:shadow-2xl transform hover:scale-110 transition-all duration-500">
                                    <img src="{{ asset('assets/line-messenger-logo-svgrepo-com.png') }}" alt="LINE" class="social-icon">
                                </div>
                                <span class="social-tooltip">Chat on LINE</span>
                            </a>
                            
                            <a href="https://www.tiktok.com/@battleofminds.pcu" target="_blank" class="social-link group relative" data-aos="zoom-in" data-aos-duration="600" data-aos-delay="800">
                                <div class="absolute -inset-2 bg-gray-600 rounded-2xl blur-lg opacity-0 group-hover:opacity-70 transition-all duration-500"></div>
                                <div class="relative bg-gray-800 p-4 md:p-5 rounded-2xl shadow-xl hover:shadow-2xl transform hover:scale-110 hover:rotate-6 transition-all duration-500">
                                    <img src="{{ asset('assets/toktok.png') }}" alt="TikTok" class="social-icon">
                                </div>
                                <span class="social-tooltip">Follow us</span>
                            </a>
                        </div>
                    </div>

                    <!-- Right Section: Logos -->
                    <div class="contact-section logos-section">
                        <div class="main-logos" data-aos="fade-right" data-aos-duration="800" data-aos-delay="200">
                            <div class="logo-item">
                                <img src="{{ asset('assets/PCU-LOGO.png') }}" class="main-logo" alt="PCU Logo">
                            </div>
                            <div class="logo-item">
                                <img src="{{ asset('assets/BOM Logo.png') }}" class="main-logo bom-logo" alt="BOM Logo">
                            </div>
                        </div>

                        <div class="faculty-logos" data-aos="fade-right" data-aos-duration="800" data-aos-delay="400">
                            <div class="logo-item">
                                <img src="{{ asset('assets/FTSP Logo.png') }}" class="faculty-logo" alt="FTSP Logo">
                            </div>
                            <div class="logo-item">
                                <img src="{{ asset('assets/FTI Logo.png') }}" class="faculty-logo fti-logo" alt="FTI Logo">
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="pt-8 border-t border-gray-300 w-full max-w-xl">
                        <p class="font-raleway text-center text-gray-600 text-sm md:text-base">
                            <span class="font-bold text-[#d3d5d2] text-base md:text-lg">&copy IT X CREATIVE BATTLE OF MINDS 2026</span><br>
                            <span class="text-[#d3d5d2] font-semibold">ALL RIGHTS RESERVED.</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Decorative elements -->
        {{-- <div
            class="absolute bottom-10 left-10 w-32 h-32 border-4 border-white/20 rounded-full animate-ping-slow hidden lg:block">
        </div>
        <div
            class="absolute top-20 right-20 w-24 h-24 border-4 border-white/20 rounded-full animate-ping-slower hidden lg:block">
        </div> --}}
    </div>
</section>
