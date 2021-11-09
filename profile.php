<?php
session_start();
require_once "pdo.php";

if (!isset($_SESSION['signup_id'])) {
    $_SESSION['error'] = 'Not a signed in user';
    header('Location: 404-page.html');
    return;
}



// $stmt = $pdo->query("SELECT first_name,last_name,signup_id,email,pnum FROM signup");
// $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);




if (!isset($_GET['signup_id'])) {
    $_SESSION['error'] = "Missing signup_id";
    header('Location: cosmosmainpage.php');
    return;
}



if (isset($_POST['uploadBtn'])) {
    // Get image name
    $image = $_FILES['image']['name'];
    // Get text
    // $image_text = mysqli_real_escape_string($db, $_POST['image_text']);

    // image file directory
    $target = "images/".basename($image);

    $sql = "INSERT INTO extras (image,signup_id,email) VALUES (:img,:sid,:email) ";
    // execute query
    $stmt = $pdo->query($sql);

    $stmt->execute(
        array(
            ':img' => $image,
            ':sid'=>$_GET['signup_id'],
            ':email'=>$_SESSION['email']
            )
        );

}
$result = $pdo->query("SELECT image from extras");


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSMOS > PROFILE</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="../profile page/profile page css.css"> -->
    <!-- <link rel="stylesheet" href="profile.css"> -->
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <script src="https://kit.fontawesome.com/33ef740869.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <style>
        @import url('http://fonts.googleapis.com/css?family=Poppins&display=swap');
        @import url('http://fonts.googleapis.com/css?family=Bree+Serif&display=swap');

        :root {
            --color: #111;
        }

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background: #e9e9e9;
            overflow: auto;
            padding-top: 100px;
            font-family: "Poppins", sans-serif;
            margin: 0 50px;
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
            /* width: 100%;
        max-width: 115rem;
        margin: 0 9rem;
        padding: 0; */
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

        .logo {
            width: 100%;
            height: 100vh;
            background-image: url("logo.png");
            min-height: 500px;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            /* margin: 21rem 17rem; */
        }

        .logo::after {
            content: '';
            width: inherit;
            height: inherit;
            position: absolute;
            top: 0;
            left: 0;
        }

        .demo-content {
            width: 100%;
            height: 200vh;
            background-color: #151515;
        }

        /* Hero end*/

        .search-opt::after {
            position: fixed;
        }

        .search-opt {
            left: 49%;
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

        .profile-header {
            background: #fff;

            width: 100%;
            display: flex;
            height: 200px;
            position: relative;
            box-shadow: 0px 3px 4px rgba(0, 0, 0, .2);
        }

        #uploadBtn {
            height: 40px;
            width: 80%;
            left: 2.4rem;
            top:-31rem;
            /* transform: translateX(0%); */
            text-align: center;
            margin-top: 20rem;
            background: yellow;
            z-index: 1000;
            color: black;
            border-radius: 1rem;;
            border: 2px solid black;
            line-height: 30px;
            font-size: 15px;
            position: relative;
            display: none;
        }

        #photo {
            height: 100%;
            width: 100%;
        }

        #file {
            display: none;
        }

        .profile-img {
            margin-left: 5rem;
            margin-top: -3rem;
            float: left;
            font-size: 23rem;
        }

        .profile-img img {
            border-radius: 50%;
            height: 230px;
            width: 230px;
            border: 4px solid #fff;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, .2);
            position: absolute;
            left: 50px;
            top: 14px;
            z-index: 3;
            background: #fff;
        }

        .profile-nav-info {
            float: left;
            flex-direction: column;
            justify-content: center;
    margin-left: 4rem;
            padding-top: 60px;
        }

        .profile-nav-info h3 {
            font-variant: small-caps;
            font-size: 4rem;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: bold;
        }

        .profile-nav-info .address {
            display: flex;
            font-weight: bold;
            color: #777;
        }

        .profile-nav-info .address p {
            margin-right: 5px;
        }

        .profile-option {
            width: 40px;
            height: 40px;
            background: #111;
            position: absolute;
            right: 50px;
            top: 50%;
            transform: translateY(-50%);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all .5s ease-in-out;
            outline: none;
        }

        .profile-option .notification i {
            color: #fff;
            font-size: 1.2rem;
            transition: all .1s ease-in-out;
        }

        .profile-option .notification .alert-message:hover {
            background-color: #111;
            color: #fff;
        }

        .profile-option .notification .alert-message {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #fff;
            color: #111;
            border-radius: 50%;
            height: 20px;
            width: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: .8rem;
            font-weight: bold;
            border: 2px solid black;
        }

        .main-bd {
            overflow: auto;
            width: 100%;
            display: flex;
            padding-right: 15px;
        }

        .profile-side {
            width: 300px;
            background: #fff;
            box-shadow: 0px 3px 5px rgba(0, 0, 0, .2);
            padding: 90px 30px 20px;
            font-family: 'Bree Serif', serif;
            margin-left: 10px;
            z-index: 99;
        }

        .profile-side p {
            margin-bottom: 7px;
            font-size: 14px;
            color: #333;
        }

        .profile-side p i {
            color: #111;
            margin-right: 10px;
        }

        .profile-btn {
            display: flex;
        }

        button.chatbtn,
        button.createbtn {
            border: 0;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            background: #111;
            font-family: 'Bree Serif', serif;
            font-size: 1rem;
            margin: 5px 2px;
            text-decoration: none;
            cursor: pointer;
            outline: none;
            margin-bottom: 10px;
            transition: .3s ease-in-out;
            box-shadow: 0px 5px 7px 0px rgba(0, 0, 0, .3);
            color: #fff;
        }

        a.delThebtn {
            border: 0;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            text-align: center;
            background: #111;
            font-family: 'Bree Serif', serif;
            font-size: 1rem;
            margin: 5px 2px;
            text-decoration: none;
            cursor: pointer;
            outline: none;
            margin-bottom: 10px;
            transition: .3s ease-in-out;
            box-shadow: 0px 5px 7px 0px rgba(0, 0, 0, .3);
            color: #fff;
        }

        button.chatbtn :hover,
        button.createbtn :hover,
        a.delThebtn:hover {
            opacity: .9;
            /* background: rgba(288, 0, 70, .9); */
        }

        button.chatbtn i,
        button.createbtn i {
            margin-right: 5px;
        }

        .user-rating {
            display: flex;
        }

        .user-rating h1 {
            font-size: 2.5rem;
            font-weight: 200;
            margin-right: 5px;
            letter-spacing: 1px;
            color: #666;
        }

        .user-rating .no-user {
            font-size: .9rem;
        }

        .rate {
            padding-top: 6px;
        }

        .rate i {
            font-size: .9rem;
            color: #111;
        }

        .fa1 {
            padding-right: 1.2rem;
        }

        .nav {
            font-size: 15px;
            width: 100%;
            z-index: -1;
        }

        .nav ul {
            width: 100%;
            display: flex;
            justify-content: center;
            list-style-type: none;
            height: 40px;
            background: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, .3);
        }

        .nav ul li {
            padding: 10px;
            width: 100%;
            cursor: pointer;
            text-align: center;
            transition: all .2s ease-in-out;
        }

        .nav ul li.active,
        .nav ul li :hover {
            box-shadow: 0px -3px 0px #111 inset;
            width: 100%;
        }

        .profile-body {
            width: 100%;
            z-index: -1;
        }

        .tab {
            padding: 20px;
            width: 100%;
            text-align: center;
            display: none;
        }

        #see-more-bio,
        #see-less-bio {
            color: black;
            font-weight: bold;
            cursor: pointer;
            text-transform: lowercase;
        }

        @media(max-width: 1100px) {
            .profile-side {
                width: 250px;
                padding: 90px 15px 20px;
            }

            .profile-img img {
                height: 200px;
                width: 200px;
                left: 20px;
                right: 50px;
            }

            #uploadBtn {
                width: 57%;

            }
        }

        .avatar1 {
            margin-top: -1.3rem;
        }

        @media(max-width: 900px) {
            body {
                margin: 0 20px;
            }

            .profile-header {
                display: flex;
                height: 100%;
                flex-direction: column;
                text-align: center;
                padding-bottom: 20px;
            }

            .profile-img {
                float: left;
                width: 100%;
                height: 200px;
            }

            .profile-img img {
                position: relative;
                left: 0;
            }

            .profile-nav-info {
                text-align: center;
            }

            .profile-nav-info .address {
                justify-content: center;
            }

            .profile-option {
                right: 20px;
                top: 75px;
                transform: translateY(58%);
            }

            .main-bd {
                flex-direction: column;
                padding-right: 0px;
            }

            .profile-side {
                width: 100%;
                text-align: center;
                padding: 20px;
                margin: 5px 0;
            }

            .user-rating {
                justify-content: center;
            }

            #uploadBtn {
                width: 26%;
                left: 25.4rem;

                text-align: center;
                margin-top: -2rem;
            }
        }

        @media(max-width: 400px) {
            body {
                margin: 0;
            }

        }
    </style>
