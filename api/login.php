<?php
  session_start();
  include("connect.php");

  $mobile = $_POST['mobile'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  $check = mysqli_query($connect, "SELECT * FROM uservote WHERE mobile='$mobile' AND password='$password'  AND role='$role' ");

  if(mysqli_num_rows($check) > 0){

    $userdata = mysqli_fetch_array($check);
    $_SESSION['userdata'] = $userdata;

    $groups = mysqli_query($connect, "SELECT * FROM uservote WHERE role=2");
    // $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    if(mysqli_num_rows($groups)>0){
      $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
      $_SESSION['groupsdata'] = $groupsdata;
  }

    $_SESSION['userdata'] = $userdata;
    // $_SESSION['groupsdata'] = $groupsdata;

    echo '
    <script>
       window.location = "../routes/dashboard.php";
    </script>
    ';
  }
  else{
    echo '
    <script>
       alert("Invalid credentials or user not found");
       window.location = "../";
    </script>
    ';
  }


?>