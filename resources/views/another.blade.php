@foreach ($chat as $chats)
	@foreach ($chan as $chans)
	            @if ($chats->chanId == $chans->chanId)
		            @if ($chats->twitchname == $chans->twitchname)
		            	<span id="twitchname" class="chat-user-name" style="text-decoration: underline gold;">{{ $chats->twitchname }} :</span>
		            @else
	                    <span id="twitchname" class="chat-user-name" >{{ $chats->twitchname }} :</span>
	                @endif
	                    <br>
	                <span id="chatOutput" data="{{ $chats->cId }}" class="chat-user-text">{{ $chats->content }}</span></p>
	            @endif
	@endforeach
@endforeach