<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('main_page');	

	}
	
	public function login_page()
	{
		$this->load->view('login');
	}
	
	public function login()
	{
		if($_REQUEST['EID'] == '' || $_REQUEST['Password'] == ''){ echo '0'; }
		if(LDAP_authUser($_REQUEST['EID'],$_REQUEST['Password']) != 0){
			$this->session->set_userdata('LoggedIn',true);		
			$this->session->set_userdata('EID',$_REQUEST['EID']);
			$this->session->set_userdata('Password',$_REQUEST['Password']);
			$this->session->set_userdata('Email',getEmail($_REQUEST['EID'],$_REQUEST['Password']));
			$title=getTitle($_REQUEST['EID'],$_REQUEST['Password']);
			if(($title=="Web Developer")||($title=="Mgr, Customer Care")||($title=="Supv, Customer Care")||($title=="Lead, Technical Support Rep")||($title=="Lead, Customer Care")||($title=="Lead, Customer Care Rep"))
				$this->session->set_userdata('Admin',$title );
			echo "1";
			
		}else{
			$this->session->set_userdata('LoggedIn',false);
			echo "0";
		}

	}
	
	public function logout()
	{
		
		$this->session->set_userdata('LoggedIn',false);
		$this->session->unset_userdata('Admin');
		$this->session->unset_userdata('EID');
		$this->session->unset_userdata('Password');
		
		header("location:http://compliments.domain.com");

	}

	public function giveaway($g)
	{
		$date=date('Y-m-d H:i:s');
		$sql= "select * from ".$this->config->item('ma')." where entry_deadline>='".$date."' and id='".$g."'";//
		$query = $this->db->query($sql);
		if ($query->num_rows() == 1){
			$data['gid']=$g;
			$data['table']=$this->config->item('mu');
			$this->load->view('entry_form',$data);	
		}
		else {
			$data['error']="The giveaway you are looking for has ended.";
			$this->load->view('main_page', $data);
		}	
		
	}
	public function admin_compliment($g)
	{
		if($g==0){
			$data['table']=$this->config->item('ma');
			$data['gid']='';
			$this->load->view('entry_form',$data);	
		}
		else{
			$date=date('Y-m-d H:i:s');
			$sql= "select * from ".$this->config->item('ma')." where id='".$g."'";//".$date."
			$query = $this->db->query($sql);
			if ($query->num_rows() == 1){
				$data['gid']=$g;
				$data['table']=$this->config->item('ma');
				$this->load->view('entry_form',$data);	
			}
		}	
	}

	public function search($g,$type)
	{
		
		if($g!='0'){
			$data['eid']=$g;
			$data['type']=$type;
			$data['table']=$this->config->item('ma');
			$this->load->view('results',$data);	
	
		}
		else{
			$this->load->view('search');	
		}	
	}
	
	public function results()
	{
			
		$where=" where ";
		$url='?';
		if(@$_REQUEST['rep_eid']!=''){
			$where.= "rep_eid='".$_REQUEST['rep_eid']."' and ";
			$url.="rep_eid=".$_REQUEST['rep_eid']."&";
		}
		if(@$_REQUEST['sup_eid']!=''){
			$where.= "sup_eid='".$_REQUEST['sup_eid']."' and ";
			$url.="sup_eid=".$_REQUEST['sup_eid']."&";
		}
		if(@$_REQUEST['city']!=''){
			$where.= "city='".$_REQUEST['city']."' and ";
			$url.="city=".$_REQUEST['city']."&";
		}
		if(@$_REQUEST['compliment']!=''){
			$where.= "compliment like '%".$_REQUEST['compliment']."%' and ";
			$url.="compliment=".$_REQUEST['compliment']."&";
		}
			
		$datetime=mktime(0,0,0,date('m'),date('d'),date('Y'));
		if((@$_REQUEST['fday']!='')||(@$_REQUEST['tday']!='')||(@$_REQUEST['fmonth']!='')||(@$_REQUEST['tmonth']!='')){
				$date_from = $_REQUEST['fyear']."-".$_REQUEST['fmonth']."-".$_REQUEST['fday'];
				$date_to = $_REQUEST['tyear']."-".$_REQUEST['tmonth']."-".$_REQUEST['tday'];
				$where = $where." date >= '$date_from%' and date <= '$date_to%' and ";
				$url.="date_to=".$date_to."&"."date_from=".$date_from."&";
		}
		else{
			if($_REQUEST['time']=='day'){
				$date_from=date('Y-m-d',$datetime-86400);
			}
			else if($_REQUEST['time']=='week'){
				$date_from=date('Y-m-d',$datetime+604800);
			}
			else if($_REQUEST['time']=='month'){
				$date_from=date('Y-m-d',$datetime-2678400);
			}
			else if($_REQUEST['time']=='6months'){
				$date_from=date('Y-m-d',$datetime-15811200);
			}
			else if($_REQUEST['time']=='year'){
				$date_from=date('Y-m-d',$datetime-31536000);
			}
			else{
				$date_from=date('Y-m-d',$datetime-604800);
			}
			
			$where.= " date >='".$date_from."' and "; 
			$url.="date_from=".$date_from."&";
		}
		
		$where .= " rep_eid !=''";
		$url.="end";
		$compliment_sql="select * from ". $this->config->item('ma')." ".$where ." order by sup_eid desc, rep_eid asc";
	
		$query = $this->db->query($compliment_sql);
		if($query->num_rows()>0) {
			echo('<br><a href="http://compliments.domain.com/php/search_results.php'.$url.'">Download Search Results to Excel</a><br>');
			echo ('<br><font size="+1" color="#000066">Your Results:</font><br>');
			$old_rep='';
			$old_sup='';
			foreach ($query->result() as $row){
				$temp=explode(" ",$row->date);
				$temp1=explode("-",$temp[0]);
				$nicedate=$temp1[1]."-".$temp1[2]."-".$temp1[0];
				
				if(($old_sup!=$row->sup_eid))
					echo "<br><font size='+1'><strong>Supervisor: </strong><a href='".$this->config->item("base_url")."main/search/".$row->sup_eid."/sup'>".$row->sup_fn." ".$row->sup_ln."</a></font><br>";
					
					
				if($old_rep!=$row->rep_eid)
					echo "<br><strong><a href='".$this->config->item("base_url")."main/search/".$row->rep_eid."/rep'>".$row->rep_fn." ".$row->rep_ln."</a></strong><br>";
				
				if(($row->admin_eid==$this->session->userdata("EID"))||($this->session->userdata("EID")=='E101063')||($this->session->userdata("EID")=='E045606')&&($this->session->userdata("EID")!=''))
					$edit="<a href='".$this->config->item("base_url")."main/edit/". $this->config->item('ma')."/".$row->id."'>Edit this compliment.</a>";
				else
					$edit='';
								
				echo ("<strong>".$nicedate."</strong>&nbsp;-&nbsp;".$row->compliment." - ".$row->acct_no." - " . $row->city ."  ".$edit."<br>");	
				$this->load->helper('cookie');
				$_COOKIE["query"]=$compliment_sql;
				$old_rep=$row->rep_eid;
				$old_sup=$row->sup_eid;
			}		
			//fclose($fp);
		}
	}
	
	public function edit($type, $id=0)
	{
		
		if($type=='emails'){
			$data['table']=$this->config->item('at');
			$this->load->view('edit',$data);	
	
		}
		else{
		
			$data['id']=$id;
			$data['table']=$this->config->item('ma');
			$this->load->view('edit',$data);
		}	
	}

	public function delete($table, $id)
	{
			$this->db->delete($table,array('id' => $id));
			header("location:http://compliments.domain.com");
	}
	
	public function eidlookupbyemail($email)
	{
		$ds = LDAPConnect('albldap','Qazwsx12');
		$Perms = 3;
		$dn = 'OU=Company Divisions,DC=corp,DC=domain,DC=com';					// Set the base DN
		$justthese = array("cn", "displayname","department","division");	

		$lookfor='(mail='.$email.'*)';
		$filter='(&(objectCategory=*)(objectClass=*) '.$lookfor.' (cn=E*))';			// Create the filter (more Detal = faster)
		$sr=ldap_search($ds, $dn, $filter,$justthese);
		$info = @ldap_get_entries($ds, $sr);
			for($x=0;$x < count($info)-1;$x++){
				$arr[$x]['eid']=$info[$x]['cn'][0];
				$arr[$x]['name']=$info[$x]['displayname'][0];
				$arr[$x]['department']=$info[$x]['department'][0];
				$arr[$x]['division']=$info[$x]['division'][0];
			}
			echo json_encode($arr);
		
	}
	
	public function account_lookup($house,$custno)
	{
		$CI->mssqldb = $this->load->database('mssql', TRUE);
		$this->mssqldb=& $CI->mssqldb;  
		
		$mssql1="select cufnm, culnm, holin1, holin2, holin3, holin4 from [TSTarget_CAR].[dbo].[CAR_HOSTPF], [TSTarget_CAR].[dbo].[CAR_CUMSTPF] where CUHO#=HONUM and CUNROV=HONROV and HONUM=".$house." and hocus=".$custno;
		$msquery = $this->mssqldb->query($mssql1);
		if($msquery->num_rows()==1){
			foreach ($msquery->result() as $row){
				$temp=explode(",",$row->holin3);
				echo($row->cufnm." ".$row->culnm."<br>".$row->holin1."<br>".$row->holin2."<br>".$row->holin3."<br>".$row->holin4."<br><input type='hidden' name='city' value='".$temp[0]."'>");
			
			}
		}
		else
			echo "No Account Found. Please verify your entry.";
	}

	public function supervisor_lookup($emp_eid)
	{
		$CI->mssqldb2 = $this->load->database('mssql2', TRUE);
		$this->mssqldb2=& $CI->mssqldb2;  
		$mssql1="select supervisoreid, supervisorname from [dbo].[EAST_ROSTER] where eid='".$emp_eid."'";
		$msquery2 = $this->mssqldb2->query($mssql1);
		$x=0;
		if($msquery2->num_rows()>0){
			foreach ($msquery2->result() as $row){	
				$arr[$x]['eid']=$row->supervisoreid;
				$arr[$x]['name']=$row->supervisorname;
				$x++;
			}
		}
		echo json_encode($arr);
	
		
	}
  //*************************************\\
 //     	EDIT FUNCTION		  \\
