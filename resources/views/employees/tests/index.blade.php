@extends('layouts.main')
@section('content')
<div class="allcontent">
    <table class="table">
        <tr class="table-heading">
            <th>Test Name</th>
        </tr>
        <tr>
            @if ($unit->tests)
                @foreach ($unit->tests as $test)
                    <td><a href=" {{ route('employee.tests.questions.index', $test )  }}">{{ $test->name}}</td></a>
                @endforeach    
            @else
            <h1 style="text-align: center;">No Test Available</h1>         
            @endif
        </tr>
    </table>
</div>
@endsection