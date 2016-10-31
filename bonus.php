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
	<p>Добавь в свой ник Steam: SuperKyza и получи шанс к победе <span class="yellow">+5%</span></p>
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
		<img src="images/profile.png"><span style="color: #7E8294;">Нас на сайте:</span> 100 человек

	</div>
<a href="#" title="Техническая поддержка" style=" margin-left: 55px; " >Техническая поддержка</a>

</div>


	<div class="contentblock" style="height:250px;">
		<div class="titleblock">Пригласи трех друзей и получи <span class="yellow">+3%</span> к шансу на победу!</div>
		<p style="color:#858790;font-size: 16px;line-height: 30px;"><img style="  margin: 10px;float:left;" src="images/bonuskey.png">Как же получить?<br>Введите 3 ключа, которые можно получить от друзей и получите +3% к шансу победы.</p>

<div style=" padding: 25px; background: #252629; float: left; margin-left: -20px; margin-top: 15px; ">Ключ: <span class="yellow">213ASD2</span></div>
<input style=" padding: 20px; background: #252629; border: none; color: #5D6169; width: 400px; margin-top: 15px; height: 25px; font-size: 14px; margin-left: 40px;" value="Получили ключ от друга? Введите его здесь:"/>
	
<a href="#"><div style="   text-align: center;padding: 20px; width: 130px; border: 1px solid #FFD500; margin: 20px 300px; float: left;">Активировать ключ</div></a>
</div>


	<div class="contentblock" style="height:170px;">
		<div class="titleblock">Добавь в свой ник Steam "Steam-Lucky.ru" и получи шанс к победе <span class="yellow">+5%</span>!</div>
		<p style="color:#858790;font-size: 16px;line-height: 30px;"><img style="  margin: 10px;float:left;" src="images/podaroks.png">После смены ника, для вступления бонуса в силу нажмите кнопку "Выйти" и зайдите на сайт заново!</p>

	
<a href="http://steamcommunity.com/id/user/edit"><div style="   text-align: center;padding: 20px; width: 130px; border: 1px solid #FFD500; margin: 20px 300px; float: left;">Сменить никнейм</div></a>
</div>


</div>
</body>
</html>
