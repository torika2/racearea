@foreach ($topDonator as $topDonators)
	@if ($topDonators->total >= 3000)
		<li><code>&bigstar;&bigstar;&bigstar;</code> {{$topDonators->name}} : {{$topDonators->total}}</li>
	@endif
	@if ($topDonators->total >= 2000 && $topDonators->total < 3000)
		<li><code>&bigstar;&bigstar;</code> {{$topDonators->name}} : {{$topDonators->total}}</li>
	@endif
	@if ($topDonators->total >= 1000 && $topDonators->total < 2000)
		<li><code>&bigstar;</code> {{$topDonators->name}} : {{$topDonators->total}}</li>
	@endif
	@if ($topDonators->total >= 500 && $topDonators->total < 1000)
		<li><b>&starf;</b> {{$topDonators->name}} : {{$topDonators->total}}</li>
	@endif
	@if ($topDonators->total >= 300 && $topDonators->total < 500)
		<li>&#9734; {{$topDonators->name}} : {{$topDonators->total}}</li>
	@endif
	@if ($topDonators->total >= 100 && $topDonators->total < 300)
		<li> {{$topDonators->name}} : {{$topDonators->total}}</li>
	@endif
@endforeach
<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>