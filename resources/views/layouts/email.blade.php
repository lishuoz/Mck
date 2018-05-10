<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">

    <title>Hello, world!</title>
</head>
<body>
  <div class="container">
    @yield('content')
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ URL::asset('js/jquery-3.3.1.slim.min.js') }}"></script>
<script src="{{ URL::asset('js/popper.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
</body>
</html>

