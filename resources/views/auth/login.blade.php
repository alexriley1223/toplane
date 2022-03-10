@extends('layout.base.app', ['title' => 'Login'])

@section('content')

<form method="POST" action="{{ route('auth.authenticate') }}">
    @csrf
    <div>
        <input type="text" placeholder="Email" id="email" name="email" required autofocus>
        @if ($errors->has('email'))
        <span>{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div>
        <input type="password" placeholder="Password" id="password" name="password" required>
        @if ($errors->has('password'))
          <span>{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Remember Me
            </label>
        </div>
    </div>
    <div>
        <button type="submit">Signin</button>
    </div>
</form>

@endsection

@push('script')

@endpush
