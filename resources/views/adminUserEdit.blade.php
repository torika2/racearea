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
<style>
.main {
  display: grid;
  grid-template-columns: auto auto auto;
  background-color: darkgrey;
  padding: 10px;
  height: 100%;
}
.grid-item {
  background-color: grey;
  border: 1px solid rgba(0, 0, 0, 0.8);
  padding: 10px;
  font-size: 17px;
  text-align: center;
}
</style>
</style>

	@if ($userInfo)

			
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
			

			@if ($banInfo)
				@foreach ($banInfo as $banInfos)

				<dir>

				<dl>
					@if (!is_null($banInfos->chatBan) && !is_null($banInfos->channelBan))
					
	
					@foreach ($channel as $channels)

						@if ($channels->id == $banInfos->chanId && $banInfos->userId != $channels->userId)
<div class="grid-item">
						<form action="{{ route('streamerGuy') }}" method="POST">
							@csrf
							<input type="hidden" name="chanId" value="{{$channels->id}}">
							<input type="hidden" name="userId" value="{{$channels->userId}}">
						<dd ><b>Streamer: </b><button style="background: none;border:none;"><code style="text-decoration: underline orange;color: white">{{$channels->twitchname}}</code></button></dd>
						</form>
</div>
<div class="grid-item">
							<dt style="color: black;">Chat Ban</dt>
							@if ($banInfos->chatBan == 1)
								<form action="{{ route('adminBan') }}" method="POST">
									@csrf
							 		<dd style="color: white;"><kbd style="color: red;">Banned</kbd></dd>
							 			<input type="hidden" name="userId" value="{{$userInfos->id}}"/>
							 			<input type="hidden" name="chanId" value="{{$channels->id}}"/>
							 			<input type="hidden" value="0" name="unBanChat">
							 			<button class="btn btn-warning">unBan</button>
							 	</form>
							@elseif($banInfos->chatBan == 0)
								<form action="{{ route('adminBan') }}" method="POST">
							 		@csrf
							 		<dd style="color: white;"><kbd>N\A</kbd></dd>
							 			<input type="hidden" name="userId" value="{{$userInfos->id}}"/>
							 			<input type="hidden" name="chanId" value="{{$channels->id}}"/>
							 			<input type="hidden" value="1" name="banChat"/>
							 			<button class="btn btn-danger">Ban</button>
							 	</form>
							@endif					 
							<dt style="color: black;">Channel Ban</dt>
							@if ($banInfos->channelBan == 1)
								<form action="{{ route('adminBan') }}" method="POST">
							 		@csrf
							 		<dd style="color: white;"><kbd style="color: red;">Banned</kbd></dd>
							 			<input type="hidden" name="userId" value="{{$userInfos->id}}"/>
							 			<input type="hidden" name="chanId" value="{{$channels->id}}"/>
							 			<input type="hidden" value="0" name="unBanChannel">
							 			<button class="btn btn-warning">unBan</button>
							 	</form>
							@elseif($banInfos->channelBan == 0)
								<form action="{{ route('adminBan') }}" method="POST">
							 		@csrf
							 		<dd style="color: white;"><kbd>N\A</kbd></dd>
							 			<input type="hidden" name="userId" value="{{$userInfos->id}}"/>
							 			<input type="hidden" name="chanId" value="{{$channels->id}}"/>
							 			<input type="hidden" value="1" name="banChannel"> 
							 			<button class="btn btn-danger">Ban</button>
							 	</form>
							@endif
		</div>
						@elseif ($banInfos->userId == $channels->userId)
								<div class="grid-item">
									<b>Streamer's Channel:</b> <code style="color: white">{{$channels->twitchname}}</code>
								</div>
						@endif
						</div>
						@endforeach


					@else
						<dd style="color: white;"><kbd>Not active yet.!</kbd></dd>
					@endif
					
				</dl>

				</dir>

				@endforeach	
			@endif

			

		</div>

		@endforeach
	@endif
@endsection