@extends('layout.base.auth', ['title' => 'Forgot Password'])

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
            <h1 class="text-2xl">Recovering Your Account</h1>
            <p class="leading-4 my-3"><small class="font-medium">Enter the email associated with your account - if the account exists we will send an email with a password reset link.</p>
          </div>

          {{-- Register Form --}}
          <form method="POST" action="{{ route('auth.forgot.post') }}">
            @csrf
            {{-- Email --}}
            <div class="relative w-full mb-3">
              <label for="email" class="block uppercase text-gray-600 text-xs font-bold mb-2">Email</label>
              <input type="text" placeholder="Email" name="email" value="{{ old('email') }}" required class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
            </div>

            {{-- Submit Button --}}
            <div class="text-center mt-6">
              <input class="bg-gray-800 text-white active:bg-blueGray-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full ease-linear transition-all duration-150 cursor-pointer" type="submit" value="Send Email"></input>
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
