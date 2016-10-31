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
		<img src="images/profile.png"><span style="color: #7E8294;">Нас на сайте:</span> 13 человек

	</div>
<a href="#" title="Техническая поддержка" style=" margin-left: 55px; " >Техническая поддержка</a>

</div>


	<div class="contentblock" style="height:1500px;">
		<div class="titleblock">О сайте <span class="yellow">+3%</span></div>

	<div style=" background: #26272C; padding: 5px; position: relative; width: 80px; margin-left: 15px; ">Всё просто!</div>
	<div style=" border: 2px solid #FFD502; padding: 20px; margin-top: -15px; ">Игроки вносят предметы из CS:GO на сайт. Чем дороже стоимость предмета, тем больше шанс выиграть ставку. Но даже внеся 1$, у Вас есть шанс выиграть jackpot!</div><br>
<div class="titleblock" style=" line-height: 28px; "><img style=" float: left;  margin-right: 5px; " src="images/abzk.png">О сервисе</div>
		<p style="color:#A7AAB6;font-size: 13px;">
		1. Вы вносите свои предметы в депозит.
2.Система зачисляет Вам очки. 
Например: если Ваш предмет стоит 10$, то вы получаете 100 очков, а с предметом стоимостью 100$ вы получаете 1000 очков и т.д.
3.Когда сайт набирает 30 предметов в сумме, тогда система собирает все выданные очки вместе и случайным образом выбирает победителя.
		</p>
<br>

<div class="titleblock" style=" line-height: 28px; "><img style=" float: left;   margin-right: 5px;" src="images/abzks.png">Некоторые особенности</div>
		<p style="color:#A7AAB6;font-size: 13px;">
		 1. Минимальная общая стоимость предметов не менее 2$. Максимальный депозит предметов – 10 штук за игру. Минимальная стоимость одного предмета 0,5$.
2. Сервис взимает от 1 до 10% в зависимости от величины выигрыша.
3. Выдача выигрыша происходит в автоматическом режиме.
Иногда время выдачи предмета может затянуться до нескольких минут.
4. Запрещено ставить сувенирные предметы, за исключением наборов.
5. Каждый раз отправляя предметы, вы соглашаетесь с правилами использования сайта.
6. Сайт гарантирует правильную оценку предмета только тогда, когда вещь есть на торговой площадке Steam.
7. В слачае, если ваш инвентарь закрыт ,или Вы указали неверную ссылку на инвентарь, то, в течение часа, Вы можете исправить это самостоятельно или с помощью агентов поддержки.
8. Если Вы вложили предметов больше, чем может вместить в себя текущий раунд, то ваши переходят в следующий.
9. Если Вы отменили обмен или отправили контр-предложение после победы, то ваши предметы не будут возвращены.
		</p>
<br>

<div class="titleblock" style=" line-height: 28px; "><img style=" float: left;  margin-right: 5px; " src="images/abzkss.png">Конфиденциальность</div>
		<p style="color:#A7AAB6;font-size: 13px;">
		1. Сайт слил SuperKyza 2. Покупайте хороший хостинг! 3. Внимание! Это почти готовый скрипт настройте его и у вас готовый сайт! 
		</p>


</div>



</div>
</body>
</html>
