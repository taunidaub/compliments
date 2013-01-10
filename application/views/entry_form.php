<!DOCTYPE html>
<html>
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $this->config->item('app_title')?></title>
<link href="<?php echo $this->config->item('base_url_noIndex')?>css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?php echo $this->config->item('base_url_noIndex')?>js/mootools-core.js"></script>
<script src="<?php echo $this->config->item('base_url_noIndex')?>js/mootools-more.js"></script>
<script src="<?php echo $this->config->item('base_url_noIndex')?>js/csshorizontalmenu.js"></script>
<script src="<?php echo $this->config->item('base_url_noIndex')?>js/main.js"></script>
<script src="<?php echo $this->config->item('base_url_noIndex')?>js/datetimepicker.js"></script>
<script type="text/javascript">
var baseURL = '<?php echo $this->config->item("base_url")?>';
var noIndexURL = '<?php echo $this->config->item("base_url_noIndex")?>';
var user_eid = '<?php echo $this->session->userdata('EID') ?>';

</script>
</head>
<?php include ('cssmenubar.php'); ?>
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
		<div id="post">
		
		<?php 
		if($this->session->userdata("Admin")==true){
			?>
			<h2 class="title" id="title">Compliment Submission</h2>
			<div class="entry" id="entry">
			<form id="myForm" action="<?php echo $this->config->item('base_url') ?>main/insert_mailer/<? echo $this->config->item('ma')?>">
			<input type="hidden" name="admin_eid" title="admin_eid" value='<?php echo $this->session->userdata("EID")?>' />
			<p class="label">Type the rep's email address here:
			<input type="text" name="emp_email" id="emp_email" title="Rep Email Address" size="40" onKeyUp="javascript:eid_lookup('emp_email','rep_eid')" /> &nbsp;&nbsp;
			 Select correct user here: <select name="rep_eid" id="rep_eid" default="1" onChange="get_sup_from_dropdown(this);">
			<option value="">Please type in an email address to the left</option>
			</select>	</p>
			<div id='sup_select' style="display:none">
			<p class="label">Type the supervisor's email address here:
			<input type="text" name="sup_email" id="sup_email" title="Sup Email Address" size="40" onKeyUp="javascript:eid_lookup('sup_email','sup_eid')" /> &nbsp;&nbsp; Select correct user here: <select name="sup_eid" id="sup_eid" default="1">
			<option value="">Please type in an email address to the left</option>
			</select>	</p>
			</div>
			<p class="label">Compliment method:
			<select name="method" id="method" default="1">
			<option>Email</option>
			<option>Letter</option>
			<option>Telephone</option>
			</select>	</p>
			<p class="label">Account number: <input type="text" name="house" id="house" size="10" maxlength="8" title="" value='' />-<input type="text" name="customer" id="customer" size="3" maxlength="2" title="" value='' />&nbsp;<input type="button" name="check_account" onClick="javascript:verify_account();" value="Verify Account"></p>
			<div id="account_info"></div>
			<p class="label">City (if verify fails)
			<input type="text" name="bk_city" id="bk_city" size="40">
			<p class="label">Compliment: <textarea name="compliment" cols="80"></textarea> </p>
			<p>
			<input name="btnsubmit" id="btnsubmit" type="submit" value="Enter Compliment" onClick="javascript:insert('<? echo $this->config->item('ma')?>');" /></p>
			<div id="myResult" style="visibility:hidden;"></div>
			
			</form>
			</div>		
			<script language="javascript" type="text/javascript">
			window.addEvent('domready', function(){
			
			  // The elements used.
			  var myForm = document.id('myForm'),
				myResult = document.id('myResult');
			
			  // Labels over the inputs.
			  myForm.getElements('[type=text], textarea,[type=password]').each(function(el){
				new OverText(el);
			  });
			
			  // Validation.
			  new Form.Validator.Inline(myForm);
			
			  // Ajax (integrates with the validator).
			
			  new Form.Request(myForm, myResult, {
				requestOptions: {
				  'spinnerTarget': myForm
				},
				onSuccess: function(responseText,responseXML){ 
			
					if(responseText.get('html') === '1'){
						window.location.reload(true);
					}
				}
			  });
			
			});
			</script>
			<? }
			 ?>		

		</div>
	</div>	
	<!-- end #content -->
	<div style="clear: both;">&nbsp;</div>
<!-- end #page -->
</div>
<div id="footer">
	<p>Copyright (c) <?php echo (date('Y')) ?> <a href="daubdesigns.com">Daub Designs</a>. All rights reserved.</p>
</div>
	<!-- end #footer -->

	
</body>
</html>
