<?php // Do not put any HTML above this line

session_start();
unset($_SESSION['error']);

require_once "pdo.php";
// $stmt = $pdo->query("SELECT signup_id,first_name,last_name,email,pnum FROM signup WHERE  ");
// $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
$salt = 'XyZzy12*_';
    
    $check = hash('md5', $salt . $_SESSION['password']);
    $sql = "SELECT signup_id FROM signup WHERE email = :em  AND password = :pw";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':em' => $_SESSION['email'],
        ':pw' => $check
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row !== false) {
        $_SESSION['signup_id'] = $row['signup_id'];
    }


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

  
    <section class="logo"></section>
    <section class="demo-content">
        

        <!-------------Main Options------------>
        <div id="main-opt-items">
            <a href="#" id="space-blogs-opt-main" class="opt-main">
                <span>
                    SPACE-BLOGS 
                </span>
            </a>
            <a href="wallpaper-page.php" id="wallpapers-opt-main" class="opt-main">
                <span>
                    WALLPAPERS
                    
                </span>
            </a>
            <a href="#" id="research-opt-main" class="opt-main">
                <span>
                    RESEARCHES
                </span>
            </a>
          <?php   
          if (!isset($_SESSION['name'])) { 
            echo('<a href="profile.php" id="profile-opt-main" class="opt-main"><span>PROFILE</span></a>');
          } else {
            echo('<a href="profile.php?signup_id='.$_SESSION['signup_id'].'" id="profile-opt-main" class="opt-main"><span>PROFILE</span></a>'); 
          }
            ?>
        </div>
        <!--------x-------Main Options-----x---------->
        <!-------------Trending Section------------->
        <div>
            <a href="#" id="trending-opt" class="trending-section-opt">
                <span>
                    TRENDING...
                </span>
            </a>
        </div>
        <!--------------Trending Box--------------->
        <div>
            <a href="#" id="trending-scroll-opt">
                <!-- is line me trending ka content dalega  color white de dena to aajayega anchor tag bhi diya h baad me chahe to hata denge-->
            </a>
        </div>
        <!-------x-------Trending Box--------x------->
        <!--------x------Trending Section--------x------->

        <!--------------Blog Section--------------->
        <div>
            <a href="" id="blog_opt_section">
                <span>
                    BLOGS...
                </span>
            </a>
        </div>
        <!--------------Blog Box Section--------------->
        <div class="page-wrapper">

            <!--------------slider------------->

            <div class="post-slider">
                <i class="fas fa-chevron-left prev"></i>
                <i class="fas fa-chevron-right next"></i>
                <div class="post-wrapper">

                    <!-----------1st post Box-------- -->
                    <div class="post">
                        <a href="#">
                            <img src="p1.jpg" alt="image is here" class="slider-image">
                            <div class="post-info">
                                <span class="head-txt">1Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil,
                                    molestiae et?</span>
                                    <br>
                                <i class="fas fa-user"><span class="username-type">Yash Nalin - </span></i>
                                &nbsp;
                                <span class="mg-3">5th Sept. 2020</span></i>
                            </div>
                        </a>
                    </div>

                    <!-------------2nd post Box--------------->
                    <div class="post">
                        <a href="#">
                            <img src="p1.jpg" alt="image is here" class="slider-image">
                            <div class="post-info">
                                <span class="head-txt">2Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil,
                                    molestiae et?</span>
                                    <br>
                                <i class="fas fa-user"><span class="username-type">Yash Nalin - </span></i>
                                &nbsp;
                                <span class="mg-3">5th Sept. 2020</span></i>
                            </div>
                        </a>
                    </div>

                    <!--------------3rd post Box------------->
                    <div class="post">
                        <a href="#">
                            <img src="p1.jpg" alt="image is here" class="slider-image">
                            <div class="post-info">
                                <span class="head-txt">3Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil,
                                    molestiae et?</span>
                                    <br>
                                <i class="fas fa-user"><span class="username-type">Yash Nalin - </span></i>
                                &nbsp;
                                <span class="mg-3">5th Sept. 2020</span></i>
                            </div>
                        </a>
                    </div>

                    <!---------------4rth post Box------------->
                    <div class="post">
                        <a href="#">
                            <img src="p1.jpg" alt="image is here" class="slider-image">
                            <div class="post-info">
                                <span class="head-txt">4Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil,
                                    molestiae et?</span>
                                    <br>
                                <i class="fas fa-user"><span class="username-type">Yash Nalin - </span></i>
                                &nbsp;
                                <span class="mg-3">5th Sept. 2020</span></i>
                            </div>
                        </a>
                    </div>

                    <!--------------5th post Box------------>
                    <div class="post">
                        <a href="#">
                            <img src="p1.jpg" alt="image is here" class="slider-image">
                            <div class="post-info">
                                <span class="head-txt">5Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil,
                                    molestiae et?</span>
                                    <br>
                                <i class="fas fa-user"><span class="username-type">Yash Nalin - </span></i>
                                &nbsp;
                                <span class="mg-3">5th Sept. 2020</span></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--------x--------Blog Box----------x-------->
    <!--------x--------Blog Section----------x-------->

    <!----------------Footer Section------------------>

    <footer>
        <div class="main-content">
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
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, eligendi eaque voluptates doloribus similique officia?</p>
                    <form action="#">
                     

                            <br />
                        <div class="btn">
                            <button type="submit">Donate</button>
                        </div>

                        <!-- </div> -->
                    </form>
                </div>
            </div>
        </div>
    </footer>
    <!--------x--------Footer Section----------x-------->

    <!-------------------Blog Box Section Java-------------->

    <!-------------------JavaScript------------------->

    <!-- j Query  -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


    <script src="https://kit.fontawesome.com/33ef740869.js" crossorigin="anonymous"></script>

    <!-- script coursel -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

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

    <script>
        window.addEventListener('scroll', function() {
            let header = document.querySelector('header');
            let windowPosition = window.scrollY > 0;
            header.classList.toggle('scrolling-active', windowPosition);
        })
    </script>



</body>

</html>