<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{asset('Images/gamepad.png')}}" sizes="16x16"/>
	@yield('link')
	<title>@yield('title')</title>
</head>
<body>
<style type="text/css">
	.nav{
		position: fixed;
		width: 100%;
		margin-right:-25%;
		float: right;
		z-index: 3;
		height: 80px;
		background: #343a40;
		margin:0px;
		color:white;
	}
	.aside1{
		float: left;
		min-height:546px;
		margin-top: 5.9%;
		z-index: 5;
		width: 17%;
		background: #343a45;
		color:white;
		text-decoration: none;
		position: fixed;
		height: 100%;
	}	
	.main{
		width: 83%;
		margin-top: 5.5%;
		z-index: -1;
		float:right;
		height: 100%;
		background: grey;
	}
	.streamPageButton{
		background:lightgrey;
		width: 110px;
		border-radius:4px;
		height: 29px;
		margin-left: 4%;
		text-align:center;
		color:white;
		position:inherit;
		margin-top: 25%;
	}
	.logoLink{
		margin:1%;
	}
	.adminName{
		color:white;
		text-decoration: underline gold;
		float: right;
		margin-left: 30%;
		margin-top: 1.7%;
	}
	.adminPanelText{
		margin-left:40%;
		color: white;
		font-size: 30px;
		margin-top: 0.8%;
	}
	.list-group a{
		background: #343a45;
		color: white;
	}
</style>
<nav class="nav">
		<a href="{{ route('adminPage') }}" class="logoLink">
		  <img src="{{ asset('Images/gamepad.png') }}" width="55px;" height="45px;"  alt="logo" >
		</a>
		<p class="adminPanelText"><code><b>Admin Panel</b></code></p>
		<a href="#" class="adminName">
			<code>
				{{\Auth::user()->name}}
			</code>
		</a>
</nav>
<aside class="aside1">
	<code style="margin-left: 39%;font-size: 17px;">Menu</code>
		<div class="list-group">
			@if (Auth::check())
				<a href="{{ route('adminPage') }}" class="list-group-item list-group-item-action list-group-item-dark">
					<code>Users</code> Controller
				</a>
				<a href="#"  class="list-group-item list-group-item-action list-group-item-dark">
					<code>Channels</code> Controller
				</a>
				<a href="#" class="list-group-item list-group-item-action list-group-item-dark">
					<code>Ban</code> Controller
				</a>
				<a href="#" class="list-group-item list-group-item-action list-group-item-dark">
					<code>Admin</code> Controller
				</a>
				<a href="{{ route('home') }}" style="background: darkred;" class="list-group-item list-group-item-action list-group-item-dark">
					Stream Page
				</a>
			@else
				<a href="{{ route('logout') }}" style="background: darkred;" class="list-group-item list-group-item-action list-group-item-dark">
       				<code>Session Not Exist!</code>
       			</a>
        	@endif
		</div>
</aside>
	<main class="main">
		@yield('main')
	</main>
</body>
<script type="text/javascript">
	@yield('script')
</script>
</html>