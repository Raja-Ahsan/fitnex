<aside class="main-sidebar" style="margin-top: 60px;">
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="{{ route('trainer.dashboard') }}"
                    class="{{ request()->is('trainer/dashboard') ? 'active' : '' }}">
                    <i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->is('trainer/bookings*') ? 'active' : '' }}">
                <a href="{{ route('trainer.bookings.index') }}">
                    <i class="fa fa-list" aria-hidden="true"></i> <span>Bookings</span>
                </a>
            </li>
            <li class="{{ request()->is('trainer/availability*') ? 'active' : '' }}">
                <a href="{{ route('trainer.availability.index') }}">
                    <i class="fa fa-calendar-check-o" aria-hidden="true"></i> <span>Availability</span>
                </a>
            </li>
            {{-- <li class="{{ request()->is('trainer/pricing*') ? 'active' : '' }}">
                <a href="{{ route('trainer.pricing.index') }}">
                    <i class="fa fa-usd" aria-hidden="true"></i> <span>Pricing</span>
                </a>
            </li> --}}
            <li class="{{ request()->is('trainer/slots*') ? 'active' : '' }}">
                <a href="{{ route('trainer.slots.index') }}">
                    <i class="fa fa-th-list" aria-hidden="true"></i> <span>My Slots</span>
                </a>
            </li>
            <li class="{{ request()->is('trainer/google*') ? 'active' : '' }}">
                <a href="{{ route('trainer.google.index') }}">
                    <i class="fa fa-google" aria-hidden="true"></i> <span>Google Sync</span>
                </a>
            </li>
            <li class="{{ request()->is('trainer/profile*') ? 'active' : '' }}">
                <a href="{{ route('trainer.profile.edit') }}">
                    <i class="fa fa-user" aria-hidden="true"></i> <span>Profile</span>
                </a>
            </li>
        </ul>
    </section>
</aside>