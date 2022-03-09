<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ url('styles.css') }}">
    <title>Wonde Code Exercise</title>
</head>
<body>
<div id="app">
    <!-- navbar -->
    <div class="nav">
        <div class="title">
            Wonde Code Test
        </div>
        <div class="help">
            Wonde
        </div>
    </div>

    <!-- main -->
    <div class="main-wonde-icon">
        <img src="https://www.wonde.com/wp-content/themes/wonde/assets/svg/home-hero-baloon.svg" alt="">
    </div>
    <div class="main">
        <div class="main-container">
            <div class="header">
                Student / Class Checker <span class="school-name"> Wonde Testing School</span>
            </div>
            <hr>
            @yield('content')
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="title">
            By Jack Love
        </div>
        <div class="help">
            @wonde 2022
        </div>
    </div>

</div>

<!-- app js -->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>
