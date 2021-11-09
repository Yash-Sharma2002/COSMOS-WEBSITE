<!-- using model view controller -->


<!-- MODEL -->
<?php
session_start();

require_once "pdo.php";

$salt = 'XyZzy12*_';



$failure = false;  // If we have no POST data

if (isset($_POST['email']) && isset($_POST['password'])) {
    if (strpos($_POST['email'], "@") === false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: login.php");
        return;
    } else if ($_POST['password'] < 5) {
        $_SESSION['error'] = 'Password must contain more than 5 characters.';
        header("Location: login.php");
        return;
    }

    $check = hash('md5', $salt . $_POST['password']);
    $sql = "SELECT signup_id,first_name,last_name,pnum,email FROM signup WHERE email = :em  AND password = :pw";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':em' => $_POST['email'],
        ':pw' => $check
    ));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row !== false) {

        $_SESSION['name'] = $row['first_name'] . " " . $row['last_name'];
        $_SESSION['fname'] = $row['first_name'];
        $_SESSION['signup_id'] = $row['signup_id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['pnum']  = $row['pnum'];

        // Redirect the browser to main page

        $_SESSION['success'] = "Login Success";
        header("Location: cosmosmainpage.php");
        return;
    } else {
        $_SESSION['error'] = "Incorrect E-mail or password";
        error_log("Login fail " . $_POST['email'] . " $check");
        header("Location: login.php");
        return;
    }
}

// Fall through into the View
?>


