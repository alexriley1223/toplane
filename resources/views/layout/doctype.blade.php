<meta charset="utf-8" />
<meta name="content-language" content="english" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=5.0" />

<title>{{ $title }}</title>
<meta name="description" content="description" />
<meta name="author" content="Alex Riley" />
<meta name="keywords" content="" />
<meta name="rating" content="general" />
<meta name="robots" content="index, follow" />
<meta name="audience" content="all" />

<link rel="canonical" href="{{ url()->current() }}"/>
<meta property="og:type" content="website" />
<meta property="og:title" content="" />
<meta property="og:description" content="" />
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="" />
<meta property="og:image" content="" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="" />
<meta name="twitter:title" content="" />
<meta name="twitter:image" content="" />

<link type="image/png" rel="icon" href="/assets/img/favicon.png" />

{{-- Alpine --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

{{-- Bootstrap Icons --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

{{-- Main App Styles --}}
<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
