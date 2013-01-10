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
			<h2 class="title" id="title">Compliment Search</h2>
			<div class="entry" id="entry">
			<?php
				$rep_sql="select distinct rep_eid, rep_ln, rep_fn from ". $this->config->item('ma')." order by rep_ln asc";
				$query = $this->db->query($rep_sql);
				if($query->num_rows()>0)
					$rep_names='';
					
				foreach ($query->result() as $row)
					if($row->rep_ln!='')
						$rep_names.="<option value='".$row->rep_eid."'>".$row->rep_ln.", ".$row->rep_fn."</option>";
						
				$sup_sql="select distinct sup_eid, sup_ln, sup_fn from ". $this->config->item('ma')." order by sup_ln asc";
				$query = $this->db->query($sup_sql);
				if($query->num_rows()>0)
					$sup_names='';
					
				foreach ($query->result() as $row)
					if($row->sup_ln!='')
						$sup_names.="<option value='".$row->sup_eid."'>".$row->sup_ln.", ".$row->sup_fn."</option>";
			
				$city_sql="select distinct city from ". $this->config->item('ma')." where date> '2012%' order by city asc";
				$query = $this->db->query($city_sql);
				if($query->num_rows()>0)
					$all_cities='';
					
				foreach ($query->result() as $row)
					if($row->city!='')
						$all_cities.="<option value='".$row->city."'>".$row->city."</option>";
			
		
			?>
			<div id="myResult2"></div>
			<form id="myForm2" action="<?php echo $this->config->item('base_url') ?>main/results/">
			
			<p>Date range for the search: </p>
			<p> From: <select name='fmonth' id="fmonth">
					<option value=''>All</option>
					<option>01</option>
					<option>02</option>
					<option>03</option>
					<option>04</option>
					<option>05</option>
					<option>06</option>
					<option>07</option>
					<option>08</option>
					<option>09</option>
					<option>10</option>
					<option>11</option>
					<option>12</option>
				</select>
				&nbsp;	
				<select name='fday' id="fday">
					<option value=''>All</option>
					<option>01</option>
					<option>02</option>
					<option>03</option>
					<option>04</option>
					<option>05</option>
					<option>06</option>
					<option>07</option>
					<option>08</option>
					<option>09</option>
					<option>10</option>
					<option>11</option>
					<option>12</option>
					<option>13</option>
					<option>14</option>
					<option>15</option>
					<option>16</option>
					<option>17</option>
					<option>18</option>
					<option>19</option>
					<option>20</option>
					<option>21</option>
					<option>22</option>
					<option>23</option>
					<option>24</option>
					<option>25</option>
					<option>26</option>
					<option>27</option>
					<option>28</option>
					<option>29</option>
					<option>30</option>
					<option>31</option>
				</select>
				&nbsp;
				<select name='fyear' id="fyear">
					<option value=''>All</option>
					<?php for($y=date('Y');$y>2007;$y--)
						echo "<option>$y</option>";
					?>
				</select>
				&nbsp;To: 
				<select name='tmonth' id="tmonth">
					<option value=''>All</option>
					<option>01</option>
					<option>02</option>
					<option>03</option>
					<option>04</option>
					<option>05</option>
					<option>06</option>
					<option>07</option>
					<option>08</option>
					<option>09</option>
					<option>10</option>
					<option>11</option>
					<option>12</option>
				</select>
				</td>
				<td>	
				<select name='tday' id="tday">
					<option value=''>All</option>
					<option>01</option>
					<option>02</option>
					<option>03</option>
					<option>04</option>
					<option>05</option>
					<option>06</option>
					<option>07</option>
					<option>08</option>
					<option>09</option>
					<option>10</option>
					<option>11</option>
					<option>12</option>
					<option>13</option>
					<option>14</option>
					<option>15</option>
					<option>16</option>
					<option>17</option>
					<option>18</option>
					<option>19</option>
					<option>20</option>
					<option>21</option>
					<option>22</option>
					<option>23</option>
					<option>24</option>
					<option>25</option>
					<option>26</option>
					<option>27</option>
					<option>28</option>
					<option>29</option>
					<option>30</option>
					<option>31</option>
				</select>
				
				<select name='tyear' id="tyear">
					<option value=''>All</option>
					<?php for($y=date('Y');$y>2007;$y--)
						echo "<option>$y</option>";
					?>
				</select>
			<p>Time frame for the search: <select name="time" id="time" default="1">
			<option value="" selected="selected">Use Date Range</option>
			<option value="day">1 Day</option>
			<option value="week">1 Week</option>
			<option value="month">1 Month</option>
			<option value="6months">6 Months</option>
			<option value="year">1 Year</option>
			</select>
			</p>
			<p>Search by Representative : <select name="rep_eid" id="rep_eid" default="1">
			<option value="">All Reps</option>
			<?php echo $rep_names; ?>
			</select>	
			</p>
			<p>
			Search by Supervisor: <select name="sup_eid" id="sup_eid" default="1">
			<option value="">All Sups</option>
			<?php echo $sup_names; ?>
			</select>
			</p>
			<p>
			Search by Customer City: <select name="city" id="city" default="1">
			<option value="">All Cities</option>
			<?php echo $all_cities; ?>
			</select>
			</p>
			<p>
			Search compliment text: <input type="text" name="compliment" id="compliment"></p>
			<p>
			<input name="submit" id="submit" type="submit" value="Search" onClick="javascript:search_compliments();"/>
			</p>
			</form>
			
			
			</div>
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
