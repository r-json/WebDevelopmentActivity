<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Web Development Application')">
    <meta name="theme-color" content="#4f46e5">
    <title>@yield('title') | WebDev App</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- Skip-to-content link for keyboard/screen-reader users -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    @include('common.header')

    <main id="main-content" role="main">
        <div class="my-3 container">
            @yield('content')
            @yield('content2')
        </div>
        @yield('content3')
    </main>

    @include('common.footer')
</body>
</html>
