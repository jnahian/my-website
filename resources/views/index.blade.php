@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
    'locales' => config('app.locales'),
    'githubAuth' => config('services.github.client_id'),
];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }}</title>

  <link href="https://fonts.googleapis.com/css?family=Crimson+Text&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
  <style>
    html, body {
      font-family: 'Crimson Text', serif !important;
      font-size: 1.2rem;
      letter-spacing: 1px;
    }
  </style>
</head>
<body>
  <div id="app"></div>

  {{-- Global configuration object --}}
  <script>
    window.config = @json($config);
  </script>

  {{-- Load the application scripts --}}
  <script src="{{ mix('dist/js/app.js') }}"></script>
</body>
</html>
