<?php
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../includes.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$userContainer = $AdminiAccountPull->get_advertiser($_SESSION["aSessn"]["aSeck"]);
$userContainer = $userContainer[0];
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Timeline');?>
</head>
<body>
    <div class="dash-full-wrapper">
        <div class="container-fluid">
            <div id="post-wrapper">
                <div id="post-wrapper-fader">
                    <div class="row">
                        <aside class="col-sm-12 col-md-3 col-lg-3 col-xl-3 aside">
                            <?php $AdminiUXTemplate->side();?>
                        </aside>
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <h4>Account Owner Details</h4>
                            <hr>
                            <div class="error-display">
                                <?php $UserErrorsPool->error_s("sub_updated","Billing Details Update Successful")?>
                            </div>
                            <?php 
                                if(is_array($userContainer) && !empty($userContainer)){
                                   echo '<div class="tabs settings-tabs">
                                   <div class="tab">
                                       <div class="tab-header">
                                           <div class="wrap-notice">
                                               <i class="fa fa-user"></i>
                                           </div>
                                       </div>
                                       <div class="tab-body">
                                           <h5>
                                               <strong>
                                                   Account Details
                                               </strong>
                                           </h5>
                                            <span> Full Name: '.$userContainer["fname"]." ".$userContainer["sname"].'</span><br>
                                            <span> Internal: '.$userContainer["adr_code"].'</span><br>
                                            <span> Secret Code: '.$userContainer["rand_id"].'</span><br>
                                            <br>
                                            <span>';
                                                if($userContainer["email"]!=0)
                                                        echo "Email Address: ".$userContainer["email"]."<br>";
                                                    else 
                                                        echo "Email Address: Unknown";
                                            '</span>
                                            <br>
                                            <span>';
                                                if($userContainer["adr_mobile"]!=0)
                                                    echo "Mobile Number: ".$userContainer["adr_mobile"];
                                                else 
                                                echo "Mobile Number: Unknown";
                                            '</span>
                                            <br>

                                       </div>
                                   </div>
                               </div>';
                                              
                                }else{
                                    echo '<h5 class="err_products">
                                                <i class="fa fa-robot"></i>
                                                <br>
                                                Sorry, Timeline Information Not Found
                                            </h5>';
                                }
                            ?>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
</body>
</html>

 

