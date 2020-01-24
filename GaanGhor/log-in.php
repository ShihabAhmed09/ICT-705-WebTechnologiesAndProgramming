<?php 
    $filePath = realpath(dirname(__FILE__));
    include_once $filePath.'/lib/Session.php';
    Session::init();
?>
<?php 
    include 'lib/User.php';
    Session::checkLogin();
?>
<?php 
    $user = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $userLogin = $user->userLogin($_POST); //$_POST -> sends all the values of the form which we get
    }
?>
<!DOCTYPE html>
<html>

<head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="materialize/css/materialize.min.css" media="screen,projection" />
    <!-- <font awesome> -->
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <!-- main css -->
    <link rel="stylesheet" href="style.css">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>জ্ঞানঘর-কুবি</title>
</head>

<body>

    <!-- log in -->
    <div class="fullscreen">

        <section class="section section-logo deep-blue center">
            <div class="container">
                <h3><a href="register.php" class="whitish-text">জ্ঞানঘর</a></h3>
                <h5 class="amber-text">জ্ঞানের আলোয় আলোকিত</h5>
            </div>
        </section>
        <section class="section section-log deep-blue center">
        
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <div class="btns">
                            <a href="log-in.php" class="btn  waves-effect waves-light  blue darken-1 white-text">Log in</a></li>
                            <a href="register.php" class="btn  waves-effect blue darken-4">Register</a>
                        </div>
                        <div class="card-panel my-log center">
                            <form action="#"  method="POST">
                                <div class="input-feild mylogin">
                                    <input id="email" type="email" placeholder="Email" name="email" class="form-control">
                                </div>
                                <div class="input-feild mylogin">
                                    <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                                </div>
                                <input type="submit" value="Login" name="login" class="btn" id="go-btn">
                                <!--<a href="index.php" class="btn" id="go-btn">GO</a>-->
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        <?php 
            if (isset($userLogin)) {
                echo $userLogin;
            }  
        ?>    
        </section>

        <footer class=" log-footer navy-blu white-text center">
            <h5 class="white-text">জ্ঞানঘর-কুবি &copy; 2019</h5>
        </footer>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>

</body>

</html>
