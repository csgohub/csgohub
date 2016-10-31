var circle,bets=100500,timeleft=120,ms=1000;
var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'audio.mp3');
var audioElement2 = document.createElement('audio');
audioElement2.setAttribute('src', 'msg.mp3');

window.onload = function onLoad() {
	circle = new ProgressBar.Circle('#prograsd', {
		color: '#FFAD08',
		strokeWidth: 12,
		easing: 'easeInOut',
		trailColor: "#4e5d6c"
	});
	circle.animate(1);
	setInterval("reloadinfo()",1000);
	setInterval("updatetimer()",1);
};

function alert2(txt,typet) {
	var n = noty({
		layout: 'bottomRight',
		text: txt,
		type: typet,
		timeout: 10000
	});
	audioElement.play();
}

function updatetimer() {
	var d = new Date();
    var n = 99-Math.round(d.getMilliseconds()/10);
	if(timeleft == 120) n = 0;
	if(n < 0) n = 0
	if(n < 10) $('#timeleft').text(timeleft+'.0'+n);
	else $('#timeleft').text(timeleft+'.'+n);
}

function reloadinfo() {
	$.ajax({
		type: "GET",
		url: "currentgame.php",
		success: function(msg){
			$("#gameid").text("#"+msg);
		}
	});
	$.ajax({
		type: "GET",
		url: "currentchance.php",
		success: function(msg){
			$("#mychance").text(msg);
		}
	});
	$.ajax({
		type: "GET",
		url: "currentitems.php",
		success: function(msg){
			if(msg > 100) msg = 100;
			circle.animate(msg/100);
			$('.progressbar__label').text(msg+'/30');
		}
	});
	$.ajax({
		type: "GET",
		url: "currentbank.php",
		success: function(msg){
			$('#bank').text(msg+'');
		}
	});
	$.ajax({
		type: "GET",
		url: "timeleft.php",
		success: function(msg) {
			timeleft = msg;
		}
	});
	$.ajax({
		type: "GET",
		url: "items.php",
		success: function(msg){
			$('.rounditems').html(msg);
		}
	});
}