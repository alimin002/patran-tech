
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link href="{{URL('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{url('assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h3>Welcome to patra Tech</h3>
            <p>
							System Application and Product In Data Processing For Resources optimation <br/>(Base Development Version)
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
						@if(session('session_message'))
						<div class="alert alert-danger">
               Password Or username is incorrect!
            </div>
						@endif
            <form class="m-t" role="form" action="{{url('do_login')}}" method="POST">
								{{ csrf_field() }}
                <div class="form-group">
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
                </div>
								<div class="form-group">
                    <select name="role" id="role" class="form-control" placeholder="Password" required="">
											<option>Select Roles</option>
											@foreach($sys_roles as $key => $value)
											<option value="{{$value['name']}}">{{$value['name']}}</option>
											@endforeach
										</select>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>
            </form>
            <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{url('assets/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>

</body>

</html>
