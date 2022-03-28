@extends('layout.base.auth', ['title' => 'Login'])

@section('content')

<section class="auth">
  <div class="auth__container">
    <div class="auth__wrapper">
      <h1>Welcome back!</h1>
      <p>New? <a href="{{ route('auth.registration') }}">Create an account</a></p>
      <form method="POST" action="{{ route('auth.authenticate') }}">
          @csrf
          <div class="auth__input">
              <label for="email">Email</label>
              <input type="text" placeholder="Email" id="email" name="email" required autofocus>
          </div>
          <div class="auth__input">
              <label for="password">Password <a href="">Forgot Password?</a></label>
              <input type="password" placeholder="Password" id="password" name="password" required>
              @if ($errors->has('password'))
                <span>{{ $errors->first('password') }}</span>
              @endif
          </div>
          <div class="auth__input">
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="remember"> Remember Me
                  </label>
              </div>
          </div>
          @if ($errors->has('email') || $errors->has('password'))
            <div class="inline-error inline-error__alert">
              @include('modules.svg.alert.alert')
              <p>The provided credentials do not match our records</p>
            </div>
          @endif
          <div>
              <button type="submit">Login</button>
          </div>
      </form>
    </div>
  </div>

</section>

@endsection

@push('script')

@endpush
