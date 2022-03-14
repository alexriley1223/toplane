@extends('layout.base.auth', ['title' => 'Register'])

@section('content')

<section class="auth">
  <div class="auth__container">
    <div class="auth__wrapper">
      <h1>Create an account</h1>
      <p>Already have an account? <a href="{{ route('auth.login') }}">Log in.</a></p>
      <form action="{{ route('auth.create') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username</label>
            <input type="text" placeholder="Username" id="username" name="username" required autofocus>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" placeholder="Email" id="email" name="email" required autofocus>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" placeholder="Confirm" id="password_confirmation" name="password_confirmation" required>
        </div>
        @foreach ($errors->all() as $error)
          <div>
            <p>{{ $error }}</p>
          </div>
        @endforeach
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
