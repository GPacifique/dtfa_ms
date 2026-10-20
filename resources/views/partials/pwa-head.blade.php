{{-- Shared metadata for browser tabs, search previews and social link cards. --}}
<meta name="application-name" content="{{ config('app.name', 'Sport Academy') }}">
<meta name="description" content="@yield('meta_description', 'Manage sports academies, fitness clubs, athletes, training, attendance and club operations.')">
<meta name="theme-color" content="#1d4ed8">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="Sport Academy">

<link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
<link rel="icon" type="image/svg+xml" href="{{ asset('images/pwa-icon.svg') }}">
<link rel="apple-touch-icon" href="{{ asset('logo.jpeg') }}">
<link rel="canonical" href="{{ url()->current() }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('app.name', 'Sport Academy') }}">
<meta property="og:title" content="@yield('og_title', trim($__env->yieldContent('title', config('app.name', 'Sport Academy'))))">
<meta property="og:description" content="@yield('meta_description', 'Manage sports academies, fitness clubs, athletes, training, attendance and club operations.')">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ asset('logo.jpeg') }}">
<meta property="og:image:alt" content="{{ config('app.name', 'Sport Academy') }} logo">
<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="@yield('og_title', config('app.name', 'Sport Academy'))">
<meta name="twitter:description" content="@yield('meta_description', 'Manage sports academies, fitness clubs, athletes, training, attendance and club operations.')">
<meta name="twitter:image" content="{{ asset('logo.jpeg') }}">
