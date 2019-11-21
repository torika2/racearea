@extends('layouts')
@section('link')
	<link rel="stylesheet" href="css/technostream.css">
{{-- 	<meta name="_csrf" th:content="${_csrf.token}"/>
	<meta name="_csrf_header" th:content="${_csrf.headerName}"/> --}}
  <meta charset="utf-8">
@endsection

@section('main')


@foreach ($chan as $chans)
      <div id="iframe" class="main-stream" style="width: 70%; height: 500px;display: inline-block;">
        <iframe
            src="https://player.twitch.tv/?channel={{$chans->twitchname}}&muted=true"
            height="100%"
            width="100%"
            frameborder="0"
            scrolling="no"
            allowfullscreen="true" >
        </iframe>
      </div>
      {{-- chat --}}
      <div class="main-chat">
        <div class="chat-output">
            <div class="chat-message">
        <p>

            @foreach ($chat as $chats)
	            @if ($chats->chanId == $chans->chanId)
		            @if ($chats->twitchname == $chans->twitchname)
		            	<span class="chat-user-name" style="text-decoration: underline gold;">{{ $chats->twitchname }} :</span>
		            @else
	                    <span class="chat-user-name" >{{ $chats->twitchname }} :</span>
	                @endif
	                    <br>
	                <span id="chatOutput" class="chat-user-text">{{ $chats->content }}</span></p>
	            @endif
            @endforeach
        </div>
        </div>
        <div class="chat-input">
            <form action="{{ route('anotherChat') }}" method="POST">
                {{ csrf_field() }}
                <input type="text" style="color:white;" name="content">
                <input type="hidden" name="aUserId" value="{{ $chans->uId }}">
                <input type="hidden" name="chanId" value="{{ $chans->chanId }}">
                <button class="btn btn-primary" style="display: inline-block;height: 32px;font-size: 19px;">^</button>
            </form>
            
        </div>
      </div>
      </div>
      {{-- chatend--}}
      <div>
          <p style="display:inline-block;">Viewers : <span id="stream-viewers" style="font-size: 20px"><code>{{$chans->view}}</code></span></p>
		          	<p style="display:inline-block; margin-left: 2%;">Donated Coins:<span id="stream-subscribers" style="margin-left:2px;font-size: 20px"><code>{{$donator}}</code></span></p>

          <form id="chatForm" action="{{ route('goAnotherCoin') }}" method="POST">
          	{{ csrf_field() }}
          		<select  name="amount" >
          			<option value="5">5</option>
          			<option value="10">10</option>
          			<option value="20">20</option>
          			<option value="25">25</option>
          			<option value="50">50</option>
          			<option value="100">100</option>
          			<option value="125">125</option>
          		</select>
          		<input type="hidden" name="amountCoin" value="{{ $chans->coin }}">
          		<input type="hidden" name="userId" value="{{ $chans->uId }}">
                <input type="hidden" name="chanId" value="{{ $chans->chanId }}">
          		<button class="btn btn-danger">Give Coins</button>
          </form>
{{--           	<script type="text/javascript">
          			$('#chatForm').on('submit', function(){
          				e.preventDefault();
          				var details = $('#chatForm').serialize();
          				$.post('{{ route('goCoin') }}',details,function(){
          					$('#chatOutput').html(data);
          				});
          			});
          	</script> --}}
      </div>
      <div class="main-about">
          <div class="main-about-stream">
            <article>
                <h4>ტოპ დონატორები</h4>
                <hr>
                <ul style="display: block;">
                    <li>სახელი</li>
                    <li>სახელი</li>
                    <li>სახელი</li>
                    <li>სახელი</li>
                    <li>სახელი</li>
                </ul>
            </article>
            <article>
                <h4>ტოპ მოგებული</h4>
                <hr>
                <ul style="display: block;">
                        <li>1000</li>
                        <li>100</li>
                        <li>10</li>
                        <li>10</li>
                        <li>10</li>
                    </ul>
            </article>
          </div>
      </div>
@endforeach

@endsection
@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
@endsection