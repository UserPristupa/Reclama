<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<nav role="navigation" class="navbar navbar-default navbar-form">
<nav role="navigation" class="navbar navbar-default navbar-fixed-top">-->

    <!-- Toggle menu for mobile display 
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>-->

    <!-- default menu 
	<div class="col-md-3 col-md-pull-9">-->
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="fon">
			<div class="row" >
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" id="left-sidebar">
	    <img class="img-circle img-sm" hspace="20" vspace="20"/> 
		<!-- left-sidebar<i class="material-icons">content_paste</i>
		<i class="icomoon icon-truck"></i>
		<i class="icon-copy-2"></i>-->
		<!--<i class="box-add"></i>-->
		<div class="menu_list">
		<span class="fa-user">
		</span>
		<?
			require_once 'autoload.php';
			$sid=session_id();
			$res=\App\Models\User::getCurrentUserBySession($sid);
			echo $res[0]->name;
		?>
		<a><span class="glyphicon glyphicon-cog btn-lg" style="float: right;" id="profile"></span>
		<!--<img src="./img/Настройки.png" align="right" widht="30"  height="30" hspace="10" vspace="10" id="profile"/>-->
		</a>

		</div>
        <ul id="menu_list">
            <? include "templates/menu.php"; ?>
		</ul>
	
	</div>	
 <!--   <aside class="left-sidebar">
    <div id="navbarCollapse" class="collapse navbar-collapse">-->
<!--        <ul class="nav navbar-nav">
            <li class="active"><a href="/index.php">Home</a></li>
            <li><a href="/templates/viewAllTasks.php">Задачи</a></li>
            <li><a href="/templates/viewAllContactsClients.php"><span class="glyphicon-"></span>Contact</a></li>
            <li><a href="/templates/viewAllClients.php">клиенты</a></li>
            <li><a href="/templates/viewAllOrders.php">заказы</a></li>
            <li><a href="/templates/viewAllSuppliers.php">поставщики</a></li>
            <li><a href="/templates/viewAllMaterials.php">материалы</a></li>
            <li><a href="#">отчеты</a></li>

        </ul>


<div>
<img class="img-circle img-sm" hspace="20" vspace="20"/>
<!--<i class="material-icons">content_paste</i>
<i class="icomoon icon-truck"></i>
<i class="icon-copy-2"></i>-->
<!--<i class="box-add"></i>
<div class="menu_list">

<span style="margin-left: 10px">
<span class="fa-user"></span>
<?
   // require_once 'autoload.php';
    //$sid=session_id();
    //$res=\App\Models\User::getCurrentUserBySession($sid);
	//echo $res[0]->login;
?>
</span>
<a><span class="glyphicon glyphicon-cog btn-lg" id="profile"></span>
<!--<img src="./img/Настройки.png" align="right" widht="30"  height="30" hspace="10" vspace="10" id="profile"/>
</a>
</div>
</div>
        <ul id="menu_list">
            <? //include "templates/menu.php"; ?>
		</ul>
    </aside>
<!--</div>	-->

<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" id="main_modul">
	
	    <?
		    require_once "functions/functions.php";
			if($_GET['page'])
			{
			    $result=get_handler_by_menu_title($_GET['page']);
			    include $result;
			}
			else
			{
				include "templates/viewAllOrders.php";
			}
		?>
	
	</div>
</div>
</div>
    <script type="text/javascript">
//    $(document).ready(function(){
//        $('nav').append('<h5 class="testJqueryCon">Этот текст добавлен с помощью jQuery - значит эта библиотека подключена</h5>');
       // $('testJqueryCon').fadeOut(3000);
//        $('testJqueryCon').fadeIn(5000);

//    });
    document.getElementById("profile").onclick=function() {
		// создать объект для формы
        //var formData = new FormData(document.forms.profile);
        // отослать
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./profile.php", false);
	    xhr.overrideMimeType("text/plain; charset=utf8");
        xhr.send(null);
		document.getElementById("main_modul").innerHTML = xhr.responseText;
		document.getElementById("name_profile").value='<?echo $res[0]->name;?>';
		document.getElementById("email_profile").value='<?echo $res[0]->email;?>';
		//document.onkeyup = function(e)
		//{
		//	e = e || window.event;
			//if(xhr.responseText=="authorized" || e.keyCode==13)
			//{
				//window.location="/";
			//}
			//else if(xhr.responseText!="unauthorized")
			//{
			//	console.log(xhr.responseText);
			//}
		//	return false;
		//}
}
   var zoomed=true;
   function zoomInY(targetBlock)
   {
	   if(zoomed)
	   {
	        new Effect.Scale(targetBlock, 10, {duration: 1, scaleX: true, scaleY: false, scaleContent: false});
			zoomed=false;
			document.getElementById("menu_list").style.display="none";
	   }
	   else
	   {
		   new Effect.Scale(targetBlock, 1000, {duration: 1, scaleX: true, scaleY: false, scaleContent: false});
		   zoomed=true;
		   document.getElementById("menu_list").style.display="block";
	   }
   }
    </script>
</nav>
</div>