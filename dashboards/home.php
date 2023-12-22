<?php 
session_start();
ini_set("zlib.output_compression", 9);
header("Cache-Control: private,no-cache,must-revalidate,must-understand,immutable,max-age=3600,stale-if-error=3600");
include_once "../includes.php";
$AdminiSessionPush->access_permission();
$AdministratorActivity->register_activity();
$Utility->broadcast_timezone();
$current_user = $_SESSION["aSessn"]["aSeck"];
$notifications = $ProductPull->notifications($current_user);
$pieChart = $GraphSimulator->pieChart($current_user);
?>
<!DOCTYPE html>
<html>
<head>
    <?php $AdminiUXTemplate->headers('Home');?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>
<body>
    <div class="dash-full-wrapper">
        <div class="container-fluid">
            <div id="post-wrapper">
                <div id="post-wrapper-fader">
                    <div class="row">
                        <aside class="col-sm-12 col-md-3 col-lg-3 col-xl-3 aside">
                            <?php $AdminiUXTemplate->side($notifications);?>
                        </aside>
                        <section class="col-sm-12 col-md-9 col-lg-9 col-xl-9 section">
                            <?php $AdminiUXTemplate->nav();?>
                            <div>
                                <?php $UserErrorsPool->error("err_gallery_key","Gallery Requested To Display Is Not Recognized");?>
                                <?php $UserErrorsPool->error("err_pjr_key","Project Requested To Display Is Not Recognized");?>
                                <?php $UserErrorsPool->error("err_pjr_int","Project Id is not interger");?>
                                <?php $UserErrorsPool->error("err_pjr","Project Identifier Is Not Set");?>
                                <?php $UserErrorsPool->error("err_pipe","Project Creator Is Not Found");?>
                                <?php $UserErrorsPool->error("err_pjr_empty","Project Container Not Found");?>
                                <?php $UserErrorsPool->error("err_empty_rinvite","Invitations Not Found");?>
                            </div>
                            <div class="tabs">
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-snowflake"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Initialize Project</strong></h5>
                                        <p>Initialize your project.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="start"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-snowflake"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Created Projects</strong></h5>
                                        <p>Initialized project, all.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="projects"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                            </div>
                            <div>
                                <section class="project-bars">
                                    <canvas class="bar-1" id="bar-1"></canvas>
                                    <canvas class="bar-2" id="bar-2"></canvas>
                                </section>
                            </div>
                            <div class="tabs">
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-gear"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Account</strong></h5>
                                        <p>Account Settings.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="settings"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                                <div class="tab">
                                    <div class="tab-header">
                                        <div class="wrap-notice">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="tab-body">
                                        <h5><strong>Discussed Projects</strong></h5>
                                        <p>View your discusssed and shared projects.</p>
                                    </div>
                                    <footer class="tab-footer">
                                        <a href="discussed"><i class="fa fa-arrow-right"></i></a>
                                    </footer>
                                </div>
                            </div>
                        </section>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $AdminiUXTemplate->headers_bottom();?>
    <script>
          var projectTaggs = ["All Others", "Mine"];
        var projectValues = [<?php echo json_encode($pieChart["otherProjects"]); ?>,
                            <?php echo json_encode($pieChart["mineProjects"]); ?>];
        var projectColors = ["#691438","#000e31"];
        new Chart("bar-1", {
        type: "doughnut",
        data: {
            labels: projectTaggs,
            datasets: [{
            backgroundColor: projectColors,
            data: projectValues
            }]
        },
        options: {
            title: {
            display: true,
            text: "Projects Initialization"
            }
        }
        });

        var activityTaggs = ["Users", "Current"];
        var activityValues = [
                                <?php echo json_encode($pieChart["otherActivity"]); ?>,
                                <?php echo json_encode($pieChart["mineActivity"]); ?>
                            ];
        var activityColors = ["#691438","#000e31"];
        new Chart("bar-2", {
        type: "doughnut",
        data: {
            labels: activityTaggs,
            datasets: [{
            backgroundColor: activityColors,
            data: activityValues
            }]
        },
        options: {
            title: {
            display: true,
            text: "System Usage"
            }
        }
        });
    </script>
</body>
</html>