//									       \\	
	public function edit_sql($table,$id)
	{
		$date=date('Y-m-d');
		if($table== $this->config->item('ma')){
			$empf=getOthersFName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['rep_eid']);
			$empl=getOthersLName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['rep_eid']);
			$supf=getOthersFName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['sup_eid']);
			$supl=getOthersLName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['sup_eid']);
			$data= array('admin_eid'=>$this->session->userdata('EID'),'email'=>$this->session->userdata('Email'), 'date'=>$date, 'acct_no'=>$_REQUEST['house']."-".$_REQUEST['customer'], 'rep_eid'=>$_REQUEST['rep_eid'], 'rep_fn'=>$empf, 'rep_ln'=>$empl, 'sup_eid'=>$_REQUEST['sup_eid'], 'sup_fn'=>$supf, 'sup_ln'=>$supl, 	'compliment'=>$_REQUEST['compliment']);
			$this->db->where('id', $id);
		
		}
		
		if($table== $this->config->item('at')){
			$data= array('email'=>@$_REQUEST['email'],'notify'=>@$_REQUEST['notify'],'weekly'=>@$_REQUEST['weekly']);
	
			$this->db->where('id', $id);
		}
		
		$this->db->update($table, $data); 
		echo $this->db->affected_rows();
	
	}
	
	public function insert_sql($table)
	{
		$date=date('Y-m-d');
		if($table== $this->config->item('at')){
			$data= array('email'=>@$_REQUEST['email'],'notify'=>@$_REQUEST['notify'],'weekly'=>@$_REQUEST['weekly']);

		}
		if($table== $this->config->item('ma')){
			$empf=getOthersFName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['rep_eid']);
			$empl=getOthersLName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['rep_eid']);
			$supf=getOthersFName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['sup_eid']);
			$supl=getOthersLName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['sup_eid']);
			$data= array('admin_eid'=>$this->session->userdata('EID'),'email'=>$this->session->userdata('Email'), 'date'=>$date, 'acct_no'=>$_REQUEST['house']."-".$_REQUEST['customer'], 'rep_eid'=>$_REQUEST['rep_eid'], 'rep_fn'=>$empf, 'rep_ln'=>$empl, 'sup_eid'=>$_REQUEST['sup_eid'], 'sup_fn'=>$supf, 'sup_ln'=>$supl, 	'compliment'=>$_REQUEST['compliment']);
		
		}
		
		$str= $this->db->insert_string($table, $data); 
		$query = $this->db->query($str);
		echo $this->db->affected_rows();
	}
	
	public function insert_mailer($table)
	{
	
		$date=date('Y-m-d H:i:s');
		$nice_date=date('m/d/Y')." at " .date('g:i a');
		if((@$_REQUEST['bk_city']!='')&&(@$_REQUEST['city']=='')){
			$use_city=$_REQUEST['bk_city'];
			}
		else {
			$use_city=$_REQUEST['city'];
			}
		if($table== $this->config->item('ma')){
			$empf=getOthersFName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['rep_eid']);
			$empl=getOthersLName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['rep_eid']);
			$supf=getOthersFName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['sup_eid']);
			$supl=getOthersLName($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['sup_eid']);
			$data= array('admin_eid'=>$this->session->userdata('EID'),'email'=>$this->session->userdata('Email'), 'date'=>$date, 'acct_no'=>$_REQUEST['house']."-".$_REQUEST['customer'],'method'=>$_REQUEST['method'], 'rep_eid'=>$_REQUEST['rep_eid'], 'rep_fn'=>$empf, 'rep_ln'=>$empl, 'sup_eid'=>$_REQUEST['sup_eid'], 'sup_fn'=>$supf, 'sup_ln'=>$supl, 'city'=>$use_city, 'compliment'=>$_REQUEST['compliment']);
			
			$str = $this->db->insert_string($table, $data); 
			//echo $str;
			$query = @$this->db->query($str);
			$subject="Compliment entered about you.";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From:compliments@domain.com[do_not_reply@domain.com]' . "\r\n" .
						'Reply-To: do_not_reply@domain.com[do_not_reply@domain.com]' . "\r\n" .
						'X-Mailer: PHP/' . phpversion();
			
			$to=getOthersEmail($this->session->userdata('EID'),$this->session->userdata('Password'),$_REQUEST['rep_eid']);//
			
			$body='
			<html>
			<head>
				<title>A new compliment entered about you.</title>
			</head>
			<body>
			Congratulations!
			<p>'.$_REQUEST['compliment'].' was entered for '.$empf.' '.$empl.' on '.$nice_date.'. Please visit <a href="http://compliments.domain.com">http://compliments.domain.com</a> to view all the details.</p>
			';
			$body .='		
			</body>
			</html>';
			mail($to, $subject, $body, $headers);
			
			
			$subject2="New compliment entered";					
				
			$body2='
			<html>
			<head>
				<title>New Compliment Entered</title>
			</head>
			<body>
			<p>'.$_REQUEST['compliment'].' was entered on '.$nice_date.'. Please visit <a href="http://compliments.domain.com">http://compliments.domain.com</a> to view all the details.</p>
			';
			$body2 .='		
			</body>
			</html>';
			$select="select email from emails where notify='Y'";
			$query2 = @$this->db->query($select);
			foreach ($query2->result() as $row2)
			{
				$to2=$row2->email;//"tauni.daub@domain.com"
				mail($to2, $subject2, $body2, $headers);
				
			}
			mail("tauni.daub@domain.com",$subject2, $body2, $headers);
			
		}
			
		//echo "1";
	}
	
	
	public function send_mail()
	{
		mail($this->session->userdata("To"), $this->session->userdata("Subject"), $this->session->userdata("Body"), $this->session->userdata("Headers"));
		header('location:http://compliments.domain.com/index.php/');
	}
	
	public function get_upload($id)
	{
		$data['ID']=$id;
		$this->load->view('upload_form',$data);	
	}
		
	public function encrypt($text) 
	{ 
		return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SALT, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))); 
	} 
	
	public function decrypt($text) 
	{ 
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SALT, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
	} 

	public function upload_document()
	{
		$date_added = date("Y-m-d");
		$this->load->library('ftp');
	}
	

}	
/* End of file main.php */
/* Location: ./application/controllers/main.php */

?>