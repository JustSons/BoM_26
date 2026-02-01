<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 80px;
        height: 100vh;
        background: rgba(30, 41, 35, 0.4); 
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        z-index: 9998;
        padding: 6px 14px;
        transition: all 0.5s cubic-bezier(.02, .89, .52, 1.01);
        border-right: 1px solid rgba(255, 255, 255, 0.1);
        overflow: hidden;
        white-space: nowrap;
    }

    .sidebar.active {
        width: 280px;
        background: rgba(30, 41, 35, 0.8);
        box-shadow: 10px 0 30px rgba(0,0,0,0.3);
    }

    .sidebar .logo-menu {
        display: flex;
        align-items: center;
        width: 100%;
        height: 60px;
        margin-bottom: 20px;
        color: white;
        position: relative;
    }

    /* Tombol Toggle Desktop */
    .sidebar .logo-menu .toggle-btn {
        position: absolute;
        left: 0;
        width: 45px;
        height: 45px;
        cursor: pointer;
        transition: .5s;
        fill: none;
        stroke: #fff;
    }

    /* List Menu */
    .sidebar .list {
        padding-left: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .list .list-item {
        list-style: none;
        width: 100%;
        height: 50px;
        line-height: 50px;
    }

    .list .list-item a {
        display: flex;
        align-items: center;
        width: 100%;
        height: 100%;
        border-radius: 12px;
        text-decoration: none;
        color: white;
        transition: all .4s ease;
        position: relative;
    }

    /* Ikon */
    .list .list-item a i {
        min-width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s ease;
    }
    
    .list .list-item a i svg {
        width: 24px; height: 24px; stroke-width: 2px;
    }

    /* Teks Menu */
    .list .list-item .link-name {
        opacity: 0;
        pointer-events: none;
        transition: .3s;
        font-family: 'Raleway', sans-serif;
        font-weight: 600;
        font-size: 1rem;
    }

    .sidebar.active .list .list-item .link-name {
        opacity: 1;
        pointer-events: auto;
        transition-delay: 0.1s;
    }


    .list .list-item a:hover { background: rgba(255, 255, 255, 0.1); }
    
    .list .list-item.current-section a {
        background: linear-gradient(90deg, rgba(74, 222, 128, 0.2), rgba(74, 222, 128, 0.05));
        border-left: 4px solid #AEB5B1;
    }
    .list .list-item.current-section a i { color: #AEB5B1; }
    .list .list-item.current-section .link-name { color: #AEB5B1; }

    .auth-divider {
        margin: 10px 0;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    /* SVG Animation Style */
    .ham { cursor: pointer; -webkit-tap-highlight-color: transparent; transition: transform 400ms; -moz-user-select: none; }
    .hamRotate.active { transform: rotate(45deg); }
    .line { fill: none; transition: stroke-dasharray 400ms, stroke-dashoffset 400ms; stroke: #fff; stroke-width: 5.5; stroke-linecap: round; }
    .ham6 .top { stroke-dasharray: 40 172; }
    .ham6 .middle { stroke-dasharray: 40 111; }
    .ham6 .bottom { stroke-dasharray: 40 172; }
    .ham6.active .top { stroke-dashoffset: -132px; }
    .ham6.active .middle { stroke-dashoffset: -71px; }
    .ham6.active .bottom { stroke-dashoffset: -132px; }

    /* Mobile */
    .mobile-ham-btn {
        display: none;
        position: fixed;
        top: 20px;
        left: 20px;
        width: 50px;
        height: 50px;
        background: rgba(30, 41, 35, 0.8); 
        backdrop-filter: blur(10px);
        border-radius: 12px;
        z-index: 10000; 
        box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .mobile-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0,0,0,0.6);
        z-index: 9990;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s ease;
    }
    .mobile-overlay.show { opacity: 1; visibility: visible; }

    @media screen and (max-width: 1024px) {
        .sidebar {
            width: 0;
            padding: 0;
            border: none;
        }

        .sidebar.active {
            width: 280px;
            padding: 6px 14px;
        }


        .mobile-ham-btn {
            display: flex;
        }


        .sidebar .logo-menu .toggle-btn {
            display: none; 
        }


        .sidebar.active .list .list-item .link-name {
            opacity: 1;
        }

        .mobile-ham-btn.moved {
            left: 230px; 
            background: transparent;
            box-shadow: none;
        }
    }
</style>

<div class="mobile-overlay" id="mobileOverlay"></div>

<div class="mobile-ham-btn" id="mobileHamBtn">
    <svg class="ham ham6" viewBox="0 0 100 100" width="40">
        <path class="line top" d="m 30,33 h 40 c 13.1,0 14.3,31.8 6.8,33.4 -24.6,5.3 9.0,-52.3 -12.7,-30.5 l -28.2,28.2" />
        <path class="line middle" d="m 70,50 c 0,0 -32.2,0 -40,0 -7.7,0 -6.4,-4.6 -6.4,-8.5 0,-5.8 6.0,-11.7 12.2,-5.5 6.2,6.2 28.2,28.2 28.2,28.2" />
        <path class="line bottom" d="m 69.5,67.0 h -40 c -13.1,0 -14.3,-31.8 -6.8,-33.4 24.6,-5.3 -9.0,52.3 12.7,30.5 l 28.2,-28.2" />
    </svg>
</div>

<nav class="sidebar">
    <div class="logo-menu">
        <svg class="ham ham6 toggle-btn" viewBox="0 0 100 100" width="60">
            <path class="line top" d="m 30,33 h 40 c 13.1,0 14.3,31.8 6.8,33.4 -24.6,5.3 9.0,-52.3 -12.7,-30.5 l -28.2,28.2" />
            <path class="line middle" d="m 70,50 c 0,0 -32.2,0 -40,0 -7.7,0 -6.4,-4.6 -6.4,-8.5 0,-5.8 6.0,-11.7 12.2,-5.5 6.2,6.2 28.2,28.2 28.2,28.2" />
            <path class="line bottom" d="m 69.5,67.0 h -40 c -13.1,0 -14.3,-31.8 -6.8,-33.4 24.6,-5.3 -9.0,52.3 12.7,30.5 l 28.2,-28.2" />
        </svg>
    </div>

    <ul class="list">
        @if (session()->has('email'))
             <li class="list-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg></i>
                    <span class="link-name">Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="GET" class="hidden"></form>
            </li>
            
        @else
            <li class="list-item">
                <a href="{{ route('applicant.login') }}">
                    <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" x2="3" y1="12" y2="12"/></svg></i>
                    <span class="link-name">Login</span>
                </a>
            </li>
        @endif

        <li class="list-item">
            <a href="{{ route('applicant.registerNow') }}">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-paperclip-icon lucide-paperclip"><path d="m16 6-8.414 8.586a2 2 0 0 0 2.829 2.829l8.414-8.586a4 4 0 1 0-5.657-5.657l-8.379 8.551a6 6 0 1 0 8.485 8.485l8.379-8.551"/></svg>
                </i>
                <span class="link-name">Register</span>
            </a>
        </li>
        <div class="auth-divider"></div>

        <li class="list-item" data-section="hero">
            <a href="#hero">
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house-icon lucide-house"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/><path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                </i>
                <span class="link-name">Home</span>
            </a>
        </li>

        <li class="list-item" data-section="about">
            <a href="#about">
                <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg></i>
                <span class="link-name">About Us</span>
            </a>
        </li>

        <li class="list-item" data-section="divisi">
            <a href="#divisi">
                <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 2 7l10 5 10-5-10-5Z"/><path d="m2 17 10 5 10-5"/><path d="m2 12 10 5 10-5"/></svg></i>
                <span class="link-name">Divisions</span>
            </a>
        </li>

        <li class="list-item" data-section="requirement">
            <a href="#requirement">
                <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><path d="M15 2H9a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1Z"/><path d="m9 14 2 2 4-4"/></svg></i>
                <span class="link-name">Requirements</span>
            </a>
        </li>

        <li class="list-item" data-section="contact">
            <a href="#contact">
                <i><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></i>
                <span class="link-name">Contact</span>
            </a>
        </li>
    </ul>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('.sidebar');
        const desktopToggle = document.querySelector('.sidebar .toggle-btn'); 
        const mobileToggle = document.getElementById('mobileHamBtn'); 
        const mobileOverlay = document.getElementById('mobileOverlay');
        const listItems = document.querySelectorAll('.list-item[data-section]');

        function toggleSidebar() {
            const isActive = sidebar.classList.toggle('active');
            

            if(desktopToggle) desktopToggle.classList.toggle('active');
            
            if(mobileToggle) {
                mobileToggle.querySelector('.ham').classList.toggle('active');
                mobileToggle.classList.toggle('moved'); 
            }
            if(window.innerWidth <= 1024) {
                if(mobileOverlay) mobileOverlay.classList.toggle('show');
            } else {
                if(mobileOverlay) mobileOverlay.classList.remove('show');
            }
        }

        if(desktopToggle) {
            desktopToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleSidebar();
            });
        }

        if(mobileToggle) {
            mobileToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                toggleSidebar();
            });
        }

        if(mobileOverlay) {
            mobileOverlay.addEventListener('click', () => {
                if(sidebar.classList.contains('active')) toggleSidebar();
            });
        }


        function updateActiveSection() {
            const scrollPosition = window.scrollY;
            const windowHeight = window.innerHeight;
            
            listItems.forEach(item => {
                const sectionId = item.getAttribute('data-section');
                const section = document.getElementById(sectionId);

                if (section) {
                    const rect = section.getBoundingClientRect();
                    if (rect.top <= windowHeight / 2 && rect.bottom >= windowHeight / 2) {
                        listItems.forEach(i => i.classList.remove('current-section'));
                        item.classList.add('current-section');
                    }
                }
            });
        }

        listItems.forEach(item => {
            const link = item.querySelector('a');
            const href = link.getAttribute('href');

            if (href && href.startsWith('#')) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = href.substring(1);
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop, 
                            behavior: 'smooth'
                        });

                        if (window.innerWidth <= 1024 && sidebar.classList.contains('active')) {
                            toggleSidebar();
                        }
                    }
                });
            }
        });

        window.addEventListener('scroll', updateActiveSection);
        updateActiveSection();
    });
</script>