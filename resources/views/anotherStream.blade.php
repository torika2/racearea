@extends('layouts')
@section('link')
<link href="{{ asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN') }} " crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('css/technostream.css') }}">
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
            <div id="comments" class="chat-message">
            {{-- @foreach ($chat as $chats)
              @if ($chats->chanId == $chans->chanId)
                @if ($chats->twitchname == $chans->twitchname)
                  <span id="twitchname" class="chat-user-name" style="text-decoration: underline gold;">{{ $chats->twitchname }} :</span>
                @else
                      <span id="twitchname" class="chat-user-name" >{{ $chats->twitchname }} :</span>
                  @endif
                      <br>
                  <p><span id="chatOutput" data="{{ $chats->cId }}" class="chat-user-text">{{ $chats->content }}</span></p>
              @endif
            @endforeach --}}
        </div>
        </div>
        <div class="chat-input">
{{--             <form action="{{ route('anotherChat') }}" method="POST">
                {{ csrf_field() }} --}}
                <input onkeypress="process(event,this)" id="content" type="text" style="color:white;" name="content">
                <input id="aUserId" type="hidden" name="aUserId" value="{{ $chans->uId }}">
                <input id="chanId" type="hidden" name="chanId" value="{{ $chans->chanId }}">
              <button id="chatAdd" class="btn btn-primary" style="display: inline-block;height: 32px;font-size: 19px;"></button>
{{--             </form> --}}
<script src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js') }}">
  
</script>
<script type="text/javascript">


function process(e){
  var code = (e.KeyCode ? e.KeyCode : e.which);
  if(code == 13){
    giveComm();
  }
}

function giveComm(){
    var content = $('#content').val();
    var chanId = $('#chanId').val();
    var aUserId = $('#aUserId').val();
        $.ajax({
          type:'POST',
          url:'{{ route('anotherChat') }}',
          data: {
            content:content,
            chanId:chanId,
            aUserId:aUserId,
            _token:"{{ csrf_token() }}"
          },
          success:function() {
            var content = $('#content').val("");
            // console.log('Ajax Input Successfull!!');
          }
        }).fail(function(){
          console.log('Input notSuccessful');
        });
}
function takeComm(){
     var chanId = $('#chanId').val();
        $.ajax({
          type:'POST',
          url:'{{ route('another') }}',
          data:{
            _token:"{{csrf_token()}}",
            chanId:chanId,
          },
          success:function(data){
            $('#comments').html(data);
           // console.log('Ajax OutPut Successfull!!');
          }
        }).fail(function(){
          console.log(' OutPut notSuccessful');
        });
}
setInterval(function(){
  takeComm();
},2000);

</script>
        </div>
      </div>
      </div>
      {{-- chatend--}}
      <div>
          <p style="display:inline-block;">Viewers : <span id="stream-viewers" style="font-size: 20px"><code>{{$chans->view}}</code></span></p>
          @php
                           App\Channel::where('id',$chans->chanId)->update(['coins' => $donator]);
          @endphp 

          @if ($donator)
            <span id="outputCoin">
		          	<p  style="display:inline-block; margin-left: 2%;">Donated Coins:<span id="stream-subscribers" style="margin-left:2px;font-size: 20px"><code>{{$donator}}</code></span></p>
            </span>
          @endif
{{--           <form id="chatForm" action="{{ route('goAnotherCoin') }}" method="POST">
          	{{ csrf_field() }} --}}
          		<select  name="amount" id="selectedCoin">
          			<option value="5">5</option>
          			<option value="10">10</option>
          			<option value="20">20</option>
          			<option value="25">25</option>
          			<option value="50">50</option>
          			<option value="100">100</option>
          			<option value="125">125</option>
          		</select>
                <input type="hidden" id="coinChanId" name="chanId" value="{{ $chans->chanId }}">
          		<button id="coinButton" class="btn btn-danger">Give Coins</button>
       {{--    </form> --}}

<script type="text/javascript">
$('#coinButton').on('click',function(){
  var chanId = $('#coinChanId').val();
  var amount = $('#selectedCoin').val();
        $.ajax({
          type:'POST',
          url:'{{ route('goAnotherCoin') }}',
          data:{
            _token:"{{csrf_token()}}",
            chanId:chanId,
            amount:amount
          },
          success:function(){
            $('#selectedCoin').val('');
            console.log('AJAX COIN +')
          }
        }).fail(function(){
          console.log('NO!! AJAX COIN');
        });
});

function test(){
    var chanId = $('#coinChanId').val();
        $.ajax({
          type:'POST',
          url:'{{ route('anotherCoinPage') }}',
          data:{
            _token:"{{csrf_token()}}",
            chanId:chanId
          },
          success:function(data){
            $('#outputCoin').html("<p style='display:inline-block; margin-left: 2%;'>Donated Coins:<span id='stream-subscribers' style='margin-left:2px;font-size: 20px'><code>"+data+"</code></span></p>");    
          }
        }).fail(function(){
          console.log(' OutPut notSuccessful');
        });
}
setInterval(function(){
  test();
},2000);
</script>

      </div>
      <div class="main-about">
          <div class="main-about-stream">
            <article>
                <h4>ტოპ დონატორები</h4>
                <hr>
                <ul style="display: block;" id="topDonatorOutput">
@foreach ($topDonator as $topDonators)
    <li> {{$topDonators->name}} : {{$topDonators->total}}</li>
@endforeach     
                </ul>
            </article>
          </div>
      </div>
<script type="text/javascript">
function takeTopDonator(){
  var chanId = $('#coinChanId').val();
  $.ajax({
    type:'POST',
    url:'{{ route('anotherDonator') }}',
    data:{
      _token:"{{csrf_token()}}",
      chanId:chanId,
    },
    success:function(data){
      $('#topDonatorOutput').html(data);
      // console.log('ajax +');
    }
  }).fail(function(){
    console.log('ajax failed');
  });
}
setInterval(function(){
  takeTopDonator();
},2000);
</script>
@endforeach

@endsection
@section('script')
<script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection