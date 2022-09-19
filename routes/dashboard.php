<?php
   session_start();
   if(!isset($_SESSION['userdata'])){
      header("location: ../");
   }

   $userdata = $_SESSION['userdata'];
   $groupsdata = $_SESSION['groupsdata'];

   if($_SESSION['userdata']['status']==0){
    $status = '<b style="color:red"> Not Voted </b>';
   }
   else{
    $status = '<b style="color:green"> Voted </b>';
   }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="/css/style1.css"> -->
    <title>Online Voting System - Dashboard</title>
    <style>

        body{
            margin: 0;
            padding: 0;
            font-family: cursive;
            background: lightcyan;
        }
        #headerSection h1{
           font-family: cursive;
           text-align: center;
        }

        #headerSection {
            padding-bottom: 5px;
            background: #fecd45;
            padding: 10px;
        }

        #headerSection a button{
            font-family: cursive;
        }
        
        
        #logout-button{
            float: right;
            background: #fecd45;
            color:black;
            padding: 6px;
            border-radius: 25px;
            width: 125px;
            border: none;
            outline: none;
            font-size:medium;
        }

        #backbtn{
         background: #fecd45;
         color:black;
         padding: 6px;
         border-radius: 25px;
         width: 125px;
         border: none;
         outline: none;
         font-size:medium;
        }
        
        #backbtn:hover{
            background-color: blue;
            color:white;
        }
        
        #logout-button:hover{
            background-color: blue;
            color:white;
        }
        

        #profile{
            position: relative;
            top: 15px;
            left: 10px;
            border: 1px solid black;
            border-radius: 12px;
            width: 30%;
            float: left;
            background: white;
        }

        #profile b{
            position: relative;
            left: 17px;
        }

        #profile img{
            position: relative;
            top: 15px;
        }

        #group{
            position: relative;
            top: 15px;
            border: 1px solid black;
            border-radius: 12px;
            width: 60%;
            /* height: 500px; */
            padding: 20px;
            float: right;
            background: white;
        }

        #votebtn{
         background: blue;
         color:white;
         padding: 6px;
         border-radius: 25px;
         width: 70px;
         font-size: small;
         border: none;
        }

        #votebtn:hover{
            background-color: #00FF00;
            color: white;
        }

        #voted{
         background: green;
         color:white;
         padding: 6px;
         border-radius: 25px;
         width: 70px;
         font-size: small;
         border: none;
        }

        .mainpanel{
            padding: 10px;
            height: 550px;
            /* background: red; */
        }

        .extra-btn{
            margin-right: 10px;
        }

    </style>
</head>
<body>
    <div id="mainSection">
        <div id="headerSection">
            <a href="../" ><button  id="backbtn" > Back</button></a>
            <a href="logout.php"><button id="logout-button" > Logout</button></a>
            <a href="https://en.wikipedia.org/wiki/Elections_in_India" ><button  class="extra-btn" id="backbtn" style="float: right;"> Info</button></a>
            <a href="https://right2vote.in/" ><button  class="extra-btn" id="backbtn" style="float: right;"> About</button></a>
            <a href="../routes/dashboard.php" ><button  class="extra-btn" id="backbtn" style="float: right;"> Home</button></a>
        </div>
        <div style="text-align:center;  background-color: #7f64c1; color: white; width:100%; height: 80px; padding-top:2px; padding-bottom:2px;">
            
            <h1>Online Voting System</h1>
           
        </div>

            <div class="mainpanel">

              <div id="profile">
                  <center> <img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100" ><br><br> </center>
                  <b>Name:  &nbsp; </b> <?php echo $userdata['name'] ?> <br><br>
                  <b>Mobile:  &nbsp; </b> <?php echo $userdata['mobile'] ?> <br><br>
                  <b>Address:  &nbsp; </b> <?php echo $userdata['address'] ?> <br><br>
                  <b>Status:   </b> <?php echo $status ?> <br><br>
              </div>
      
              <div id="group">
                  <?php
                     if($_SESSION['groupsdata']){
                      for($i=0; $i<count($groupsdata); $i++){
                          ?>
                             <div>
                               <img style="float: right;" src="../uploads/<?php echo $groupsdata[$i]['photo']  ?> " height="80" width="80" >
                               <b>Group Name: </b> <?php echo $groupsdata[$i]['name']  ?> <br><br>
                               <b>Votes: </b> <?php echo $groupsdata[$i]['votes']  ?> <br><br>
                               <form action="../api/vote.php" method="POST">
                                  <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                                  <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                                  <?php
                                  if($_SESSION['userdata']['status']==0){
                                    ?>
                                       <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                    <?php
                                  }
                                  else{
                                    ?>
                                       <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>
                                    <?php
                                  }
                                  ?>
                               </form>
                             </div>
                             <hr>
                          <?php
                         }
                     }
                     else{
                        ?>
                        <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px">
                            <b>No groups available right now.</b>    
                        </div>
                    <?php
  
                    }
                  ?>
              </div>
          </div>

    </div>
</body>
</html>