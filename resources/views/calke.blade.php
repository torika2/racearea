 @foreach ($chat as $chats)
    @foreach ($chan as $chans)
                @if ($chats->chanId == $chans->id)
                    @if ($chats->userId == \Auth::user()->id)
                        <span class="chat-user-name" style="text-decoration: underline gold">
                            {{ $chans->twitchname }}
                        </span>
                    @else
                         <span class="chat-user-name" >{{ $chats->name }}</span>
                    @endif
                        <br>
                    <span id="chatOutput" data="{{$chats->cId}}" class="chat-user-text">{{ $chats->content }}</span></p>
                @endif
    @endforeach
@endforeach