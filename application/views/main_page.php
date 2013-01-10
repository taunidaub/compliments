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
<script type="text/javascript">
var baseURL = '<?php echo $this->config->item("base_url")?>';
var noIndexURL = '<?php echo $this->config->item("base_url_noIndex")?>';
var user_eid = '<?php echo $this->session->userdata('EID') ?>';

</script>
</head>
<!--end #head -->
<!-- begin #pagecode -->
<?php include ('cssmenubar.php'); ?>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><?php echo $this->config->item('app_title')?></h1>
		</div>
	</div>
</div>
<div style="clear: both;">&nbsp;</div>
	<!-- begin #page -->
	<div id="page">	
	<!-- begin #content -->
	<div id="content">
		<div id="post">
				<?php
				if(@$error!=''){
					echo "<h2 class='error'>".$error."</h2>";
					$error='';
				}
				
				
				$sql="select * from new_compliments order by date desc";//".$date."
				$query = $this->db->query($sql);
				if($query->num_rows()>0){
					echo '<br><h2 class="title" id="title">Most Recent Compliments:</h2>
					<div class="entry" id="entry">';
					$x=0;
					$max=10;
					foreach ($query->result() as $row)
					{
						if ($x<$max){
							echo("<strong><a href='".$this->config->item("base_url")."main/search/".$row->rep_eid."/rep'>".$row->rep_fn." ".$row->rep_ln."</a></strong><br>");	
							echo '&nbsp;&nbsp;-&nbsp;'.$row->compliment."<BR>";
							
							echo "<BR>";
						}
							$x++;
					}			
					
							
				echo "</div>";
				} 
				else
				echo "<h3 class='title'>There are currently no active contests for you to enter.</h3>";
				?>
		</div>

	</div>
	<!-- end #content -->
	<div style="clear: both;">&nbsp;</div>
<!-- end #page -->
</div>
<!-- begin #footer -->
<div id="footer">
	<p>Copyright (c) <?php echo (date('Y')) ?> <a href="daubdesigns.com">Daub Designs</a>. All rights reserved.</p>
</div>
<!-- end #footer -->
</body>
</html>
