
<html>
   
   <head>
      <style>
         .login{
            width:280px;
            position:absolute;
            top:30%;
            left:50%;
            transform:translate(-50%,-30%);
            
         }
         .login h1{
            float:left;
            font-size:40px;
            border-bottom:6px solid rgb(11, 177, 214);;
            margin-bottom:40px;
            padding:13px 0;
            color:grey;

         }
         .textbox{
            width:100%;
            overflow:hidden;
            font-size:20px;
            padding:8px 0;
            margin:2.5rem  0;
            border-bottom: 1px solid rgb(11, 177, 214);
            color: #fff;
         }
         .textbox img{
            width:2rem;
            height:2rem;
            float:left;
            color:blue;
         }
         .textbox input{
            border:none;
            outline:none;
            background:none;
            font-size:18px;
            width:80%;
            float:left;
            margin: 0 10px;
            color:black;
         }
         .btnn{
            width:100%;
            background:none;
            border:2px solid rgb(11, 177, 214);
            color:black;
            padding:5px;
            font-size:18px;
            cursor:pointer;
            margin: 2rem 0;
            padding:.5rem 0;
         }
         /* .btnn:hover{
            background:blue;
            color:black;
         } */
         body{
            background: url("bg5.jpg") no-repeat;
            background-position: center;
            background-size:cover;
            
         }
         .legend{
            position:absolute;
            bottom:10%;
            left:50%;
            transform: translate(-50%,-10%);
            font-size:2rem;
         }
         h2{
            color:grey;
         }
      </style>
   </head>
   
   <body>
   <div class="login">
    <h1>Login</h1>
    <form method="POST" action="">
      <div class="textbox">
      <img src="user.svg" alt="">
      <input type="text"  autocomplete="off" placeholder="username" name="username">
      
         
      </div>
      <div class="textbox">
         <img src="password.svg" alt="">
         <input type="password" placeholder="password" name="password">
      </div>
      <input class="btnn" name="submit" type="submit" value="Login">
    </form>
  </div>
  <div class="legend">
         <h2>Bienvenue</h2>
  </div>

   </body>
</html>

<?php
   include('config/connect_db.php');

   if(isset($_POST['submit'])){

      $uname = mysqli_real_escape_string($conn,$_POST['username']);
      $password = mysqli_real_escape_string($conn,$_POST['password']);
  
      if ($uname != "" && $password != ""){
  
          $sql_query = "select count(*) as cntUser from users where username='".$uname."' and passcode='".$password."'";
          $result = mysqli_query($conn,$sql_query);
          $row = mysqli_fetch_array($result);
  
          $count = $row['cntUser'];
  
          if($count > 0){
              $_SESSION['uname'] = $uname;
              header('Location: annonce.php');
          }else{
              echo "Invalid username and password";
          }
  
      }
  
  } 
?>