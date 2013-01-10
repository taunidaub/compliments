<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $this->config->item('app_title')?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url_noIndex')?>/css/style.css" rel="stylesheet" media="screen" />

<script src="<?php echo $this->config->item('base_url_noIndex')?>js/mootools-core.js"></script>
<script src="<?php echo $this->config->item('base_url_noIndex')?>js/mootools-more.js"></script>
<script src="<?php echo $this->config->item('base_url_noIndex')?>js/main.js"></script>

<?php 
$_SESSION['debug']=0;
	if ($_SESSION['debug']) {
	
		echo "<pre><strong>\$_REQUEST:</strong><br />"; var_dump($_REQUEST); echo "</pre>";
		echo "<pre><strong>\$_SESSION:</strong><br />"; var_dump($_SESSION); echo "</pre>";
		echo "<pre><strong>\$_GET:</strong><br />"; var_dump($_GET); echo "</pre>";
		echo "<pre><strong>\$_POST:</strong><br />"; var_dump($_POST); echo "</pre>";
		echo "<pre><strong>\$_FILES</strong><br />"; var_dump($_FILES); echo "</pre>";
	}
	?>
</head>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><?php echo $this->config->item('app_title')?></h1>
		</div>
	</div>
</div>
<div style="clear: both;">&nbsp;</div>
<div id="page">
	<div id="content">
		<div class="post" align="center">
		
		<div class="entry"> 
			<p class="login">
			<p class="title">Log In:</p>
			<form id="myForm" action="<?php echo $this->config->item('base_url') ?>main/login">
				<p class="label">EID: <input type="text" name="EID" class="required" title="EID" /></p>
				<p class="label">Password: <input type="password" name="Password" class="required" title="Password" /></p>
				<p><input name="submit" id="submit" type="submit" value="Log In" onClick="javascript:login();" /></p>
			  <div id="myResult" style="visibility:hidden;"></div>
			
			</form>		

			</p>
		</div>
		</div>
	</div>
	
			<!-- end #content -->
	<div style="clear: both;">&nbsp;</div>
	<!-- end #page -->
</div>
<div id="footer">
	<p>Copyright (c) <?php echo (date('Y')) ?> <a href="daubdesigns.com">Daub Designs</a>. All rights reserved.<br />Maintained by the <a href="mailto:DL-ALB-MIS-PROG@domain.com">Albany IT Department</a></p>
</div>
	<!-- end #footer -->
<script language="javascript" type="text/javascript">

window.addEvent('domready', function(){

  // The elements used.
  var myForm = document.id('myForm'),
    myResult = document.id('myResult');

  // Labels over the inputs.
  myForm.getElements('[type=text], textarea,[type=password]').each(function(el){
    new OverText(el);
  });
  
  new Form.Validator.Inline(myForm);

  new Form.Request(myForm, myResult, {
	onSuccess: function(responseText,responseXML){ 
		if(responseText.get('html') === '1'){
			window.location.href="http://compliments.domain.com";
		}
		else {
			myResult.style.visibility="visible";
			myResult.innerHTML="<font color='#660000'>The eid and password provided did not work. Please try again.</font>";
			}
	}
  });


});
</script>

</body>
</html>
