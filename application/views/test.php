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
<body>

<div id="footer">
	<p>Copyright (c) <?php echo (date('Y')) ?> <a href="daubdesigns.com">Daub Designs</a>. All rights reserved.</p>
</div>
	<!-- end #footer -->

	
</body>
</html>
