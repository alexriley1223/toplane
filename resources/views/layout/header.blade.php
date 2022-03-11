<ul>
  <li><a href="{{ route('pages.home') }}">Home</a></li>
  <li><a href="/forum">Forum</a></li>
  <li><a href="/news">News</a></li>
  @auth
    <li><a href="/profile/{{ auth()->user()->name }}">Profile</a></li>
    <li><a href="{{ route('auth.signout') }}">Logout</a></li>
  @endauth

  @admin
    <li><a href="{{ route('admin.dashboard') }}">Admin Dash</a></li>
  @endadmin

  @mod
    <li><a href="{{ route('moderator.dashboard') }}">Mod Dash</a></li>
  @endmod

  @guest
    <li><a href="{{ route('auth.login') }}">Login</a></li>
    <li><a href="{{ route('auth.registration') }}">Register</a></li>
  @endguest

</ul>
