<?php
session_start();

require_once 'source/db.php';

if(isset($_POST['signup-btn'])) {

      $username = $_POST['user-name'];
      $email = $_POST['user-email'];
      $password = $_POST['user-pass'];

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
      $SQLInsert = "INSERT INTO Userinfo (username, password, email)
                   VALUES (:username, :password, :email)";

      $statement = $dbh->prepare($SQLInsert);
      $statement->execute(array(':username' => $username, ':password' => $hashed_password, ':email' => $email));

      if($statement->rowCount() == 1) {
        header('location: home.php');
      }
    }
    catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

}

if ($data) { // if the user exists
  if ($data['username'] === $username) {
    echo "This username already exist";
  }

  if ($user['email'] === $email) {
   echo  "This email already exist";
  }
}

?>