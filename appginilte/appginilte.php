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

function homeLinkInfoBox_1($title, $count, $link, $icon = "far fa-envelope", $color = "info", $sizeclass = "col-md-3 col-sm-6 col-12", $icontype = "default", $appginiIcon)
{
	$show_icon = ($icontype == 'default') ? '<i> <img src="' . $appginiIcon . '"></i>' : '<i class="' . $icon . '"></i>';
	$html = '<div class="' . $sizeclass . '">
	<div class="info-box">
	  <span class="info-box-icon bg-' . $color . '">' . $show_icon . '</span>
	  <div class="info-box-content">
		<span class="info-box-text"><a href="' . $link . '" style="text-decoration:none;color:black"><b>' . $title . '</b></a></span>
		<span class="info-box-number">' . number_format($count) . '</span>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	</div>';
	return $html;
}
function homeLinkInfoBox_2($title, $count, $link, $icon = "far fa-envelope", $color = "info", $sizeclass = "col-md-3 col-sm-6 col-12", $icontype = "default", $appginiIcon)
{
	$show_icon = ($icontype == 'default') ? '<i> <img src="' . $appginiIcon . '"></i>' : '<i class="' . $icon . '"></i>';
	$html = '<div class="' . $sizeclass . '">
	<div class="info-box bg-' . $color . '">
	  <span class="info-box-icon">' . $show_icon . '</span>
	  <div class="info-box-content">
		<span class="info-box-text"><a href="' . $link . '" style="text-decoration:none;color:black"><b>' . $title . '</b></a></span>
		<span class="info-box-number">' . number_format($count) . '</span>
	  </div>
	  <!-- /.info-box-content -->
	</div>
	</div>';
	return $html;
}
function homeLinkInfoBox_3($title, $count, $link, $icon = "far fa-envelope", $color = "info", $sizeclass = "col-md-3 col-sm-6 col-12", $icontype = "default", $appginiIcon)
{
	$show_icon = ($icontype == 'default') ? '<i> <img src="' . $appginiIcon . '"></i>' : '<i class="' . $icon . '"></i>';
	$html = '<div class="' . $sizeclass . '">
	<!-- small card -->
	<div class="small-box bg-' . $color . '">
	  <div class="inner">
		<h3>' . number_format($count) . '</h3>
		<p>' . $title . '</p>
	  </div>
	  <div class="icon">
	  ' . $show_icon . '
	  </div>
	  <a href="' . $link . '" class="small-box-footer">
		More info <i class="fas fa-arrow-circle-right"></i>
	  </a>
	</div>
  </div>';
	return $html;
}
