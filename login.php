<?php

require_once 'source/session.php';
require_once 'source/db.php';

if(isset($_POST['login-btn'])) {

    $user = $_POST['user-name'];
    $password = $_POST['user-pass'];

    try {
      $SQLQuery = "SELECT * FROM Userinfo WHERE username = :username";
      $statement = $dbh->prepare($SQLQuery);
      $statement->execute(array(':username' => $user));

      while($row = $statement->fetch()) {
        $id = $row['Id'];
        $hashed_password = $row['password'];
        $username = $row['username'];

        if(password_verify($password, $hashed_password)) {
          $_SESSION['id'] = $id;
          $_SESSION['username'] = $username;
          header('location: dashboard.php');
        }
        else {
          echo "Error: Invalid username or password";
        }
      }
    }
    catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

}

?>