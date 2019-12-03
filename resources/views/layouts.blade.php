<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kulim+Park&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="Images/gamepad.png" sizes="16x16"/>
        @yield('link')
    <link rel="stylesheet" href="{{asset('css/techhome.css')}}">
    
    <title>Home</title>
</head>
<body>
    <style type="text/css">
        .logoLink:hover{
            opacity: 0.7;
        }
        .ahrefCoin img:hover{
            opacity: 0.8   ;
        }
        .loader,
.loader:before,
.loader:after {
  background: #ffffff;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader {
  color: #ffffff;
  text-indent: -9999em;
  margin: 88px auto;
  position: relative;
  font-size: 11px;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-animation-delay: -0.16s;
  animation-delay: -0.16s;
}
.loader:before,
.loader:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader:before {
  left: -1.5em;
  -webkit-animation-delay: -0.32s;
  animation-delay: -0.32s;
}
.loader:after {
  left: 1.5em;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em;
    height: 5em;
  }
}
    </style>

        <div class="sidebar">

                <h4>ტოპ 5 არხები</h4>
                <hr>
                <ul class="top-channels" style="margin-left: -10px;">
                    @foreach (App\Channel::select('users.id AS uId','channels.id as chanId','channels.twitchname','channels.choosen_game')->join('users','channels.userId','=','users.id')->orderBy('coins','desc','view','desc')->take(5)->get() as $popularUsers)
                    <form method="POST" action="{{ route('streamerGuy') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$popularUsers->uId}}" name="userId">
                        <input type="hidden" name="chanId" value="{{$popularUsers->chanId}}">
                        <button style="background: #1d2329;border:none;">
                            <li style="display: block;">
                                <img src="{{ asset('Images/man.png') }}" alt="avatar" width="30" height="30" style="display: inline-block;">
                                <p style="display: inline-block;">
                                    {{ $popularUsers->twitchname }}<code style="font-size:20px;">&trade;</code>

                                </p>
                                <span id="dot-on" style="display: inline-block;">
                                </span>
                                <p style="display: block;">
                                    {{ $popularUsers->choosen_game }}
                                </p>
                            </li>
                            </button>
                            </form>
                            <hr>
                    @endforeach
                    
                </ul>
                <h4>არხები</h4>
                <hr>
                <ul class="top-channels" style="margin-left: -10px;">
@foreach (App\Channel::select('channels.id as chanId','users.id','channels.twitchname','channels.choosen_game')->join('users','channels.userId','=','users.id')->get() as $chans)
@if (\Auth::user()->id != $chans->uId)
    <form method="POST" action="{{ route('streamerGuy') }}">
                {{csrf_field()}}
            <input type="hidden" value="{{ $chans->id }}" name="userId">
            <input type="hidden" name="chanId" value="{{$chans->chanId}}">
            <button style="background: #1d2329;border:none;">
      
                        <li style="display: block;">
                            <img src="Images/man.png" alt="avatar" width="30" height="30" style="display: inline-block;">
                            <p style="display: inline-block;">
                                {{ $chans->twitchname }} 
                            </p>
                             {{--  @if (date('g', strtotime($chans->last_activity)) > date('g')-1)
                                <span id="dot-on" style="display: inline-block;">
                              @else
                                <span id="dot-off" style="display: inline-block;">
                              @endif   
                            </span> --}}
                            <p style="display: block;">
                                {{$chans->choosen_game}}
                            </p>
                        </li>
                       
            </button>
    </form>
            <hr>
        @endif
@endforeach
                    </ul>
        </div>
<nav id="nav">
        <div id="logo" style="display: inline-block;">
<a href="{{ route('home') }}" class="logoLink">
  <img src="{{ asset('Images/gamepad.png') }}" width="55px;" height="45px;" style="margin-top: 0%;" alt="logo" >
</a>
        </div>
        <div class="coins" id="myCoinOutput" style="display: inline-block;margin-top: 25px">
            <a href="{{ route('coinBuy') }}" class="ahrefCoin"> 
            <p style="display: inline-block;" >რაოდენობა: {{\Auth::user()->coin}}<p style="display: inline-block;">
             <img src="{{ asset('Images/coins.png')}}" alt="coing" width="30" height="30" style="display: inline-block; margin-left: 10px;">
              </a>
        </div>

        <div class="saxeli-gvari" style="display: inline-block;">
           <a href="{{ route('mS') }}">
                <img style="display: inline-block;" class="rounded-circle" src="{{ asset('Images/man.png') }}" alt="saxeli-gvari" width="42" height="42">
                <p style="display: inline-block;"><a href="#">{{\Auth::user()->name}}</a></p>
            </a>
        </div>
<div style="display: inline-block;">
            <form method="POST" action="{{ route('logout') }}">
                {{ csrf_field() }}
                <button class="btn btn-danger">Logout</button>
            </form>
        </div>
</nav>
    {{-- menu --}}
    <input type="hidden" id="myid" name="myId" value="{{ \Auth::user()->id }}">
    {{-- menuend --}}
    <main id="main">
        <div class="loader"></div>
        @yield('main')
    </main>
    </body>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript">
$(window).on('load', function(){
  setTimeout(removeLoader,2000); //wait for page load PLUS two seconds.
});
function removeLoader(){
    $( ".loader" ).fadeOut(500, function() {
      // fadeOut complete. Remove the loading div
      $( ".loader" ).remove(); //makes page more lightweight 
  });  
}
function myCoins() {
    var myid = $('#myid').val(); 
    $.ajax({
        type:'POST',
        url:'{{ route('layoutCoin') }}',
        data:{
            _token:"{{csrf_token()}}"
        }, 
        success:function(data){
            $('#myCoinOutput').html(data);
        },
    }).fail(function(){
        console.log('Ajax mycoin failed!');
    });
}

    setInterval(function(){
        myCoins();
    },2000);
setInterval(function(){
    console.clear();
},5000);
</script>
<script type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    @yield('script')
</html>