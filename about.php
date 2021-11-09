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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COSMOS - ABOUT</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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

  .product-device {
    position: absolute;
    right: 10%;
    bottom: -30%;
    width: 300px;
    height: 540px;
    background-color: #333;
    border-radius: 21px;
    transform: rotate(30deg);
  }

  .product-device::before {
    position: absolute;
    top: 10%;
    right: 10px;
    bottom: 10%;
    left: 10px;
    content: "";
    background-color: rgba(255, 255, 255, .1);
    border-radius: 5px;
  }

  .product-device-2 {
    position: absolute;
    right: 73%;
    bottom: -30%;
    width: 300px;
    height: 540px;
    background-color: #333;
    border-radius: 21px;
    transform: rotate(30deg);
    z-index: 100;
  }

  .product-device-2::before {
    position: absolute;
    top: 10%;
    right: 10px;
    bottom: 10%;
    left: 10px;
    content: "";
    background-color: rgba(255, 255, 255, .1);
    border-radius: 5px;
  }


  /* for increasing the size of the card */
  .p-9 {
    padding: 9rem !important;
  }

  /* for makingh color white */

  .cl1 {
    color: #fff;
  }


  /* footer here */


  footer {
    /* position: fixed; */
    top: 3rem;
    bottom: 0px;
    width: 116%;
    margin-left: -108px;
    color: white;
    font-size: 14px;
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

  .box .contenta {
    margin: 20px 0 0 0;
    position: relative;
  }

  .box .contenta:before {
    position: absolute;
    content: '';
    top: -10px;
    height: 2px;
    width: 100%;
    background: #1a1a1a;
  }

  .box .contenta:after {
    position: absolute;
    content: '';
    height: 2px;
    width: 15%;
    background: #f12020;
    top: -10px;
  }

  .left .contenta p {
    text-align: justify;
  }

  .left .contenta .social {
    margin: 20px 0 0 0;
  }

  .left .contenta .social a {
    padding: 0 2px;
  }

  .left .contenta .social a span {
    height: 40px;
    width: 40px;
    background: #1a1a1a;
    line-height: 40px;
    text-align: center;
    font-size: 18px;
    border-radius: 5px;
    transition: 0.3s;
  }

  .left .contenta .social a span:hover {
    background: #f12020;
  }

  .center .contenta .fas {
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

  .center .contenta .fas:hover {
    background: #f12020;
  }

  .center .contenta .text {
    font-size: 1.0625rem;
    font-weight: 500;
    padding-left: 10px;
  }

  .center .contenta .phonea {
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
            echo ('<a class="nava-link" href="profile.php?signup_id=' . $_SESSION['signup_id'] . '"><img alt="profile" src="//www.gravatar.com/avatar/ad83af7510c0f93dfb5a9f46c4baf446?s=30&amp;r=g&amp;d=mm" srcset="//www.gravatar.com/avatar/ad83af7510c0f93dfb5a9f46c4baf446?s=30&amp;r=g&amp;d=mm 2x" class="avatar1" height="30" width="30" style="border-radius:30px;margin-right:9px;margin-bottom: -7px;">Welcome, ' . htmlentities($_SESSION['name']) . '</a><div  class="divider-symbol"></div><a href="logout.php" class="nava-link logout">LOGOUT</a>');
          }

          ?>
        </div>
      </nav>
    </div>
  </header>


  <section class="logo"></section>
  <section class="demo-content">

    <div class="position-relative overflow-hidden p-9 my-md-3 text-center  bg-light ">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal"></h1>
        <p class="lead fw-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this
          example based on Apple’s marketing pages.</p>
        <a class="btn btn-outline-secondary" href="#">Coming soon</a>
      </div>
      <div class=" shadow-sm d-none d-md-block marg"></div>
      <div class="product-device  shadow-sm d-none d-md-block"></div>
    </div>

    <div class="position-relative overflow-hidden p-9 my-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal"></h1>
        <p class="lead fw-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this
          example based on Apple’s marketing pages.</p>
        <a class="btn btn-outline-secondary" href="#">Coming soon</a>
      </div>
      <div class="product-device-2 shadow-sm d-none d-md-block"></div>
      <div class=" product-device-2 shadow-sm d-none d-md-block"></div>
    </div>

    <div class="position-relative overflow-hidden p-9 my-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal"></h1>
        <p class="lead fw-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this
          example based on Apple’s marketing pages.</p>
        <a class="btn btn-outline-secondary" href="#">Coming soon</a>
      </div>
      <div class="product-device shadow-sm d-none d-md-block"></div>
      <div class="product-device  shadow-sm d-none d-md-block"></div>
    </div>

    <div class="position-relative overflow-hidden p-9 my-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal"></h1>
        <p class="lead fw-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this
          example based on Apple’s marketing pages.</p>
        <a class="btn btn-outline-secondary" href="#">Coming soon</a>
      </div>
      <div class="product-device-2 shadow-sm d-none d-md-block"></div>
      <div class="product-device-2  shadow-sm d-none d-md-block"></div>
    </div>

    <div class="position-relative overflow-hidden p-9 my-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal"></h1>
        <p class="lead fw-normal">And an even wittier subheading to boot. Jumpstart your marketing efforts with this
          example based on Apple’s marketing pages.</p>
        <a class="btn btn-outline-secondary" href="#">Coming soon</a>
      </div>
      <div class="product-device shadow-sm d-none d-md-block"></div>
      <div class="product-device  shadow-sm d-none d-md-block"></div>
    </div>


    <!-- information about team -->

    <main class="container">
      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4 cl1">TEAM MEMBERS</h1>
        <p class="lead cl1">We are a team of only 3 developers and we made this kind of start up only in few months.
        </p>
      </div>

      <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

        <!-- sharma ki profile -->
        <div class="col">
          <div class="card mb-4 shadow-sm">
            <div class="card-header">
              <h4 class="my-0 fw-normal">YASH SHARMA</h4>
            </div>
            <div class="card-body">

              <ul class="list-unstyled mt-3 mb-4">


                <li>10 users included</li>
                <li>2 GB of storage</li>
                <li>Email support</li>
                <li>Help center access</li>
              </ul>
              <a href="#" class="w-100 btn btn-lg btn-outline-primary">Git hub link here</a>
            </div>
          </div>
        </div>

        <!-- nalin ki profile -->

        <div class="col">
          <div class="card mb-4 shadow-sm">
            <div class="card-header">
              <h4 class="my-0 fw-normal">NALIN SHUKLA</h4>
            </div>
            <div class="card-body">

              <ul class="list-unstyled mt-3 mb-4">


                <!-- har bnde ki info daal den idhar aur photo bhi -->
                <li>20 users included</li>
                <li>10 GB of storage</li>
                <li>Priority email support</li>
                <li>Help center access</li>
              </ul>
              <a href="#" class="w-100 btn btn-lg btn-outline-primary">Git hub link here</a>
            </div>
          </div>
        </div>


        <!-- garg ki profile -->

        <div class="col">
          <div class="card mb-4 shadow-sm">
            <div class="card-header">
              <h4 class="my-0 fw-normal">YASH GARG</h4>
            </div>
            <div class="card-body">

              <ul class="list-unstyled mt-3 mb-4">

                <!-- har bnde ki info daal den idhar aur photo bhi -->
                <li>30 users included</li>
                <li>15 GB of storage</li>
                <li>Phone and email support</li>
                <li>Help center access</li>
              </ul>
              <a href="#" class="w-100 btn btn-lg btn-outline-primary">Git hub link here</a>
            </div>
          </div>
        </div>
      </div>



      <!-- footer here -->


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
            <div class="contenta">
              <div class="place">
                <span class="fas fa-map-marker-alt"></span>
                <span class="text">address</span>
              </div>
              <div class="phonea">
                <span class="fas fa-phone-alt"></span>
                <span class="text">mobile number</span>
              </div>
              <div class="emaila">
                <span class="fas fa-envelope"></span>
                <span class="text">abc@example.com</span>
              </div>
            </div>
          </div>
          <div class="right box">
            <h2>
              Support us</h2>
            <div class="content">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit, eligendi eaque voluptates doloribus
                similique officia?</p>
              <form action="#">

                <div class="btna">
                  <button type="submit">Donate</button>
                </div>


              </form>
            </div>
          </div>
        </div>
      </footer>

  </section>



  <script>
    window.addEventListener('scroll', function() {
      let header = document.querySelector('header');
      let windowPosition = window.scrollY > 0;
      header.classList.toggle('scrolling-active', windowPosition);
    })
  </script>



</body>

</html>