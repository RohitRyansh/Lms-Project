@extends('layouts.main')
@section('content')
<div class="allcontent">
    <div class="enrollments">
        @if (session('success'))
            <p class="succesmessage"> {{ session('success') }} </p>
        @endif
        @if (session('unsuccess'))
            <p class="dangermessage"> {{ session('unsuccess') }} </p>
        @endif
        <table class="table">
            <tr class="table-heading">
                <th>Name</th>
                <th>Enrolled</th>
                <th>Action</th>
            </tr>
            <tr>
                <form action=" {{ route('enroll.store', $course)  }} " method="post">
                    @csrf
                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Add Users
                        </button>
                        <ul class="dropdown-menu">
                          @foreach ($users as $user)
                          <p><input type="checkbox" name="userIds[]" id="check" value="{{ $user->id }} "/>{{ $user->first_name  }}</p>
                          @endforeach
                          <input type="submit" value="Add" name="submit">
                        </ul>
                      </div>          
                </form>
                <div>
                    @error('userIds')
                        {{ $message }}
                    @enderror
                </div>
                @foreach ($enrolledUsers as $enrolledUser)
                <td> {{ $enrolledUser->first_name }} </td>
                <td> {{ $enrolledUser->created_at }} </td>
                <form action=" {{ route('enroll.delete',['course' => $course,'enrolledUser' => $enrolledUser] ) }} " method="post">
                    @csrf
                    @method('delete')
                    <td><input type="submit" value="Unenroll" class="enrollDelete"></td>
                </form>
                @endforeach
            </tr>
        </table>
        <a href=" {{  route('courses')  }} " class="btn btn-outline-secondary">courses</a>
    </div>
@endsection
