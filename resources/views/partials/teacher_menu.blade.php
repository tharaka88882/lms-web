<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    <!-- Add icons to the links using the .nav-icon class

             with font-awesome or any other icon font library -->

    <li class="nav-item {{ request()->is('user/dashboard*') ? 'menu-open' : '' }}">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('user/dashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                My Dashboard
            </p>
        </a>
    </li>



    <li class="nav-item {{ request()->is('teacher/conversation*') ? 'menu-open' : '' }}">

        <a href="{{ route('teacher.conversation_list') }}" class="nav-link {{ request()->is('teacher/conversation*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-comments"></i>

            <p>

               My Mentee

                {{-- <i class="fas fa-angle-left right"></i> <span class="badge badge-info right">6</span> --}}

            </p>

        </a>

    </li>



    <li class="nav-item {{ request()->is('teacher/subject*') ? 'menu-open' : '' }}">

        <a href="#" class="nav-link {{ request()->is('teacher/subject*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-marker"></i>

            <p>

                Mentoring Topics/Professions

                <i class="fas fa-angle-left right"></i> {{-- <span class="badge badge-info right">6</span> --}}

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{ route('teacher.find_subject') }}" class="nav-link {{ request()->is('teacher/subject/find') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Find  Mentoring Topics</p>

                </a>

            </li>

            <li class="nav-item">

                <a href="{{ route('teacher.my_subject') }}" class="nav-link {{ request()->is('teacher/subject') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>My Expertise</p>

                </a>

            </li>

        </ul>

    </li>



    {{-- <li class="nav-item {{ request()->is('teacher/schedule*') ? 'menu-open' : '' }}">

        <a href="#" class="nav-link {{ request()->is('teacher/schedule*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-tasks"></i>

            <p>

                Schedule

                <i class="right fas fa-angle-left"></i>

            </p>

        </a>

        <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{route('teacher.create_schedule')}}" class="nav-link {{ request()->is('teacher/schedule/create') ? 'active' : '' }}">



                    <i class="far fa-circle nav-icon"></i>

                    <p>Add Schedule</p>

                </a>

            </li>

        </ul>

        <ul class="nav nav-treeview">

            <li class="nav-item">

               <a href="{{route('teacher.schedule_list')}}" class="nav-link {{ request()->is('teacher/schedule') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Schedule List</p>

                </a>



            </li>

        </ul>

    </li> --}}



    <li class="nav-item {{ request()->is('teacher/mentor*') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link {{ request()->is('teacher/mentor*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
                Other Mentors
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>

        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('teacher.mentors')}}" class="nav-link {{ request()->is('teacher/mentor') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Find Mentors</p>
                </a>
            </li>
        </ul>

        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="{{route('teacher.mentor_conversation_list')}}" class="nav-link {{ request()->is('teacher/mentor/conversation') ? 'active' : '' }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>My Mentor</p>
                </a>

            </li>
        </ul>
    </li>

    <li class="nav-item {{ request()->is('user/dashboard*') ? 'menu-open' : '' }}">
        <a href="{{route('user.milestone')}}" class="nav-link {{ request()->is('user/milestone*') ? 'active' : '' }}">
            <i class="fas fa-flag"></i>
            <p>My Development</p>
        </a>
    </li>

       {{-- <li class="nav-item {{ request()->is('teacher/payment/history*') || request()->is('teacher/payout*') ? 'menu-open' : '' }}">

        <a href="" class="nav-link {{ request()->is('teacher/payment/history*') || request()->is('teacher/payout*') ? 'active' : '' }}">

            <i class="nav-icon fas fa-history"></i>

            <p>

               Payment

                 <i class="right fas fa-angle-left"></i>

            </p>

        </a>



          <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{route('teacher.create_payout')}}" class="nav-link {{ request()->is('teacher/payout/request') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Request Payout</p>



                </a>

            </li>

        </ul>

          <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{route('teacher.payout_history')}}" class="nav-link {{ request()->is('teacher/payout/history') || request()->is('teacher/payout/view*') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Payout History</p>



                </a>

            </li>

        </ul>

          <ul class="nav nav-treeview">

            <li class="nav-item">

                <a href="{{ route('teacher.payment_history') }}" class="nav-link {{ request()->is('teacher/payment/history') ? 'active' : '' }}">

                    <i class="far fa-circle nav-icon"></i>

                    <p>Purchase History</p>



                </a>

            </li>

        </ul>

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

                    <p>My Payment</p>

                </a>

            </li>

        </ul>

    </li> --}}



</ul>

