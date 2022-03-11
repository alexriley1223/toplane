<!DOCTYPE html>

<html lang="en">
    <head>
        @include('layout.doctype', [ 'title' => $title ])

        {{-- Per Page Styles --}}
        @stack('style')
    </head>
    <body>
        @include('layout.header')

        <main class="wrapper">
            @yield('content')
        </main>

        @include('layout.footer')

        <script type="text/javascript" src="{{ mix('assets/js/app.js') }}"></script>

        {{-- Per Page Scripts --}}
        @stack('script')
    </body>
</html>
