<?php

include 'connect.php';

if (isset($_POST['signUp'])) {
 $name = $_POST['name'];
 $email = $_POST['email'];
 $phone = $_POST['phone'];
 $password = $_POST['password'];
 $password = md5($password);
 $employee = $_POST['role'];

 $checkEmail = "SELECT * from users where email='$email'";
 $result = $conn->query($checkEmail);
 if ($result->num_rows > 0) {
  echo "Email address already exists !";
 } else {
  $insertQuery = "INSERT INTO users(name, email,  phone, password, employee)
  VALUES('$name','$email','$phone','$password','$employee')";
  if ($conn->query($insertQuery) == TRUE) {
   header("location:loginpage.php");
  } else {
   echo "Error:" . $conn->error;
  }
 }
}

if (isset($_POST['signIn'])) {
 // $name = $_POST['name'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $password = md5($password);
 $employee = $_POST['role'];

 $sql = "SELECT * FROM users WHERE  email='$email' AND password='$password' AND employee='$employee'";
 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
  session_start();
  
  $row = $result->fetch_assoc();
  $_SESSION['name'] = $row['name'];
  $_SESSION['email'] = $row['email'];
  $_SESSION['password'] = $row['password'];
  $_SESSION['employee'] = $row['employee'];
 

  // Redirect based on the employee role
  if ($row['employee'] == 'MARKET_MANAGER') {
   header("Location: /dashboard/market_manager.php");
  } elseif ($row['employee'] == 'Agricultural Officer') {
   header("Location: /dashboard/agri_officer_dashboard.php");
  } elseif ($row['employee'] == 's_foodqualityofficer') {
   header("Location: /dashboard/s_foodqualityofficer.php");
  } elseif ($row['employee'] == 's_government_office') {
   header("Location: /dashboard/s_government_office_dashboard.php");
  } elseif ($row['employee'] == 'WARHOUSE_MANAGER') {
   header("Location: /dashboard/s_warhousemanager.php");
  } elseif ($row['employee'] == 'CUSTOMER') {
   header("Location: /dashboard/consumer_db/index.php");
  }
  exit();
 } else {
  echo "Not Found, Incorrect Email, Password, or Employee Role";
 }
 exit();
} else {
 echo "Not Found , Incorrect Email, Password or Employee role";
}

?>php