<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Main Page</title>
</head>
<body>

    <header>
        <a class="nav" href="{{url('/preferred')}}">
            My Preferred Shops
        </a>
        <a class="nav active" href="{{url('/')}}">
            Nearby Shops
        </a>
    </header>
    <div class="container">
    <nearby :shops-data="{{$shops}}"></nearby>
    </div>


    <script src="{{asset('js/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/nearby.js')}}" type="text/javascript"></script>
</body>
</html>