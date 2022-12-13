@extends('layouts.main')
@section('content')
<div class="allcontent">
    <table class="table">
        <tr class="table-heading">
            <th>Unit Name</th>
        </tr>
        @if ($course->units)
        @foreach ($course->units as $unit)
        <tr>
            <td><a href=" {{ route('employee.units.tests.index', $unit)  }}">{{ $unit->title}}</td></a>
        </tr>
        @endforeach
        @else
            <h1 style="text-align: center;">No Unit Available</h1>         
        @endif
    </table>
</div>
@endsection