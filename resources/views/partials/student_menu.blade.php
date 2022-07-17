<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <!-- Add icons to the links using the .nav-icon class

             with font-awesome or any other icon font library -->

    <li class="nav-item {{ request()->is('user/dashboard*') ? 'menu-open' : '' }}">

        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('user/dashboard*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-tachometer-alt"></i>

            <p>

                My Dashboard {{-- <i class="right fas fa-angle-left"></i> --}}

            </p>

        </a>

    </li>



    <li class="nav-item {{ request()->is('student/tutor*') || request()->is('student/conversation*') ? 'menu-open' : '' }}">

        <a href="#" class="nav-link {{ request()->is('student/tutor*') || request()->is('student/conversation*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-chalkboard-teacher"></i>

            <p>

                Mentor

                <i class="fas fa-angle-left right"></i> {{-- <span class="right badge badge-danger">New</span> --}}

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{ route('student.tutors') }}" class="nav-link {{ request()->is('student/tutor*') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Find Mentors</p>

                </a>

            </li>

            <li class="nav-item">
                <a href="{{route('student.conversation_list')}}" class="nav-link {{ request()->is('student/conversation*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>My Mentor</p>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item {{ request()->is('user/milestone*') ? 'menu-open' : '' }}">
        <a href="{{route('user.milestone')}}" class="nav-link {{ request()->is('user/milestone*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-flag"></i>
            <p>My Development</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="https://you2mentor.com/" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Home Page</p>
        </a>
    </li>
    <li class="nav-item">
        <a target="_blank" href="https://you2mentor.com/about/" class="nav-link">
            <i class="nav-icon fas fa-address-card"></i>
            <p>About Us</p>
        </a>
    </li>
    <li class="nav-item">
        <a target="_blank" href="https://you2mentor.com/privacy-policy/" class="nav-link">
            <i class="nav-icon fas fa-file-contract"></i>
            <p>Legal</p>
        </a>
    </li>
    {{-- <li class="nav-item">

        <a href="#" class="nav-link">

            <i class="nav-icon fas fa-th"></i>

            <p>

                Class Schedule

                <i class="fas fa-angle-left right"></i> <span class="right badge badge-danger">New</span>

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{ route('student.tutors') }}" class="nav-link">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Pending</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="#" class="nav-link">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Update Schedule</p>

                </a>

            </li>

        </ul>

    </li> --}}

    {{-- <li class="nav-item {{ request()->is('student/payment/history*') ? 'menu-open' : '' }}">

        <a href="{{ route('student.payment_history') }}" class="nav-link {{ request()->is('student/payment/history*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-history"></i>

            <p>
               Purchase History
            </p>

        </a>

    </li> --}}

    {{-- <li class="nav-item">

        <a href="#" class="nav-link">

            <i class="nav-icon fas fa-chart-pie"></i>

            <p>

                Payments

                <i class="right fas fa-angle-left"></i>

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="../charts/flot.html" class="nav-link">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Payment History</p>

                </a>

            </li>

        </ul>

    </li> --}}



</ul>

