<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style1.css">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <main>
        <div class="mainContent">
            <div class="content1">
                <ul class="navcontent">
                    <li><img src="/LOGO.webp" alt="not found" width="180px"></li>
                    <li><a href="/dashboard">Overview</a></li>
                    <li><a href="{{ route ('users') }}">Users</a></li>
                    <li><a href="{{ route ('categories') }}">Categories</a></li>
                    <li><a href="{{ route ('courses') }}">Courses</a></li>
                    <li>Reports</li>
                </ul>
            </div>
            <div class="index">
                <div class="dropdown">   
                    <button class="btn btn-secondary dropdown-toggle" id="superAdminButton" type="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->first_name}}
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="">Account & Settings</a></li>
                        <li><a class="dropdown-item" href="{{ route ('Auth.logout') }}">Logout</a></li>
                    </ul>
                </div>
                @yield('content')
            </div>
        </div>
</body>
</html>

                
                