@foreach ($chat as $chats)
	@foreach ($chan as $chans)

        @if ($chats->twitchname == $chans->twitchname)
         <span id="twitchname" class="chat-user-name" style="text-decoration: underline gold;">{{ $chats->twitchname }} :</span>
        @else
              <span id="twitchname" class="chat-user-name" >{{ $chats->twitchname }} :</span>
        @endif
              <br>
          <span id="chatOutput" data="{{ $chats->id }}" class="chat-user-text">{{ $chats->content }}</span></p>

	@endforeach
@endforeach
	    @if (\Auth::user()->streamer == 0)
	    	<code>You're Not Streamer,</code><br>
	    	<code>Can't Chat With.</code>
	    @endif