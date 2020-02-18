@extends('layouts')
@section('title','Profile Page')
@section('link')
<link href="{{ asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN " crossorigin="anonymous">
	<link rel="stylesheet" href="{{asset('css/technostream.css')}}">
    <meta name="_csrf" th:content="${_csrf.token}"/>
<meta name="_csrf_header" th:content="${_csrf.headerName}"/>
@endsection

@section('main')
@foreach ($chan as $chans)
    @if ($chans->userId == \Auth::user()->id && \Auth::user()->streamer == 1)
      @php
            $donators =  App\Donator::select('amount')->where('chanId',$chans->id)->sum('amount');
            App\Channel::where('userId',\Auth::user()->id)->update(['coins' => $donators]);
      @endphp
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
        
            @foreach ($chat as $chats)
                @if ($chats->chanId == $chans->id)
                    @if ($chats->userId == \Auth::user()->id)
                        <span class="chat-user-name" style="text-decoration: underline gold">
                            {{ $chans->twitchname }}
                        </span>
                    @else
                         <span class="chat-user-name" >{{ $chats->name }}</span>
                    @endif
                        <br>
                    <p><span id="chatOutput" data="{{$chats->cId}}" class="chat-user-text">{{ $chats->content }}</span></p>
                @endif
            @endforeach
        </div>
        </div>
        <div class="chat-input">
{{--             <form id="chatForm" action="{{ route('chat') }}" method="POST">
                {{ csrf_field() }} --}}
{{--                 @foreach (App\bannedUsers::join('users','users.id','=','banned_users.userId')->where('chanId',$chans->chanId)->get() as $bannedUser)
                  @if ($bannedUser->chatBan == null) --}}
                    
                    <input onkeypress="process(event,this)" type="text" id="content" name="content">
                    <input id="chanId" type="hidden" name="chanId" value="{{ $chans->id }}">
                      @if ($chans->userId == \Auth::user()->id)
                        <input type="hidden" name="myId" value="{{ $chans->userId }}">
                      @endif
                    <button id="button"  type="submit" class="btn btn-primary" style="display: inline-block;"></button>
{{--                   @else
                    <input type="text"  disabled>
                  @endif
                @endforeach --}}
{{--             </form> --}}

<script type="text/javascript">
function addInfo() {
     var content = $('#content').val();
     var chanId = $('#chanId').val();
     var myId = $('#myId').val();
            $.ajax({
              type:'POST',
              url:'{{ route('chat') }}',
              data:{
                _token:"{{csrf_token()}}",
                 content:content,
                 chanId:chanId,
                 myId:myId
              },
               success:function(data) {
                   var content = $('#content').val("");
                   // console.log('Ajax Successfull!!!');
               }
            }).fail(function(){
                console.log('NO AJAX!');
            });
}
function process(e){
  var code = (e.KeyCode ? e.KeyCode : e.which);
  if(code == 13 || $('#button').click()){
   addInfo();
  }
}

   function recieveComm() {
       var content = $('#content').val();
       var chanId = $('#chanId').val();
       var myId = $('#myId').val();
              $.ajax({
                 type:'POST',
                 url:'{{ route('recieve') }}',
                 data:{
                  _token:"{{csrf_token()}}",
                  chanId:chanId,
                  }
                 success:function(data) {
                     $('#comments').append(data);
                 }
              }).fail(function(){
                  console.log('NO AJAX!');
              });
  }


  setInterval(function(){
    recieveComm();},500);

</script>
        </div>
      </div>
      </div>
      {{-- chatend--}}
      <div>
          <p style="display:inline-block;">Viewers : <span id="stream-viewers" style="font-size: 20px"><code>{{$chans->view}}</code></span></p>
          <p style="display:inline-block; margin-left: 2%;">Donated Coins: <span id="stream-subscribers" style="margin-left:2px;font-size: 20px"><code>{{$donators}}</code></span></p>
      </div>
      <div class="main-about">
          <div class="main-about-stream">
            <article>
                <h4>ტოპ დონატორები</h4>
                <hr>
                <ul style="display: block;">
                  @foreach (App\Donator::select('donators.userId','donators.chanId','amount','name')->join('users','users.id','=','donators.userId')->where('chanId',$chans->id)->groupBy('users.name')->orderBy('amount','DESC')->get() as $topDonators)
                    <li>{{$topDonators->name}}:{{$topDonators->amount}}</li>
                  @endforeach
                </ul>
            </article>
            {{-- upload --}}
 
          </div>
      </div>
      <div>
    <form  method="POST" action="{{ route('uploadPhoto') }}" style="margin-top: -20.9%;" enctype="multipart/form-data"> 
      @csrf
      <input class="file-upload" type="file" name="image">
      <button class="btn btn-primary">Upload Image</button>
    </form>

    @if($errors->any())
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)      
        <li>{{$error}}</li>
      @endforeach
      </div>
    @endif
</div>
{{-- UPLOADED IMAGE START--}}
@if ($image->count() > 0)
  <div class="grid-container2">
     @foreach ($image as $images)
      <div class="grid-item2">
        <form method="POST" action="{{ route('profilePic') }}">
          @csrf
          @method('put')
          <input type="hidden" name="image_id" value="{{$images->id}}">
          <button style="background: none;border:none;" class="imageBut">
            <img height="100" width="100" src="{{$images->profile_image}}">
          </button>
        </form>
        @if ($images->profile_image != 'Images/man.png')
        <form method="POST" action="{{ route('profilePicDelete') }}">
          @csrf
          @method('delete')
          <input type="hidden" name="image_id" value="{{$images->id}}">
          <input type="hidden" name="image_path" value="{{$images->profile_image}}">
          <button class="btn btn-danger">Delete</button>
        </form>
        @endif
      </div>
    @endforeach
  </div>
@endif
{{-- UPLOADED IMAGE END --}}
        @if (\Auth::user()->admin == 1)
            <div style="background: lightgrey;width: 110px; border-radius:4px;height: 29px;float: right;text-align: center;opacity: 0.8;color: white;">
                <a href="{{ route('adminPage') }}"><code>Admin Page</code></a>
            </div>

        @endif
    @endif

@endforeach
@if (\Auth::user()->streamer == 0)
<main class="main" style="height: 545px;">
    <label style="color:white;">Create Your Channel</label>
        <form  class="form-group" method="POST" action="{{ route('createChannel') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input err class="form-controll" type="text" name="twitchName" placeholder="Your twitch name...">
            </div>

            <div class="form-group">
            <select name="gameName" class="form-controll">
                <option >Choose game</option>
                <option value="Bloger">Bloger</option>
                <option value="Fortnite">Fortnite</option>
                <option value="Pubg">Pubg</option>
                <option value="Smite">Smite</option>
                <option value="League of Legends">League of Legends</option>
                <option value="CS:GO">CS:GO</option>
                <option value="Dota">Dota</option>
                <option value="World of warcraft">World of warcraft</option>
                <option>Another Game</option>
            </select>
            </div>
            <div class="form-group">
                <input placeholder="Channel Description" name="desc">
            </div>
            <div>
                <button class="btn btn-primary">Create Channel</button>
            </div>
        </form>
        @if ($errors->any())
          <div class="alert alert-danger" style="margin-left:-25%;">
              @foreach ($errors->all() as $error)
                <li style="width: 50%;">{{$error}}</li>
              @endforeach
          </div>
        @endif
</main>
@endif
@endsection
