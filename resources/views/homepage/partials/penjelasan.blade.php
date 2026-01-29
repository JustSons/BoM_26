 <style>
     #about {
         overflow: visible;
     }

     /* #aboutContent {
         animation: fadeInUp 1s ease-out forwards;
     } */

     /* @keyframes fadeInUp {
         from {
             opacity: 0;
             transform: translateY(30px) scale(0.95);
         }

         to {
             opacity: 1;
             transform: translateY(0) scale(1);
         }
     }

     .badge {
         animation: badgeFadeIn 0.6s ease-out forwards;
         position: relative;
         overflow: hidden;
     }

     .badge::before {
         content: '';
         position: absolute;
         inset: 0;
         background: linear-gradient(to right, #047857, #059669, #10b981);
         opacity: 0;
         transition: opacity 0.5s ease-out;
         border-radius: 0.75rem;
     }

     .badge:hover::before {
         opacity: 1;
     }

     .badge span {
         position: relative;
         z-index: 1;
     }

     .badge:nth-child(1) {
         animation-delay: 0.3s;
     }

     .badge:nth-child(2) {
         animation-delay: 0.5s;
     }

     .badge:nth-child(3) {
         animation-delay: 0.7s;
     }

     @keyframes badgeFadeIn {
         from {
             opacity: 0;
             transform: translateY(20px);
         }

         to {
             opacity: 1;
             transform: translateY(0);
         }
     }

     .badge {
         opacity: 0;
     } */
 </style>
 <section id="about"
     class="w-screen min-h-screen relative overflow-hidden flex items-center justify-center px-6 py-20 mt-20">
     <div
         class="absolute top-0 left-0 w-[25rem] h-[25rem] rounded-full mix-blend-multiply filter blur-3xl opacity-10 bg-[#596c48] animate-pulse">
     </div>
     <div class="absolute bottom-0 right-0 w-[25rem] h-[25rem] rounded-full mix-blend-multiply filter blur-3xl opacity-10 bg-[#596c48] animate-pulse"
         style="animation-delay: 2s;"></div>

     <div id="aboutContent" class="relative text-center max-w-4xl mx-auto px-4">
         <div
             class="w-full mx-auto p-8 md:p-12 rounded-3xl bg-[#26392d] bg-gradient-to-r from-[#202c24] via-[#26392d] to-[#324539] backdrop-blur-md border border-white/20 shadow-2xl ring-1 ring-white/10">
             <h1
                 class="font-raleway text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-8 bg-gradient-to-r from-[#6f934e] via-[#6f8c55] to-[#8ba376] bg-clip-text text-transparent leading-tight tracking-wider">
                 BATTLE OF MINDS 2026
             </h1>

             <div id="aboutText"
                 class="font-raleway text-justify font-bold space-y-6 text-[#d19537] text-sm md:text-lg leading-relaxed mb-8">
                 <p>
                    Sejalan dengan visi Indonesia Emas 2045, penting bagi generasi muda untuk memahami dan tertarik pada bidang STEM. 
                     Karena itu, Battle of Minds hadir sebagai lomba matematika dan logika yang dirancang sesuai dengan karakter siswa/i SMA. 

                 </p>
                 <p>
                     Lomba ini bertujuan untuk membantu siswa/i terus berkembang, melatih kemampuan berpikir logis, serta menumbuhkan semangat belajar dan kerja sama dalam bidang akademik. 
                     Battle of Minds akan diselenggarakan pada Juli 2026 sebagai wadah kompetisi akademik yang menantang, edukatif, dan relevan bagi siswa/i SMA.
                 </p>
             </div>

             {{-- <div class="font-organetto flex flex-wrap justify-center gap-4 mt-6">
                 <div
                     class="badge px-6 py-3 bg-gradient-to-r from-green-600 via-green-500 to-green-300 border border-green-500 rounded-xl backdrop-blur-sm hover:from-green-700 hover:via-green-600 hover:to-green-400 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/50 hover:-translate-y-1 transition-all duration-5000 ease-out shadow-lg">
                     <span class="text-white font-semibold text-sm md:text-base">Bridge Competition</span>
                 </div>
                 <div
                     class="badge px-6 py-3 bg-gradient-to-r from-green-600 via-green-500 to-green-500 border border-green-300 rounded-xl backdrop-blur-sm hover:from-green-700 hover:via-green-600 hover:to-green-600 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/50 hover:-translate-y-1 transition-all duration-500 ease-out shadow-lg">
                     <span class="text-white font-semibold text-sm md:text-base">Lomba Kuat Tekan Beton</span>
                 </div>
                 <div
                     class="badge px-6 py-3 bg-gradient-to-r from-green-600 via-green-500 to-green-300 border border-green-500 rounded-xl backdrop-blur-sm hover:from-green-700 hover:via-green-600 hover:to-green-400 hover:scale-105 hover:shadow-2xl hover:shadow-green-500/50 hover:-translate-y-1 transition-all duration-500 ease-out shadow-lg ">
                     <span class="text-white font-semibold text-sm md:text-base">Earthquake Resistance Design
                         Competition</span>
                 </div>
             </div> --}}
         </div>
     </div>

 </section>

 <script>
    if (history.scrollRestoration) {
        history.scrollRestoration = 'manual';
    }
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
     document.addEventListener("DOMContentLoaded", () => {
         gsap.registerPlugin(ScrollTrigger);

         const aboutContent = document.getElementById("aboutContent");
         const paragraphs = document.querySelectorAll("#aboutText p");

         ScrollTrigger.refresh();
        gsap.fromTo(aboutContent, 
            {
                opacity: 0, 
                y: 100, 
                scale: 0.9 
            },
            {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 1.4,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: aboutContent,
                    start: "top 80%",
                    markers: true,
                    toggleActions: "play none none reverse" 
                }
            }
        );

         // Create overlay
         paragraphs.forEach((p, i) => {
             const wrapper = document.createElement("span");
             wrapper.style.position = "relative";
             wrapper.style.display = "inline-block";
             wrapper.innerHTML = p.innerHTML;
             p.innerHTML = "";
             p.appendChild(wrapper);

             const overlay = document.createElement("span");
             overlay.className = "absolute bottom-0 left-0 bg-[#6f8c55] rounded-sm";
             overlay.style.height = "100%";
             overlay.style.width = "100%";
             overlay.style.transformOrigin = i % 2 === 0 ? "right" : "right";
             overlay.style.transform = "scaleX(1)";
             overlay.style.zIndex = "5";
             wrapper.appendChild(overlay);

            const tl = gsap.timeline({
                    scrollTrigger: {
                        trigger: p,
                        start: "top 85%",
                        toggleActions: "play none none reverse", 
                    }
                });
            tl.fromTo(p, 
                { opacity: 0, y: 40 }, 
                { opacity: 1, y: 0, duration: 1.2, ease: "power3.out" }
            )
            .to(overlay, 
                { scaleX: 0, duration: 1.2, ease: "power2.out" }, 
                "<0.1" 
            );
         });
     });
 </script>
