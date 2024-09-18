<!DOCTYPE html>
<html>
<head>
    <title>ABC Corporation</title>
    <link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        nav {
            width: 90%;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav h1 {
            font-family: 'Lobster', cursive;
        }

        #navli {
            list-style: none;
            display: flex;
        }

        #navli li {
            margin-left: 20px;
        }

        #navli a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        #navli .homered {
            color: red;
        }

        #navli .homeblack {
            color: #fff;
        }

        .divider {
            height: 10px;
            background-color: #ddd;
            margin: 20px 0;
        }

        #divimg {
            margin: 20px 0;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 35px;
            margin-left: 70px;
        }

        .welcome-text {
            text-align: center;
            margin-top: 100px;
        }

        .welcome-text h1 {
            font-family: 'Lobster', cursive;
            font-weight: 200;
            font-size: 50px;
        }

        .welcome-text p {
            font-family: 'Montserrat', sans-serif;
            font-size: 30px;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            #navli {
                flex-direction: column;
            }

            #navli li {
                margin: 10px 0;
            }

            img {
                margin: 20px;
                float: none;
            }

            .welcome-text h1 {
                font-size: 40px;
            }

            .welcome-text p {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            nav h1 {
                font-size: 24px;
            }

            #navli a {
                font-size: 16px;
            }

            .welcome-text h1 {
                font-size: 30px;
            }

            .welcome-text p {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <h1>ABC Corp.</h1>
            <ul id="navli">
                <li><a class="homered" href="index.html">HOME</a></li>
                <li><a class="homeblack" href="#">ABOUT US</a></li>
                <li><a class="homeblack" href="#">CONTACT</a></li>
                <li><a class="homeblack" href="ulogin.html">LOG IN</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="divider"></div>
    <div id="divimg">
        <!-- Add an image or other content here if needed -->
    </div>

    <img src="" alt="Example Image">

    <div class="welcome-text">
        <h1>Welcome to ABC Corp.</h1>
        <p>Your One Stop Solution</p>
    </div>
</body>
</html>
