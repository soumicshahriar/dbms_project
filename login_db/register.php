<?php

include 'connect.php';

if(isset($_POST['signUp'])){
 $name =$_POST['name'];
 $email =$_POST['email'];
 $phone=$_POST['phone'];
 $password =$_POST['password'];
 $password=md5($password);
 $employee=$_POST['role'];

 $checkEmail ="SELECT * from users where email='$email'";
 $result = $conn->query($checkEmail);
 if($result->num_rows>0){
  echo "Email address already exists !";

 }
 else{
  $insertQuery="INSERT INTO users(name, email,  phone, password, employee)
  VALUES('$name','$email','$phone','$password','$employee')";
  if($conn->query($insertQuery)==TRUE){
   header("location:loginpage.php");
  }
  else{
   echo "Error:".$conn->error;
  }

 }


}

if(isset($_POST['signIn'])){
 $email= $_POST['email'];
 $password=$_POST['password'];
 $password=md5($password);
 $employee=$_POST['role'];

 $sql="SELECT * FROM users where email='$email' and password='$password' and employee='$employee' ";
 $result = $conn->query($sql);
 if($result->num_rows>0){
  session_start();
  $row=$result->fetch_assoc();
  $_SESSION['email']=$row['email'];
  $_SESSION['password']=$row['password'];
  $_SESSION['employee']=$row['employee'];

  header("location:/dashboard/market_manager.php");
  header("location:/dashboard/agri_officer_dashboard.php");
  header("location:/dashboard/s_foodqualityofficer.php");
  header("location:/dashboard/s_government_office_dashboard.php");
  header("location:/dashboard/s_warhousemanager.php");
  header("location:/dashboard/customer_dashboard.php");
  exit();
 }
 else{
  echo "Not Found , Incorrect Email, Password or Employee role";
 }
}

?>