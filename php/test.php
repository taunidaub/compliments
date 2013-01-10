<?php

$link = mssql_connect('ALB-SALESF02', 'TS_WebOps', 'HIsue8&%Gs4#');

if (!$link) {
    die( mssql_get_last_message());
}

$server = 'NEWVSSQL02';
//$server = '10.73.6.133:1435';cardevsql03.corp.domain.com
$link = mssql_connect('NEWVSSQL02', 'EastRosterReader', 'fun2read!');

if (!$link) {
    die( mssql_get_last_message());
}

	//$CI->mssqldb2 = $this->load->database('mssql2', TRUE);
		//$this->mssqldb2=& $CI->mssqldb2;  
		$mssql1="select supervisoreid, supervisorname from [dbo].[EAST_ROSTER] where eid='E101063'";
		echo $mssql1;
		$msquery2 = mssql_query($mssql1);
		echo mssql_num_rows($msquery2);
		if(mssql_num_rows($msquery2)>0){
			while ($row = mssql_fetch_array($msquery2) ){
				echo($row['supervisorname'].", ".$row['supervisoreid']."<br>");

			}
		}
?>