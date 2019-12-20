@extends('adminLayout')
	@section('title','Admin Home')
@section('link')
	<link rel="stylesheet" href="{{asset('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css')}}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection
@section('main')
<style type="text/css">
  tr{
    color: lightgrey;
  }
  table{
    background: #343a45;
  }
</style>
<div style="margin:1%">
<table class="table table-striped">
  <thead>
    <tr>
      <div class="md-form mt-0" style="border-radius: none;">
          <input class="form-control" type="text" placeholder="Search" aria-label="Search">
      </div>
    </tr>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Status</th>
      <th>-------</th>
      <th scope="col">Chat Status</th>
      <th scope="col">Ban Status</th>
    </tr>
  </thead>
  <tbody>
@if ($users) 
  @foreach ($users as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
        @if ($user->streamer == 1)
          Streamer
        @else
          None
        @endif
      </td>
      @if (\Auth::user()->admin == 1)
        <td>
          <form action="{{ route('userEdit') }}" method="POST" style="position: relative;">
              @csrf
                    <input type="hidden" name="userId" value="{{$user->id}}" name="userId" >
              <button class="btn btn-warning" style="color: white;" >Edit</button>
          </form>
        </td>
      @else
        <td>
          <form action="{{ route('userEdit') }}" method="POST">
                @csrf
          
              <button class="btn btn-warning" style="color: white;" disabled>Edit</button>
          </form>
        </td>
      @endif
      {{-- if user banned --}}
      <td>
        N/A
      </td>
      <td>
        N/A
      </td>
    </tr>
  @endforeach
@else
  <th>  
    <td>Here will be users list! (User)</td>
  </th>
@endif
  </tbody>
</table>
</div>
@endsection
@section('script')
	
@endsection