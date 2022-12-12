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
                <th>Course Name</th>
                <th>Enrolled</th>
                <th>Action</th>
            </tr>
            <tr>
                <form action=" {{ route('userenroll.store', $user) }} " method="post">
                    @csrf
                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Add Courses
                        </button>
                        <ul class="dropdown-menu">
                          @foreach ($courses as $course)
                          <p><input type="checkbox" name="courseIds[]" id="check" value=" {{ $course->id }} "/>{{ $course->title }}</p>
                          @endforeach
                          <input type="submit" value="Add" name="submit">
                        </ul>
                      </div>
                </form>
                <div>
                    @error('courseIds')
                        {{ $message }}
                    @enderror
                </div>
                @foreach ($enrolledCourses as $enrolledCourse)
                <td> {{ $enrolledCourse->title }} </td> 
                <td> {{ $enrolledCourse->created_at }} </td>
                <form action=" {{ route('userenroll.delete', ['user' => $user, 'enrolledCourse' => $enrolledCourse]) }} " method="post">
                    @csrf
                    @method ('delete')
                    <td><input type="submit" value="Unenroll" class="enrollDelete"></td>
                </form>
                @endforeach
            </tr>
        </table>
        <a href=" {{ route('users') }} " class="btn btn-outline-secondary">Users</a>
    </div>
@endsection
