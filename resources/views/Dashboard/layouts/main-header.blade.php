<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/' . ($page = 'index')) }}"><img src="{{ URL::asset('Dashboard/img/brand/logo.png') }}"
                        class="logo-1" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img
                        src="{{ URL::asset('Dashboard/img/brand/logo-white.png') }}" class="dark-logo-1"
                        alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img
                        src="{{ URL::asset('Dashboard/img/brand/favicon.png') }}" class="logo-2" alt="logo"></a>
                <a href="{{ url('/' . ($page = 'index')) }}"><img
                        src="{{ URL::asset('Dashboard/img/brand/favicon.png') }}" class="dark-logo-2"
                        alt="logo"></a>
            </div>
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
            <div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
                <input class="form-control" placeholder="Search for anything..." type="search">
                <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
            </div>
        </div>
        <div class="main-header-right">
            <ul class="nav">
                <li class="">
                    <div class="dropdown  nav-itemd-none d-md-flex">
                        <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown"
                            aria-expanded="false">
                            @if (App::getLocale() == 'ar')
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                        src="{{ URL::asset('Dashboard/img/flags/YE.png') }}" alt="img"></span>
                                <strong
                                    class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                            @elseif (App::getLocale() == 'en')
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                        src="{{ URL::asset('Dashboard/img/flags/us_flag.jpg') }}"
                                        alt="img"></span>
                                <strong
                                    class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                            @else
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                        src="{{ URL::asset('Dashboard/img/flags/AT.png') }}" alt="img"></span>
                                <strong
                                    class="mr-2 ml-2 my-auto">{{ LaravelLocalization::getCurrentLocaleName() }}</strong>
                            @endif
                            <div class="my-auto">
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    @if ($properties['native'] == 'English')
                                        <i class="flag-icon flag-icon-us"></i>
                                    @elseif ($properties['native'] == 'Deutsch')
                                        <i class="flag-icon flag-icon-at"></i>
                                    @elseif($properties['native'] == 'العربية')
                                        <i class="flag-icon flag-icon-ye"></i>
                                    @endif
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
            <div class="nav nav-item  navbar-nav-right ml-auto">
                <div class="nav-link" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="submit" class="btn btn-default nav-link resp-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="dropdown nav-item main-header-message ">
                    <a class="new nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-mail">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>

                        @if (Auth::guard('doctor')->check() && App\Models\Message::ChekDoctor()->count() > 0)
                            <span class=" pulse-danger"></span>
                    </a>
                @elseif (Auth::guard('patient')->check() && App\Models\Message::ChekPatient()->count() > 0)
                    <span class=" pulse-danger"></span></a>
                @elseif (Auth::guard('admin')->check() && App\Models\Message::ChekAdmin()->count() > 0)
                    <span class=" pulse-danger"></span></a>
                    </a>
                    @endif

                    <div class="dropdown-menu">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Messages</h6>
                                <span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All
                                    Read</span>
                            </div>
                            @if (Auth::guard('doctor')->check())
                                <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
                                    {{ App\Models\Message::ChekDoctor()->count() > 0 }}
                                </p>
                            @else
                                <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">
                                    {{ App\Models\Message::ChekPatient()->count() > 0 }}
                                </p>
                            @endif
                        </div>
                        <div class="main-message-list chat-scroll">

                            @if (Auth::guard('admin')->check())
                                @if (App\Models\Message::ChekAdmin()->count() > 0)
                                    <a href="{{ route('chat.doctors') }}" class="p-3 d-flex border-bottom">
                                        <div class="  drop-img  cover-image  "
                                            data-image-src="{{ URL::asset('Dashboard/img/faces/3.jpg') }}">
                                            <span class="avatar-status bg-teal"></span>
                                        </div>
                                        <div class="wd-90p">
                                            <div class="d-flex">
                                                <h5 class="mb-1 name">يوجد لديك رسائل غير مفروة</h5>
                                            </div>
                                            <p class="mb-0 desc" style="color: blue">اضغط هنا لعرض جميع الرسائل </p>
                                            <p class="time mb-0 text-left float-right mr-2 mt-2">Mar 15 3:55 PM</p>
                                        </div>
                                    </a>
                                @endif
                            @endif

                            @if (Auth::guard('doctor')->check())
                                @if (App\Models\Message::ChekDoctor()->count() > 0)
                                    <a href="{{ route('chat.patients') }}" class="p-3 d-flex border-bottom">
                                        <div class="  drop-img  cover-image  "
                                            data-image-src="{{ URL::asset('Dashboard/img/faces/3.jpg') }}">
                                            <span class="avatar-status bg-teal"></span>
                                        </div>
                                        <div class="wd-90p">
                                            <div class="d-flex">
                                                <h5 class="mb-1 name">يوجد لديك رسائل غير مفروة</h5>
                                            </div>
                                            <p class="mb-0 desc" style="color: blue">اضغط هنا لعرض جميع الرسائل </p>
                                            <p class="time mb-0 text-left float-right mr-2 mt-2">Mar 15 3:55 PM</p>
                                        </div>
                                    </a>
                                @endif
                            @endif

                            @if (Auth::guard('patient')->check())
                                @if (App\Models\Message::ChekPatient()->count() > 0)
                                    <a href="{{ route('chat.doctors') }}" class="p-3 d-flex border-bottom">
                                        <div class="  drop-img  cover-image  "
                                            data-image-src="{{ URL::asset('Dashboard/img/faces/3.jpg') }}">
                                            <span class="avatar-status bg-teal"></span>
                                        </div>
                                        <div class="wd-90p">
                                            <div class="d-flex">
                                                <h5 class="mb-1 name">يوجد لديك رسائل غير مفروة</h5>
                                            </div>
                                            <p class="mb-0 desc" style="color: blue">اضغط هنا لعرض جميع الرسائل </p>
                                            <p class="time mb-0 text-left float-right mr-2 mt-2">Mar 15 3:55 PM</p>
                                        </div>
                                    </a>
                                @endif
                            @endif
                        </div>
                        <div class="text-center dropdown-footer">
                            <a href="text-center">VIEW ALL</a>
                        </div>
                    </div>
                </div>
                <div class="dropdown nav-item main-header-notification">
                    <a class="new nav-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        @if (auth()->user() && App\Models\Notification::CauntNotification()->count() > 0)
                            <span class=" pulse"></span>
                    </a>
                    @endif

                    <div class="dropdown-menu dropdown-notifications">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications
                                </h6>
                                <span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All
                                    Read</span>
                            </div>
                            <p data-count="0"
                                class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 notif-count">
                                {{ App\Models\Notification::CauntNotification()->count() }}</p>
                        </div>
                        <div class="main-notification-list Notification-scroll">

                            <div class="new_message">
                                <a class="d-flex p-3 border-bottom" href="#">
                                    <div class="notifyimg bg-pink">
                                        <i class="la la-file-alt text-white"></i>
                                    </div>
                                    <div class="mr-3">
                                        <h4 class="notification-label mb-1"></h4>
                                        <div class="notification-subtext"></div>
                                    </div>
                                    <div class="mr-auto">
                                        <i class="las la-angle-left text-left text-muted"></i>
                                    </div>
                                </a>
                            </div>

                            @foreach (App\Models\Notification::where('user_id', auth()->user()->id)->where('reader_status', 0)->get() as $notification)
                                <a class="d-flex p-3 border-bottom"
                                    href="{{ route('show_notification_admin', [$notification->id, 'notification_id' => $notification->id]) }}">
                                    <div class="notifyimg bg-pink">
                                        <i class="la la-file-alt text-white"></i>
                                    </div>
                                    <div class="mr-3">
                                        <h5 class="notification-label mb-1">{{ $notification->message }}</h5>
                                        <div class="notification-subtext">{{ $notification->created_at }}</div>
                                    </div>
                                    <div class="mr-auto">
                                        <i class="las la-angle-left text-left text-muted"></i>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="dropdown-footer">
                            <a href="">VIEW ALL</a>
                        </div>
                    </div>
                </div>

                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-maximize">
                            <path
                                d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                            </path>
                        </svg>
                    </a>
                </div>
                <div class="dropdown main-profile-menu nav nav-item nav-link">


                    <a class="profile-user d-flex" href="">
                        <div class="profile-user">
                            @if (auth()->user()->image)
                                @if (auth('admin')->check())
                                    <img alt="User Profile" class="avatar avatar-xs brround"
                                        src="{{ asset('Dashboard/img/admins/' . auth()->user()->image->filename) }}">
                                @elseif (auth('doctor')->check())
                                    <img alt="User Profile" class="avatar avatar-xs brround"
                                        src="{{ asset('Dashboard/img/doctors/' . auth()->user()->image->filename) }}">
                                @else
                                    <img alt="User Profile" class="avatar avatar-xm brround"
                                        src="{{ asset('Dashboard/img/ray_employees/' . auth()->user()->image->filename) }}">
                                @endif
                            @else
                                <img alt="Default Profile" class="avatar avatar-xs brround"
                                    src="{{ asset('Dashboard/img/doctor_default.png') }}">
                            @endif
                        </div>
                    </a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="profile-user">
                                    @if (auth()->user()->image)
                                        @if (auth('admin')->check())
                                            <img alt="User Profile" class="avatar avatar-xl brround"
                                                src="{{ asset('Dashboard/img/admins/' . auth()->user()->image->filename) }}">
                                        @elseif (auth('doctor')->check())
                                            <img alt="User Profile" class="avatar avatar-xl brround"
                                                src="{{ asset('Dashboard/img/doctors/' . auth()->user()->image->filename) }}">
                                        @else
                                            <img alt="User Profile" class="avatar avatar-xl brround"
                                                src="{{ asset('Dashboard/img/ray_employees/' . auth()->user()->image->filename) }}">
                                        @endif
                                    @else
                                        <img alt="Default Profile" class="avatar avatar-xl brround"
                                            src="{{ asset('Dashboard/img/doctor_default.png') }}">
                                    @endif
                                </div>
                                <div class="mr-3 my-auto">
                                    <h6>{{ auth()->user()->name }}</h6><span>{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
                        <a class="dropdown-item" href=""><i class="bx bx-cog"></i> Edit Profile</a>
                        <a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
                        <a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a>
                        <a class="dropdown-item" href=""><i class="bx bx-slider-alt"></i> Account Settings</a>

                        @if (auth('web')->check())
                            <form method="POST" action="{{ route('logout.user') }}">
                            @elseif(auth('admin')->check())
                                <form method="POST" action="{{ route('logout.admin') }}">
                                @elseif(auth('patient')->check())
                                    <form method="POST" action="{{ route('logout.patient') }}">
                                    @elseif(auth('ray_employee')->check())
                                        <form method="POST" action="{{ route('logout.ray_employee') }}">
                                        @elseif(auth('laboratorie_employee')->check())
                                            <form method="POST" action="{{ route('logout.laboratorie_employee') }}">
                                            @else
                                                <form method="POST" action="{{ route('logout.doctor') }}">
                        @endif
                        @csrf
                        <a class="dropdown-item" href="#"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"><i
                                class="bx bx-log-out"></i> {{ __('Dashboard/login_trans.Sign_out') }}</a>
                        </form>

                    </div>
                </div>
                <div class="dropdown main-header-message right-toggle">
                    <a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-menu">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /main-header -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>

{{-- هذا الاشعارات مفرد خاص --}}
<script src="{{ asset('js/app.js') }}"></script>
<script>
    var notificationsWrapper = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount = parseInt(notificationsCountElem.data('count'));

    var notifications = notificationsWrapper.find('h4.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();

    Echo.private('create-invoice.{{ auth()->user()->id }}').listen('.create-invoice', (data) => {
        var newNotificationHtml = `
       <h4 class="notification-label mb-1">` + data.message + data.patient + `</h4>
       <div class="notification-subtext">` + data.created_at + `</div>`;
        new_message.show();
        notifications.html(newNotificationHtml);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
    });
</script>
{{--
<script>
    function autoRefresh() {
        location.reload(true); // قم بإعادة تحميل الصفحة
    }

    // قم بتنفيذ autoRefresh() كل 5 ثوانٍ (5000 مللي ثانية)
    setInterval(autoRefresh, 5000);
</script> --}}

{{-- هذا الاشعارات للجميع --}}
{{-- <script>
    var notificationsWrapper   = $('.dropdown-notifications');
    var notificationsCountElem = notificationsWrapper.find('p[data-count]');
    var notificationsCount  = parseInt(notificationsCountElem.data('count'));

    var notifications = notificationsWrapper.find('h4.notification-label');
    var new_message = notificationsWrapper.find('.new_message');
    new_message.hide();

    var pusher = new Pusher('80bd93b64a8150d3f71a', {
        cluster: 'mt1'
    });

    var channel = pusher.subscribe('my-invoice');
    channel.bind('App\\Events\\MyEvent', function(data) {

        var newNotificationHtml = `
       <h4 class="notification-label mb-1">`+data.message+data.patient+`</h4>
       <div class="notification-subtext">`+data.created_at+`</div>`;
        new_message.show();
        notifications.html(newNotificationHtml);
        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
    });


</script> --}}
