@extends('layouts.main')
@section('content')
<div class="allcontent">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href=" {{ route ('courses')  }} ">Course</a></li>
            <li class="breadcrumb-item" ><a href="{{ route('courses.view', $course) }}" style="text-decoration: none;width: 600px;">{{ $course->title }}</a></li>
            <li class="breadcrumb-item" ><a href="{{ route('courses.view', $course) }}" style="text-decoration: none;width: 600px;">{{ $test->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Question</li>
        </ol>
    </nav>
    @if (session('success'))
        <p class="succesmessage"> {{ session('success') }} </p>
    @endif
    <div class="courses1">
        <span class="errorMessage">
            @if($errors->all())
            @foreach ($errors->all() as $error)
                {{ $error }}      
            @endforeach
            @endif
        </span>
        <form action=" {{ route ('tests.questions.store', [ $course, $unit, $test ]) }} " method="post" class="CourseCreate" enctype="multipart/form-data">
            @csrf

            <label for="exampleFormControlInput1" class="form-label">Type of Question</label>
            <input type="text" name="question" class="form-control" id="exampleFormControlInput1" placeholder="Enter Question">
            <span class="errorMessage">
                @error('question')
                 {{ $message }}      
                @enderror
            </span> 

            <label for="exampleFormControlInput1" class="form-label">Options</label>
            @for($i=1;$i<5;$i++)
                <div class="btn-group1">
                      <div class="options">
                            <input type="text" name="options[]" id=""> <input type="radio" name="answer" id="check" value={{$i}} />
                      </div>
                    </div>          
                @endfor
   
            <div class="saveButtons">
                <button type="submit" value="save" name="save" class="btn btn-secondary">Save</button>
                <button type="submit" value="CreateAnother" name="save_another" class="btn btn-secondary">Save & Add Another</button>
                <a href=" {{ route('courses.units.tests.edit', [ $course, $unit, $test ])  }} " class="btn btn-outline-secondary">Cancel</a>         
            </div>
        </form>
    </div>
</div>
@endsection
