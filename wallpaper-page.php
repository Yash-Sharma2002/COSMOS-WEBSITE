<?php // Do not put any HTML above this line


session_start();

require_once "pdo.php";

unset($_SESSION['error']);

$stmt = $pdo->query("SELECT signup_id,first_name,last_name,email,pnum FROM signup");


$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <title>COSMOS - WALLPAPERS</title>
</head>
<style>
    /*-----------Scroll Bar--------  */
    ::-webkit-scrollbar {
        width: 12px;
    }

    ::-webkit-scrollbar-track {
        border: 7px solid darkslateblue;
        box-shadow: inset 0 0 2.5px 2px rgba(0, 0, 0, 0);
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(45deg,
                #06dee1,
                #79ff6c);
        border-radius: 1rem;
    }

    /*------x---------Scroll Bar----x------ */

    body {
        background-color: #151515;
    }

    *::before,
    *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        font-family: 'Roboto', sans-serif;
        font-size: 10px;
    }

    header {
        background-color: #151515;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        transition: background-color .5s ease;
        z-index: 1000;
        border-bottom: 3px solid white;
    }

    .container1 {
        padding: 0;
        background-color: #151515;
        margin-left: auto;
        margin-right: 9rem;
    }

    .nava {
        width: 100%;
        height: 9rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid rgba(255, 255, 255, .05);
        transition: height .5s ease;
    }

    .nava a {
        text-decoration: none;
        color: #fff;
        font-size: 1.6rem;
    }


    .nava-list {
        list-style: none;
        display: flex;
        margin-right: auto;
        margin-left: 4rem;
    }

    .nava-link {
        margin: 0 2rem;
        position: relative;
    }

    .nava-link::after {
        content: '';
        width: 100%;
        height: 2px;
        background-color: #fff;
        position: absolute;
        left: 0;
        bottom: -3px;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .5s ease-in-out;
    }

    .nava-link:hover::after {
        transform: scaleX(1);
    }



    /*Apply styles after scroll*/
    .scrolling-active {

        box-shadow: 0 3px 1rem rgba(0, 0, 0, .1);
    }

    .scrolling-active .nava {
        height: 6.6rem;
    }

    .scrolling-active .nava a {
        color: white;
    }

    .scrolling-active .search-opt {
        height: 53px;
        top: 33px;

    }

    .scrolling-active .search-btn {
        height: 30px;
    }

    .scrolling-active .nava-link::after {
        background-color: white;
    }

    /*Apply styles after scroll end*/

    .divider-symbol {
        display: inline-block;
        width: 2px;
        height: 29px;
        background-color: white;
        margin: -6px 0;
    }




    /* Hero Demo Content*/


    .demo-content {
        width: 98%;
        height: 100%;
        background-color: #fff;
        

    }

    /* Hero end*/

    .search-opt::after {
        position: fixed;

    }

    .search-opt {
        left: 50%;
        background: #ffffff;
        height: 53px;
        border-radius: 5px;
        padding: 10px;
        top: 47px;
        transition-delay: .1s;
        transform: translate(-50%, -50%);
        position: fixed;
    }

    .search-btn {
        position: relative;
        float: right;
        width: 40px;
        height: 35px;
        border-radius: 10%;
        background: #151515;
        display: flex;
        justify-content: center;
        align-items: center;
        text-decoration: none;
        transition: 0.4s;
    }

    .search-opt:hover>#searchin-opt {
        width: 240px;
        padding: 0px 6px;
    }

    .search-opt:hover>.search-btn {
        background: white;
        color: #151515;
    }

    #searchin-opt {
        border: none;
        background: none;
        outline: none;
        float: left;
        padding: 0px;
        font-size: 16px;
        color: black;
        font-weight: 600;
        transition: 0.4s;
        line-height: 40px;
        width: 0px;
    }

    .w-100 {
        height: 500px;
    }

    .my-6 {
        margin-top: 5rem;
    }

    .fs {
        font-size: 32px;
        font-weight: 600;
    }

    .mr {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: rgb(165, 160, 160);
        text-align: right;
        margin-top: -21px;
        margin-right: 7rem;
    }

    .fs2 {
        margin-left: 3rem;
        margin-top: 15px;
    }


    /*-------------slider---------------*/
    .post-slider {

        position: relative;

    }

    .post-slider .post-wrapper {
        width: 92%;
        /* height: 350px; */
        margin: 0px auto;
        cursor: pointer;
        overflow: hidden;
        padding: 10px 0px 10px 0px;
        /* transform: translate3d(-30%,0,-200px); */
    }

    .post-slider .post-wrapper .post {
        width: 332px;
        /* height: 350px; */
        margin: 0px 10px;
        display: inline-block;
        /* transform: translate3d(-30%,0,-200px); */
    }



    a {
        text-decoration: none;
        color: inherit;
    }

    .post-slider .post-wrapper .post {
        width: 403px;
        /* height: 330px; */
        margin: 0px 8px;
        display: inline-block;
        background: white;
        /* border-radius: 1rem; */
        transition: .5s ease-in-out;
        /* transform: translate3d(-30%,0,-200px); */
        box-shadow: 1rem 1rem 1rem -1rem black;
    }


    .post-slider .post-wrapper .post .slider-image {
        width: 100%;
        height: 200px;
        border-radius: 1rem;
        /* transform: translate3d(-30%,0,-200px); */
    }

    .post-slider .next {
        position: absolute;
        right: 20px;
        /* background: none; */
        top: 45%;
        z-index: 100;
        font-size: 2rem;
        color: black;
        cursor: pointer
    }

    .post-slider .prev {
        position: absolute;
        left: 20px;
        top: 45%;
        z-index: 100;
        font-size: 2rem;
        color: black;
        cursor: pointer;
    }

    .post:hover {
        transform: scale(1.2);
        border-radius: none;
        z-index: 1000;
    }

    .cs2 {
        margin-top: 3rem;
    }


    /* ----------------Footer Section------------------ */
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

    footer {
        /* position: fixed; */
        color: #fff;
        bottom: 0px;
        width: 100%;
        background: #111;
        /* margin-top: 3rem; */
    }

    .main-content {
        display: flex;
    }

    .main-content .box {
        flex-basis: 50%;
        padding: 10px 20px;
    }

    .box h2 {
        font-size: 1.125rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .box .content {
        margin: 20px 0 0 0;
        position: relative;
    }

    .box .content:before {
        position: absolute;
        content: '';
        top: -10px;
        height: 2px;
        width: 100%;
        background: #1a1a1a;
    }

    .box .content:after {
        position: absolute;
        content: '';
        height: 2px;
        width: 15%;
        background: #f12020;
        top: -10px;
    }

    .left .content p {
        text-align: justify;
    }

    .left .content .social {
        margin: 20px 0 0 0;
    }

    .left .content .social a {
        padding: 0 2px;
    }

    .left .content .social a span {
        height: 40px;
        width: 40px;
        background: #1a1a1a;
        line-height: 40px;
        text-align: center;
        font-size: 18px;
        border-radius: 5px;
        transition: 0.3s;
    }

    .left .content .social a span:hover {
        background: #f12020;
        color: white;
    }

    .center .content .fas {
        font-size: 1.4375rem;
        background: #1a1a1a;
        height: 45px;
        width: 45px;
        line-height: 45px;
        text-align: center;
        border-radius: 50%;
        transition: 0.3s;
        cursor: pointer;
    }

    .center .content .fas:hover {
        background: #f12020;
        color: #fff;

    }

    .center .content .text {
        font-size: 1.0625rem;
        font-weight: 500;
        padding-left: 10px;
    }

    .center .content .phone {
        margin: 15px 0;
    }

    .right form .text {
        font-size: 1.0625rem;
        margin-bottom: 2px;
        color: #656565;
    }

    .right form .msg {
        margin-top: 10px;
    }

    .right form input,
    .right form .msgForm {
        width: 100%;
        font-size: 1.0625rem;
        background: #151515;
        padding-left: 10px;
        border: 1px solid #222222;
    }

    .right form input:focus,
    .right form .msgForm:focus {
        outline-color: #3498db;
    }

    .right form input {
        height: 35px;
    }

    .right form .btna {
        margin-top: 10px;
    }

    .right form .btna button {
        height: 40px;
        width: 100%;
        border: none;
        outline: none;
        background: #f12020;
        font-size: 1.0625rem;
        font-weight: 500;
        cursor: pointer;
        color: white;
        transition: .3s;
        font-size: 16px;
    }

    .right form .btna button:hover {
        background: #000;
        color: white;
        font-size: 20px;
    }

    .bottom center {
        padding: 5px;
        font-size: 0.9375rem;
        background: #151515;
    }

    .bottom center span {
        color: #656565;
    }

    .bottom center a {
        color: #f12020;
        text-decoration: none;
    }

    .bottom center a:hover {
        text-decoration: underline;
    }

    @media screen and (max-width: 900px) {
        footer {
            position: relative;
            bottom: 0px;
        }

        .main-content {
            flex-wrap: wrap;
            flex-direction: column;
        }

        .main-content .box {
            margin: 5px 0;
        }
    }
    .avatar1{
    margin-top: -1.6rem;
  }
</style>

<body>
    <header>
        <div class="container1">
            <nav class="nava">

                <ul class="nava-list">
                    <li>
                        <a href="cosmosmainpage.php" class="nava-link">HOME</a>
                    </li>
                    <li>
                        <a href="about.html" class="nava-link">ABOUT</a>
                    </li>



                </ul>
                <div id="searchbar-opt" class="search-opt">
                    <input type="search" id="searchin-opt" name="s" placeholder="  Search..." aria-label="search through the site content">
                    <a class="search-btn" href="#"><i class="fa fa-search only-for-search-icon" aria-hidden="true"></i>
                    </a>
                </div>
                <div>

                    <?php
                    if (!isset($_SESSION['name'])) {
                        echo (' <a href="login.php" class="nava-link">LOGIN</a>');
                        echo ('<div class="divider-symbol"></div>');
                        echo ('<a href="sign-up.php" class="nava-link">SIGN UP</a>');
                    } else {
                        echo ('<a class="nava-link" href="profile.php?signup_id='.$_SESSION['signup_id'].'"><img alt="profile" src="//www.gravatar.com/avatar/ad83af7510c0f93dfb5a9f46c4baf446?s=30&amp;r=g&amp;d=mm" srcset="//www.gravatar.com/avatar/ad83af7510c0f93dfb5a9f46c4baf446?s=30&amp;r=g&amp;d=mm 2x" class="avatar1" height="30" width="30" style="border-radius:30px;margin-right:9px;margin-bottom: -7px;">Welcome, ' . htmlentities($_SESSION['name']) . '</a><div  class="divider-symbol"></div><a href="logout.php" class="nava-link logout">LOGOUT</a>');
                    }

                    ?>
                </div>
            </nav>
        </div>
    </header>

    <section class="logo">
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="p1.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="background.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="nebula.jpg" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section>

    <section class="demo-content mx-4">
        <div class="row text-center">
            <h1 class="text-center fs my-6">CATEGORIES</h3>
                <div class="col-lg-4 my-6">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
                    </svg>

                    <h2>Heading</h2>
                    <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh
                        ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.
                        Praesent commodo cursus magna.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4 my-6">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
                    </svg>

                    <h2>Heading</h2>
                    <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                        Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo,
                        tortor mauris condimentum nibh.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4 my-6">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#777" /><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text>
                    </svg>

                    <h2>Heading</h2>
                    <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id
                        ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris
                        condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                    <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->



        <h1 class="mx-6 fs2">GALAXY </h1><a href="wallpapers2.php" class="mr">MORE></a>


        <div class="page-wrapper cs2">

            <!--------------slider------------->

            <div class="post-slider">
                <i class="fas fa-chevron-left prev"></i>
                <i class="fas fa-chevron-right next"></i>
                <div class="post-wrapper ">

                    <!-----------1st post Box-------- -->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!-------------2nd post Box--------------->

                    <a href="#" class="post">
                        <img src="nebula.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------3rd post Box------------->

                    <a href="#" class='post'>
                        <img src="background.jpg" alt="image is here" class="slider-image">


                    </a>


                    <!---------------4rth post Box------------->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------5th post Box------------>

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>

                </div>
            </div>
        </div>




        <h1 class="mx-6 fs2">COSMOS</h1><a href="wallpapers2.php" class="mr">MORE></a>

        <div class="page-wrapper cs2">

            <!--------------slider------------->

            <div class="post-slider">
                <i class="fas fa-chevron-left prev"></i>
                <i class="fas fa-chevron-right next"></i>
                <div class="post-wrapper ">

                    <!-----------1st post Box-------- -->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!-------------2nd post Box--------------->

                    <a href="#" class="post">
                        <img src="nebula.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------3rd post Box------------->

                    <a href="#" class='post'>
                        <img src="background.jpg" alt="image is here" class="slider-image">


                    </a>


                    <!---------------4rth post Box------------->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------5th post Box------------>

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>

                </div>
            </div>
        </div>








        <h1 class="mx-6 fs2">PLANETS </h1><a href="wallpapers2.php" class="mr">MORE></a>

        <div class="page-wrapper cs2">

            <!--------------slider------------->

            <div class="post-slider">
                <i class="fas fa-chevron-left prev"></i>
                <i class="fas fa-chevron-right next"></i>
                <div class="post-wrapper ">

                    <!-----------1st post Box-------- -->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!-------------2nd post Box--------------->

                    <a href="#" class="post">
                        <img src="nebula.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------3rd post Box------------->

                    <a href="#" class='post'>
                        <img src="background.jpg" alt="image is here" class="slider-image">


                    </a>


                    <!---------------4rth post Box------------->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------5th post Box------------>

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>

                </div>
            </div>
        </div>








        <h1 class="mx-6 fs2">NEBULA </h1><a href="wallpapers2.php" class="mr">MORE></a>

        <div class="page-wrapper cs2">

            <!--------------slider------------->

            <div class="post-slider">
                <i class="fas fa-chevron-left prev"></i>
                <i class="fas fa-chevron-right next"></i>
                <div class="post-wrapper ">

                    <!-----------1st post Box-------- -->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!-------------2nd post Box--------------->

                    <a href="#" class="post">
                        <img src="nebula.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------3rd post Box------------->

                    <a href="#" class='post'>
                        <img src="background.jpg" alt="image is here" class="slider-image">


                    </a>


                    <!---------------4rth post Box------------->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------5th post Box------------>

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>

                </div>
            </div>
        </div>








        <h1 class="mx-6 fs2">BLACK HOLE</h1><a href="wallpapers2.php" class="mr">MORE></a>

        <div class="page-wrapper cs2">

            <!--------------slider------------->

            <div class="post-slider">
                <i class="fas fa-chevron-left prev"></i>
                <i class="fas fa-chevron-right next"></i>
                <div class="post-wrapper ">

                    <!-----------1st post Box-------- -->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!-------------2nd post Box--------------->

                    <a href="#" class="post">
                        <img src="nebula.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------3rd post Box------------->

                    <a href="#" class='post'>
                        <img src="background.jpg" alt="image is here" class="slider-image">


                    </a>


                    <!---------------4rth post Box------------->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------5th post Box------------>

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>

                </div>
            </div>
        </div>














        <h1 class="mx-6 fs2">GALAXY </h1><a href="wallpapers2.php" class="mr">MORE></a>

        <div class="page-wrapper cs2">

            <!--------------slider------------->

            <div class="post-slider">
                <i class="fas fa-chevron-left prev"></i>
                <i class="fas fa-chevron-right next"></i>
                <div class="post-wrapper ">

                    <!-----------1st post Box-------- -->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!-------------2nd post Box--------------->

                    <a href="#" class="post">
                        <img src="nebula.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------3rd post Box------------->

                    <a href="#" class='post'>
                        <img src="background.jpg" alt="image is here" class="slider-image">


                    </a>


                    <!---------------4rth post Box------------->

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>


                    <!--------------5th post Box------------>

                    <a href="#" class="post">
                        <img src="p1.jpg" alt="image is here" class="slider-image">

                    </a>

                </div>
            </div>
        </div>


    </section>





    <footer>
        <div class="main-content mx-4">
            <div class="left box">
                <h2>
                    About us</h2>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex veritatis libero alias veniam odio,
                        doloribus eius eaque ut dolor harum architecto possimus numquam ea animi expedita blanditiis
                        ipsum. Neque, mollitia voluptatem unde sequi ratione voluptas accusantium. Suscipit aspernatur
                        necessitatibus itaque. Amet eligendi deserunt exercitationem ad!</p>
                    <div class="social">
                        <a href="https://facebook.com/coding.np"><span class="fab fa-facebook-f"></span></a>
                        <a href="#"><span class="fab fa-twitter"></span></a>
                        <a href="https://instagram.com/coding.np"><span class="fab fa-instagram"></span></a>
                        <a href="https://youtube.com/c/codingnepal"><span class="fab fa-youtube"></span></a>
                    </div>
                </div>
            </div>
            <div class="center box">
                <h2>
                    Address</h2>
                <div class="content">
                    <div class="place">
                        <span class="fas fa-map-marker-alt"></span>
                        <span class="text">address</span>
                    </div>
                    <div class="phone">
                        <span class="fas fa-phone-alt"></span>
                        <span class="text">mobile number</span>
                    </div>
                    <div class="email">
                        <span class="fas fa-envelope"></span>
                        <span class="text">abc@example.com</span>
                    </div>
                </div>
            </div>
            <div class="right box">
                <h2>
                    Support us</h2>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, eligendi eaque voluptates
                        doloribus similique officia?</p>
                    <form action="#">


                        <br />
                        <div class="btna">
                            <button type="submit">Donate</button>
                        </div>

                        <!-- </div> -->
                    </form>
                </div>
            </div>
        </div>
    </footer>
    <!--------x--------Footer Section----------x-------->



    <script>
        function redirect() {
            var url = "wallpapers.php";
            window.location.href(url);
        }
    </script>


    <!-- j Query  -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


    <script src="https://kit.fontawesome.com/33ef740869.js" crossorigin="anonymous"></script>

    <!-- script coursel -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            let header = document.querySelector('header');
            let windowPosition = window.scrollY > 0;
            header.classList.toggle('scrolling-active', windowPosition);
        })
    </script>

    <script type="text/javascript">
        $('.post-wrapper').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            nextArrow: $('.next'),
            prevArrow: $('.prev')
        });
    </script>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


</body>

</html>