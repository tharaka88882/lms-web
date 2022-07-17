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



    <li
        class="nav-item {{ request()->is('admin/teacher*') || request()->is('admin/add_teacher') ? 'menu-open' : '' }}">

        <a href=""
            class="nav-link {{ request()->is('admin/teacher*') || request()->is('admin/add_teacher') ? 'active' : '' }}">

            <i class="nav-icon fas fa-chalkboard-teacher"></i>

            <p>

                Mentor

                <i class="fas fa-angle-left right"></i> {{-- <span class="right badge badge-danger">New</span> --}}

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{ route('admin.pending_teacher') }}"
                    class="nav-link {{ request()->is('admin/teacher') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Pending</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.add_teachers') }}"
                    class="nav-link {{ request()->is('admin/add_teacher') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Add Mentor</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.teachers') }}"
                    class="nav-link {{ request()->is('admin/teachers') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Mentors List</p>

                </a>

            </li>

        </ul>

    </li>

    <li
        class="nav-item {{ request()->is('admin/student*') || request()->is('admin/add_student') ? 'menu-open' : '' }}">

        <a href="{{ route('admin.students') }}"
            class="nav-link {{ request()->is('admin/student*') || request()->is('admin/add_student') ? 'active' : '' }}">

            <i class="nav-icon fas fa-users"></i>

            <p>

                Mentee

                <i class="fas fa-angle-left right"></i> {{-- <span class="badge badge-info right">6</span> --}}

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{ route('admin.add_students') }}"
                    class="nav-link {{ request()->is('admin/add_student') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Add Mentee</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.students') }}"
                    class="nav-link {{ request()->is('admin/students') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Mentees List</p>

                </a>

            </li>

        </ul>

    </li>

    <li
        class="nav-item {{ request()->is('admin/subject') || request()->is('admin/subject/create') ? 'menu-open' : '' }}">

        <a href="#"
            class="nav-link {{ request()->is('admin/subject') || request()->is('admin/subject/create') ? 'active' : '' }}">

            <i class="nav-icon fas fa-marker"></i>

            <p>

                Skills

                <i class="fas fa-angle-left right"></i> {{-- <span class="badge badge-info right">6</span> --}}

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{ route('admin.create_subject') }}"
                    class="nav-link {{ request()->is('admin/subject/create') ? 'active' : '' }}">



                    <i class="far fa-circle nav-icon"></i>

                    <p>Add Skills</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.subjects') }}"
                    class="nav-link {{ request()->is('admin/subject') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Skills List</p>

                </a>

            </li>

        </ul>

    </li>


    {{-- <li class="nav-item {{ request()->is('admin/industry*') ? 'menu-open' : '' }}">
        <a href="{{ route('admin.industry') }}"
            class="nav-link {{ request()->is('admin/industry*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-marker"></i>
            <p>
                Mentor Industries
            </p>
        </a>
    </li> --}}

    <li
        class="nav-item {{ request()->is('admin/industry*') || request()->is('admin/add-position*') || request()->is('admin/add-company*') ? 'menu-open' : '' }}">

        <a href="#"
            class="nav-link {{ request()->is('admin/industry*') || request()->is('admin/add-position*') || request()->is('admin/add-company*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-info-circle"></i>

            <p>

                Mentor Detail

                <i class="fas fa-angle-left right"></i> {{-- <span class="badge badge-info right">6</span> --}}

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item {{ request()->is('admin/industry*') ? 'menu-open' : '' }}">
                <a href="{{ route('admin.industry') }}"
                    class="nav-link {{ request()->is('admin/industry*') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Mentor Industries
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.add_position') }}"
                    class="nav-link {{ request()->is('admin/add-position') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Positions</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.add_company') }}"
                    class="nav-link {{ request()->is('admin/add-company') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Institutes/Companies</p>

                </a>

            </li>

        </ul>

    </li>

    <li class="nav-item {{ request()->is('admin/payment*') ? 'menu-open' : '' }}">

        <a href="#" class="nav-link {{ request()->is('admin/payment*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-dollar-sign"></i>

            <p>

                Payments

                <i class="fas fa-angle-left right"></i> {{-- <span class="badge badge-info right">6</span> --}}

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{ route('admin.payout_requests') }}"
                    class="nav-link {{ request()->is('admin/payment/requests*') ? 'active' : '' }}">



                    <i class="far fa-circle nav-icon"></i>

                    <p>Payout Requests</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.payouts') }}"
                    class="nav-link {{ request()->is('admin/payments') || request()->is('admin/payment/payouts*') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Payout History</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.create_package') }}"
                    class="nav-link {{ request()->is('admin/payment/create') ? 'active' : '' }}">



                    <i class="far fa-circle nav-icon"></i>

                    <p>Add Packages</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.packages_list') }}"
                    class="nav-link {{ request()->is('admin/payment/packages*') ? 'active' : '' }}">



                    <i class="far fa-circle nav-icon"></i>

                    <p>Payment Packages</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.user_orders') }}"
                    class="nav-link {{ request()->is('admin/payment/orders*') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>User Orders</p>

                </a>

            </li>

        </ul>

    </li>

    <li class="nav-item {{ request()->is('admin/complaint*') ? 'menu-open' : '' }}">

        <a href="{{ route('admin.complaints') }}"
            class="nav-link {{ request()->is('admin/complaint*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-thumbs-down"></i>

            <p>

                Mentee Complaints

                {{-- <i class="fas fa-angle-left right"></i> <span class="badge badge-info right">6</span> --}}

            </p>

        </a>

        {{-- <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{ route('admin.create_subject') }}" class="nav-link {{ request()->is('admin/subject/create') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Add Subject</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('admin.subjects') }}" class="nav-link {{ request()->is('admin/subject') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Subjects List</p>

                </a>

            </li>

        </ul> --}}

    </li>

    <li class="nav-item {{ request()->is('admin/settings*') ? 'menu-open' : '' }}">
        <a href="{{ route('admin.settings') }}"
            class="nav-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-cog"></i>
            <p>Settings</p>
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


</ul>
