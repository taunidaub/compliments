<?PHP
include_once ("/var/www/phpincludes/db.php");
include_once ("/var/www/phpincludes/config.php");
conn2('compliments'); 

$today_mktime=mktime(0,0,date('Y'),date('m'),date('d'));
$week_ago=$today_mktime-604800; 
$date = date('Y-m-d',$week_ago);
$time="week";
$date2=Date('Y') ."-01-01";
$date3=Date('Y') ."-".date('m')."-01";

$sql4="select * from new_compliments where date > '$date%'";
$result4= mysql_query($sql4) or die(mysql_error());
$new=@mysql_num_rows($result4);

$msg="<table border='1'><tr bgcolor='9999CC'><td colspan='5'> There were ". $new ." new Compliments this week.</td></tr>";
$msg=$msg."<tr bgcolor='CC99CC'><td>Supervisor</td><td>Compliments</td><td>Points</td><td>Monthly</td><td>Yearly</td></tr>";
$msg=$msg."<ol>";

$head= "There were ". $new ." new Compliments this week.\n\n";
		$headers .= "From: Compliments Database <do_not_reply@domain.com>\n";
		$headers .= "X-Sender: <do_not_reply@domain.com>\n";
		$headers .= "X-Mailer: PHP\n";
		$headers .= "X-Priority: 3\n";
		$headers .= "Return-Path: <do_not_reply@domain.com>\n";
		//Uncomment this to send html format
		$headers .= "Content-Type: text/html; charset=iso-8859-1\n";

$sql2="select count(*) as total, sup_fn, sup_ln, sup_eid from new_compliments where date > '$date%' group by sup_eid";
$result2= mysql_query($sql2);
$i=0;

while ($row = mysql_fetch_assoc($result2)) {

	$sql3="select method from new_compliments where  date > '$date%' and sup_eid ='".$row['sup_eid']."'";
	$result3= mysql_query($sql3);
	$total=0;
	while ($mth = mysql_fetch_assoc($result3)) {
		$method=$mth['method'];
		if($method=='Email')
			$total+=1;
		else if($method=='Telephone')
			$total+=1;
		else if($method=='Letter')
			$total+=3;
	}	
	$ysql=mysql_query("select count(*) from new_compliments where date > '$date2%' and sup_eid ='".$row['sup_eid']."'");
	$yearly=mysql_result($ysql,0,0);

	$msql=mysql_query("select count(*) from new_compliments where date > '$date3%' and sup_eid ='".$row['sup_eid']."'");
	$monthly=mysql_result($msql,0,0);
		
	
	$msg=$msg."<tr><td>".$row['sup_fn']." ".$row['sup_ln']."</td><td>".$row['total']."</td><td>".$total."</td><td>".$monthly."</td><td>".$yearly."</td></tr>";
	$i++;
	}
	$msg.="</table>";
	
	

$query1="SELECT * FROM emails where notify='Y'";
$result1= mysql_query($query1);
$email_list='';
echo("$msg<br>");	
while ($user_row = mysql_fetch_assoc($result1)) {
	$email_list	.=	$user_row['email'].";  ";
	$email=$user_row['email'];
	mail($email,$head,$msg,$headers);	
}
$msg.="\n
".$email_list;	
mail('tauni.daub@domain.com',$head,$msg,$headers);	

?>
