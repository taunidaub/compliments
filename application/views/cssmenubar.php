<?php 
$date=date('Y-m-d H:i:s');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url_noIndex')?>css/csshorizontalmenu.css" />
<script type="text/javascript" src="<?php echo $this->config->item('base_url_noIndex')?>js/csshorizontalmenu.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url_noIndex')?>js/main.js"></script>
<div class="horizontalcssmenu">
<ul id="cssmenu1">
<? if($this->session->userdata("LoggedIn")==false){ ?>
<li><a href="javascript:login_page();">Login</a></li>
<? }
else{?>
	<li><a href="<?php echo $this->config->item('base_url') ?>main/logout">Logout</a></li>
	
	<?php if($this->session->userdata("Admin")==true){ ?> 
	<li><a href="<?php echo $this->config->item('base_url') ?>main/edit/emails">Edit the mailing list</a></li>
	<li><a href="javascript:add_compliment();">Add a compliment</a></li>
	<?php } ?>
<li><a href="<?php echo $this->config->item('base_url') ?>main/search/<?php echo $this->session->userdata('EID')?>/rep" >Your compliments</a></li>
<? } ?>
<li><a href="<?php echo $this->config->item('base_url') ?>main/search/0/na" >Search</a></li>
<li><a href="<?php echo $this->config->item('base_url') ?>" >Top 10</a></li>
</ul> 
<br style="clear: left;" />
</div> 
