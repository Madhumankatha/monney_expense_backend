<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cooming Soon!!</title>
        <link rel="apple-touch-icon" sizes="180x180" href="https://www.haptechinnovations.com/img/logo.png">
        <link rel="icon" type="image/png" sizes="32x32" href="https://www.haptechinnovations.com/img/logo.png">
        <link rel="icon" type="image/png" sizes="16x16" href="https://www.haptechinnovations.com/img/logo.png">
        <style>
            body, html {
                height: 100%;
                margin: 0;
            }

            .bgimg {
                background: #1a2980; /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #1a2980, #26d0ce); /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #1a2980, #26d0ce); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                height: 100%;
                background-position: center;
                background-size: cover;
                position: relative;
                color: white;
                font-family: "Courier New", Courier, monospace;
                font-size: 25px;
                z-index: 10;
            }

            .topleft {
                position: absolute;
                top: 0;
                left: 16px;
            }

            .bottomleft {
                position: absolute;
                bottom: 0;
                left: 16px;
            }

            .middle {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }

            hr {
                margin: auto;
                width: 40%;
            }

            a {
                color: orange;
                text-decoration: none;
                letter-spacing: 0.15em;
                display: inline-block;
                position: relative;
            }

            a:after {
                background: none repeat scroll 0 0 transparent;
                bottom: 0;
                content: "";
                display: block;
                height: 2px;
                left: 50%;
                position: absolute;
                background: #fff;
                transition: width 0.3s ease 0s, left 0.3s ease 0s;
                width: 0;
            }
            a:hover:after {
                width: 100%;
                left: 0;
            }

            .background {
                position: absolute;
                display: block;
                top: 0;
                left: 0;
                z-index: 0;
            }

        </style>
    <body>

    <div class="bgimg">
        <div class="topleft">

        </div>
        <div class="middle">
            <h1>COMING SOON</h1>
            <hr>
            <p>This page is under construction. Please come back soon!</p>
            <p>Follow us on</p>
            <span><a href="https://www.facebook.com/haptechinnovations" target="_blank" >Facebook</a> | </span><span><a href="https://www.haptechinnovations.com/" target="_blank">Website</a></span>
        </div>
        <div class="bottomleft">
            <p> Developed & Maintained by <a href="https://www.haptechinnovations.com" class="link" target="_blank">Haptech Innovations</a></p>
        </div>
    </div>

    <canvas class="background"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js"></script>
    <script type="text/javascript">
        window.onload= function() {
            Particles.init({
                selector: '.background'
            });
        };
    </script>

    </body>
</html>
