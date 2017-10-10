<?
session_start();
include "handlers/checkSession.php";
$res=check_session();
if($res=='unauthorized')
{
	include "authorization.php";
	
}	
else
{
	//session start
	// проверка на авторизацию
	// если нет параметра то грузим заказы
?>
<!DOCTYPE html>
<html>
<!--<head>-->
<!-- подключим к странице head.php заголовки и линковку-->
<!--    <meta http-equiv="content-type" content="text/html;charset=utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>изготовление наружной рекламы в Чернигове акрилайт , баннер , вывеска , лайтбокс , лайтпостер , плакат , постер , призматрон ,  </title>-->
                                            <!-- js код -->
                              <!--<script src="http://code.jquery.com/jquery-latest.min.js"></script>-->
                       <!-- или так-->
               <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
<!--    <script type="text/javascript" src="js/jquery.min.js"></script>-->
<!---->
<!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->
<!--    <link rel="stylesheet" href="css/bootstrap-theme.min.css">-->
<!--    <link rel="stylesheet" href="css/manual.css">-->
<!--    <link rel="icon" href="fonts/glyphicons-halflings-regular.ttf">-->
<!--    <link rel="shortcut icon"  href="img/favicon/icon.ico">-->
<!--    <script src="js/bootstrap.min.js"></script>-->
<!--    <script type="text/javascript" src="js/ajax_post_get.js"></script>-->
<!--</head>-->
<?php
      require_once ('./head.php');
?>
<body>

<div class="container">
    <div class="row navbar navbar-inverse navbar-fixed-top" id="header">
        <!--   wrapper      подтянем header сайта-->
        <!-- относительно точки	<div class="col-lg-2">-->
        <?php require_once ('./templates/header.php'); ?>
		
	</div>
	<div class="row" id="main_cont"><!-- middle  -->
	<!--<?echo password_hash ( "password2" , PASSWORD_BCRYPT);?>-->
        <!--    подтянем menu сайта-->
        <?php require_once ('./navigation.php'); ?>
     <!--<div class="footer">
            <div> статус: admin/user<br>имя пользователя/ник</div>      
        </div>-->
    </div>
    
          
</div>
</body>
</html>

<script type="text/javascript">
/*$(document).ready(function () {
      var offset = $('#header').offset();
    var topPadding = 0;
    $(window).scroll(function() {
        if ($(window).scrollTop() > offset.top) {
			$('#header').css('margin-top',$(window).scrollTop() - offset.top + topPadding);
           // $('#header').stop().animate({marginTop: $(window).scrollTop() - offset.top + topPadding});
        }
        else {
			$('#header').css('margin-top',0);
           // $('#header').stop().animate({marginTop: 0});
        }
    });
});
*/
</script>
<?}?>