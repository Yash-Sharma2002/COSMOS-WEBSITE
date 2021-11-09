<?php
session_start();

// unset($_SESSION['error']);
unset($_SESSION['success']);

require_once "pdo.php";
if (
    isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['password'])
    && isset($_POST['cpass']) && isset($_POST['gender']) && isset($_POST['email']) && isset($_POST['pnum']) && isset($_POST['address']) && isset($_POST['postal_code'])
) {
    if (strpos($_POST['email'], "@") === false) {
        $_SESSION['error'] = "Email must have an at-sign (@)";
        header("Location: sign-up.php");
        return;
    } else if (strlen($_POST['password']) < 5) {
        $_SESSION['error'] = 'Password must be more than 5 numbers';
        header("Location: sign-up.php");
        return;
    } else if ($_POST['cpass'] !== $_POST['password']) {
        $_SESSION['error'] = 'Password is not same in both fields';
        header("Location: sign-up.php");
        return;
    } else if (is_numeric($_POST['pnum']) != 1) {
        $_SESSION['error'] = 'Phone number must be numeric.';
        header("Location: sign-up.php");
        return;
    }
    // if we want postal code from users than we use this condition
    // else if(is_numeric($_POST['pcode']) !=1){
    //     $_SESSION['error'] = 'Postal code must be numeric.';
    //     header("Location: sign-up.php");
    // //     return;
    // }
    $salt = 'XyZzy12*_';
    // storing password as hash due to security reasons of the user
    $check = hash('md5', $salt . $_POST['password']);
    $sql = "INSERT INTO signup
(signup_id, first_name, last_name, email, password,gender,pnum,address,postal_code)
VALUES (:signup_id, :fname, :lname, :email,:pass, :gender,:pnum,:address,:pcode)";
    $stmt = $pdo->prepare($sql);

    $stmt->execute(
        array(
            ':signup_id' => $_POST['signup_id'],
            ':fname' => $_POST['first_name'],
            ':lname' => $_POST['last_name'],
            ':email' => $_POST['email'],
            ':pass' => $check,
            ':pnum' => $_POST['pnum'],
            ':gender' => $_POST['gender'],
            ':address' => $_POST['address'],
            ':pcode' => $_POST['postal_code']
        )
    );
    $_SESSION['name'] = $_POST['first_name'] . " " . $_POST['last_name'];
    $_SESSION['fname'] = $_POST['first_name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['password'] = $_POST['password'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['address'] = $_POST['address'];
    $_SESSION["pcode"] = $_POST['pcode'];
    $_SESSION['pnum']  = $_POST['pnum'];
    $_SESSION['success'] = "Sign up Succesfull";
    header("Location: cosmosmainpage.php");
    return;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COSMOS - SIGN UP</title>
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

    /* 
    * {
        background-color: #151515;
    } */

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
        opacity: 1;
    }

    .container1 {
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

    section.demo-content {
        display: flex;


    }

    div.logo-image img {
        /* display: block; */
        /* float: left ; */
        width: 50%;
        margin-top: 30rem;
        margin-left: 6rem;
        position: relative;
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


    /* --------------------------------------------option starts herer ------------------------------------------------------------------------ */

    @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');

    /* *{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Montserrat', sans-serif;
} */
    /* div.whole{
  background: #fec107;
  padding: 0 10px;
} */
    .wrapper {
        max-width: 500px;
        width: 100%;
        background: #fff;
        /* margin: 20px auto; */
        margin-top: -37rem;
        margin-left: 89rem;
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.125);
        padding: 30px;
    }

    .wrapper .title {
        /* font-size: 24px;
        font-weight: 700; */
        margin-bottom: 25px;
        color: white;
        text-transform: uppercase;
        text-align: center;
        /* margin-top: 4rem; */
        /* margin-bottom: 4rem; */
        padding: 4rem 0px;
        font-family: 'Secular One', sans-serif;
        font-size: 35px;
        background-image: linear-gradient(45deg, #c21500, #ffc500);
        border-radius: 1rem;
        font-style: normal;
        font-variant: normal;
        font-weight: 700;
        line-height: 26.4px;
    }

    .wrapper .form {
        width: 100%;
    }

    .wrapper .form .inputfield {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .wrapper .form .inputfield label {
        width: 200px;
        font-family: 'Secular One', sans-serif;
        font-size: 15px;
        font-style: normal;
        font-variant: normal;
        font-weight: 700;
        line-height: 26.4px;
        color: black;
        margin-right: 10px;

    }

    .wrapper .form .inputfield .input,
    .wrapper .form .inputfield .textarea {
        width: 100%;
        outline: none;
        border: 1px solid #DC2424;
        font-size: 15px;
        padding: 8px 10px;
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .wrapper .form .inputfield .textarea {
        width: 100%;
        height: 125px;
        resize: none;
    }

    .wrapper .form .inputfield .custom_select {
        position: relative;
        width: 100%;
        height: 37px;
    }

    .wrapper .form .inputfield .custom_select:before {
        content: "";
        position: absolute;
        top: 12px;
        right: 10px;
        border: 8px solid;
        border-color: black transparent transparent transparent;
        pointer-events: none;
    }

    .wrapper .form .inputfield .custom_select select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        outline: none;
        width: 100%;
        height: 100%;
        border: 0px;
        padding: 8px 10px;
        font-size: 15px;
        border: 1px solid #DC2424;

    }


    .wrapper .form .inputfield .input:focus,
    .wrapper .form .inputfield .textarea:focus,
    .wrapper .form .inputfield .custom_select select:focus {
        border: 1px solid black;
    }

    .wrapper .form .inputfield p {
        font-family: 'Secular One', sans-serif;
        font-size: 15px;
        font-style: normal;
        font-variant: normal;
        font-weight: 700;
        line-height: 26.4px;
        color: black;

    }

    .wrapper .form .inputfield .check {
        width: 15px;
        height: 15px;
        position: relative;
        display: block;
        cursor: pointer;
    }

    .wrapper .form .inputfield .check input[type="checkbox"] {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .wrapper .form .inputfield .check .checkmark {
        width: 15px;
        height: 15px;
        border: 1px solid#DC2424;
        display: block;
        position: relative;
    }

    .wrapper .form .inputfield .check .checkmark:before {
        content: "";
        position: absolute;
        top: 1px;
        left: 1px;
        width: 12px;
        height: 7px;
        border: 2px solid;
        border-color: transparent transparent #fff #fff;
        transform: rotate(-45deg);
        display: none;
    }

    .wrapper .form .inputfield .check input[type="checkbox"]:checked~.checkmark {
        background: #fc00ff;
    }

    .wrapper .form .inputfield .check input[type="checkbox"]:checked~.checkmark:before {
        display: block;
    }

    .wrapper .form .inputfield .btn {
        width: 100%;
        padding: 8px 10px;
        /* font-size: 15px; */
        border: 2px solid white;
        background-image: linear-gradient(45deg, #00dbde, #fc00ff);
        color: #111;
        cursor: pointer;
        border-radius: 3px;
        outline: none;
        font-family: 'Secular One', sans-serif;
        font-size: 15px;
        font-style: normal;
        font-variant: normal;
        font-weight: 700;
        line-height: 26.4px;

    }

    .wrapper .form .inputfield .btn:hover {
        background-image: linear-gradient(45deg, #fc00ff, #00dbde);
        border: 2px solid black;
    }

    .wrapper .form .inputfield:last-child {
        margin-bottom: 0;
    }

    div.last-next-opt {
        color: black;
        text-align: center;
        justify-content: center;
        align-items: center;
        font-family: 'Secular One', sans-serif;
        font-size: 15px;
        font-style: normal;
        font-variant: normal;
        font-weight: 700;
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

    .abc {
        color: green;
        font-size: 15px;
        text-align: center;
    }

    @media (max-width:420px) {
        .wrapper .form .inputfield {
            flex-direction: column;
            align-items: flex-start;
        }

        .wrapper .form .inputfield label {
            margin-bottom: 5px;
        }

        .wrapper .form .inputfield.terms {
            flex-direction: row;
        }
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

    <section class="demo-content">
        <div class="logo-image">
            <img src="logo.png" alt="COSMOS">
            <div class="written">-- WHAT'S BEYOND THE SKY !</div>
            <div>
                <div class="whole">
                    <div class="wrapper">
                        <div class="title">
                            Connect With Us
                        </div>

                        <?php
                        if (isset($_SESSION['success'])) {
                            echo ('<p style="  color: green;font-size: 15px;text-align: center;">' . htmlentities($_SESSION['success']) . "</p>\n");
                            unset($_SESSION['success']);
                        } else if (isset($_SESSION['error'])) {
                            echo ('<p style="  color: red;font-size: 15px;text-align: center;">' . htmlentities($_SESSION['error']) . "</p>\n");
                            unset($_SESSION['error']);
                        }
                        ?>
                        <form class="form" method="post">
                            <div class="inputfield">
                                <label>First Name</label>
                                <input name="first_name" type="text" class="input" required>
                            </div>
                            <div class="inputfield">
                                <label>Last Name</label>
                                <input name="last_name" type="text" class="input">
                            </div>
                            <div class="inputfield">
                                <label>Password</label>

                                <input name="password" id="id_1723" type="password" class="input" required>
                                <!-- <span class="show" onclick="return active();">SHOW</span> -->

                            </div>
                            <div class="inputfield">
                                <label>Confirm Password</label>
                                <input type="password" class="input" name="cpass" required>

                            </div>
                            <div class="inputfield">
                                <label>Gender</label>
                                <div class="custom_select">
                                    <select name="gender">
                                        <option value="">Select---</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="female">Transgender</option>
                                    </select>
                                </div>
                            </div>
                            <div class="inputfield">
                                <label>Email Address</label>
                                <input type="text" class="input" name="email" required>
                            </div>
                            <div class="inputfield">
                                <label>Phone Number</label>
                                <input type="text" class="input" name="pnum">
                            </div>
                            <div class="inputfield">
                                <label>Address</label>
                                <textarea class="textarea" name="address"></textarea>
                            </div>
                            <div class="inputfield">
                                <label>Postal Code</label>
                                <input type="text" class="input" name="postal_code">
                            </div>
                            <div class="inputfield terms">
                                <label class="check" required>
                                    <input type="checkbox" required>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Agreed to terms and conditions</p>
                            </div>
                            <div class="inputfield">
                                <input type="submit" value="Submit" class="btn">
                            </div>
                            <div class="last-next-opt">
                                Already have an account ? <a href="login.php" class="login-next">Login Now.</a>
                            </div>
                        </form>
                    </div>

    </section>


    <!-- <script type="text/javascript">
        function doValidate() {

            console.log('Validating...');

            try {

                pw = document.getElementById('id_1723').value;

                console.log("Validating pw=" + pw);

                if (pw == null || pw == "") {

                    alert("Both fields must be filled out");

                    return false;

                }

                return true;

            } catch (e) {

                return false;

            }

            return false;

        }
    </script> -->



    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- <script>
        var input = document.querySelector('.input');
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
    </script> -->


    <script>
        window.addEventListener('scroll', function() {
            let header = document.querySelector('header');
            let windowPosition = window.scrollY > 0;
            header.classList.toggle('scrolling-active', windowPosition);
        })
    </script>
    <!-- Code injected by live-server -->
    <script type="text/javascript">
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>
</body>

</html>