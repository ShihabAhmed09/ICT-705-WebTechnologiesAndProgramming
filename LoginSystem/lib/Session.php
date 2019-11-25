<?php 

    class Session{
        //works while login
        public static function init(Type $var = null) //init->initialization
        {
            //for lower version of 5.4.0
            if (version_compare(phpversion(), '5.4.0', '<')) {
                if (session_id() == '') {
                    session_start();
                }
            }
            else {
                //for upper version of 5.4.0
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
            }
        }

        public static function set($key, $val)
        {
            $_SESSION[$key] = $val;
        }

        public static function get($key)
        {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            } else {
                return false;
            }
        }

        public static function checkSession()
        {
            if (self::get("login") == false) {
                self::destroy();
                header("Location: login.php");
            }
        }

        public static function checkLogin()
        {
            if (self::get("login") == true) {
                header("Location: profile.php");
            }
        }

        //for logout
        public static function destroy()
        {
            session_destroy();
            session_unset();
            header("Location: login.php");
        }
    }

?>