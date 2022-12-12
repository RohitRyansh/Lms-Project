@extends('layouts.main')
@section('content')
<div class="allcontent">
    <table class="table">
        <tr class="table-heading">
            <th>Course Name</th>
            <th>Created At</th>
        </tr>
        <tr>
        @if ($courses)
            @foreach ($courses as $course)
                <td><a href=" {{ route('employee.units.index', $course)  }}"> {{ $course->title }}</a> </td> 
                <td> {{ $course->created_at }} </td>
            @endforeach
        @else
            <h1 style="text-align: center;">No Course Enrolled</h1>         
        @endif
        </tr>
    </table>
</div>
@endsection