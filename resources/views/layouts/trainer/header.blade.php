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

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>
                        @if($notifications->count())
                            <span class="badge badge-warning">{{ $notifications->count() }}</span>
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-right notifications-dropdown">
                        <style>
                            .notifications-dropdown {
                                max-height: 354px;
                                overflow-y: auto;
                            }

                            .notification-item {
                                padding: 10px 15px;
                                border-bottom: 1px solid #eee;
                            }

                            .notification-item.unread {
                                background-color: #fff3cd;
                                border-left: 3px solid #ffc107;
                            }

                            .notification-dot {
                                display: inline-block;
                                width: 8px;
                                height: 8px;
                                background-color: #ffc107;
                                border-radius: 50%;
                                margin-right: 8px;
                            }

                            .dropdown-header {
                                position: sticky;
                                top: 0;
                                background-color: #fff;
                                z-index: 1;
                                padding: 10px 15px;
                                border-bottom: 1px solid #eee;
                            }
                        </style>
                        <div class="dropdown-header">Notifications</div>

                        @forelse($notifications as $notification)
                            @php
                                $data = $notification->data;
                                $isAppointmentNotification = isset($data['type']) && in_array($data['type'], ['appointment_booked', 'appointment_confirmed']);
                            @endphp

                            @if($isAppointmentNotification)
                                <a href="{{ route('mark.notification.read', $notification->id) }}"
                                    class="dropdown-item notification-item{{ $notification->read_at ? '' : ' unread' }}">
                                    @if(!$notification->read_at)
                                        <span class="notification-dot"></span>
                                    @endif
                                    <span>{{ $data['message'] }}</span>
                                </a>
                            @else
                                <span class="dropdown-item notification-item">
                                    Unknown notification type.
                                </span>
                            @endif
                        @empty
                            <span class="dropdown-item notification-item">No new notifications</span>
                        @endforelse
                    </div>
                </li>


                <li>
                    <a href="{{ url('/') }}" target="_blank">Visit Website</a>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (!empty(Auth::user()->image))
                            <img src="{{asset('/admin/assets/images/UserImage') }}/{{  Auth::user()->image }}"
                                style="object-fit: cover;width: 40px;height: 40px;border-radius: 50px;margin-top: -10px;margin-right: 8px;"
                                alt="">
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
                                <a class="dropdown-item btn btn-default btn-flat" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
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