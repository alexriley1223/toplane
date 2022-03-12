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

{{-- Google Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;900&display=swap" rel="stylesheet">

{{-- Main App Styles --}}
<link type="text/css" rel="stylesheet" href="{{ mix('assets/css/app.css') }}" />
