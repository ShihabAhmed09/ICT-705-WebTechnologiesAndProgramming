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
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        $userRegi = $user->userRegistration($_POST); //$_POST -> sends all the values of the form which we get
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
                <h3><a href="log-in.php" class="whitish-text">জ্ঞানঘর</a></h3>
                <h5 class="amber-text">জ্ঞানের আলোয় আলোকিত</h5>
            </div>
        </section>
        <section class="section section-reg deep-blue center">
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <div class="btns">
                            <a href="log-in.php" class="btn  waves-effect blue darken-4">Log in</a></li>
                            <a href="register.php" class="btn  waves-effect waves-light  blue darken-1 white-text">Register</a>
                        </div>
                        <div class="row my-reg">

                            <form action="#" class="col s12 center">
                                <div class="row">
                                    <div class="input-feild col s12 m4">
                                        <input type="text" placeholder="First Name" class="form-control" id="firstName" name="firstName">
                                    </div>
                                    <div class="input-feild col s12 m4">
                                        <input type="text" placeholder="Last Name" class="form-control" id="lastName" name="lastName">
                                    </div>
                                    <div class="input-feild col s12 m4">
                                        <select>
                                            <option value="" disabled selected class="whitish-text">Department</option>
                                            <option value="1">ICT</option>
                                            <option value="2">CSE</option>
                                            <option value="3">Mathematics</option>
                                            <option value="4">Physics</option>
                                            <option value="5">Chemistry</option>
                                            <option value="6">Pharmacy</option>
                                            <option value="7">Law</option>
                                            <option value="8">Marketing</option>
                                            <option value="9">Finance</option>
                                            <option value="10">AIS</option>
                                            <option value="11">Journalism</option>
                                            <option value="12">Public Ad</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-feild col s12 m4">
                                        <input type="email" placeholder="Email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="input-feild col s12 m4">
                                        <input type="password" placeholder="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="input-feild col s12 m4">
                                        <input type="password" placeholder="Confirm password" class="form-control" id="confirmPassword"  name="confirmPassword">
                                    </div>
                                </div>
                                <input type="submit" value="Submit" name="register" class="btn" id="go-btn">
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <?php 
                if (isset($userRegi)) {
                    echo $userRegi;
                }  
            ?>

        </section>

        <footer class=" log-footer navy-blu white-text center">
            <h5 class="white-text">জ্ঞানঘর-কুবি &copy; 2019</h5>
        </footer>
    </div>

    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="materialize/js/materialize.min.js"></script>
    <script>
        //select
        const select = document.querySelectorAll('select');
        M.FormSelect.init(select, {});
    </script>

</body>

</html>