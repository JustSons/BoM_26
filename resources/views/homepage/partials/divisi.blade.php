<style>
    .divisi-card {
        perspective: 1000px;
        cursor: pointer;
        /* Mobile: 11rem wide, 20rem tall */
        width: 12rem;
        height: 18rem;
        flex-shrink: 0;
    }

    /* iphone SE */
    @media (max-width: 420px) {
        .divisi-card {
            width: 10rem;
            height: 15rem;
        }

        .card-back-desc {
            font-size: 0.65rem !important;
            font-weight: normal;
        }

        .card-icon {
            width: 7rem;
            height: 7rem;
        }
    }

    /* Tablet 640px+ */
    @media (min-width: 640px) {
        .divisi-card {
            width: 13rem;
            height: 21.25rem;
        }
    }

    /* Desktop 1024px+ */
    @media (min-width: 1024px) {
        .divisi-card {
            width: 15rem;
            height: 23.75rem;
        }
    }

    .divisi-card__inner {
        position: relative;
        width: 100%;
        height: 100%;
        transition: transform 0.6s cubic-bezier(.4, 0, .2, 1);
        transform-style: preserve-3d;
    }

    .divisi-card.flipped .divisi-card__inner {
        transform: rotateY(180deg);
    }

    .divisi-card__front,
    .divisi-card__back {
        position: absolute;
        inset: 0;
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
        background: #26392d !important;
        border: 2px solid #CC7434;
        border-radius: 1rem;
    }

    .divisi-card__back {
        transform: rotateY(180deg);
    }

    /* ── Swiper slide: width matches card exactly, no stretch ── */
    #divisi-swiper .swiper-slide {
        width: 11rem;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.4s ease, opacity 0.4s ease;
        opacity: 0.45;
        transform: scale(0.78);
    }

    @media (min-width: 640px) {
        #divisi-swiper .swiper-slide {
            width: 13rem;
        }
    }

    @media (min-width: 1024px) {
        #divisi-swiper .swiper-slide {
            width: 15rem;
        }
    }

    #divisi-swiper .swiper-slide-active {
        opacity: 1 !important;
        transform: scale(1) !important;
    }

    #divisi-swiper .swiper-slide-prev,
    #divisi-swiper .swiper-slide-next {
        opacity: 0.72 !important;
        transform: scale(0.88) !important;
    }

    /* ── Front face ── */
    .divisi-card__front {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .card-icon {
        width: 9rem;
        height: 9rem;
        object-fit: contain;
        margin-bottom: 0.875rem;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, .4));
        transition: transform 0.3s cubic-bezier(.4, 0, .2, 1);
    }

    .divisi-card:not(.flipped):hover .card-icon {
        transform: scale(1.5);
    }

    @media (min-width: 640px) {
        .card-icon {
            width: 7rem;
            height: 7rem;
            margin-bottom: 1rem;
        }
    }

    @media (min-width: 1024px) {
        .card-icon {
            width: 10rem;
            height: 10rem;
            margin-bottom: 1.125rem;
        }
    }

    .card-title {
        font-size: 0.9375rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #fff;
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
        text-align: center;
        line-height: 1.3;
    }

    @media (min-width: 640px) {
        .card-title {
            font-size: 1.0625rem;
        }
    }

    @media (min-width: 1024px) {
        .card-title {
            font-size: 1.125rem;
        }
    }

    .card-hint {
        font-size: 0.9rem;
        font-weight: 700;
        margin-top: 0.375rem;
        color: #CC7434;
        font-family: 'Raleway', sans-serif;
    }

    @media (min-width: 640px) {
        .card-hint {
            font-size: 0.75rem;
            margin-top: 0.5rem;
        }
    }

    @media (min-width: 1024px) {
        .card-hint {
            font-size: 0.8125rem;
            margin-top: 0.625rem;
        }
    }

    /* ── Back face ── */
    .divisi-card__back {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 1.25rem;
    }

    @media (min-width: 640px) {
        .divisi-card__back {
            padding: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .divisi-card__back {
            padding: 1.75rem;
        }
    }

    .card-back-title {
        font-size: 1rem;
        margin-bottom: 0.625rem;
        color: #fff;
        font-family: 'Raleway', sans-serif;
        font-weight: 700;
        text-align: center;
    }

    @media (min-width: 640px) {
        .card-back-title {
            font-size: 1.0625rem;
            margin-bottom: 0.75rem;
        }
    }

    @media (min-width: 1024px) {
        .card-back-title {
            font-size: 1.125rem;
            margin-bottom: 0.875rem;
        }
    }

    .card-back-desc {
        font-size: 0.8rem;
        line-height: 1.6;
        font-weight: 700;
        color: #CC7434;
        font-family: 'Raleway', sans-serif;
        text-align: center;
    }

    @media (min-width: 640px) {
        .card-back-desc {
            font-size: 0.8125rem;
        }
    }

    @media (min-width: 1024px) {
        .card-back-desc {
            font-size: 0.875rem;
        }
    }
</style>

<section class="relative w-full py-16 sm:py-24 overflow-hidden">

    <!-- Section Title -->
    <div class="text-center mb-10 px-4" data-aos="fade-up">
        <h2
            class="font-raleway font-extrabold text-[#26392d] drop-shadow-[0_0_15px_rgba(38,57,45,0.6)] text-3xl sm:text-4xl lg:text-6xl tracking-tight">
            DIVISIONS
        </h2>
    </div>

    <!-- Swiper Carousel -->
    <div id="divisi-swiper" class="swiper w-full px-8 sm:px-12 py-6">
        <div class="swiper-wrapper">

            <!-- ── 1. Sponsor ── -->
            <div class="swiper-slide">
                <div class="divisi-card">
                    <div class="divisi-card__inner">
                        <div class="divisi-card__front shadow-lg shadow-indigo-900/40">
                            <img src="{{ asset('assets/logo sponsor.webp') }}" alt="Sponsor" class="card-icon">
                            <span class="card-title">Sponsor</span>
                            <span class="card-hint">Tap to flip</span>
                        </div>
                        <div class="divisi-card__back shadow-lg shadow-indigo-900/40">
                            <h3 class="card-back-title">Sponsor</h3>
                            <p class="card-back-desc">
                                Divisi yang mencari, menjalin, dan mengelola kerja sama dengan sponsor serta memastikan
                                pemenuhan hak dan kewajiban sponsor sesuai kesepakatan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── 2. Materi ── -->
            <div class="swiper-slide">
                <div class="divisi-card">
                    <div class="divisi-card__inner">
                        <div class="divisi-card__front shadow-lg shadow-emerald-900/40">
                            <img src="{{ asset('assets/logo materi.webp') }}" alt="Materi" class="card-icon">
                            <span class="card-title">Materi</span>
                            <span class="card-hint">Tap to flip</span>
                        </div>
                        <div class="divisi-card__back shadow-lg shadow-emerald-900/40">
                            <h3 class="card-back-title">Materi</h3>
                            <p class="card-back-desc">
                                Divisi yang bertugas merancang dan menyusun soal-soal yang inovatif, berbasis STEM, yang
                                disesuaikan dengan karakteristik siswa/i SMA.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── 3. Transkapman ── -->
            <div class="swiper-slide">
                <div class="divisi-card">
                    <div class="divisi-card__inner">
                        <div class="divisi-card__front shadow-lg shadow-amber-900/40">
                            <img src="{{ asset('assets/logo transkapman.webp') }}" alt="Transkapman" class="card-icon">
                            <span class="card-title">Transkapman</span>
                            <span class="card-hint">Tap to flip</span>
                        </div>
                        <div class="divisi-card__back shadow-lg shadow-amber-900/40">
                            <h3 class="card-back-title">Transkapman</h3>
                            <p class="card-back-desc">
                                Divisi yang bertanggung jawab atas pengadaan dan pengelolaan perlengkapan, pengaturan
                                transportasi, serta menjaga keamanan dan ketertiban selama acara berlangsung.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── 4. Acara ── -->
            <div class="swiper-slide">
                <div class="divisi-card">
                    <div class="divisi-card__inner">
                        <div class="divisi-card__front shadow-lg shadow-rose-900/40">
                            <img src="{{ asset('assets/logo acara.webp') }}" alt="Acara" class="card-icon">
                            <span class="card-title">Acara</span>
                            <span class="card-hint">Tap to flip</span>
                        </div>
                        <div class="divisi-card__back shadow-lg shadow-rose-900/40">
                            <h3 class="card-back-title">Acara</h3>
                            <p class="card-back-desc">
                                Divisi yang bertanggung jawab atas perencanaan konsep acara, penyusunan alur kegiatan,
                                serta pelaksanaan keseluruhan acara dari awal hingga akhir.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── 5. Creative ── -->
            <div class="swiper-slide">
                <div class="divisi-card">
                    <div class="divisi-card__inner">
                        <div class="divisi-card__front shadow-lg shadow-fuchsia-900/40">
                            <img src="{{ asset('assets/logo creative.webp') }}" alt="Creative" class="card-icon">
                            <span class="card-title">Creative</span>
                            <span class="card-hint">Tap to flip</span>
                        </div>
                        <div class="divisi-card__back shadow-lg shadow-fuchsia-900/40">
                            <h3 class="card-back-title">Creative</h3>
                            <p class="card-back-desc">
                                Divisi yang mengelola visual dan kreativitas acara, termasuk desain konten, dekorasi,
                                dokumentasi, dan publikasi untuk meningkatkan daya tarik acara.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── 6. IT ── -->
            <div class="swiper-slide">
                <div class="divisi-card">
                    <div class="divisi-card__inner">
                        <div class="divisi-card__front shadow-lg shadow-cyan-900/40">
                            <img src="{{ asset('assets/logo IT.webp') }}" alt="IT" class="card-icon">
                            <span class="card-title">IT</span>
                            <span class="card-hint">Tap to flip</span>
                        </div>
                        <div class="divisi-card__back shadow-lg shadow-cyan-900/40">
                            <h3 class="card-back-title">IT</h3>
                            <p class="card-back-desc">
                                Divisi yang menangani kebutuhan teknis berbasis teknologi, seperti sistem pendaftaran,
                                pengelolaan data peserta, perangkat lomba, dan dukungan teknis selama acara.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── 7. Sekkonkes ── -->
            <div class="swiper-slide">
                <div class="divisi-card">
                    <div class="divisi-card__inner">
                        <div class="divisi-card__front shadow-lg shadow-lime-900/40">
                            <img src="{{ asset('assets/logo sekkonkes.webp') }}" alt="Sekkonkes" class="card-icon">
                            <span class="card-title">Sekkonkes</span>
                            <span class="card-hint">Tap to flip</span>
                        </div>
                        <div class="divisi-card__back shadow-lg shadow-lime-900/40">
                            <h3 class="card-back-title">Sekkonkes</h3>
                            <p class="card-back-desc">
                                Divisi yang mengelola administrasi dan surat, mengatur konsumsi panitia dan peserta,
                                serta menangani kebutuhan kesehatan selama acara.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── 8. Public Relation ── -->
            <div class="swiper-slide">
                <div class="divisi-card">
                    <div class="divisi-card__inner">
                        <div class="divisi-card__front shadow-lg shadow-blue-900/40">
                            <img src="{{ asset('assets/logo PR.webp') }}" alt="Public Relation" class="card-icon">
                            <span class="card-title">Public Relation</span>
                            <span class="card-hint">Tap to flip</span>
                        </div>
                        <div class="divisi-card__back shadow-lg shadow-blue-900/40">
                            <h3 class="card-back-title">Public Relation</h3>
                            <p class="card-back-desc">
                                Divisi yang bertanggung jawab mengelola komunikasi dan informasi acara, serta membangun
                                citra acara melalui media sosial, publikasi informasi, dan hubungan peserta, sekolah,
                                serta pihak terkait lainnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const divisiSwiper = new Swiper('#divisi-swiper', {
            centeredSlides: true,
            slidesPerView: 3,
            spaceBetween: 150,
            loop: true,
            grabCursor: true,
            speed: 400,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },

            breakpoints: {
                420: {
                    slidesPerView: 3,
                    spaceBetween: 180,
                },
                640: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1040: {
                    slidesPerView: 5,
                    spaceBetween: 20,
                },
            },
        });

        const cards = document.querySelectorAll('#divisi-swiper .divisi-card');

        cards.forEach(function (card) {
            card.addEventListener('click', function (e) {
                e.stopPropagation();

                this.classList.toggle('flipped');

                const anyFlipped = document.querySelector(
                    '#divisi-swiper .divisi-card.flipped'
                );

                if (anyFlipped) {
                    divisiSwiper.autoplay.stop();
                } else {
                    divisiSwiper.autoplay.start();
                }
            });
        });
    });
</script>