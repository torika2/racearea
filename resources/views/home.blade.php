@extends('layouts')
@section('title','Home Page')
@section('link')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css')}}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

@endsection

@section('main')
<style type="text/css">
    main{
        margin-top:-1.5%;
    }
</style>
@if (!empty($channel))
        @if ( $channel->userId == \Auth::user()->id )
        <div class="popular-stream">
                <iframe style="border: solid 2px orange" 
                src="https://player.twitch.tv/?channel=
   {{$channel->twitchname}}
             &muted=true"
                height="100%"
                width="100%"
                frameborder="0"
                scrolling="no"
                allowfullscreen="true">
            </iframe>
        </div>
        @else
                <div class="popular-stream">
                <iframe
                src="https://player.twitch.tv/?channel=
   {{$channel->twitchname}}
             &muted=true"
                height="100%"
                width="100%"
                frameborder="0"
                scrolling="no"
                allowfullscreen="true">
            </iframe>
        </div>
        @endif
@endif
        
        <hr>
        <h3 style="text-align: center;">ტოპ სტრიმები</h3>
        <div class="stream-grid">
            @if (!empty($topStreams) && !empty($channel))
             @foreach ($topStreams as $topStream)
                @if ($topStream->userId != $channel->userId)
                    <article>
                        @if ($topStream->userId == Auth::user()->id)
                            <div class="recomended-streams" style="border: solid 3px orange;width: 339px; height: 250px;">
                                <iframe
                                    src="https://player.twitch.tv/?channel={{$topStream->twitchname}}&muted=true"
                                    height="100%"
                                    width="100%"
                                    frameborder="0"
                                    scrolling="no"
                                    allowfullscreen="true">
                                </iframe>
                            </div>
                            @else
                            <div class="recomended-streams" style="width: 339px; height: 250px;">
                                <iframe
                                    src="https://player.twitch.tv/?channel={{$topStream->twitchname}}&muted=true"
                                    height="100%"
                                    width="100%"
                                    frameborder="0"
                                    scrolling="no"
                                    allowfullscreen="true">
                                </iframe>
                            </div>
                        @endif
                    </article>
                @endif
            @endforeach
            @endif
            </div>
    <hr>
  <h3 style="text-align: center;">ტოპ კლიპები</h3>
  <div class="stream-grid" style="margin-top: 30px;">
        <article>
                <div class="top-clips" style="width: 339px; height: 250px;">
                        <video src=""></video>
                </div>
        </article>
        <article>
            <div class="top-clips" style="width: 339px; height: 250px;">
            <video src=""></video>
        </div>
        </article>
        <article>
                <div class="top-clips" style="width: 339px; height: 250px;">
                        <video src=""></video>
                </div>
        </article>
        </div>

@endsection

@section('script')
<script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js') }}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@endsection
