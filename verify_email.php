<?php 
   include_once "./includes.php";
   $oWorldLocations = $UserAccountPull->get_world_locations();
    if(!is_array($oWorldLocations) || empty($oWorldLocations['countries']) || empty($oWorldLocations['districts']) || empty($oWorldLocations['states'])){
        header("Location:index?worldlocations_pop_join");
    }
    $s_email = null;
    $s_code = null;
    if(isset($_GET["s_email"]) && isset($_GET["s_code"])){
        if(empty($_GET["s_email"]) || empty($_GET["s_code"])){
            echo "headerlocation:index?err_auth_email_empty";
        } else {
            $s_email = $_GET["s_email"];
            $s_code = $_GET["s_code"];
        }
    }else header("location:index?err_auth_email_unset");
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <?php $UXviewTemplate->headers();?>
    <link rel="stylesheet" href="./libraries/auth/intl-tel-input-master/build/css/intlTelInput.css">
    <link rel="stylesheet" href="./libraries/auth/intl-tel-input-master/build/css/demo.css">
    <style>
        .top-nav-2 .top-nav-split
        {
            background-color: white;
        }
        body 
        {
            padding: 0;
            margin:0;
            outline: 0; 
            background: url("./assets/1.jpg");
            background-position: top;
            background-repeat: no-repeat;
            box-sizing:cover;
            width: 100%;
        }
        .signup-main 
        {
            height: 100vh;
            overflow-y: hidden;
        }
        @media screen and (max-width: 768px){ 
            .signup-main 
            {
                height: auto;
                overflow-y: scroll;
            }
        }
    </style>
</head>
    <body style="margin:0;padding:0;">
        <main class="signup-main">
            <div class="container" style="padding-bottom:20%;">
                <div class="row justify-content-space-between tabs">
                    <div class="GospelText col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 my-3 my-*-0">
                        <h4>Email Verification.</h4>
                        <b><img src="./assets/favicon.png" class="form-icon" alt="favicon"></b>
                        <hr>
                        <p>
                            It's made simple... <br>
                            Create Quickly ..... <br>
                            Immediately Share ..... <br>
                            Immediately Review ..... <br>
                            Instantly Backed up Projects ..... <br>
                            Collect All Quickly ..... <br>
                        </p>
                        <h4>Supreme Than All Other Options</h4>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-6 col-xl-6 my-3 my-*-0">
                        <div class="form-wrap shadow">
                            <form action="./middleware/admini/handleAccounts/mw_auth_email_confirm?s_email=<?php echo $s_email;?>&&s_code=<?php echo $s_code;?>" method="POST" enctype="multipart/form-data">
                                <div class="form-intro">
                                    <b><img src="./assets/favicon.png" class="form-icon" alt="favicon"></b>
                                    <div class="error-display">
                                        <?php $UserErrorsPool->error("unset","OTP or Email Was Not Set")?>
                                        <?php $UserErrorsPool->error("empty","OTP or Email Was Empty")?>
                                        <?php $UserErrorsPool->error("email_unexist","Email Address Does Not Exist")?>
                                        <?php $UserErrorsPool->error("otp_fetch_fail","Code Confirmation Failed")?>
                                        <?php $UserErrorsPool->error("err_rand_exist","Replicated Hash Code, Try Again")?>
                                        <?php $UserErrorsPool->error("err_unexist","Account Does Not Exist")?>
                                        <?php $UserErrorsPool->error("err_login","Login Failed, Try Again")?>
                                        <?php $UserErrorsPool->error("failed","Failed To Verify Eamil Address")?>
                                        <?php $UserErrorsPool->error("suspicious","Unexpected Interruption, Sign In")?>
                                        <?php $UserErrorsPool->error("limitedRetries","Retry limit exceeded, Sign In To Continue")?>
                                        <?php $UserErrorsPool->error("err_reset","Reset Your Password From Link In Your Email")?>
                                        <?php $UserErrorsPool->error("closed","Account Officially Closed")?>
                                        <?php $UserErrorsPool->error("deleted","Account Officially Deleted")?>
                                        <?php $UserErrorsPool->error("unverified","Account Unverified.Verify Your Account By Clicking Forgot Password")?>
                                        <?php $UserErrorsPool->error_s("success","Email Successfully Verified <a href='index' class='btn btn-primary btn-sm'>Login</a>")?>
                                        
                                    </div>
                                </div>
                                <input type="email" id="email" 
                                            name="email" 
                                            class="form-control" 
                                            value="<?php echo $s_email; ?>"
                                            require
                                            placeholder="Enter Email Address">
                                <div class="password-wrap">
                                    <i class="fa fa-eye" id="p-eye"></i>
                                    <input type="password" 
                                            id="password" 
                                            placeholder="Enter Code" 
                                            value="<?php echo $s_code; ?>"
                                            class="form-control" 
                                            name="password" 
                                                    required>
                                </div>
                                <br>
                                <div class="reset-menu"></div>
                                <button type="submit" id="submit" 
                                    class="btn btn-sm form-control" 
                                        style="background-color: orange;
                                                color:white;">
                                                <strong style="color:white;">
                                                    Verify Email
                                                </strong>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php $UXviewTemplate->headers_footer();?>
    <script src="./libraries/auth/intl-tel-input-master/build/js/intlTelInput.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(function(){
            $("#p-eye").click(function(){
                if(!$("#password").val()==''){
                    var input = document.getElementById('password');
                    if(input.type==="password"){
                        input.type = "text";
                        if($("#p-eye").hasClass("fa-eye")){
                            $("#p-eye").removeClass("fa-eye");
                            $("#p-eye").addClass("fa-eye-slash");
                        }
                        else{$("#p-eye").addClass("fa-eye");}
                    }
                    else 
                    {
                        if($("#p-eye").hasClass("fa-eye-slash")){
                                $("#p-eye").removeClass("fa-eye-slash");
                                $("#p-eye").addClass("fa-eye");
                                input.type = "password";
                        }else {$("#p-eye").addClass("fa-eye");}
                    }
                }else{
                    $(".error-display").show(200,function(){
                        $(".error-display").html("<h6 class='e-notice'>The Password Field is Empty</h6>");
                    });
                    passwordEmptyHide = setTimeout(() => {
                        $(".error-display").hide(200);
                        clearTimeout(passwordEmptyHide);
                    },3000);
                }
            });
        });
    </script>
    </body>
</html>