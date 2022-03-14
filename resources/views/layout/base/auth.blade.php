<!DOCTYPE html>

<html lang="en">
    <head>
        @include('layout.doctype', [ 'title' => $title ])
    </head>
    <body>

        <main
            @yield('content')
        </main>

        <script type="text/javascript" src="{{ mix('assets/js/app.js') }}"></script>

        {{-- Per Page Scripts --}}
        @stack('script')
    </body>
</html>
