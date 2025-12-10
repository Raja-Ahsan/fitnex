<aside class="main-sidebar" style="margin-top: 60px;">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{ route('dashboard') }}"
                    class="{{ request()->is('dashboard') || request()->is('profile/*') ? 'active' : '' }}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="{{ route('appointments.index') }}" class="{{ request()->is('appointments') ? 'active' : '' }}">
                    <i class="fa fa-calendar" aria-hidden="true"></i> <span>Appointments</span>
                </a>
            </li>
        </ul>
    </section>
</aside>