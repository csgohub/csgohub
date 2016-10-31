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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/noty/packaged/jquery.noty.packaged.min.js"></script>
	<script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>
	<script src="js/main.js"></script>
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

<?php
							$gamenum = fetchinfo("value","info","name","current_game");
							$rs = mysql_query("SELECT * FROM `games` WHERE `id` < $gamenum ORDER BY `id` DESC LIMIT 10");
							while($row = mysql_fetch_array($rs)) {
							$lastwinner = $row["userid"];
							$winnercost = round($row["cost"], 2);
							$winnerpercent = $row["percent"];
							$winneravatar = fetchinfo("avatar","users","steamid",$lastwinner);
							$winnername = fetchinfo("name","users","steamid",$lastwinner);
							echo '
	<div class="contentblock2" style="height:150px;padding-top:20px;width: 828px;">

<div class="imgstylee" style=" margin-right: 15px; margin-top: 25px;">
<img style="width:100px;height:100px;" src="'.$winneravatar.'"><div class="procentpobedi" style="width:100px;">Игра №'.$row["id"].'</div>
	</div>
<div class="istornick">'.$winnername.'</div>

<div class="istorblockst">
<div class="istorcen">$'.$winnercost.'</div>
<div class="istorcen" style="margin-top: 10px;">'.round($winnerpercent,1).'%</div></div>
<div class="istroblockstn">
<div class="istorblocktxt">Сумма выигрыша</div>
<div class="istorblocktxt">Шанс победы</div>
</div>'; 
echo '<div class="stuff" style="float: none; padding: 5px; width: 100%">
									<ul style="list-style-type:none; display:inline">';
								$rs2 = mysql_query("SELECT * FROM `game".$row["id"]."`");
								while($row2 = mysql_fetch_array($rs2)) {
									echo '
										<li style="display:inline">
											<a href="#">
												<img src="http://steamcommunity-a.akamaihd.net/economy/image/'.$row2["image"].'/60fx60f" width="60" height="60">
												
											</a>
										</li>';
								}
									echo '</ul>
								</div>
								</li>';
							}
								?>




</body>
</html>
