@extends('layout.base.app', ['title' => 'Register'])

@section('content')

<form action="{{ route('auth.create') }}" method="POST">
  @csrf
  <div>
      <input type="text" placeholder="Name" id="username" name="username" required autofocus>
      @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
      @endif
  </div>
  <div>
      <input type="text" placeholder="Email" id="email_address" name="email" required autofocus>
      @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
      @endif
  </div>
  <div>
      <input type="password" placeholder="Password" id="password" name="password" required>
      @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
      @endif
  </div>
  <div>
      <div class="checkbox">
        <label><input type="checkbox" name="remember"> Remember Me</label>
      </div>
  </div>
  <div>
      <button type="submit">Sign up</button>
  </div>
</form>

@endsection

@push('script')

@endpush
