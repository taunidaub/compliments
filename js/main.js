// JavaScript Document


function login(){	

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
 // console.log('entering Submission AJAX');
  new Form.Request(myForm, myResult, {
	onSuccess: function(responseText,responseXML){ 
		if(responseText.get('html') === '1'){
			window.location.href="http://compliments.domain.com";
		}
	}
  });	

}

function logout() {
	new Request({
		url: baseURL + 'main/logout',
		onSuccess: function (responseText) {
			//console.log('Response: ' +responseText);
			if(responseText === '1'){
				window.location.href="http://compliments.domain.com";
			}
		}
	}).send();
}	

function refreshdiv(divId){ 
	//alert(divId);
	document.getElementById(divId).innerHTML="";

	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById(divId).innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET",baseURL+"main/"+divId+"/",true);
	xmlhttp.send();	
}

function verify_account(){
	if((document.getElementById("customer").value.length>1)&&(document.getElementById("house").value!=''))
	{
		var lookup1=document.getElementById('house').value;
		var lookup2=document.getElementById('customer').value;
		
		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
		else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		
		xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var answer=xmlhttp.responseText;
					document.getElementById("account_info").style.visibility="visible";
					document.getElementById("account_info").innerHTML=answer;
				}
			}
			xmlhttp.open("GET",baseURL+"main/account_lookup/"+lookup1+"/"+lookup2,true);
			xmlhttp.send();

	}
}
	
function updated(){

	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET",baseURL+"main/updated/",true);
	xmlhttp.send();
}

function showResult(str)
{
	if (str.length>0)
	{
		new_rows();
	}
	function new_rows(){
		//var selected=
		var myElement = document.getElementById('livesearch');
		//alert('scripts/forms.php'+form_load);
		var myHTMLRequest = new Request({
		url: baseURL+"main/livesearch/"+str,
		method: 'get',
		onRequest: function() {
			myElement.innerHTML='';
		},
		onComplete: function(responseText) {
			var new_rows = new Element('div', {
				'html': responseText
			});
			// inject new fields at bottom
			myElement.innerHTML='';
			new_rows.inject(myElement,'bottom');
			
			//    remove loading image
		}
		}).send();
	}
}

function insert(table)
{
	
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
  //console.log('entering Submission AJAX');
  new Form.Request(myForm, myResult, {
	onSuccess: function(responseText,responseXML){ 
		if(responseText.get('html') === '1'){
			window.location.reload(true);
		}
	}
  });
}

function edit(table)
{
	
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
  //console.log('entering Submission AJAX');
  new Form.Request(myForm, myResult, {
    requestOptions: {
      'spinnerTarget': myForm
    },
	onSuccess: function(responseText,responseXML){ 
	 console.log(responseText.get('html'));
		if(responseText.get('html') === '1'){
			window.location.reload(true);
		}
	}
  });
}

function new_request(table) {

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
  console.log('entering Submission AJAX');
  new Form.Request(myForm, myResult, {
    requestOptions: {
      'spinnerTarget': myForm
    },
	onSuccess: function(responseText,responseXML){ 
	// console.log(responseText.get('html'));
		if(responseText.get('html') === '1'){
			window.location.reload(true);
		}
	}
  });

}

function edit_request(table, id) {

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
  console.log('entering Submission AJAX');
  new Form.Request(myForm, myResult, {
    requestOptions: {
      'spinnerTarget': myForm
    },
	onSuccess: function(responseText,responseXML){ 
	// console.log(responseText.get('html'));
		if(responseText.get('html') === '1'){
			window.location.reload(true);
		}
	}
  });

}

function delete_item(table, id) {
	if (confirm("Are you sure you want to delete this item?")) { 
		 var myRequest = new Request({
			url: baseURL+"main/delete/"+table+"/"+id,
			method: 'get',
			onSuccess:function(responseText,responseXML){ 
				if(responseText === '1'){
					window.location.reload(true);
					}
			}
		 }).send();
	}

}


function eid_lookup(email,eid){
	var myElement = document.getElementById(eid);
	document.getElementById(eid).options.length = 0;
	var lookup=document.getElementById(email).value;
	var returned_eid='';
	if(lookup.length>3){
		var temp=lookup.split('@');
		var options = new Array();
		var myRequest = new Request.JSON({
			url: baseURL+"main/eidlookupbyemail/"+temp[0],
			method: 'get',
			onRequest: function(){
			},
			onSuccess: function(responseJSON){
			if(responseJSON.length>1){
				responseJSON.each (function (value){
					myElement.add(new Option(value.name+" "+value.department+" in "+value.division,value.eid));
					returned_eid=value.eid;
					});
			}
			else
				responseJSON.each (function (value){
					myElement.add(new Option(value.name+" "+value.department+" in "+value.division,value.eid, true, true));
					returned_eid=value.eid;
					});
				
				get_sup_from_list(returned_eid);
			},
			onFailure: function(){
				myElement.set('value', 'Sorry, your request failed :(');
			}
		}).send();
	}
	
}

