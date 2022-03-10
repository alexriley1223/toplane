<ul>
  <li><a href="{{ route('pages.home') }}">Home</a></li>
  <li><a href="/forum">Forum</a></li>
  <li><a href="/news">News</a></li>
  @auth
    <li><a href="{{ route('auth.signout') }}">Logout</a></li>
  @endauth

  @guest
    <li><a href="{{ route('auth.login') }}">Login</a></li>
    <li><a href="{{ route('auth.registration') }}">Register</a></li>
  @endguest

</ul>
