@extends('layouts.main')

@section('content')
<div class="allcontent">
    <div class="breadcrumbs-mine">
        <div style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" ><a href="  {{  route('courses') }}" style="text-decoration: none;">Course</a></li>
                <li class="breadcrumb-item" ><a href="  {{  route('courses.view', $course) }}" >  {{ $course->title}}</a></li>
            </ol>
        </div>
    </div>
    <section class="nav-bottom">
        <div>
            <a href=" {{ route('courses.units.create', $course) }} " class="btn btn-primary" id="createbtn">Add Unit</a>
        </div>
    </section>
    @if (session('success'))
        <p class="succesmessage"> {{ session('success') }} </p>
    @endif
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
                <div><p>{{ date('H:i', mktime(0,$course->units->sum('duration')))}}m</p></div>
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
                    <div class="units">
                        <i class="bi bi-grip-vertical" style="font-size: 25px;color:grey;"></i>
                        <h4> {{ $unit->title }} </h4>
                    </div>
                    <div class="unit-detail-info">
                        <p> {{ $unit->description }} </p>
                    </div>
                </div>
                <div class="editAndDelete"> 
                    <a href=" {{  route('courses.units.edit', [$course, $unit] ) }} " class="unit-edit"><i class="bi bi-pencil-square"></i> Edit Section</a>
                    <form action=" {{ route('courses.units.delete', [$course, $unit] ) }} " method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="delete" class="btn btn-outline-danger btn-sm">
                    </form>
                </div>
            </div>
            <div class="unit-detail1">
                <div><h6>Lessons</h6></div>
                <div><p>Duration : {{ date('H:i', mktime(0,$unit->tests->sum('duration')))}}m</p></div>
            </div>
                @foreach ($unit->tests as $test)
                <div class="testDurations">
                    <p>{{ $test->name }}</p>
                    <p>Duration : {{ $test->duration}}m</p>
                </div>
                @endforeach
        </section>
        @endforeach
    </section>
</div>

@endsection