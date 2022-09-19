<?php
  include("connect.php");

  $name = $_POST['name'];
  $password = $_POST['password'];
  $mobile = $_POST['mobile'];
  $cpassword = $_POST['cpassword'];
  $address = $_POST['address'];
  $image = $_FILES['photo']['name'];
  $tmp_name = $_FILES['photo']['tmp_name'];
  $role = $_POST['role'];

  if($password == $cpassword){

    move_uploaded_file($tmp_name, "../uploads/$image");
    $insert = mysqli_query($connect, "INSERT INTO uservote (name, mobile, address, password, photo, role, status, votes) VALUES ('$name', '$mobile', '$address', '$password', '$image', '$role', 0, 0)");
    if($insert){
        echo '
    <script>
       alert("registration complete");
       window.location = "../";
    </script>
    ';
    }
    else{
        echo '
    <script>
       alert("error");
       window.location = "../routes/registration.html";
    </script>
    ';
    }
  }
  else{
    echo '
    <script>
       alert("invalid");
       window.location = "../routes/registration.html";
    </script>
    ';
  }
?>