<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Connectbook')</title>
<link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --blue: #1877f2; --blue-dark: #166fe5; --green: #42b72a; --green-dark: #36a420;
    --text-primary: #1c1e21; --text-secondary: #65676b; --text-link: #1877f2;
    --border: #dddfe2; --bg-page: #f0f2f5; --bg-card: #ffffff;
    --shadow: 0 2px 4px rgba(0,0,0,.1), 0 8px 16px rgba(0,0,0,.1);
    --radius: 8px; --input-border: #ccd0d5;
  }
  html, body { height: 100%; font-family: 'Libre Franklin', -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif; background: var(--bg-page); color: var(--text-primary); }
  body { display: flex; flex-direction: column; min-height: 100vh; }
</style>
@stack('styles')
</head>
<body>
  @yield('content')

  @stack('scripts')
</body>
</html>
