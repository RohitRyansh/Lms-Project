@extends('layouts.main')
@section('content')
<div class="allcontent">
    @if (session('success'))
        <p class="succesmessage"> {{ session('success') }} </p>
    @endif
    <div class="content2">
        <table class="table">
            <tr class="table-heading">
                <th>Category Name</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Push</th>
            </tr>
            @foreach ($categories as $category)
            <tr>
            <td>{{ $category->name }}</td>
                    @if ($category->owner_id == 1)  
                    <td>
                        <div class="drop-items-icon">
                            <i class="bi bi-wrench-adjustable"></i>
                            <a href=" {{  route('trainee.edit', $category) }} ">Edit Category</a>
                        </div>
                    </td>
                    <td>
                        <div class="drop-items-icon">
                            <i class="bi bi-wrench-adjustable"></i>
                            <form action="{{ route('trainee.delete', $category) }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="deletebuttons" onclick="return confirm('Are you sure you want to delete this item?');">
                            </form>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route ('trainee.push', $category) }}" method="post">
                            @csrf
                            <button type="submit" value="Update" name="push" id="pushButton" class="btn btn-secondary" onclick="return confirm('Are you sure you want to push this item?');">Push</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @endforeach
        </table>
    </div>
</div>
@endsection

