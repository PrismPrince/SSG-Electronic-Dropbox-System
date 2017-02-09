<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <link href="/css/app.css" rel="stylesheet">
  @stack('styles')

  <!-- Scripts -->
  @if (Auth::guest())
    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
      ]) !!}
    </script>
  @else
    <script>
      window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'authorization' => 'Bearer ' . Auth::user()->api_token,
      ]) !!}
    </script>
  @endif
</head>