function get_sup_from_list(eid){
	var myElement = document.getElementById('sup_eid');
	document.getElementById('sup_select').style.display="";
	var lookup=eid;
	var options = new Array();
		var myRequest = new Request.JSON({
			url: baseURL+"main/supervisor_lookup/"+lookup,
			method: 'get',
			onRequest: function(){
			
			},
			onSuccess: function(responseJSON){
			if(responseJSON.length>1){
					responseJSON.each (function (value){
					myElement.add(new Option(value.name,value.eid));
					});
			}
			else
				responseJSON.each (function (value){
					myElement.add(new Option(value.name,value.eid, true, true));
					});
			},
			onFailure: function(){
				myElement.set('value', 'Sorry, your request failed :(');
			}
		}).send();
	
}

function get_sup_from_dropdown(sel){
	var myElement = document.getElementById('sup_eid');
	document.getElementById('sup_select').style.display="";
	var lookup=sel.options[sel.selectedIndex].value;
	var options = new Array();
		var myRequest = new Request.JSON({
			url: baseURL+"main/supervisor_lookup/"+lookup,
			method: 'get',
			onRequest: function(){
				
			},
			onSuccess: function(responseJSON){
			if(responseJSON.length>1){
					responseJSON.each (function (value){
					myElement.add(new Option(value.name+" "+value.department+" in "+value.division,value.eid));
					});
			}
			else
				responseJSON.each (function (value){
					myElement.add(new Option(value.name+" "+value.department+" in "+value.division,value.eid, true, true));
					});
			},
			onFailure: function(){
				myElement.set('value', 'Sorry, your request failed :(');
			}
		}).send();
	
}

function eid_lookup2() {
	if((document.getElementById("behalf_email").value!='Email Address')&&(document.getElementById("behalf_email").value!=''))
	{
		var lookup=document.getElementById("behalf_email").value;
		temp=lookup.split('@');
		
		if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
		else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
		xmlhttp.onreadystatechange=function()
			{
				if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					var answer=xmlhttp.responseText;
					document.getElementById("behalf_eid").value=answer;
				}
			}
			xmlhttp.open("GET",baseURL+"main/eidlookupbyemail/"+temp[0]+"/",true);
			xmlhttp.send();

	}
	else
	alert("Please complete the email address field to use this functionality.");

}		



function pad(num, size) {
    var s = "000000000" + num;
    return s.substr(s.length-size);
}
function display(field){	
	if(document.getElementById(field).style.display == 'none')
		document.getElementById(field).style.display = "";
	else if(document.getElementById(field).style.display == "")
		document.getElementById(field).style.display = 'none';
}

function login_page(){	
	var url=baseURL + 'main/login_page/';
	window.location.href=url;
}

function edit_compliment(id){	
	var url=baseURL + 'main/admin_compliment/'+id;
	window.location.href=url;
}
function add_compliment(){	
	var url=baseURL + 'main/admin_compliment/0';
	window.location.href=url;
}
function view_admin_compliment(id){	
	var url=baseURL + 'main/view/'+id;
	window.location.href=url;
}

function gohome(){	
	window.location.href=baseURL;
}
function send_mail(){	
	var url=baseURL + 'main/send_mail/';
	window.location.href=url;
}

function select_winners(id){	
	var url=baseURL + 'main/select_winners/'+id;
	window.location.href=url;
}
function verify_winners(id){	
	var url=baseURL + 'main/verify_winners/'+id;
	window.location.href=url;
}

function search_compliments(){	
	
  // The elements used.
  var myForm = document.id('myForm2'),
    myResult = document.id('myResult2');

  // Labels over the inputs.
  myForm.getElements('[type=text], textarea,[type=password]').each(function(el){
    new OverText(el);
  });

  new Form.Validator.Inline(myForm);
  new Form.Request(myForm, myResult, {
	onSuccess: function(responseText,responseXML){ 
		document.getElementById('myResult2').innerHTML=responseText.get('html');
	}
  });	
	
}
