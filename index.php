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
	<script src="js/progressbar.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<div class="header">
	<a href="index.php"><div class="logo"></div>
	
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
		<img src="images/profile.png"><span style="color: #7E8294;">Сейчас на сайте человек:</span><span class="online-num">12</span> 

	</div>
<a href="#" title="Техническая поддержка" style=" margin-left: 55px; " >Техническая поддержка</a>

</div>


	<div class="contentblock">
		<div class="titleblock">Авторизуйся, чтобы испытать удачу</div>
		<div class="buttomcont"><img style="float:left;" src="images/steamicocont.png">Войдите в Steam акаунт и попробуйте выиграть <span style="font-family: Arial; font-size: 13.0pt;">$</span><?php 
						$result = mysql_query("SELECT MAX(cost) AS cost FROM `games`");
						$row = mysql_fetch_array($result);
						$maxcost =  round($row["cost"], 2);
						echo $maxcost;
						?></div><br>
		<p style="color:#858790;font-size: 16px">Участвующие вносят скины, по достижении определенного максимального количества случайным образом выбирается победитель, который получит все скины. Шанс выигрыша зависит от стоимости внесенных скинов. <del><span style="font-family: Arial; font-size: 13.0pt;">P</span></del>1, у вас есть шанс выиграть!</p>
	</div>

	<div class="contentblock" style="height: 83px;padding: 10px 20px;width: 797px;">
<div class="statsblock">
<div class="txtspc">Разыграно вещей</div>
<div class="colortxtblock"><span style="font-family: Arial; font-size: 30pt"></span><?php
									$result = mysql_query("SELECT SUM(itemsnum) AS itemsnum FROM games WHERE `starttime` > ".(time()-86400));
									$row = mysql_fetch_assoc($result);
									echo $row["itemsnum"];
									?></div></div>
<div class="razdelit"></div>


<div class="games">
<div class="txtspc">Игр сегодня</div>
<div class="colortxtblock">15</div></div>
<div class="razdelit""></div>


<div class="games">
<div class="txtspc">Уникальных игроков</div>
<div class="colortxtblock">61</div></div>
<div class="razdelit"></div>


<div class="games">
<div class="txtspc">Максимальный выигрыш</div>
<div class="colortxtblock"><del><span style="font-family: Arial; font-size: 30pt"></span></del><? echo $maxcost ?></div></div>
	</div>



	<div class="contentblock" style="height: 113px;width: 798px;padding: 20px;">
<div class="txtblockcnop">Играй там, где реально выиграть!</div>

<a href="#"><div class="cs"></div></a>
<a href="#"><div class="dota2"></div></a>
<a href="#"><div class="tf"></div></a>
	</div>

	<div class="contentblock" style="height:70px;padding: 45px 0px;  width: 838px;">
		
	<div style="float:left; padding-left:10px; margin-top:-50px">
	<div class="visual" style="padding-right:15px; padding-top:10px">
								<div id="prograsd" style="position: relative;"><p class="progressbar__label" style="position: absolute; top: 50%; left: 50%; padding: 0px; margin: 0px; transform: translate(-50%, -50%); color: rgb(238, 238, 238);">0/30</p></div>
								
						</div>
	</div>						
	<div class="gamesum" style=" width: 120px; ">
	<div class="gamesumname">Сумма выигрыша</div>
	<div class="gamesumfor" style="padding: 6px 40px;"><span style="font-family: Arial; font-size: 20pt">$</span><span id="bank">0</span></div>
	</div>

	<div class="gamesum" style="width: 100px; ">
	<div class="gamesumname">Шанс выиграть</div>
	<div class="gamesumfor"><span id="mychance">0%</span></div>
	</div>
	

	<div class="gamesum" style="  width: 270px;  float: right; margin-top:-100px  ">
	<div class="txtgamesno" style=" width: 80px; ">Игра <span id="gameid"></span></div>
	<div class="txtgamesno" style=" float: right; width: 120px; ">Выключить звук<div class="zvuk"></div></div>
<div style="clear:both;"></div><br>
	<div style="font-size: 12px;font-weight: bold;background: #222328;padding: 6px 10px;width: 220px;">Игра закончится через:<img src="images/clock.png" width="15" height="15"><span id="timeleft" style="">0</span></div>
	</div>
