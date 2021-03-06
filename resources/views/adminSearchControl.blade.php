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
            Guest
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
      </tr>
  @endforeach
  @else
    <th>  
      <td>Users not exist yet!</td>
    </th>
@endif