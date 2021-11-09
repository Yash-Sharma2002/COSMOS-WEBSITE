<?php // Do not put any HTML above this line


session_start();

require_once "pdo.php";

unset($_SESSION['error']);

$stmt = $pdo->query("SELECT signup_id,first_name,last_name,email,pnum FROM signup");


$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>COSMOS</title>
    <link rel="stylesheet" href="cosmos-page-css.css">
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
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
        width: 100%;
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
    .avatar1{
    margin-top: -1.6rem;
  }

</style>

<body>

<!-- i give no notifications for success or failure of login or sign up  -->

    <!----------------Navigation Bar----------------->
  
    <header>
        <div class="container">
            <nav class="nav">

                <ul class="nav-list">
                    <li>
                        <a href="cosmosmainpage.php" class="nav-link">HOME</a>
                    </li>
                    <li>
                        <a href="about.php" class="nav-link">ABOUT</a>
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
                        echo (' <a href="login.php" class="nav-link">LOGIN</a>');
                        echo ('<div class="divider-symbol"></div>');
                        echo ('<a href="sign-up.php" class="nav-link">SIGN UP</a>');
                    } else {
                        echo ('<a class="nav-link" href="profile.php?signup_id='.$_SESSION['signup_id'].'"><img alt="profile" src="//www.gravatar.com/avatar/ad83af7510c0f93dfb5a9f46c4baf446?s=30&amp;r=g&amp;d=mm" srcset="//www.gravatar.com/avatar/ad83af7510c0f93dfb5a9f46c4baf446?s=30&amp;r=g&amp;d=mm 2x" class="avatar" height="30" width="30" style="border-radius:30px;margin-right:9px;margin-bottom: -7px;">Welcome, ' . htmlentities($_SESSION['name']) . '</a><div  class="divider-symbol"></div><a href="logout.php" class="nav-link logout">LOGOUT</a>');
                    }

                    ?>
                </div>
            </nav>
        </div>
    </header>
    <!--------------x------------------Navigation Bar------------------------x-->

<!--   add if you want to make logo in the backgrounf
    <section class="logo"></section> -->
    <section class="demo-content">
        
        <!-- Your content lies here -->
    </section>
</body>
</html>
