@extends('layout.base.auth', ['title' => 'Login'])

@section('content')

<section class="bg-gray-100 h-screen w-screen">

  {{-- Auth Wrapper --}}
  <div class="w-full md:w-1/2 xl:w-4/12 px-4 mx-auto pt-12">

    {{-- Auth Card --}}
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-gray-200 border-0">
      <div class="rounded-t mb-0 px-6 py-6">
        <div class="flex-auto px-4 lg:px-10 py-5">

          {{-- Heading Wrapper --}}
          <div class="text-gray-600 text-center mb-3 font-bold">
            <h1 class="text-2xl">Welcome Back!</h1>
            <p><small class="font-medium">New? <a href="{{ route('auth.registration') }}" class="font-bold underline">Create an account</a></small></p>
          </div>

          @if($errors)
            {{ $errors }}
          @endif

          {{-- Sign In Form --}}
          <form method="POST" action="{{ route('auth.authenticate') }}">
            @csrf
            {{-- Email --}}
            <div class="relative w-full mb-3">
              <label for="email" class="block uppercase text-gray-600 text-xs font-bold mb-2">Email</label>
              <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
            </div>

            {{-- Password --}}
            <div class="relative w-full mb-3">
              <div class="flex flex-row justify-between">
                <label for="password" class="block uppercase text-gray-600 text-xs font-bold mb-2">Password</label>
                <a href="{{ route('auth.forgot.view')}}" class="h-fit"><small class="block uppercase text-gray-600 text-xs font-bold">Forgot Password?</small></a>
              </div>
              <input type="password" placeholder="Password" name="password" required class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
            </div>

            {{-- Remember Me --}}
            <div>
              <label class="inline-flex items-center cursor-pointer"><input id="customCheckLogin" type="checkbox" class="form-checkbox border-0 rounded text-blueGray-700 ml-1 w-5 h-5 ease-linear transition-all duration-150"><span class="ml-2 text-sm font-semibold text-blueGray-600">Remember Me</span></label>
            </div>

            {{-- Submit Button --}}
            <div class="text-center mt-6">
              <input class="bg-gray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150 cursor-pointer" type="submit" value="Sign In"></input>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  @if ($errors->has('password'))
    <span>{{ $errors->first('password') }}</span>
  @endif

  @if ($errors->has('email') || $errors->has('password'))
    <div>
      @include('modules.svg.alert.alert')
      <p>The provided credentials do not match our records</p>
    </div>
  @endif
</section>

@endsection
