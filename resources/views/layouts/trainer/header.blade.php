<header class="main-header">
    <a href="{{ route('trainer.dashboard') }}" class="logo">
        <img id="header-logo" src="{{asset('/admin/assets/images/page') }}/{{ $home_page_data['header_logo'] }}"
            style="width: 150px;position:absolute;left: 2%;top: 20%;height: 100px;" alt="">
        <!--  <span class="logo-lg" style="position:absolute;top:230%;left:3%;">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</span> -->
    </a>
    <nav class="navbar navbar-static-top">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <span
            style="float:left;line-height:50px;color:rgb(255, 255, 255);font-weight: 600;padding-left:15px;font-size:15px;"><span
                class="logo-lg">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</span></span>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @php
                    $notifications = Auth::user()->unreadNotifications;
                @endphp

                <li class="nav-item dropdown trainer-bell">
                    <a class="nav-link trainer-bell__toggle" data-toggle="dropdown" href="#" aria-label="Notifications">
                        <i class="fa fa-bell"></i>
                        @if($notifications->count())
                            <span class="trainer-bell__count">{{ $notifications->count() > 9 ? '9+' : $notifications->count() }}</span>
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-right trainer-bell__menu">
                        <div class="trainer-bell__head">
                            <strong>Notifications</strong>
                            @if($notifications->count())
                                <form action="{{ route('notifications.read-all') }}" method="POST" style="margin:0;">
                                    @csrf
                                    <button type="submit" class="trainer-bell__readall">Mark all as read</button>
                                </form>
                            @endif
                        </div>

                        <div class="trainer-bell__list">
                            @forelse($notifications as $notification)
                                @php
                                    $data = $notification->data;
                                    $type = $data['type'] ?? null;
                                    $isAppointment = in_array($type, ['appointment_booked', 'appointment_confirmed']);
                                    $icon = $data['icon'] ?? ($isAppointment ? 'fa-solid fa-calendar-check' : 'fa-solid fa-bell');
                                    $title = $data['title'] ?? ($isAppointment ? 'Appointment update' : 'Notification');
                                    $link = route('mark.notification.read', $notification->id);
                                    if (!empty($data['url'])) {
                                        $link .= '?redirect=' . urlencode($data['url']);
                                    }
                                @endphp

                                @if(!empty($data['message']))
                                    <a href="{{ $link }}" class="trainer-bell__item trainer-bell__item--{{ $type ?? 'general' }}">
                                        <span class="trainer-bell__icon"><i class="{{ $icon }}"></i></span>
                                        <span class="trainer-bell__body">
                                            <span class="trainer-bell__title">{{ $title }}</span>
                                            <span class="trainer-bell__text">{{ $data['message'] }}</span>
                                            <span class="trainer-bell__time">{{ $notification->created_at?->diffForHumans() }}</span>
                                        </span>
                                    </a>
                                @endif
                            @empty
                                <div class="trainer-bell__empty">
                                    <i class="fa-regular fa-bell-slash"></i>
                                    <span>You're all caught up</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </li>


                <li>
                    <a href="{{ url('/') }}" target="_blank">Visit Website</a>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (!empty(Auth::user()->image))
                            <img src="{{ asset('admin/assets/images/UserImage/' . Auth::user()->image) }}"
                                style="object-fit: cover;width: 40px;height: 40px;border-radius: 50px;margin-top: -10px;margin-right: 8px;"
                                alt="Profile Image"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
                            <i class="fa fa-user-circle" style="font-size: 20px; display: none;" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-user-circle" style="font-size: 20px;" aria-hidden="true"></i>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div>
                                <a href="{{ route('trainer.profile.edit') }}" class="btn btn-default btn-flat">Edit
                                    Profile</a>
                            </div>
                            <div>
                                <a class="dropdown-item btn btn-default btn-flat" href="{{ route('user.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>

    </nav>
