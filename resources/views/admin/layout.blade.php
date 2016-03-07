<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NPM Redirector</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.0/foundation.min.css">
  <style>
    body {
      margin-top: 40px;
    }
    .right {
      float: right;
    }
  </style>
  <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.0/foundation.min.js"></script>
</head>
<body>
  <div class="row">
    <div class="columns">
      @if(Session::get('alert'))
        <div class="callout primary">{!! Session::get('alert') !!}</div>
      @endif

      @yield('content')
    </div>
  </div>
</body>
</html>
