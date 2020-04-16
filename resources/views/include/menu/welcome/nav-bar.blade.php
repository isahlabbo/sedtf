<!-- Header -->

<header class="header d-flex flex-row">
        <div class="header_content d-flex flex-row align-items-center">
            <!-- Logo -->
            <div class="logo_container">
                <div class="logo">
                    <img src="{{asset('img/welcome/logo-img.png') }}" alt="">
                    <span>SEDTF</span>
                </div>
            </div>

            <!-- Main Navigation -->
            <nav class="main_nav_container">
                
            </nav>
        </div>
        <div class="header_side d-flex flex-row justify-content-center align-items-center" style="backgroung-color:#4a2d09">
        <div class="main_nav">
                    <ul class="main_nav_list">
                        <li class="main_nav_item"><a href="{{asset(route('student.auth.login'))}}">login</a></li>
                        
                    </ul>
                </div>
        </div>

        <!-- Hamburger -->
        <div class="hamburger_container">
            <i class="fas fa-bars trans_200"></i>
        </div>

    </header>
    <div class="menu_container menu_mm">

        <!-- Menu Close Button -->
        <div class="menu_close_container">
            <div class="menu_close"></div>
        </div>

        <!-- Menu Items -->
        <div class="menu_inner menu_mm">
            <div class="menu menu_mm">
                <ul class="menu_list menu_mm">
                   <li class="main_nav_item"><a href="{{asset('')}}">home</a></li>
                        <li class="main_nav_item"><a href="{{asset('about')}}">about us</a></li>
                        
                </ul>

                Menu Social
                
                <div class="menu_social_container menu_mm">
                    <ul class="menu_social menu_mm">
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-pinterest"></i></a></li>
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li class="menu_social_item menu_mm"><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>

                <div class="menu_copyright menu_mm">All rights reserved</div>
            </div>

        </div>

    </div>
    <!-- Home -->

    <div class="home">

        <!-- Hero Slider -->
        <div class="hero_slider_container">
            <div class="hero_slider owl-carousel">
                
                <!-- Hero Slide -->
                <div class="hero_slide">
                    <div class="hero_slide_background" style="background-image:url(img/welcome/slider_background.jpg)"></div>
                    <div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
                        <div class="hero_slide_content text-center">
                            <h2 class="h2" data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Get your <span>Certificate in Computer Science</span></h2>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Slide -->
                <div class="hero_slide">
                    <div class="hero_slide_background" style="background-image:url(img/welcome/slider_background.jpg)"></div>
                    <div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
                        <div class="hero_slide_content text-center">
                            <h2 class="h2" data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Get your <span>Certifate in Computer Engineering</span></h2>
                        </div>
                    </div>
                </div>
                
                <!-- Hero Slide -->
                <div class="hero_slide">
                    <div class="hero_slide_background" style="background-image:url(img/welcome/slider_background.jpg)"></div>
                    <div class="hero_slide_container d-flex flex-column align-items-center justify-content-center">
                        <div class="hero_slide_content text-center">
                            <h2 class="h2" data-animation-in="fadeInUp" data-animation-out="animate-out fadeOut">Get your <span>Diplomer in Computer Science</span></h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="hero_slider_left hero_slider_nav trans_200"><span class="trans_200">prev</span></div>
            <div class="hero_slider_right hero_slider_nav trans_200"><span class="trans_200">next</span></div>
        </div>

    </div>