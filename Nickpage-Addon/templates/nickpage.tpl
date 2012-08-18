<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
       "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>{TITLE}</title>
		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
		{SITECACHE}
		<link rel="stylesheet" type="text/css" href="{STYLE}sitestyle.css" media="screen">
		<link rel="stylesheet" type="text/css" href="{STYLE}formatting.css" media="screen">
		<link rel="stylesheet" type="text/css" href="{STYLE}lytebox.css" media="screen">
		<script type="text/javascript" src="{JS}jquery.js"></script>
		<script type="text/javascript" src="{JS}functions.js"></script>
		<script type="text/javascript" src="{JS}lytebox.js"></script>
		<script type="text/javascript">
			function showreg(username) {
				popW=800;
				popH=600;
				var winleft = (screen.width - popW) / 2;
				var winUp = (screen.height - popH) / 2;
				winName=username;
				features = 'width='+popW+',height='+popH+',left='+winleft+',top='+winUp+',scrollbars=yes'+',resizable=no';
				window.open('{INSTALL}nickpage.php?sid={SID}&showid='+username+'&auth=1&senduid={SENDUID}&setvisit=true',winName,features);
			}
		</script>
		<script type="text/javascript">
			<!--
			var maxCount={MAXSIGNS};
			function checkSignCount(field){
				if(maxCount!='ub'){
					var z=field.value.length;
					if(z>maxCount) field.value=field.value.substr(0,maxCount);
					document.getElementById('counter').innerHTML=maxCount-field.value.length;
				}
			}
			//-->
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				function smartColumns(){
					$("ul.column").css({'width' : "100%"});
					var colWrap = $("ul.column").width();
					var colNum = Math.floor(colWrap/200);
					var colFixed = Math.floor(colWrap/colNum);
					$("ul.column").css({'width' : colWrap});
					$("ul.column li").css({'width' : colFixed});
				}
				smartColumns();
				$(window).resize(function(){
					smartColumns();
				});
				if("{ALLOWIMGURL}" == "false"){
					$("#urlbutton").hide();
					$("#imgbutton").hide();
				}
			});
		</script>
	</head>
	
	<body{ONLOAD}>
		<br><br>
		<center>
		<div id="wrapper">
			<div id="content_head">
				Usernickpage von {NPUSER_NAME} ({ISONLINE})
			</div>
			<div id="content_content">
				<br>
				<a href="nickpage.php?site=profile&amp;sid={SID}&amp;senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}">Userprofil</a>&nbsp; &nbsp; 
				<a href="nickpage.php?site=guestbook&amp;sid={SID}&amp;senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}">G&auml;stebuch</a>&nbsp; &nbsp; 
				<a href="nickpage.php?site=blog&amp;sid={SID}&amp;senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}">Blog</a>&nbsp; &nbsp; 
				<a href="nickpage.php?site=friends&amp;sid={SID}&amp;senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}">Freunde</a>&nbsp; &nbsp; 
				<a href="nickpage.php?site=slogan&amp;sid={SID}&amp;senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}">Motto</a>&nbsp; &nbsp; 
				<a href="nickpage.php?site=gallery&amp;sid={SID}&amp;senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}">Bilder-Galerie</a>&nbsp; &nbsp; 
				<a href="nickpage.php?site=statistic&amp;sid={SID}&amp;senduid={SENDUID}&amp;showid={SHOWID}&amp;auth={AUTH}">Statistik</a>
				{SITECONTENT}
			</div>
			{DEBUG_BOX}
		</div>
		</center>
	</body>
</html>