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
@endif