</head>

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
                        echo ('<a class="nava-link" href="profile.php?signup_id=' . $_SESSION['signup_id'] . '"><img alt="profile" src="//www.gravatar.com/avatar/ad83af7510c0f93dfb5a9f46c4baf446?s=30&amp;r=g&amp;d=mm" srcset="//www.gravatar.com/avatar/ad83af7510c0f93dfb5a9f46c4baf446?s=30&amp;r=g&amp;d=mm 2x" class="avatar1" height="30" width="30" style="border-radius:30px;margin-right:9px;margin-bottom: -6px;">Welcome, ' . ($_SESSION['name']) . '</a><div  class="divider-symbol"></div><a href="logout.php" class="nava-link logout">LOGOUT</a>');
                    }

                    ?>
                </div>
            </nav>
        </div>
    </header>

    <!-- <section class="logo"></section>
    <section class="demo-content"> -->

    <div class="container">
        <div class="profile-header">
            <div class="profile-img">
                <i class="far fa-user-circle"></i><input type="submit" name="uploadBtn" id="uploadBtn" value="UPDATE">
                <input type="file" id="file" name="image">
            </div>
            <div class="profile-nav-info">
                <h3 class="username">
                    <?php
                    echo ($_SESSION['name']);  ?>
                </h3>
                <!-- <div class="address">
                    <p class="state">New Delhi</p>
                    <span class="country">India</span>
                </div> -->
            </div>
            <div class="profile-option">
                <div class="notification">
                    <i class="fa fa-bell"></i>
                    <span class="alert-message">1</span>
                </div>
            </div>
        </div>

        <div class="main-bd">
            <div class="left-side">
                <div class="profile-side">
                    <p class="mobile-no">
                        <i class="fa fa-phone">
                        </i>
                        <?php
                        echo (htmlentities($_SESSION['pnum']));
                        ?>
                    </p class="user-mail">
                    <i class="fa1 fa fa-envelope"></i>
                    <?php
                    echo (htmlentities($_SESSION['email']));  ?>
                    </p>
                    <div class="user-bio">
                        <h3>Bio</h3>
                        <p class="bio">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor perspiciatis est deleniti
                            hic officiis doloribus quod ut saepe doloremque pariatur.
                        </p>
                    </div>
                    <div class="profile-btn">
                        <!-- <button name="update" class="chatbtn">
                            Update profile
                        </button> -->
                        <?php
                        echo ('<a href="update.php?signup_id=' . $_SESSION['signup_id'] . '" class="delThebtn" name="update">Update Profile</a>');

                        echo ('<a href="delete_account.php?signup_id=' . $_SESSION['signup_id'] . '" class="delThebtn" name="delete1">Delete Account</a>'); ?>

                        <button class="createbtn">
                            <i class="fa fa-plus"></i>
                            Post
                        </button>
                    </div>
                    <div class="user-rating">
                        <h3 class="rating">4.5</h3>
                         <div class="rate">
                             <div class="stars">

                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div> 
                        </div>
                        <span class="no-user">
                            <span>123</span> &nbsp; &nbsp; Review
                        </span>
                    </div>
                </div>
            </div>


            <div class="right-side">
                <div class="nav">
                    <ul>
                        <li onclick="tabs(0)" class="user-post active">Posts</li>
                        <li onclick="tabs(1)" class="user-review ">Review</li>
                        <li onclick="tabs(2)" class="user-setting ">Setting</li>
                        <li onclick="tabs(3)" class="user-followers ">Followers</li>
                    </ul>
                </div>
                <div class="profile-body">
                    <div class="profile-post tab">
                        <h1>Your posts</h1>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea dolorum magni vero beatae
                            molestiae commodi eligendi. Totam ipsam, tempore dolorum eaque reiciendis adipisci vitae
                            soluta, impedit id labore amet quas veniam provident
                            voluptas nostrum, saepe quasi dignissimos praesentium sapiente. Sunt.</p>
                    </div>
                    <div class="profile-review tab">
                        <h1>user review</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis praesentium atque error
                            pariatur vero dolorum necessitatibus ullam consequatur ex qui!</p>
                    </div>
                    <div class="profile-setting tab">
                        <h1>Account Setting</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum corporis eius vero error
                            corrupti aperiam, quod fugit. Perspiciatis, deleniti alias. Lorem ipsum dolor sit amet
                            consectetur adipisicing elit. Aperiam, voluptatem.</p>
                    </div>
                    <div class="user-followers tab">
                        <h1>Followers</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo a ipsam harum perspiciatis
                            neque quas ex? Suscipit laborum ipsum tempore. Lorem ipsum dolor, sit amet consectetur
                            adipisicing elit. Facere, ab.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <script language="javascript" type="text/javascript">
        $('.nav ul li').click(function() {
            $(this).addClass("active").siblings().removeClass("active");
        })



        const tabBtn = document.querySelectorAll('.nav ul li');
        const tab = document.querySelectorAll('.tab');

        function tabs(panelIndex) {
            tab.forEach(function(node) {
                node.style.display = 'none';
            });
            tab[panelIndex].style.display = 'block';
        }
        tabs(0);


        let bio = document.querySelector('.bio');

        function bioText() {
            bio.oldText = bio.innerText;
            bio.innerText = bio.innerText.substring(0, 50) + "...";
            bio.innerHTML += "&nbsp;" + "<span onclick='addLength()' id='see-more-bio'> see more </span>";
        }
        bioText();

        function addLength() {
            bio.innerHTML = bio.oldText;
            bio.innerHTML += "&nbsp;" + "<span onclick='bioText()' id='see-less-bio'> see less </span>";
        }

        // // dp change js
        const imgDiv = document.querySelector('.profile-img');
        const img = document.querySelector('#photo');
        const file = document.querySelector('#file');
        const uploadBtn = document.querySelector('#uploadBtn');


        imgDiv.addEventListener('mouseenter', function() {
            uploadBtn.style.display = "block";
        });


        imgDiv.addEventListener('mouseleave', function() {
            uploadBtn.style.display = "none";
        });

        file.addEventListener('change', function() {
            //this refers to file
            const choosedFile = this.files[0];

            if (choosedFile) {

                const reader = new FileReader(); //FileReader is a predefined function of JS

                reader.addEventListener('load', function() {
                    img.setAttribute('src', reader.result);
                });

                reader.readAsDataURL(choosedFile);

            }
        });
    </script>

</body>

</html>