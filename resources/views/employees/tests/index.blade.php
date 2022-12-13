@extends('layouts.main')
@section('content')
<div class="allcontent">
    @if (session('success'))
    <p class="succesmessage">  {{  session('success')  }}  </p>
@endif
    <table class="table">
        <tr class="table-heading">
            <th>Test Name</th>
        </tr>
        @if ($unit->tests)
            @foreach ($unit->tests as $test)
        <tr>
            <td>
                <div class="testattempt">
                    <p>{{ $test->name}}</p>
                    <a href=" {{  route('employee.tests.questions.index', [$unit, $test] ) }} " class="btn btn-outline-secondary">Test Attempt</a></td>
                </div>

            </tr>
            @endforeach    
        @else
            <h1 style="text-align: center;">No Test Available</h1>         
        @endif
    </table>
</div>
@endsection