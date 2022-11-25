
@if (session('success'))
<p class="succesmessage">{{session('success')}}</p>
@endif
<form action="{{ route('enroll.store', $course) }}" method="post">
    @csrf
    @foreach ($users as $user)
        <p>{{ $user->first_name }} <input type="checkbox" name="user_ids" id="check" value="{{ $user->id }}"/></p>
    @endforeach
    <input type="submit" value="Add" name="submit">
</form>
@foreach($enrolledUsers as $enrolledUser)
<p>{{ $enrolledUser->first_name}}</p>
<form action="{{route('enroll.delete',['course'=>$course,'enrolledUser'=>$enrolledUser] )}}" method="post">
    @csrf
    @method('delete')
    <input type="submit" value="Unenroll" class="deletebuttons">
</form>
@endforeach