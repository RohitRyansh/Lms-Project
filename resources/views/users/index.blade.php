
@extends('layouts.main')
@section('content')
<div class="allcontent">
    <div class="nav">
        <div>
            <h2>Users</h2>
        </div>
        <div class="nav1">
            <button type="button" class="btn btn-primary"><a href=" {{ route('users.create') }} " class="createButtons">Create User</a></button> 
        </div>
    </div>
    <div class="allUser">
        <form action=" {{  route('users')}}?{{ request()->getQueryString() }} " method="get">
            <div class="d-flex">
                <input class="form-control" type="text" name="search" placeholder="Search by Name">
                <i class="bi bi-search"></i>
            </div>
        </form>
        <div class="all2">
            <div class="dropdown">   
                <button class="btn btn-secondary dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                    Latest Created Date
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href=" {{ route('users')}}?newest=latest">Newest</a></li>
                    <li><a class="dropdown-item" href=" {{ route('users')}}">Oldest</a></li>
                </ul>
            </div>
            <button class="btn btn-secondary dropdown-toggle"  id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown">
                All User Type
            </button>
            <ul class="dropdown-menu menu">
                @foreach( $roles as  $role)
                <li>
                    <a class="dropdown-item" href=" {{ route('users')}}?role={{ $role->id }}">{{ $role->name }} </a>
                </li>
                @endforeach
            </ul>  
        </div>  
    </div>
    @if (session('success'))
        <p class="succesmessage"> {{ session('success') }} </p>
    @endif
    @if (session('unsuccess'))
        <p class="dangermessage"> {{ session('unsuccess') }} </p>
    @endif
    <div class="content2">
        @if ($users->count()>0)
        <table class="table">
            <tr class="table-heading">
                <th>User Name</th>
                <th>Type of User</th>
                <th>Courses</th>
                <th>Created Date</th>
                <th>Status</th>
                <th></th>
            </tr>
                @foreach ($users as  $user)
                <tr>
                    <td class="table-data"> {{ $user->first_name }}   {{ $user->last_name }} 
                        <br> {{ $user->email }} </td>
                        <td> {{ $user->role->name }} </td>
                        <td> {{ $user->enrollments->count() }} </td>
                        <td> {{ $user->created_at }} </td>
                        <td>
                            @if( $user->status)
                            <form action=" {{ route('users.status', ['user'=>  $user,'status'=> 0])  }} " method="POST">
                                @csrf
                                <span class="badge text-bg-success">
                                    <input type="submit" name="Active" value="Active" class="active">
                                </span>
                        </form>
                        @else
                        <form action=" {{  route('users.status', ['user'=>  $user,'status'=> 1]) }} " method="POST">
                            @csrf
                            <span class="badge text-bg-danger">
                                <input type="submit" name="Deactive" value="Deactive" class="active">
                            </span>
                        </form>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </button>
                            
                            <ul class="dropdown-menu"> 
                                <li class="drop-items">
                                    <div class="drop-items-icon">
                                        <i class="bi bi-wrench-adjustable"></i>
                                        <a href=" {{  route('users.edit', $user) }} ">Edit User</a>
                                    </div>
                                </li>

                                <li class="drop-items">
                                    <div class="drop-items-icon">
                                        <i class="bi bi-people-fill"></i>
                                        <a href=" {{  route('userenroll.index', $user) }} ">Courses</a>                                    
                                    </div>
                                </li>

                                <li class="drop-items">
                                    <div class="drop-items-icon">
                                        <i class="bi bi-wrench-adjustable"></i>
                                        <form action=" {{ route('users.delete', $user) }} " method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Delete" class="deletebuttons">
                                        </form>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        
                    </td>
                </tr>
                @endforeach
            </table>
            @else
                <h1 style="text-align: center;">No User Exist</h1>      
            @endif
         {{  $users->links() }} 
    </div>
</div>
@endsection
    

