<header class="header">
  <div class="header__container">
    <div class="header__flex">
      <p class="header__logo logo"><a href="/">Top<span class="logo__emphasis">Lane</span><br><span class="logo__small">.online</span></a></p>
      <nav class="header__nav">
        <ul>
          <li><a href="{{ route('pages.home') }}">@include('modules.svg.home') <span>Home</span></a></li>
          <li><a href="{{ route('forum') }}">@include('modules.svg.forum') <span>Forum</span></a></li>
          <li><a href="/news">@include('modules.svg.news') <span>News</span></a></li>
        </ul>
      </nav>
      <div style="display: flex; align-items: center">
        @auth
          <img width="50" height="50" style="border-radius: 99px" src="/storage/{{ auth()->user()->picture_url }}" alt="{{ auth()->user()->name }}'s Profile Picture">
        @endauth
        <ul>
        @auth
          <li><a href="/profile/{{ auth()->user()->name }}">Profile</a></li>
          <li><a href="{{ route('auth.signout') }}">Logout</a></li>
        @endauth
        @guest
          <li><a href="{{ route('auth.login') }}">Login</a></li>
          <li><a href="{{ route('auth.registration') }}">Register</a></li>
        @endguest

        @admin
          <li><a href="{{ route('admin.dashboard') }}">Admin Dash</a></li>
        @endadmin

        @mod
          <li><a href="{{ route('moderator.dashboard') }}">Mod Dash</a></li>
        @endmod
        </ul>
      </div>
    </div>
  </div>
</header>