</header>
<!-- Custom Script -->
<!-- CSS for hiding the logo -->
<style>
    .hide-logo {
        display: none;
    }

    @media (max-width: 430px) {
        #header-logo {
            display: block !important;
            /* Ensure logo stays visible */
        }
    }

    @media (max-width: 375px) {
        #header-logo {
            display: block !important;
            /* Ensure logo stays visible */
        }
    }

    @media (max-width: 320px) {
        #header-logo {
            display: block !important;
            /* Ensure logo stays visible */
        }
    }

    .sidebar-mini.sidebar-collapse .main-header .logo {
        width: 50px;
        display: none;
    }

    .trainer-bell__toggle { position: relative; }
    .trainer-bell__toggle .fa-bell { font-size: 17px; }
    .trainer-bell__count {
        position: absolute; top: 9px; right: 4px;
        min-width: 18px; height: 18px; padding: 0 5px;
        border-radius: 999px; background: #e53935; color: #fff;
        font-size: 10px; font-weight: 700; line-height: 18px; text-align: center;
        box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.9);
        animation: trainer-bell-pulse 2s ease-out infinite;
    }
    @keyframes trainer-bell-pulse {
        0% { box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.9), 0 0 0 2px rgba(229, 57, 53, 0.5); }
        70% { box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.9), 0 0 0 9px rgba(229, 57, 53, 0); }
        100% { box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.9), 0 0 0 2px rgba(229, 57, 53, 0); }
    }
    .navbar-nav > .trainer-bell > .trainer-bell__menu {
        width: 340px; padding: 0; border: none; border-radius: 12px; overflow: hidden;
        box-shadow: 0 12px 32px rgba(15, 35, 60, 0.18);
    }
    .trainer-bell__head {
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 16px; background: #f5f8fc; border-bottom: 1px solid #e6edf5;
    }
    .trainer-bell__head strong { font-size: 14px; color: #1b2b3c; }
    .trainer-bell__readall {
        background: none; border: none; padding: 0;
        font-size: 12px; font-weight: 600; color: #0b6fd6; cursor: pointer;
    }
    .trainer-bell__readall:hover { text-decoration: underline; }
    .trainer-bell__list { max-height: 360px; overflow-y: auto; }
    .navbar-nav .trainer-bell__item {
        display: flex; gap: 12px; padding: 12px 16px;
        border-bottom: 1px solid #eef2f6; color: #2a3a4a; white-space: normal;
        background: #fffdf3; transition: background 0.15s;
    }
    .navbar-nav .trainer-bell__item:hover { background: #f1f6fd; color: #2a3a4a; text-decoration: none; }
    .trainer-bell__icon {
        flex: 0 0 36px; height: 36px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background: rgba(11, 111, 214, 0.1); color: #0b6fd6; font-size: 15px;
    }
    .trainer-bell__item--google_calendar_reminder .trainer-bell__icon { background: rgba(219, 68, 55, 0.1); color: #db4437; }
    .trainer-bell__body { display: flex; flex-direction: column; gap: 2px; min-width: 0; }
    .trainer-bell__title { font-size: 13px; font-weight: 700; color: #1b2b3c; }
    .trainer-bell__text { font-size: 12px; line-height: 1.45; color: #5b6875; }
    .trainer-bell__time { font-size: 11px; color: #95a2af; margin-top: 2px; }
    .trainer-bell__empty {
        display: flex; flex-direction: column; align-items: center; gap: 6px;
        padding: 28px 16px; color: #95a2af; font-size: 13px;
    }
    .trainer-bell__empty i { font-size: 24px; }
    @media (max-width: 480px) {
        .navbar-nav > .trainer-bell > .trainer-bell__menu { width: 290px; }
    }
</style>
<script>
    $(document).ready(function () {
        // Handle the sidebar toggle functionality
        $('.sidebar-toggle').on('click', function (e) {
            e.preventDefault();
            // Toggle the sidebar collapse class on the body
            $('body').toggleClass('sidebar-collapse');
            // Optionally, toggle the logo visibility
            $('#header-logo').toggleClass('hide-logo');
        });
    });
</script>
