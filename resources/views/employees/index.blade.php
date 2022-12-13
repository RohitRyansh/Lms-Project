@extends('layouts.main')
@section('content')
<div class="allcontent">
    <table class="table">
        <tr class="table-heading">
            <th>Course Name</th>
            <th>Created At</th>
        </tr>
        @if ($courses)
        @foreach ($courses as $course)
        <tr>
                <td> <h4><a href=" {{ route('employee.units.index', $course)  }}">{{ $course->title }}</a></h4> </td> 
                <td> {{ $course->created_at }} </td>
            </tr>
            @endforeach
        @else
            <h1 style="text-align: center;">No Course Enrolled</h1>         
        @endif
    </table>
</div>
@endsection