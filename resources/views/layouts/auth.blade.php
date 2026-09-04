<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background: #f4f6f9;
        }

        .auth-header {
            height: 60px;
        }

        .auth-wrapper {
            min-height: calc(100vh - 60px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark bg-dark auth-header">
        <div class="container">
            <a href="/login" class="navbar-brand fw-semibold">
                Student Management
            </a>
            <!--
        <div class="d-flex gap-2">
            <a href="/login" class="btn btn-light btn-sm">
                Login
            </a>

            <a href="/register" class="btn btn-outline-light btn-sm">
                Register
            </a>
        </div> -->
        </div>
    </nav>

    @yield('content')

</body>

</html>
