@foreach ($coin as $coins)
<a href="{{ route('coinBuy') }}" class="ahrefCoin"> 
	<p style="display: inline-block;" >რაოდენობა: {{$coins->coin}}<p style="display: inline-block;">
	<img src="{{ asset('Images/coins.png')}}" alt="coing" width="30" height="30" style="display: inline-block; margin-left: 10px;">
</a>
@endforeach