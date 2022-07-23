<header>

  {{-- Navbar --}}
  <nav class="relative container mx-auto p-6">
    {{-- Flex Container --}}
    <div x-data="{ open: false }" class="flex items-center justify-between">

      {{-- Logo --}}
      <div>
        <p><a href="/" class="hover:text-red-600">Toplane</a></p>
      </div>

      {{-- Items --}}
      <div class="hidden md:flex space-x-6">
        <a href="{{ route('pages.home') }}" class="hover:text-red-600">Home</a>
        <a href="{{ route('forum') }}" class="hover:text-red-600">Forum</a>
        <a href="/news" class="hover:text-red-600">News</a>
      </div>

      {{-- Profile --}}
      @auth
        <div @click="open = !open" class="hidden md:block w-12 h-12 rounded-full overflow-hidden border-2 dark:border-red-600 border-gray-900 cursor-pointer">
          <img class="w-full h-full object-cover" src="/storage/{{ auth()->user()->picture_url }}" alt="{{ auth()->user()->name }}'s Profile Picture">
        </div>

        {{-- Profile Dropdown --}}
        <div
          x-show="open"
          x-transition:enter="transition ease-out duration-100"
          x-transition:enter-start="transform opacity-0 scale-95"
          x-transition:enter-end="transform opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-75"
          x-transition:leave-start="transform opacity-100 scale-100"
          x-transition:leave-end="transform opacity-0 scale-95"
          class="md:absolute top-16 right-0 w-60 px-5 py-3 dark:bg-gray-200 bg-white rounded-lg shadow border dark:border-transparent mt-5">
          <a href="/profile/{{ auth()->user()->name }}" class="block hover:text-red-600">Profile</a>
          @admin
            <a href="{{ route('admin.dashboard') }}" class="block hover:text-red-600">Admin Dash</a>
          @endadmin
          @mod
            <a href="{{ route('moderator.dashboard') }}" class="block hover:text-red-600">Mod Dash</a>
          @endmod
          <a href="{{ route('auth.signout') }}" class="block hover:text-red-600">Logout</a>
        </div>

      @endauth

      {{-- Guest Login Button --}}
      @guest
        <a href="{{ route('auth.login') }}" class="hidden md:block p-3 px-6 pt-2 text-white bg-red-600 rounded-full baseline hover:bg-red-200">Login</a>
      @endguest


    </div>
  </nav>
</header>
