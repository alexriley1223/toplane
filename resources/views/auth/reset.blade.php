@extends('layout.base.auth', ['title' => 'Reset Password'])

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
            <h1 class="text-2xl">Reset your Password</h1>
          </div>

          @if($errors)
            {{ $errors }}
          @endif

          {{-- Register Form --}}
          <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Email --}}
            <div class="relative w-full mb-3">
              <label for="email" class="block uppercase text-gray-600 text-xs font-bold mb-2">Email</label>
              <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" required class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
            </div>

            {{-- Password --}}
            <div class="relative w-full mb-3">
              <label for="password" class="block uppercase text-gray-600 text-xs font-bold mb-2">Password</label>
              <input type="password" placeholder="Password" name="password" required class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
            </div>

            {{-- Password Confirm --}}
            <div class="relative w-full mb-3">
              <label for="password_confirmation" class="block uppercase text-gray-600 text-xs font-bold mb-2">Confirm Password</label>
              <input type="password" placeholder="Confirm Password" name="password_confirmation" required class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
            </div>

            {{-- Submit Button --}}
            <div class="text-center mt-6">
              <input class="bg-gray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150 cursor-pointer" type="submit" value="Reset Password"></input>
            </div>
          </form>

        </div>
      </div>
    </div>

    @if($errors->any())
      @foreach ($errors->all() as $error)
        <div class="inline-error inline-error__alert">
          @include('modules.svg.alert.alert')
          <p>{{ $error }}</p>
        </div>
      @endforeach
    @endif
  </div>
</section>

@endsection