<!-- VIEW -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSMOS > LOGIN FORM</title>
    <link rel="shortcut icon" href="favicon.jpg" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
        max-width: 120rem; */
        /* margin: 0 9rem; */
        padding: 0;
        background-color: #151515;
        margin-left: auto;
        margin-right: 9rem;
    }

    .nav {
        width: 100%;
        height: 9rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 2px solid rgba(255, 255, 255, .05);
        transition: height .5s ease;
    }

    .nav a {
        text-decoration: none;
        color: #fff;
        font-size: 1.6rem;
    }


    .nav-list {
        list-style: none;
        display: flex;
        margin-right: auto;
        margin-left: 4rem;
    }

    .nav-link {
        margin: 0 2rem;
        position: relative;
    }

    .nav-link::after {
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

    .nav-link:hover::after {
        transform: scaleX(1);
    }


    /*Apply styles after scroll*/
    .scrolling-active {

        box-shadow: 0 3px 1rem rgba(0, 0, 0, .1);
    }

    .scrolling-active .nav {
        height: 6.6rem;
    }

    .scrolling-active .nav a {
        color: white;
    }

    .scrolling-active .search-opt {
        height: 30px;
        top: 33px;

    }

    .scrolling-active .search-btn {
        height: 30px;
    }

    .scrolling-active .nav-link::after {
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

    section.major-whole {
        display: flex;
        /* text-align: center;
        justify-content: center;
        align-items: center; */
    }

    div.logo-image img {
        display: block;
        /* float: left ; */
        width: 50%;
        margin-top: 30rem;
        margin-left: 6rem;
        /* background-position: right; */
        /* background-position: center; */
    }

    div.written {
        color: white;

        margin-left: 23rem;
        font-family: 'Secular One', sans-serif;
        font-size: 24px;
        font-style: normal;
        font-variant: normal;
        font-weight: 700;
        line-height: 26.4px;
    }


    .search-opt::after {
        position: fixed;

    }

    .search-opt {
        left: 49%;
        background: #ffffff;
        height: 35px;
        border-radius: 5px;
        padding: 10px;
        top: 47px;
        transition-delay: .1s;
        transform: translate(-50%, -50%);
        position: fixed;
    }

    .search-btn {
        /* display: block; */
        position: relative;
        float: right;
        /* color: green; */
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

    /* .only-for-search-icon {
        font-size: 20px;
        font-weight: 700;
    } */


    @import url('https://fonts.googleapis.com/css?family=Montserrat:600|Noto+Sans|Open+Sans:400,700&display=swap');



    div.whole {
        display: block;
        height: 100%;

        align-items: center;
        text-align: center;
        font-family: sans-serif;
        justify-content: center;

    }

    .container {

        position: relative;
        width: 400px;
        background: white;
        padding: 0px 50px;
        margin-left: auto;
        margin-right: -21rem;
        margin-top: -33rem;
        padding-bottom: 3rem;
        padding-top: 20px;

    }

    #login-opt-head {
        font-family: 'Secular One', sans-serif;
        font-size: 40px;
        font-style: normal;
        font-variant: normal;
        font-weight: 700;
        line-height: 26.4px;
        margin-bottom: 60px;
        /* font-family: 'Montserrat', sans-serif; */
    }

    .input-field,
    form .button {
        margin: 25px 0;
        position: relative;
        height: 50px;
        width: 100%;

    }

    .input-field input {
        height: 100%;
        width: 100%;
        border: 1px solid silver;
        padding-left: 15px;
        outline: none;
        font-size: 19px;
        transition: .4s;
        border-radius: 3rem;
    }

    input:focus {
        border: 1px solid #1DA1F2;
        border-radius: 3rem;
    }

    .input-field label,
    span.show {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .input-field label {
        left: 15px;
        pointer-events: none;
        color: grey;
        font-size: 18px;
        transition: .4s;
        font-family: 'Secular One', sans-serif;
        font-size: 14px;

        font-weight: bold;
        line-height: 26.4px;

    }

    span.show {
        right: 20px;
        color: #111;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        user-select: none;
        visibility: hidden;
        font-family: 'Open Sans', sans-serif;
    }

    input:valid~span.show {
        visibility: visible;
    }

    input:focus~label,
    input:valid~label {
        transform: translateY(-33px);
        background: white;
        font-size: 16px;
        color: #1DA1F2;
    }

    form .button {
        margin-top: 30px;
        overflow: hidden;
        z-index: 111;
    }

    .button .inner {
        position: absolute;
        height: 100%;
        width: 300%;
        left: -100%;
        z-index: -1;
        transition: all .4s;
        background: -webkit-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);

    }

    .button:hover {
        left: 0;
        /* right: 0;
        border-radius: 3rem; */
    }

    .button button {
        width: 100%;
        height: 100%;
        border: none;
        background: none;
        outline: none;
        color: white;
        /* font-size: 20px; */
        cursor: pointer;
        font-family: 'Secular One', sans-serif;
        font-size: 20px;

        /* font-weight: bold; */
        line-height: 26.4px;

    }

    .container .auth {
        margin: 35px 0 20px 0;

        color: grey;
        font-family: 'Secular One', sans-serif;
        font-size: 19px;

        font-weight: bold;
        line-height: 26.4px;
    }

    .links {
        display: flex;
        cursor: pointer;

    }

    .facebook,
    .google {
        height: 40px;
        width: 100%;
        border: 1px solid silver;
        border-radius: 3px;
        margin: 0 10px;
        transition: .4s;
        border-radius: 3rem;
    }

    .facebook:hover {
        border: 1px solid #4267B2;
    }

    .google:hover {
        border: 1px solid #dd4b39;
    }

    .facebook i,
    .facebook span {
        color: #4267B2;
    }

    .google i,
    .google span {
        color: #dd4b39;
    }

    .links i {
        font-size: 23px;
        line-height: 40px;
        margin-left: -90px;
    }

    .links span {
        position: absolute;
        font-size: 17px;
        font-weight: bold;
        padding-left: 8px;
        font-family: 'Open Sans', sans-serif;
    }

    .signup {
        margin-top: 50px;
        /* font-family: 'Noto Sans', sans-serif;
        font-size: 17px; */
        font-family: 'Secular One', sans-serif;
        font-size: 15px;

        font-weight: bold;
        line-height: 26.4px;
    }

    .signup a {
        /* color: #3498db; */
        text-decoration: none;
        font-family: 'Secular One', sans-serif;
        font-size: 15px;

        font-weight: bold;
        line-height: 26.4px;

    }

    .signup a:hover {
        text-decoration: underline;
    }
</style>

<body>
    <header>
        <div class="container1">
            <nav class="nav">

                <ul class="nav-list">
                    <li>
                        <a href="cosmosmainpage.php" class="nav-link">HOME</a>
                    </li>
                    <li>
                        <a href="about.html" class="nav-link">ABOUT</a>
                    </li>



                </ul>
                <div id="searchbar-opt" class="search-opt">
                    <input type="search" id="searchin-opt" name="s" placeholder="  Search..." aria-label="search through the site content">
                    <a class="search-btn" href="#"><i class="fa fa-search only-for-search-icon" aria-hidden="true"></i>
                    </a>
                </div>
                <div>
                    <a href="login.php" class="nav-link">LOGIN</a>
                    <div class="divider-symbol"></div>
                    <a href="sign-up.php" class="nav-link">SIGN UP</a>
                </div>
            </nav>
        </div>
    </header>

    <section class="major-whole">
        <div class="logo-image">
            <img src="logo.png" alt="COSMOS">
            <div class="written">-- WHAT'S BEYOND THE SKY !</div>
            <div>
                <div class="whole">
                    <div class="container">

                        <p id="login-opt-head">Login Form</p>
                        <?php
                        // if (isset($_SESSION['success'])) {
                        //     echo ('<p style="  color: green;font-size: 15px;text-align: center;">' . htmlentities($_SESSION['success']) . "</p>\n");
                        //     unset($_SESSION['success']);
                        // } else 
                        if (isset($_SESSION['error'])) {
                            echo ('<p style="  color: red;font-size: 15px;text-align: center;">' . htmlentities($_SESSION['error']) . "</p>\n");
                            unset($_SESSION['error']);
                        }
                        ?>
                        <form method="post">
                            <div class="input-field">
                                <input type="text" id="email" name="email" required>
                                <label>Email...</label>
                            </div>
                            <div class="input-field">
                                <input class="pswrd" type="password" id="id_1723" name="password" required>
                                <span class="show">SHOW</span>
                                <label>Password...</label>
                            </div>
                            <div class="button">
                                <div class="inner">
                                </div>
                                <button type="submit" name="submit">LOGIN</button>
                            </div>
                        </form>
                        <div class="auth">
                            Or login with</div>
                        <div class="links">
                            <div class="facebook">
                                <i class="fab fa-facebook-square"><span>Facebook</span></i>
                            </div>
                            <div class="google">
                                <i class="fab fa-google-plus-square"><span>Google</span></i>
                            </div>
                        </div>
                        <div id="sign_up" class="signup">
                            Not a member? <a href="sign-up.php">Signup now</a>
                        </div>
                    </div>
                </div>
    </section>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script>
        var input = document.querySelector('.pswrd');
        var show = document.querySelector('.show');
        show.addEventListener('click', active);

        function active() {
            if (input.type === "password") {
                input.type = "text";
                show.style.color = "#1DA1F2";
                show.textContent = "HIDE";
            } else {
                input.type = "password";
                show.textContent = "SHOW";
                show.style.color = "#111";
            }
        }
    </script>
    <!-- <script>
        function doValidate() {

            console.log('Validating...');

            try {
                email = document.getElementById('email').value;
                pw = document.getElementById('id_1723').value;

                console.log("Validating email = " + email + " password =" + pw);

                if (pw == null || pw == "") {

                    alert("Both fields must be filled out");

                    return false;

                } else if (email.indexOf('@') == -1) {
                    alert("Email Must Have @ sign");
                    return false;
                }

                return true;

            } catch (e) {

                return false;

            }

            return false;

        }
    </script> -->
</body>

</html>