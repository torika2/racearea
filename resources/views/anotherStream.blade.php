@extends('layouts')
@section('link')
<link href="{{ asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN " crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{asset('css/technostream.css')}}">
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('main')
<style type="text/css">
  .selectDonator{
    background: transparent;
    border-top-style:none;
    border-left-style:none;
    border-right-style:none;
    border-bottom-style:solid;
    color:gold;
    font-size: 20px;
    margin-left: 31%;
  }
  .selectDonator option{
    background: black;
    border-bottom: solid;
  }
</style>

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
                <!-- CHAT OUTPUT HERE! -->
        </div>
        </div>
        <div class="chat-input">
{{--             <form action="{{ route('anotherChat') }}" method="POST">
                {{ csrf_field() }} --}}
                @if (\Auth::user()->streamer == 0)
                  <input onkeypress="process(event,this)" id="content" type="text" style="color:white;" name="content" disabled>
                  <input id="aUserId" type="hidden" name="aUserId" value="{{ $chans->uId }}">
                  <input id="chanId" type="hidden" name="chanId" value="{{ $chans->chanId }}">
                  <button id="chatAdd" class="btn btn-primary" style="display: inline-block;height: 32px;font-size: 19px;" disabled></button>
                @else
                  <input onkeypress="process(event,this)" id="content" type="text" style="color:white;" name="content">
                  <input id="aUserId" type="hidden" name="aUserId" value="{{ $chans->uId }}">
                  <input id="chanId" type="hidden" name="chanId" value="{{ $chans->chanId }}">
                  <button id="chatAdd" class="btn btn-primary" style="display: inline-block;height: 32px;font-size: 19px;"></button>
                @endif

{{--             </form> --}}


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
		          	<!--<p  style="display:inline-block; margin-left: 2%;">Donated Coins:<span id="stream-subscribers" style="margin-left:2px;font-size: 20px"><code>{{$donator}}</code></span></p>-->
            </span>
          @endif
{{--           <form id="chatForm" action="{{ route('goAnotherCoin') }}" method="POST">
          	{{ csrf_field() }} --}}
          		<select  name="amount" class="selectDonator" id="selectedCoin">
          			<option value="10">10</option>
          			<option value="50">50</option>
          			<option value="100">100</option>
          			<option value="250">250</option>
          			<option value="500">500</option>
          			<option value="1000">1000</option>
          		</select>
                <input type="hidden" id="coinChanId" name="chanId" value="{{ $chans->chanId }}">
          		<button id="coinButton" class="btn btn-danger">Give Coins</button>
       {{--    </form> --}}
@if ($errors->any())
  <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
  </div>
@endif



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
                        <article>
                <h4>შემოსული სტრიმერები</h4>
                <hr>
                <ul style="display: block;" id="topDonatorOutput">
@if ($userInfo)
@foreach ($userInfo as $userInfos)
  <form method="POST" action="">
    @csrf
    @if ($userInfos->userId != $chans->uId)
      <li> {{$userInfos->name}} 
      @if (\Auth::user()->id == $chans->uId)
      <select style="background: none;border:none;width: 10%;color:white;">
          <option style="color:white;">...</option>
          @if ($userInfos->chatBan != 1)
            <option value="chat" style="color:black;">chat ban</option>
          @else
            <option value="chat" style="color:black;" disabled>chat ban</option>
          @endif
          @if ($userInfos->channelBan != 1)
            <option value="channel"  style="color:black;">channel ban</option>
          @else
            <option value="channel"  style="color:black;" disabled>channel ban</option>
          @endif
          
      </select>
        <button class="btn btn-danger" id="confirmationButoon"></button>
      </li>
      @endif
    @endif
  </form>
@endforeach
@endif
                </ul>
            </article>
          </div>
      </div>
@endforeach

@endsection
@section('script')
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
    }
  }).fail(function(){
    console.log('ajax failed');
  });
}

  setInterval(function(){
    takeTopDonator();
  },3000);


$('#coinButton').on('click',function(){
  var chanId = $('#coinChanId').val();
  var amount = $('#selectedCoin').val();
        if(amount > {{ \Auth::user()->coin }}){
            alert('You have not enought coin!');
        }
        if(amount < 10){
            alert('Select coin value!');
        }
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
          }
        }).fail(function(){
          //console.log('NO!! AJAX COIN');
        });
});

function channelCoinAmount(){
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
    channelCoinAmount();
  },2000);

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
            var content = $('#content').val(" ");
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
          }
        }).fail(function(){
          console.log(' OutPut notSuccessful');
        });
}

  setInterval(function(){
    takeComm();
  },2000);

</script>
<script src="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js')}}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection