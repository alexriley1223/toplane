@extends('layout.base.auth', ['title' => 'Register'])

@section('content')

<section class="auth">
  <div class="auth__container">
    <div class="auth__wrapper">
      <h1>Create an account</h1>
      <p>Already have an account? <a href="{{ route('auth.login') }}">Log in.</a></p>
      <form action="{{ route('auth.create') }}" method="POST">
        @csrf
        <div class="auth__input">
            <label for="username">Username</label>
            <input type="text" placeholder="Username" id="username" name="username" value="{{ old('username') }}" required autofocus>
        </div>
        <div class="auth__input">
            <label for="email">Email</label>
            <input type="text" placeholder="Email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="auth__input">
            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password" name="password" required>
        </div>
        <div class="auth__input">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" placeholder="Confirm" id="password_confirmation" name="password_confirmation" required>
        </div>
        @if($errors->any())
          @foreach ($errors->all() as $error)
            <div class="inline-error inline-error__alert">
              @include('modules.svg.alert.alert')
              <p>{{ $error }}</p>
            </div>
          @endforeach
        @endif
        <div>
            <button type="submit">Sign up</button>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection

@push('script')

@endpush
