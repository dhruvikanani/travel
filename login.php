
<?php
require('_dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user exists
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Successful login, send email
        mail($email, "Login Successful", "You have logged in successfully.");

        session_start();
        $_SESSION['user_id'] = $user['id'];
        echo "Login successful!";
        header("Location: index.html");
    } else {
        echo "Invalid email or password!";
    }
}

?>



 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    body{
        height: 700px;
        /* background-color:rgb(254, 200, 209); */
        background-color: #009EE2;
        /* background-color:rgb(102, 210, 127); */
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        
    }
   
    .card{
        overflow: hidden;
        border: 0 !important;
        border-radius: 20px !important;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
       height: 550px;
       width: 90%;
    }
    .img-left{
        width: 45%;
        /* background: url(images/im-3.jpeg) center; */
        background: url(img/l1.png) center;
        background-size: cover;
        background-repeat: no-repeat;
    
    }
    .card-body{
        padding: 10px;
    }
    .title{
        margin-bottom: 30px;
    }
    
    .form-input{
        position: relative;
        text-align: center;
    }
     .form-input input{
        width: 70%;
        height: 45px;
        padding-left: 40px;
        margin-bottom: 10px;
        box-sizing: border-box;
        box-shadow: none;
        border: 1px solid #009EE2;
        /* border: 1px solid  #666666;; */
        border-radius: 8px;
        outline: none;
        background: transparent;
        
        
    } 
    .form-input span{
        position: absolute;
        top: 10px;
        padding-left: 15px;
         /* color: #666666; */
         color: #009EE2;
    }
    .form-input input::placeholder{
        color: black;
        padding-left: 0px;
    }
    .form-input input:focus, .form-input input:valid{
        border: 2px solid black;

    }
    .form-input input:focus::placeholder{
        /* color: #3B0000; */
        color: #009EE2;
    }
    .custom-checkbox .custom-control-input:checked ~ .custom-control-lable::before{
        /* background-color: #3B0000 !important; */
        background-color: #009EE2 !important;
        border: 0px;
    }
    .form-box button[type="submit"]{
        margin-top: 10px;
        border: none;
        cursor: pointer;
        border-radius: 8px;
        /* background: #3B0000; */
        background: #009EE2;
        color:white;
        font-size: 90%;
        font-weight: bold;
        letter-spacing: .1rem;
        transition: 0.5s;
        width: 100px;
    }
    .form-box button[type="submit"]:hover{
       background-color:gray;
       color: black;
    }
    .forget-link, .register-link{
       
        color: #666666;
        font-size: 15px;
        /* font-weight: bold; */
        text-decoration: none;
    }
    .forget-link{
        margin-left: 300px; 
        margin-bottom: 20px;
    }
   
    .forget-link:hover, .register-link:hover{
        /* color: #0069d9; */
        color: #0069d9;
    }
    .form-box .btn-facebook {
        background-color: #E7F2F5;
        width: 70px;
        height: 40px;
        color:  #EA4335;
        font-size: 20px;
        font-weight: bold;
    }
    .form-box .btn-twitter {
        background-color: #E7F2F5;
        width: 70px;
        height: 40px;
        color: black;
        font-size: 20px;
        font-weight: bold;
    }
    
    .form-box .btn-google {
        background-color: #E7F2F5;
        width: 70px;
        height: 40px;
        color: #0069d9;
        font-size: 20px;
        font-weight: bold;
    }
    .form-box .btn-facebook:hover {
        /* background-color:rgb(243, 200, 200); */
        background-color: #009EE2;

       
    }
    .form-box .btn-google:hover {
        /* background-color:rgb(243, 200, 200) ; */
        background-color: #009EE2;

    }
    .form-box .btn-twitter:hover {
        /* background-color:rgb(243, 200, 200); */
        background-color: #009EE2;

    }
   #btn{
     margin-left: 60px;
    width: 70%;
    margin-bottom: 10px;
   }
   #demo{
    background-image: url('img/02_travel_login_page.png');
    background-repeat:no-repeat;
    background-size: cover;
    background-position: bottom;

   }
   @media(max-width:1200px){
    .forget-link{
        margin-left: 100px;
    }
   }
   @media(max-width:540px){
    #btn{
        margin-left: 40px;
    }
   }
   @media(max-width:500px){
    
    #btn{
        margin-left:10px;
        width: 100%;
    }
    .form-box .btn-facebook{
        margin-right: 10px;
    }
   }
   @media(max-width:445px){
    .form-box .btn-facebook{
        margin-right: 10px;
        width: 40px;
    }
    .form-box .btn-twitter{
        margin-right: 100px;
        width: 40px;
    }
    .form-box .btn-google{
        margin-right: 10px;
        width: 40px;
    }
    .forget-link{
        margin-left: 34px;
    }
    .form-input input{
        width: 90%;
   }
}
</style> 

</head>
<body>
    <div class="container">
        <div class="row px-3"  >
            <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0" id="demo" >
                <div class="img-left d-none d-md-flex"></div>
                <div class="card-body">
                    <h1 class="title text-center mt-4 " style="font-weight: bold; color: #009EE2;">
                        Welcome
                    </h1>
                    <p class="text-center" style="margin-top: -30px; color: #666666;">Login with Email</p>
                    <form class="form-box px-3" method="POST">
                        <div class="form-input">
                            <span><i class=" fa fa-thin fa-envelope"></i></span>
                            <input type="email" name="email"  placeholder="Email Address"
                         required>
                        </div>
                        <div class="form-input">
                            <span><i class="fa fa-key"></i></span>
                            <input type="password" name="password" placeholder="Email password"
                         required>
                        </div>
                        <div class="mb-3">
                            <div class="custom-control custom-checkbox">
                                <div class="text-right">
                                    <a href="forget_password.php" class="forget-link">Forget Password?</a>
                                   </div>
                                 <!-- <input type="checkbox" class="custom-control-input"
                                id="cb1" name=""> -->
                                <!-- <label class="custom-control-lable" for="cb1">
                                Remeber me </label>  -->
                            </div>
                        </div>
                        <div class="mb-3 text-center" >
                         <input type="submit" name="submit" value="submit" class="btn btn-block text-uppercase"
                             style="margin-top: 10px;
        border: none;
        cursor: pointer;
        border-radius: 8px;
         background: #009EE2;
        color:white;
        font-size: 90%;
        /* font-weight: bold; */
        letter-spacing: .1rem;
        transition: 0.5s;
        width: 100px;">
                              
                    
                        </div>
                       <!-- <div class="text-right">
                        <a href="#" class="forget-link">Forget Password?</a>
                       </div>  -->
                       <div class="text-center mb-3">
                        or Login with<hr>
                       </div>
                       <div class="row" id="btn">
                        <div class="col-4" >
                            <a href="#" class="btn btn-block btn-social btn-facebook">
                                <i class="fa-brands fa-google"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="btn btn-block btn-social btn-google">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        </div>
                        <div class="col-4">
                            <a href="#" class="btn btn-block btn-social btn-twitter">
                                <i class="fa-brands fa-apple"></i>
                            </a>
                        </div>
                       </div>
                
                <div class="text-center ">
                    Don't have an account ?
                    <a href="register.php" class="register-link" style="margin-right: 23px;">Register here</a>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 


