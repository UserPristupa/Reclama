<!-- как правильнее подключать ? через перем сервер документ рут или через /     -->
<!--    <div class="col-lg-12 header">-->
<!--        <div class="row">-->
<!--            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">-->
<!--            <img src='--><?php //$_SERVER[DOCUMENT_ROOT]?><!--/img/Acc-logo200-120.jpg' -->
<!--                 alt="imgLogo" class="img-rounded img-responsive text-right">-->
<!--            </div>-->
<!--             <div class="col-lg-9" ><span class="text-center ">ADVERTISING CREATE COMPANY</span></div> -->
<!--            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" >-->
<!--                <img src="--><?php //$_SERVER[DOCUMENT_ROOT]?><!--/img/viveska2.jpg" -->
<!--                     alt="nameFirma" class="img-rounded img-responsive text-left">-->
<!--            </div>-->
<!--        </div>-->
<!--    </div> -->

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="row" id="container">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="logo">
				<div id="logo"><img src="\img\1_Primary_logo_on_transparent_346x63.png"/></div>
					<!--<img src='/img/Acc-logo200-120.jpg'
						 alt="imgLogo" class="img-rounded img-responsive text-right">-->
				</div>
						 <!--  <div class="col-lg-9" ><span class="text-center ">ADVERTISING CREATE COMPANY</span></div>-->
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
				   <!-- <img src="/img/viveska2.jpg"
						 alt="nameFirma" class="img-rounded img-responsive text-left">
						 <img src="./img/vihod.png" align= "absmiddle" vspace="10" hspace="5" />-->
						<span class="fa-user" style="margin-left: 100px;">
							<?
								require_once 'autoload.php';
								$sid=session_id();
								$res=\App\Models\User::getCurrentUserBySession($sid);
								echo $res[0]->name;
							?>
						  </span>
						<a id="exit"><i class="icon-exit3"></i>Выход</a></div>	
				<div id="completed_successfully" style="display:none">Успешно завершено</div>
			</div>
        </div>
    <!--</div>
	
<div id="header">
<div class="container">
<div id="logo"></div>
<div id="exit"><a>
<img src="./img/vihod.png" align= "absmiddle" vspace="10" hspace="5" />
<i class="icon-exit3"></i>Выход</a></div>
</div>
</div>-->
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
document.getElementById("exit").onclick=function(){
	var xhr = new XMLHttpRequest();
        xhr.open("POST", "/templates/deleteSession.php", false);
	    xhr.overrideMimeType("text/plain; charset=utf8");
        xhr.send(null);
		location.reload();
 //   	window.location="authorization.php";
}
function hide_completed()
{
	document.getElementById("completed_successfully").style="display: none";
}
function set_completed_handler(timeout){
	document.getElementById("completed_successfully").style="display: block";
	setTimeout(hide_completed,timeout);
}
</script>
