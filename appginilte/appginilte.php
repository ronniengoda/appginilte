<?php 
@include("{$currDir}/hooks/links-home.php");
if (!defined('PREPEND_PATH')) define('PREPEND_PATH', '');
if (!defined('datalist_db_encoding')) define('datalist_db_encoding', 'UTF-8');
#Redirect guest users to login page
$currentuser = getLoggedMemberID();
if ($currentuser == "guest") {
	redirect("index.php?signIn=1");
}

#Variables that will be handy
$info = getMemberInfo();
$username = $info['username'];
$email = $info['email'];
$group = $info['group'];
$groupID = $info['groupID'];
$custom1 = $info['custom']['0'];
$custom2 = $info['custom']['1'];
$custom3 = $info['custom']['2'];
$custom4 = $info['custom']['3'];
?>