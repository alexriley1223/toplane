<!DOCTYPE html>

<html lang="en" class="h-full">
    <head>
        @include('layout.doctype', [ 'title' => $title ])

        {{-- Per Page Styles --}}
        @stack('style')
    </head>
    <body class="h-full flex flex-col">
        @include('layout.header')

        <main class="flex-auto">
            @yield('content')
        </main>

        @include('layout.footer')

        <script type="text/javascript" src="{{ mix('assets/js/app.js') }}"></script>

        {{-- Per Page Scripts --}}
        @stack('script')
    </body>
</html>
