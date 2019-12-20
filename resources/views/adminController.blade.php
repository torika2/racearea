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
      <th scope="col">{ Rank }</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th>Status</th>
      <th>-------</th>
    </tr>
  </thead>
  <tbody>
    {{-- admin profile list --}}
@if ($adminUser) 
  @foreach ($adminUser as $adminUsers)
    <tr>
      <th scope="row">{{$adminUsers->id}}</th>
      	@if($adminUsers->admin == 1)
      		<td>
	      		<b style="color:gold">Admin</b>
	  		</td>
  		@endif
      <td>{{$adminUsers->name}}</td>
      <td>{{$adminUsers->email}} </td>
      <td>
        @if ($adminUsers->streamer == 1)
          Streamer
        @else
          None
        @endif
      </td>
      {{-- not to edit another admin profile --}}
      @if ($adminUsers->admin == 1)
        {{-- permission to change your admin profile --}}
        @if ($adminUsers->id == \Auth::user()->id)
          <td>
            <form action="" method="POST">
                @csrf
                <button class="btn btn-warning" style="color: white;">Edit</button>
            </form>
          </td>
        @else
          <td>
            <button class="btn btn-warning" style="color: white;" disabled>Edit</button>
          </td>
        @endif
      @else
        <td>
          <form action="" method="POST">
                @csrf
            <button class="btn btn-warning" style="color: white;" disabled>Edit</button>
          </form>
        </td>
      @endif
    </tr>
  @endforeach
@else
  <th>  
    <td>Here will be admin list! (User)</td>
  </th>
@endif
  </tbody>
</table>
</div>
@endsection
@section('script')
	
@endsection