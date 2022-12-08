@extends('layouts.main')

@section('content')
<div class="allcontent">
    <section class="nav-bottom">
        <div>
            <a href=" {{ route('courses.units.create', $course) }} " class="btn btn-primary" id="createbtn">Add Unit</a>
        </div>
    </section>
    
    <section class="course-view">
        
        <div class="course-view-detail">
            
            <div class="course-view-detail-left">
                <img src="{{asset('storage/'.$course->images->image_path)}}" alt="not found">
                <div>
                    <h2> {{  $course->title  }} </h2>
                    <p> {{  $course->description  }} </p>
                </div>
            </div>
            <div class="course-view-detail-right">
                <a href=" {{  route ('courses.edit',$course)  }} "><i class="bi bi-pencil-square"></i> Edit Basic Info</a>
            </div>
        </div>
        <hr>
        <div class="course-detail-bottom">
            <div class="course-detail-bottom-elements">
                <p><i class="bi bi-stopwatch" style="font-weight: bold;font-size: 20px;"></i></p>
                <p>Course Duration</p>
                <div><p>{{ $course->units->sum('duration')}}m</p></div>
            </div>
            <div class="course-detail-bottom-elements">
                <p><i class="bi bi-easel" style="font-weight: bold;font-size: 20px;"></i></p>
                <p>Total Unit</p>
                <div><p> {{  $course->units->count()  }} </p></div>
            </div>
            <div class="course-detail-bottom-elements">
                <p><i class="bi bi-mortarboard-fill" style="font-weight: bold;font-size: 20px;"></i></p>
                <p>Course Level</p>
                <div><p> {{  $course->level->name  }} </p></div>
            </div>
            <div class="course-detail-bottom-elements">
                <p><i class="bi bi-clock-history" style="font-weight: bold;font-size: 20px;"></i></p>
                <p>Last Updated</p>
                <div><p> {{  $course->updated_at->format('M d,Y') }} </p></div>
            </div>
            <div class="course-detail-bottom-elements">
                <p><i class="bi bi-patch-check-fill" style="font-weight: bold;font-size: 20px;"></i></p>
                <p>Certificate Of Completion</p>
                <div><p> {{ $course->certificate == 1?'Yes':'No' }} </p></div>
            </div>
        </div>
    </section>
    <section class="unitsView">

        <h2 class="content-head">Course Content</h2>
        @foreach ($course->units as $unit)
        <section class="unit">
            <div class="unit-detail">
                <div>
                    <i class="bi bi-grip-vertical" style="font-size: 25px;color:grey;"></i>
                </div>
                <div class="unit-detail-info">
                    <a href="  " class="unit-edit"><h3> {{ $unit->title }} </h3></a>

                    <p> {{ $unit->description }} </p>
                </div>
            </div>

            <div> 
                <a href=" {{  route('courses.units.edit',['course' => $course, 'unit' => $unit])  }} " class="unit-edit"><i class="bi bi-pencil-square"></i> Edit Section</a>
                
                <form action=" {{ route('courses.units.delete', ['course' => $course, 'unit' => $unit]) }} " method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="delete" class="btn btn-outline-danger btn-sm">
                </form>
            </div>
        </section>
        @endforeach
    </section>
</div>

@endsection