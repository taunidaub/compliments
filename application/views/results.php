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
				$where=" where ";
				if($type=='rep')
					$where.= "rep_eid='".$eid."' and ";
				else if($type=='sup')
					$where.= "sup_eid='".$eid."' and ";
			
				$where.= " rep_eid != '' order by rep_ln asc, date desc";
					
				
				$compliment_sql="select * from ". $this->config->item('ma')." ".$where ;
				$query = $this->db->query($compliment_sql);
				if($query->num_rows()>0) {
					echo ('<font size="+2" color="#000066">Your Results:</font><br>');
					$old_rep='';
					foreach ($query->result() as $row){
						$temp=explode(" ",$row->date);
						$temp1=explode("-",$temp[0]);
						$nicedate=$temp1[1]."-".$temp1[2]."-".$temp1[0];
							
						if($old_rep=='')
							echo "<br><font size='+1'><strong>Supervisor: </strong><a href='".$this->config->item("base_url")."main/search/".$row->sup_eid."/sup'>".$row->sup_fn." ".$row->sup_ln."</a></font><br>";
						if($old_rep!=$row->rep_eid)
							echo "<br><font size='+1'><a href='".$this->config->item("base_url")."main/search/".$row->rep_eid."/rep'>".$row->rep_fn." ".$row->rep_ln."</a></font><br>";
						if(($row->admin_eid==$this->session->userdata("EID"))||($this->session->userdata("EID")=='E101063'))
							$edit="<a href='".$this->config->item("base_url")."main/edit/". $this->config->item('ma')."/".$row->id."'>Edit this compliment</a>";
						else
							$edit='';
						
						
								
						echo ("<strong>".$nicedate."</strong>&nbsp;-&nbsp;".$row->compliment." - ".$row->acct_no." ".$edit."<br>");
					
						$old_rep=$row->rep_eid;
						
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
