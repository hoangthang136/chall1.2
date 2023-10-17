<ul class="nav">
    <li class="@yield('active-user')">
        <a @if (Auth::user()->role == 'Administrator')
            href="{{ route('user.index') }}"
        @endif
         @if (Auth::user()->role == 'Student')
            href="{{ route('userindex') }}"
         @endif
         @if (Auth::user()->role == 'Teacher')
            href="{{ route('tuser.index') }}"
         @endif
         >
            <i class="fa-solid fa-users"></i>
            <p>Users</p>
        </a>
    </li>
    <li class="@yield('active-mess')">
        <a
         @if (Auth::user()->role == 'Administrator')
            href="{{ route('message.index') }}"
        @endif
         @if (Auth::user()->role == 'Student')
            href="{{ route('messindex') }}"
         @endif
         @if (Auth::user()->role == 'Teacher')
            href="{{ route('tmessage.index') }}"
         @endif
         >
            <i class="fa-solid fa-comment-dots"></i>
            <p>Messages</p>
        </a>
    </li>
    <li class="@yield('active-assi')">
        <a
        @if (Auth::user()->role == 'Administrator')
            href="{{ route('assignments.index') }}"
        @endif
         @if (Auth::user()->role == 'Student')
            href="{{ route('assignindex') }}"
         @endif
         @if (Auth::user()->role == 'Teacher')
         href="{{ route('tassignments.index') }}"
         @endif
         >
            <i class="fa-solid fa-book"></i>
            <p>Assignments</p>
        </a>
    </li>
    <li class="@yield('active-chall')">
        <a
        @if (Auth::user()->role == 'Administrator')
            href="{{ route('challenges.index') }}"
        @endif
         @if (Auth::user()->role == 'Student')
            href="{{ route('challindex') }}"
         @endif
         @if (Auth::user()->role == 'Teacher')
            href="{{ route('tchallenges.index') }}"
            @endif
         >
            <i class="fa-solid fa-gamepad"></i>
            <p>Challenges</p>
        </a>
    </li>
</ul>