<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ mix('/css/letzshare.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/articles">Articles</a></li>
                <li><a href="/books">Books</a></li>
                <li><a href="/api/books">Books API</a></li>
                <li><a href="/users">Users</a></li>
            </ul>
        </nav>
    </header>
<div class="content">
    @yield('content')
</div>
<footer>

</footer>
<script src="{{ mix('/css/letzshare.js') }}"></script>
</body>
</html>
