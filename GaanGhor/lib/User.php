<?php 

    include_once 'Session.php';
    include 'Database.php';

    class User{
        private $db;
        public function __construct(){
            $this -> db = new Database();
        }

        //registration procedure
        public function userRegistration($data){
            $firstName = $data['firstName'];
            $lastName = $data['lastName'];
            $email = $data['email'];
            $password = $data['password'];
            $confirmPassword = $data['confirmPassword'];

            $chk_email = $this->emailCheck($email);

            if ($firstName == "" OR $lastName == ""OR $email == "" OR $password == ""  OR $confirmPassword == "") {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>Field must not be empty</div>";
                return $msg;
            }

            /*if (strlen($userName) <3 ) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>User name is too short</div>";
                return $msg;
            } else if (preg_match('/[^a-z0-9_-]+/i',$userName) ) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>User name must contain only alphanumerical, dashes and underscores!</div>";
                return $msg;
            }*/

            if (filter_var($email,FILTER_VALIDATE_EMAIL)=== false) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>The email address is not valid!</div>";
                return $msg;
            }

            if ($chk_email == true) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>Email address already Exist!</div>";
                return $msg;
            }

            if(strlen($password) < 6 ) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>Minimum length f password should be 6!</div>";
                return $msg;
            }

            if ($password == $confirmPassword) {
                $password = md5($data['password']); //generates md5 hash..encrypted
                //coz md5 korle password na dileo ekta hash file generate hobe
                $confirmPassword = md5($data['confirmPassword']);
            }

            //storing data after all the validations
            $sql = "INSERT INTO user (firstName, lastName, email, password, confirmPassword) VALUES(:firstName, :lastName, :email, :password, :confirmPassword)";

            $query = $this->db->pdo->prepare($sql);

            $query->bindValue(':firstName', $firstName);
            $query->bindValue(':lastName', $lastName);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', $password);
            $query->bindValue(':confirmPassword', $confirmPassword);
            $result =  $query->execute();
            if ($result) {
                $msg = "<div class='alert alert-success'><strong>Congratulations!! </strong>You have been registered successfully!</div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'><strong>Sorry!! </strong>Registration Failed!</div>";
                return $msg;
            }
        }

        public function emailCheck($email){
            $sql = "SELECT email FROM user WHERE email = :email";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':email', $email);
            $query->execute();
            if ($query->rowCount() > 0 ) {
                return true;
            }else {
                return false;
            }
        }

        //login procedure
        public function getLoginUser($email, $password)
        {
            $sql = "SELECT * FROM user WHERE email = :email AND password = :password LIMIT 1";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':email', $email);
            $query->bindValue(':password', $password);
            $query->execute();
            //fetching object
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }

        public function userLogin($data){
            $email = $data['email'];
            $password = md5($data['password']); //generates md5 hash..encrypted 

            $chk_email = $this->emailCheck($email);

            if ($email == "" OR $password == "") {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>Field must not be empty</div>";
                return $msg;
            }

            if (filter_var($email,FILTER_VALIDATE_EMAIL)=== false) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>The email address is not valid!</div>";
                return $msg;
            }

            if ($chk_email == false) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>Email address not Exist!</div>";
                return $msg;
            }

            $result = $this->getLoginUser($email, $password);  
            if ($result) {
                //assigning data to session.php
                Session::init();
                Session::set("login", true);
                Session::set("id", $result->id);
                Session::set("firstName", $result->firstName);
                Session::set("lastName", $result->lastName);
                Session::set("email", $result->email);
                Session::set("loginMsg", "<div class='alert alert-success'><strong>Success!! </strong>You are Logged In</div>");
                header("Location: index.php");
            } else {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>No such users available</div>";
                return $msg;
            }
        }
/*
        //for update user data
        public function getUserById($userId){
            $sql = "SELECT * FROM user WHERE id = :id LIMIT 1";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':id', $userId);
            $query->execute();
            //fetching object
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        }

        public function updateUserData($userId, $data){
            $firstName = $data['firstName'];
            $lastName = $data['lastName'];
            $email = $data['email'];

            if ($firstName == "" OR $lastName == "" OR $email == "") {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>Field must not be empty</div>";
                return $msg;
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL)=== false) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>The email address is not valid!</div>";
                return $msg;
            }

            //storing data after all the validations
            $sql = "UPDATE user set 
                        firstName = :firstName,
                        lastName = :lastName,
                        email = :email
                        WHERE id = :userId";
            $query = $this->db->pdo->prepare($sql);

            $query->bindValue(':firstName', $firstName);
            $query->bindValue(':lastName', $lastName);
            $query->bindValue(':email', $email);
            $query->bindValue(':userId', $userId);
            $result =  $query->execute();
            if ($result) {
                $msg = "<div class='alert alert-success'><strong>Success!! </strong>User data updated successfully!</div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'><strong>Sorry!! </strong>User Data not updated!</div>";
                return $msg;
            }
        }

        //check password
        private function checkPassword($id, $oldPass) {
            $password = md5($oldPass);

            $sql = "SELECT password FROM user WHERE id = :id AND password = :password";
            $query = $this->db->pdo->prepare($sql);
            $query->bindValue(':id', $id);
            $query->bindValue(':password', $password);
            $query->execute();
            if ($query->rowCount() > 0 ) {
                return true;
            }else {
                return false;
            }

        }

        //update password
        public function updatePassword($id, $data){
            $oldPass = $data['oldPass'];
            $newPass = $data['newPass'];
            $chk_pass = $this->checkPassword($id, $oldPass);

            if ($oldPass == "" OR $newPass == "" ) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>Field must not be empty!</div>";
                return $msg;
            }

            if ($chk_pass == false) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>Old password no matched!</div>";
                return $msg;
            }

            if(strlen($newPass) < 6 ) {
                $msg = "<div class='alert alert-danger'><strong>Error!! </strong>Minimum length f password should be 6!</div>";
                return $msg;
            }

            $password = md5($newPass);

            $sql = "UPDATE user set 
                        password = :password 
                        WHERE id = :id";
            $query = $this->db->pdo->prepare($sql);

            $query->bindValue(':password', $password);
            $query->bindValue(':id', $id);
            $result =  $query->execute();
            if ($result) {
                $msg = "<div class='alert alert-success'><strong>Success!! </strong>Password updated successfully!</div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'><strong>Sorry!! </strong>Password not updated!</div>";
                return $msg;
            }
        } */
    }

?>