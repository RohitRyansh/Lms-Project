@extends('layouts.main')
@section('content')
<div class="allcontent">
    <table class="table">
        <tr class="table-heading">
            <th>Course Name</th>
            <th>Created At</th>
        </tr>
        <tr>
        @if ($Courses)
            @foreach ($Courses as $Course)
                <td> {{ $Course->title }} </td> 
                <td> {{ $Course->created_at }} </td>
            @endforeach
        @else
            <h1 style="text-align: center;">No Course Enrolled</h1>         
        @endif

        </tr>
    </table>
</div>
@endsection