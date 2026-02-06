<header class="main-header">
    <a href="{{ route('dashboard') }}" class="logo">
        <img id="header-logo" src="{{asset('/admin/assets/images/page') }}/{{ $home_page_data['header_logo'] }}" style="width: 150px;position:absolute;left: 2%;top: 20%;height: 100px;" alt="">
        
    </a>
    <nav class="navbar navbar-static-top">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <span style="float:left;line-height:50px;color:#fff;padding-left:15px;font-size:18px;">Super Admin</span>

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
                                <a href="{{ route('mark.notification.read', $notification->id) }}?redirect={{ urlencode(route('appointments.show', $data['appointment_id'])) }}"
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
                        @if((Auth::user()->image))
                        <img src="{{ asset('/admin/assets/img') }}/{{ Auth::user()->image }}" class="user-image" alt="user photo">
                        @else
                        <img src="{{ asset('/admin/assets/img/dummy-user.png') }}" class="user-image" alt="user photo">
                        @endif
                        <span class="hidden-xs"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <!--  <div>
                                <a href="{{ route('admin.profile.edit') }}" class="btn btn-default btn-flat">Edit Profile</a>
                            </div> -->
                            <div>
                                <a class="dropdown-item btn btn-default btn-flat" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
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


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Custom Script -->
<script>
    $(document).ready(function() {
        $('.sidebar-toggle').click(function() {
            $('#header-logo').toggleClass('hide-logo');
        });
    });
</script>

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