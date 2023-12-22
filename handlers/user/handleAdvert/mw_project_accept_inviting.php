<?php 
session_start();
require_once ('../../../includes.php');
$o = [];
$o['inv_id'] = $_GET["inv"];
$params = "../../../dashboards/inviting?sync";

if($ProductDelete->invite($o))
    header("location:".$params."&&denied");
else 
    header("location:".$params."&&deny_failed");
?>