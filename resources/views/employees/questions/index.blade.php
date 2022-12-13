@extends('layouts.main')
@section('content')
<div class="allcontent">
    <div class="courses1">
        @if ($question)
        <span class="errorMessage">
            @if($errors->all())
            @foreach ($errors->all() as $error) 
                {{ $error }}      
            @endforeach
            @endif
        </span>
            <form action=" {{ route ('employee.questions.check', [$unit, $test, $question]) }} " method="post" class="CourseCreate" enctype="multipart/form-data">
                @csrf
                <label for="exampleFormControlInput1" class="form-label">Type of Question</label>
                <input type="text" name="question" class="form-control" id="exampleFormControlInput1" placeholder="Enter Question" value="{{ $question->question }}" disabled>
                <span class="errorMessage">
                    @error('question')
                        {{ $message }}      
                    @enderror
                </span> 

                <label for="exampleFormControlInput1" class="form-label">Options</label>
                @foreach ($question->options as $option) 
                <div class="btn-group2">
                    <div class="options">
                        <input type="radio" name="answer[]" value="{{$option->option}}" id="check" />{{ $option->option }}
                    </div>
                </div>
                @endforeach
               
                @if($question->id == $last_question->id)
                    <div class="saveButtons">
                        <button type="submit" value="save" name="save" class="btn btn-secondary">Submit Answer</button>
                    </div>
                @else
                    <button type="submit" value="next" name="next" class="btn btn-secondary">Next</button>
                @endif
            </form>
        @else
            <h1 style="text-align: center;">No Question Available</h1>         
        @endif
    </div>          
</div>
@endsection