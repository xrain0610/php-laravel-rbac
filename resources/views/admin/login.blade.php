<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{trans('admin.title')}} | {{trans('admin.login')}}</title>

    <link href="{{$static}}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{$static}}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{$static}}/css/animate.css" rel="stylesheet">
    <link href="{{$static}}/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h2 class="logo-name">{{trans('common.pianke')}}</h2>

            </div>
            <form class="m-t" role="form" method="post" action="">
                <div class="form-group">
                    <input type="username" name="username" class="form-control" placeholder="{{trans('common.username')}}" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="{{trans('common.password')}}" required="">
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button type="submit" class="btn btn-primary block full-width m-b">{{trans('admin.login')}}</button>
            </form>
            <p class="m-t"> <small>Pianke &copy; 2015</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{$static}}/js/jquery-2.1.1.js"></script>
    <script src="{{$static}}/js/bootstrap.min.js"></script>
    @if (!empty(\Session::get('error')))
    <script type="text/javascript">
        alert("{{\Session::get('error')}}");
    </script>
    @endif
</body>

</html>
