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
			
			if($table==$this->config->item('at')){
				$emailsql="select * from $table order by email asc";
				$emailquery = $this->db->query($emailsql);
				if($emailquery->num_rows()>0) {
					echo ('<h2 class="title" id="title">Edit Email Notification Entries</h2><div class="entry" id="entry">');
					foreach ($emailquery->result() as $row){
						if($row->notify=='Y')
							$n_chk = "checked";
						else
							$n_chk = "";
							
						if($row->weekly=='Y')
							$w_chk = "checked";
						else
							$w_chk = "";
						
						?>
						
						<form id="myForm" action="<?php echo $this->config->item('base_url') ?>main/edit_sql/<? echo $this->config->item('at')?>/<?php echo $row->id ?>">
						<input type="hidden" name="id" title="id" value='<?php echo $row->id ?>' />
						<p class="label">Email address:	<input type="text" name="email" id="email" title="Email Address" size="60" value="<?php echo $row->email ?>"> </p>
						<p class="label">Email notification settings:</p>
						
						<p class="label">Notify on submit <input type="checkbox" name="notify" id="notify" <?php echo $n_chk ?> value="Y"> &nbsp;&nbsp;&nbsp;Email weekly summary <input type="checkbox" name="weekly" id="weekly" <?php echo $w_chk ?> value="Y">
						<p>
						<input name="submit" id="submit" type="submit" value="Edit Entry" onClick="javascript:edit('<? echo $this->config->item('at')?>');" />&nbsp;&nbsp;<input name="delete" id="delete" type="button" value="Delete Entry" onClick="javascript:delete_item('<? echo $this->config->item('at')?>','<?php echo $row->id ?>');" /></p>
						<div id="myResult" style="visibility:hidden;"></div>
						
						</form>
						
						<? } 
						}?>
						<form id="myForm3" action="<?php echo $this->config->item('base_url') ?>main/insert_sql/<? echo $this->config->item('at')?>/">
						<input type="hidden" name="id" title="id" value='<?php echo $row->id ?>' />
						<p class="label">Email address:	<input type="text" name="email" id="email" title="Email Address" size="30" value="" </p>
						<p class="label">Email notification settings:</p>
						
						<p class="label">Notify on submit <input type="checkbox" name="notify" id="notify" <?php echo $n_chk ?> value="Y"> &nbsp;&nbsp;&nbsp;Email weekly summary <input type="checkbox" name="weekly" id="weekly" <?php echo $w_chk ?> value="Y">
						<p>
						<input name="submit" id="submit" type="submit" value="Add Entry" onClick="javascript:insert('<? echo $this->config->item('at')?>');" /></p>
						<div id="myResult3" style="visibility:hidden;"></div>
						
						</form>
						</div>	
						
				<? }
				else if ($table=$this->config->item('ma')){
				
				$compsql="select * from $table where id='$id'";
				$compquery = $this->db->query($compsql);
				if($compquery->num_rows()>0) {
					echo ('<h2 class="title" id="title">Edit Compliment</h2><div class="entry" id="entry">');
					foreach ($compquery->result() as $row){
					
					?>
					<form id="myForm" action="<?php echo $this->config->item('base_url') ?>main/edit_sql/<? echo $this->config->item('ma')?>/<?php echo $row->id ?>">
					<input type="hidden" name="admin_eid" title="admin_eid" value='<?php echo $this->session->userdata("EID")?>' />
					<p>To change the current rep from <?php echo $row->rep_fn." ".$row->rep_ln  ?>, type the new rep's email address here:
					
					<input type="text" name="emp_email" id="emp_email" title="Rep Email Address" size="40" onKeyUp="javascript:eid_lookup('emp_email','rep_eid')" /> &nbsp;&nbsp;
					 Select correct user here: <select name="rep_eid" id="rep_eid" default="1">
					<option value="">Please type in an email address to the left</option>
					</select>	</p>
					<p>To change the current supervisor from <?php echo $row->sup_fn." ".$row->sup_ln  ?>, type the supervisor's email address here:
					<input type="text" name="sup_email" id="sup_email" title="Sup Email Address" size="40" onKeyUp="javascript:eid_lookup('sup_email','sup_eid')" /> &nbsp;&nbsp; Select correct user here: <select name="sup_eid" id="sup_eid" default="1">
					<option value="">Please type in an email address to the left</option>
					</select>	</p>
					<p class="label">Account number: <input type="text" name="house" id="house" class="required" size="10" maxlength="8" title="Account" value='<?php echo substr($row->acct_no,0,7) ?>' />-<input type="text" name="customer" id="customer" class="required" size="3" maxlength="2" title="#" value='<?php echo substr($row->acct_no,8,2) ?>' onKeyUp="javascript:check_account()" /></p>
					<div id="account_info" style="visibility:hidden;"></div>
					<p class="label">Compliment: <textarea name="compliment" cols="80" class="required"><?php echo $row->compliment ?></textarea> </p>
					<p>
					<input name="submit" id="submit" type="submit" value="Edit Compliment" onClick="javascript:edit('<? echo $this->config->item('ma')?>');" /></p>
					<div id="myResult" style="visibility:hidden;"></div>
					
					</form>
					<?php
					
					
						
						if(($this->session->userdata("EID")=='E101063')||($this->session->userdata("EID")=='E045606'))	{ ?>
						<form if"myForm2" action="<?php echo $this->config->item('base_url') ?>main/delete/<? echo $this->config->item('ma')?>/<?php echo $row->id ?>">				
						<input name="submit" id="submit" type="submit" value="Delete Compliment" onClick="javascript:delete_item('<? echo $this->config->item('ma')?>','<?php echo $row->id ?>');" />
						</form>
						
						<? } ?>
					</p>
					</div>
			<?
					}
				}
			}
					
		 }
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
