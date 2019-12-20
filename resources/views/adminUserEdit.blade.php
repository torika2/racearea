@extends('adminLayout')
@section('link')
	<link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css')}}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection

	@section('title','Edit User')
<style>
	hr{
		background: white;
	}
</style>
@section('main')
	@if ($userInfo)
		<div style="display: inline-block;">
			@foreach ($userInfo as $userInfos)
			<dir>
					<dl>
					  <dt style="color: black;">Name</dt>
					  <dd style="color: white;"><kbd>{{$userInfos->name}}</kbd></dd>
					  <dt style="color: black;">Email</dt>
					  <dd style="color: white;"><kbd>{{$userInfos->email}}</kbd></dd>
					</dl>
					<meter value="0.7">60%</meter>
			</dir>
			@endforeach
			<div>
				@foreach ($banInfo as $banInfos)
				<dir>
					<hr>
				<dl>
					@if ($banInfos->chatBan == 1)
						<dt style="color: black;">Chat Ban</dt>
						@if ($banInfos->banned == 1)
					 		<dd style="color: white;"><kbd style="color: red;">Banned</kbd></dd>
						@else
					 		<dd style="color: white;"><kbd>N\A</kbd></dd>
					 	@endif
					@endif
					@if ($banInfos->channelBan == 1)
						<dt style="color: black;">Channel Ban</dt>
					 		<dd style="color: white;"><kbd style="color: red;">Banned</kbd></dd>
					 	@else
					 		<dd style="color: white;"><kbd>N\A</kbd></dd>

					@endif
				</dl>
				<hr>
				</dir>
				@endforeach
			</div>

		</div>
	@endif
@endsection