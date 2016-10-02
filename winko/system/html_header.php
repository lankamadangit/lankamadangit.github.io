<html>
<head>
<title><?=$title?></title>
<?if($v=="eng") {?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<link rel=StyleSheet HREF="winko/system/css/winko_eng.css" type=text/css title=style>
<?}elseif($v=="jp") {?>
<meta http-equiv="content-type" content="text/html;charset=x-sjis">
<link REL="STYLESHEET" HREF="winko/system/css/winko_jp.css" TYPE="text/css">
<?}elseif($v=="cn") {?>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<link rel=StyleSheet HREF="winko/system/css/winko_cn.css" type=text/css title=style>
<?}else{ ?>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<link rel=StyleSheet HREF="winko/system/css/winko.css" type=text/css title=style>
<?}?>
<script language="JavaScript" type="text/javascript" src="/alditor/alditor.js"></script>
</head>

<? require_once $_SERVER["DOCUMENT_ROOT"]."/fckeditor/fckeditor.php"; ?>
<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red">
<table cellpadding="0" cellspacing="0" width="770">
    <tr>
        <td>
<!-- {{ Top -->
<?
if($v) include ("./menu/{$v}/TOP.php");
else include ("./menu/kr/TOP.php");
?>
<!-- Top }} -->
        </td>
    </tr>
    <tr>
        <td>
<!-- {{ Menu -->
<?
if($v) include ("./menu/{$v}/MAIN_MENU.php");
else include ("./menu/kr/MAIN_MENU.php");
?>
<!-- Menu }} -->
        </td>
    </tr>
    <tr>
        <td>
<!-- {{ Body -->
<?
include $skin_folder."/head.php";
?>
