<?php
@include_once "langdoc.php";
if(!isset($_COOKIE['lang'])) {
	setcookie("lang","ru",2147485547);
	$lang = "ru";
} else $lang = $_COOKIE["lang"];
$sitename = "SuperKyza";
$title = "$sitename";
@include_once('set.php');
require('steamauth/steamauth.php');
	if(isset($_SESSION["steamid"])) {
include_once('steamauth/userInfo.php');}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>SuperKyza</title>
	<link href="styles/style.css" type="text/css" rel="stylesheet" />
</head>
<body>
	<div class="header">
	<div class="logo"></div>
	
	<ul class="topmenu">
	<li><a href="index.php">Начать игру</a></li>
	<li><a href="about.php">О сайте</a></li>
	<li><a href="nastroyki.php">Настройки</a></li>
	<li><a href="top.php">Топ игроков</a></li>
	<li><a href="istoria.php">История</a></li>
	<li><a href="bonus.php">Бонус</a></li>			
	</ul>
		<a href=""><div class="buttomstop"><div class="steamico"></div><?php
				if(!isset($_SESSION["steamid"])) {
					steamlogin();
					echo "<a class=\"btn\" href=\"?login\">".$msg[$lang]["login2"]."</a>";
				} else {
					echo "<a class=\"btn\" href=\"steamauth/logout.php\">".$msg[$lang]["logout"]."</a>";
					mysql_query("UPDATE users SET name='".$steamprofile['personaname']."', avatar='".$steamprofile['avatarfull']."' WHERE steamid='".$_SESSION["steamid"]."'");
				}
				?></div></a>
	<a href=""><div class="twitter"></div></a>
	<a href=""><div class="vk"></div></a>
	</div>
<div class="center">
<div class="sidebar">
	<div class="sidebarblock">
	<img src="images/key.png">
	<p>Пригласи трех друзей на наш сайт и получи шанс победы <span class="yellow">+3%</span></p>
	<a href="bonus.php"><div class="buttom">Подробнее</div></a>
	</div>

	<div class="sidebarblock">
	<img src="images/podarok.png">
	<p>Добавь в свой ник Steam: SuperKyza.ru и получи шанс к победе <span class="yellow">+5%</span></p>
	<a href="bonus.php"><div class="buttom">Подробнее</div></a>
	</div>

	<?php 
							$lastgame = fetchinfo("value","info","name","current_game");
							$lastwinner = fetchinfo("userid","games","id",$lastgame-1);
							$winnercost = round(fetchinfo("cost","games","id",$lastgame-1),2);
							$winnerpercent = fetchinfo("percent","games","id",$lastgame-1);
							$winneravatar = fetchinfo("avatar","users","steamid",$lastwinner);
							$winnername = fetchinfo("name","users","steamid",$lastwinner);
						{?>
   <?} echo'
	<div class="sidebarblock" style="margin-bottom:0px;height:180px;">
	<img style="width:150px;height:150px;" src="'.$winneravatar.'">
	<p><br><span class="yellow">'.$winnername.'</span></p>
	</div>
	<div class="bottomblock" style=border-top:none;>
		<span class="bluegrey">Выигрыш:</span> <span class="txtbluegrey"> '.$winnercost.'</span><br>
		<span class="bluegrey" style="margin-top:8px;">Шанс победы:</span> <span class="txtbluegrey" style="margin-top:8px;">'.$winnerpercent.'</span>
	</div>' ?>


	<div class="bottomblock" style="margin-top:20px;  height: 25px;">
		<img src="images/profile.png"><span style="color: #7E8294;">Нас на сайте:</span> 600 человек

	</div>
<a href="#" title="Техническая поддержка" style=" margin-left: 55px; " >Техническая поддержка</a>

</div>


	<div class="contentblock" style="height:300px;">
	<form method="POST" action="./updatelink.php">
		<div class="titleblock">Ссылка на обмен</div>


<div style=" padding: 15px; background: #252629; float: left; margin-left: -20px; margin-top: 15px; "><img src="images/steamsico.png"></div>
<input type="text" name="link" style=" padding: 20px; background: #252629; border: none; color: #5D6169; width: 400px; margin-top: 15px; height: 25px; font-size: 14px; margin-left: -15px;" value="Вставьте сюда ссылку на обмен в Steam:"/>
	
	<div style=" line-height: 60px; "><img style=" margin-top: 10px; margin-right: 10px; float: left; " src="images/ico01.png"><a href="http://steamcommunity.com/id/id/tradeoffers/privacy#trade_offer_access_url" style=" text-decoration: underline; color: #92959D; ">Где взять ссылку?</a></div>

<div style=" line-height: 60px; color: #92959D; "><img style=" margin-top: 10px; margin-right: 10px; float: left; " src="images/ico02.png">Обязательно <a href="http://steamcommunity.com/id/id/edit/settings" target="_blank" class="">откройте инвентарь</a> Steam, для получения приза!</div>


<a href=""><input type="submit" class="buttom" style="text-align:center;float: left;margin-left: 300px;">Сохранить</div></a>
</div>


	<div class="contentblock" style="height:220px;">
		<div class="titleblock">E-mail адрес</div>

<div style=" padding: 15px; background: #252629; float: left; margin-left: -20px; margin-top: 15px; "><img src="images/icomail.png"></div>
<input style=" padding: 20px; background: #252629; border: none; color: #5D6169; width: 400px; margin-top: 15px; height: 25px; font-size: 14px; margin-left: -15px;" value="Вставьте сюда ваш E-mail:"/>
<div style=" margin-top: 15px;  margin-bottom: 25px; ">
<input type="checkbox" class="checkbox" id="checkbox" />
<label for="checkbox" style=" color: #92959D; ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Согласен на получение новостей по почте</label>
</div>





<a href=""><div class="buttom" style="text-align:center;float: left;margin-left: 300px;">Сохранить</div></a>
</div>


</div>
</body>
</html>