</div>



	<div class="contentblock" style="height: 1800px;width: 838px;padding: 0px;">
	
	<div style=" width: 838px;height: 50px; border-bottom: 1px solid #141415;font-weight: bold; text-align: center; text-transform: uppercase; line-height: 45px;">Играй и выигрывай!</div>
	<div style="  font-size: 13px;height: 300px; width: 798px;padding: 0px 20px; background: #2C2D31; border-bottom: 1px solid #141415; ">
	<div style=" padding: 20px; border-bottom: 1px solid #393B42; ">Игра <span class="yellow">№<? $result  = mysql_query("SELECT MAX(id) as id FROM `games`"); $row = mysql_fetch_array($result); $lastid = $row['id']; echo $lastid;
	 ?></span> завершилась!</div>

	

	<div style="padding: 35px 15px;float:left;">
		<div class="txtstylel">Победил игрок: <span style=" font-weight: normal; color: #F8C22D; "><? echo $winnername ?> </span></div>
		<div class="txtstylel">Выигрыш: <span style=" font-weight: normal; color: #F8C22D; "><span style="font-family: Arial; font-size: 12pt">$</span><? echo $winnercost ?></span></div>
		<br>
		<img src="<? echo $winneravatar ?>" width="100px" height="100px">
	 	</div>
     <div style="float:left; padding-top:20px;">
     <img src="images/cubokone.png" width="150">
     </div>

	
	
	</div>

	

	

<?php
						if(!isset($_SESSION["steamid"])) { echo ' <a href="?login">
<div style="width:833px;height: 85px;background:#E3A227; padding: 40px 5px 0px 0px;">
<div style="width:65px;height:65px;background:url(images/error1.png) no-repeat;float: left;margin-left: 25px;margin-right: 25px;margin-top: -15px;"></div>
<span style=" margin-top: 24px; font-size: 16px; text-transform:uppercase;font-weight: bold; ">Игра началась, вносите предметы!</span><br>
Игрок, сделавший ставку первым, получает шанс к победе +2%
<div style="  font-size: 85px; font-weight: bold; -moz-transform: rotate(-20deg); -o-transform: rotate(-20deg); -webkit-transform: rotate(-20deg); float: right; margin-top: -52px; color: #E3B54A; ">+2%</div>
</div>
</a> '; }
else 
{ 
	$token = fetchinfo("tlink","users","steamid",$_SESSION["steamid"]);
if(strlen($token) < 2) {echo ' <a href="nastroyki.php" >
<div style="width:833px;height: 85px;background:#E3A227; padding: 40px 5px 0px 0px;">
<div style="width:65px;height:65px;background:url(images/error1.png) no-repeat;float: left;margin-left: 25px;margin-right: 25px;margin-top: -15px;"></div>
<span style=" margin-top: 24px; font-size: 16px; text-transform:uppercase;font-weight: bold; ">Игра началась, вносите предметы!</span><br>
Игрок, сделавший ставку первым, получает шанс к победе +2%
<div style="  font-size: 85px; font-weight: bold; -moz-transform: rotate(-20deg); -o-transform: rotate(-20deg); -webkit-transform: rotate(-20deg); float: right; margin-top: -52px; color: #E3B54A; ">+2%</div>
</div>
</a> ';}
else 
{ echo '<a href="Ваша ссылка на обмен">
<div style="width:833px;height: 85px;background:#E3A227; padding: 40px 5px 0px 0px;">
<div style="width:65px;height:65px;background:url(images/error1.png) no-repeat;float: left;margin-left: 25px;margin-right: 25px;margin-top: -15px;"></div>
<span style=" margin-top: 24px; font-size: 16px; text-transform:uppercase;font-weight: bold; ">Игра началась, вносите предметы!</span><br>
Игрок, сделавший ставку первым, получает шанс к победе +2%
<div style="  font-size: 85px; font-weight: bold; -moz-transform: rotate(-20deg); -o-transform: rotate(-20deg); -webkit-transform: rotate(-20deg); float: right; margin-top: -52px; color: #E3B54A; ">+2%</div>
</div>
</a> ';
}
}
	?>


<div class="stuffs promo-cover">
						<ul id="game-sts" style="display: block;  list-style-type: none;">
							<div class="rounditems" width="838"><?php 
								include "items.php";
							?>
						</div>
										<li class="orange" style="min-height: 80px; width: 100%; text-align: center;  list-style-type: none;">
										<div class="text" style="min-height: 80px; padding: 0;">
											
										</div>
									</li>
									
								</ul>
						</div>
						
</body>
</html>
