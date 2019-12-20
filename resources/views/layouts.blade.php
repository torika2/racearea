<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css')}}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <link href="{{asset('https://fonts.googleapis.com/css?family=Kulim+Park&display=swap" rel="stylesheet')}}">
    <link rel="icon" type="image/png" href="{{asset('Images/gamepad.png')}}" sizes="16x16"/>
    <link rel="stylesheet" href="{{asset('css/techhome.css')}}">
        @yield('link')

</head>
<body>
    <style type="text/css">
        .logoLink:hover{
            opacity: 0.7;
        }
        .ahrefCoin img:hover{
            opacity: 0.8   ;
        }
        .topChans:hover{
            border-top-style:none;
            border-left-style:none;
            border-right-style:none;
            border-bottom-style:solid;
            color:yellow;
        }
        .topChans .twitchname:hover{
            color:gold;
        }
        .saxeli-gvari:hover{
            opacity:0.7;
        }
        .logout{
            margin-left:0.5%;
        }
    </style>

        <div class="sidebar">

                <h4>ტოპ 5 არხები</h4>
                <hr>
                <ul class="top-channels" style="margin-left: -10px;">
                    @foreach (App\Channel::select('users.id AS uId','channels.id as chanId','channels.twitchname','channels.choosen_game')->join('users','channels.userId','=','users.id')->orderBy('coins','desc')->take(5)->get() as $popularUsers)
                    <form method="POST" action="{{ route('streamerGuy') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$popularUsers->uId}}" name="userId">
                        <input type="hidden" name="chanId" value="{{$popularUsers->chanId}}">
                        <button style="background: #1d2329;border:none;">
                            <li style="display:block;"class='topChans'>
                                <img src="{{ asset('Images/man.png') }}" alt="avatar" width="30" height="30" style="display: inline-block;">
                                <p style="display: inline-block;" class="twitchname">
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
      
                        <li style="display: block;" class="topChans">
                            <img src="{{asset('Images/man.png')}}" alt="avatar" width="30" height="30" style="display: inline-block;">
                            <p style="display: inline-block;" >
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
                <p style="display: inline-block;">{{\Auth::user()->name}}</p>
            </a>
        </div>
<div style="display: inline-block;" class="logout">
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
        @yield('main')
    </main>
    </body>
<script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript">

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
    // setInterval(function(){
    //     console.clear();
    // },30000);
    setInterval(function(){
        myCoins();
    },2000);

</script>
    @yield('script')
</html>