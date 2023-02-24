<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<header>
    @include('includes.header')
</header>
<body>
<div class="container">
    <div id="main" class="row">
        @yield('content')
    </div>
</div>
</body>
</html>
