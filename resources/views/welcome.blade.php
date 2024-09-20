<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>NTC Legal</title>
        <link rel="shortcut icon" href="public/asset/National_Telecommunications_Commission.svg" type="image/x-icon">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('asset/National_Telecommunications_Commission.svg') }}" type="image/x-icon">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }
            .top-left{
                position: absolute;
                top: 18px;
                left: 10px;
            }
            .top-left > a{
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                position: relative;
            }

            .title {
                font-size: clamp(1.875rem, -0.4688rem + 7.5vw, 3.75rem);
                z-index: 5;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                transition: .3s ease-in-out;
            }
            .d-links a:hover{
                font-size: 14px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .header-logo{
                width: 30px;
            }
            .d-logo{
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 0;
                opacity: 15%;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-left links">
                    <a href="{{ url('/') }}">
                        <img class="header-logo" src="{{ asset('asset/National_Telecommunications_Commission.svg') }}" alt="Logo">NTC Legal</a>
                </div>
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
            <img src="{{ asset('asset/National_Telecommunications_Commission.svg') }}" alt="Logo" class="d-logo">
            <div class="content">
                <div class="title m-b-md">
                    National Telecommunications Commission
                </div>
                <div class="links d-links" >
                    <a href="http://region3.ntc.gov.ph/#">NTC R3</a>
                    <a href="https://ntc.gov.ph/mission-vision/#">Mandate, Mission & Vission</a>
                    <a href="https://ntc.gov.ph/news-2/">News</a>
                </div>
            </div>
        </div>
    </body>
</html>
