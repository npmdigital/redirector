<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>NPM Redirector</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.0/foundation.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.min.css">
  <style>
    .top-bar {
      margin-bottom: 40px;
    }
    .right {
      float: right;
    }
  </style>
  <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.2.0/foundation.min.js"></script>
</head>
<body>

  <div class="top-bar">
    <div class="row">
      <div class="top-bar-title">
        <h4>NPM Redirector</h4>
      </div>
      <div class="top-bar-right">
        <ul class="menu">
          <li><a href="/auth/logout">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>


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
