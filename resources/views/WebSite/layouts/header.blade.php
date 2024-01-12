<div class="nav-outer clearfix">
    <!--Mobile Navigation Toggler For Mobile--><div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
    <nav class="main-menu navbar-expand-md navbar-light">
        <div class="navbar-header">
            <!-- Togg le Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon flaticon-menu"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
            <ul class="navigation clearfix">
                <li class="current dropdown"><a href="#">{{ __('Website/website.main') }}</a>

                </li>
                <li class="btn-box">
                    <a href="#Appointment" class="theme-btn services-btn"> {{ __('Website/website.book_appointment') }}</a>


                </li>
                <li class="btn-box">
                    <a href="#about" class="theme-btn services-btn"> {{ __('Website/website.about_us') }}</a>
                </li>
                <li class="btn-box"><a href="#doctors">{{ __('Website/website.doctors') }}</a>
                    <ul>

                    </ul>
                </li>
                <li class="btn-box"><a href="#sections">{{ __('Website/website.sections') }}</a>
                </li>
                <li><a href="#contact"> {{ __('Website/website.contact_us') }}</a></li>

                <li class="dropdown"><a href="#">{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                    <ul>
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
    <!-- Main Menu End-->

    <!-- Main Menu End-->
    <div class="outer-box clearfix">
        <!-- Main Menu End-->
        <div class="nav-box">
            <div class="nav-btn nav-toggler navSidebar-button"><span class="icon flaticon-menu-1"></span></div>
        </div>

        <!-- Social Box -->
        <ul class="social-box clearfix">
            <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
            <li><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
            <li>

                <a title=" {{ __('website.login') }}" href="{{ route('dashboard.user') }}">
                    <span class="fas fa-user"></span> {{ __('website.login') }}
                </a>

            </li>


        </ul>

        <!-- Search Btn -->
        <div class="search-box-btn"><span class="icon flaticon-search"></span></div>

    </div>
</div>
