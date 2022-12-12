@extends('layouts.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=" {{  route ('courses')  }} ">Course</a></li>
            <li class="breadcrumb-item" ><a href="{{ route('courses.view', $course) }}" style="text-decoration: none;width: 600px;">{{ $course->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Test</li>
        </ol>
    </nav>
    @if (session('success'))
        <p class="succesmessage"> {{ session('success') }} </p>
    @endif
    <div class="courses1">
        <form action=" {{ route ('courses.units.tests.update', [ $course, $unit, $test ]) }} " method="post" class="CourseCreate" enctype="multipart/form-data">
            @csrf

            <label for="exampleFormControlInput1" class="form-label">Test Name</label>
            <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Enter Test Name" value="{{ $test->name }}" >
            <span class="errorMessage">
                @error('name')
                 {{ $message }}      
                @enderror
            </span> 
            
            <label for="exampleFormControlInput1" class="form-label">Duration of Test</label>
            <input type="text" name="duration" class="form-control" id="exampleFormControlInput1" placeholder="In Minutes" value="{{ $test->duration }}">
            <span class="errorMessage">
                @error('duration')
                 {{ $message }}      
                @enderror
            </span>

            <label for="exampleFormControlInput1" class="form-label">Pass Score</label>
            <input type="text" name="pass_score" class="form-control" id="exampleFormControlInput1"  value="{{ $test->pass_score }}">
            <span class="errorMessage">
                @error('pass_score')
                 {{ $message }}      
                @enderror
            </span>
   
            <div class="saveButtons">
                <button type="submit" name="save" class="btn btn-secondary">Update</button>
                <a href=" {{ route('courses.units.edit', [ $course, $unit ])  }} " class="btn btn-outline-secondary">Cancel</a>
                <a href="{{ route('tests.questions.create', [$course, $unit, $test]) }}" class="btn btn-outline-secondary">Add Questions</a>
            </div>
        </form>
    </div>
    <div class="lessons">
        <h2>Questions</h2>
         @foreach ($test->questions as $question)
            <p>{{$question->question}}</p>
            <div> 
                <a href=" {{ route('tests.questions.edit', [ $course, $unit, $test, $question ])  }} " class="unit-edit"><i class="bi bi-pencil-square"></i> Edit </a>   
                <form action=" {{ route('tests.questions.delete', $question) }} " method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="delete" class="btn btn-outline-danger btn-sm">
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection
