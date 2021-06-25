<?php
ob_start();
define("ROOT_PATH","../");
define("INCLUDES_PATH", ROOT_PATH."includes/");
define("PATH_TO_CLASS", ROOT_PATH."class/");
require(INCLUDES_PATH."spree_init.php");
require("admin_utils.php");
include(INCLUDES_PATH."function.php");
include(PATH_TO_CLASS."ordermaster.php");
include(PATH_TO_CLASS."employeemaster.php");
require 'textlocal.class.php';
$textlocal = new Textlocal('akash.giri.09jul1989@gmail.com', '78e780c7e91baf7204585ba4adb6b80fa5430532');

if($_SESSION['user_id']=='')
{
	header('Location: index.php');
	exit();
}

//echo '<script>alert("'.$_POST['mode'].'");</script>';


if($_POST['mode']=='view')
  disphtml("showData(".$_POST['id'].");");

else if($_POST['mode']=='add' || $_POST['mode']=='edit') 
{
 if($_POST['id'])
   $id=$_POST['id'];
 else
   $id=-1;
 disphtml("saveData($id);");

}

else if($_POST['mode']=="save")
{

    $ordermaster=new ordermaster();
	$ordermaster->showData($_POST['id']);
	  
	$ordermaster->service_type=$_POST['service_type'];
	$ordermaster->service_desc=$_POST['service_desc'];
	$ordermaster->time_slot=$_POST['time_slot'];
	$ordermaster->cust_name=$_POST['cust_name'];
	$ordermaster->cust_phone_no=$_POST['cust_phone_no'];
	$ordermaster->cust_address=$_POST['cust_address'];
	$ordermaster->cust_city=$_POST['cust_city'];
	$ordermaster->cust_area=$_POST['cust_area'];
	$ordermaster->reject_reason=$_POST['reject_reason'];
	$ordermaster->order_date=@date('Y-m-d');
	$ordermaster->service_date=$_POST['service_req_date'];
	$ordermaster->status=$_POST['status'];
	$ordermaster->cust_email=$_POST['cust_email'];
	if($_POST['material_charge']==null)
	{
	$_POST['material_charge']=0;
	}
	if($_POST['labour_charge']==null)
	{
	$_POST['labour_charge']=0;
	}
	if($_POST['discount']==null)
	{
	$_POST['discount']=0;
	}
	if($_POST['quoted']==null)
	{
	$_POST['quoted']=0;
	}
	$ordermaster->material_charge=$_POST['material_charge'];
	$ordermaster->labour_charge=$_POST['labour_charge'];
	$ordermaster->discount=$_POST['discount'];
	$ordermaster->quoted=$_POST['quoted'];
	$ordermaster->assigned_to=$_POST['assigned_to'];
	if($_POST['id']==-1)
	{
		$result=$ordermaster->save(NULL);
		if($result)
		{
		  $GLOBALS['msg']="Insert Successful";
		  disphtml("main();");
		}
		else
		{
		  $GLOBALS['msg']="Insert Failed";
		  disphtml("saveData($id);");
		}
	}

	if($_POST['id']>0)
	{
		$result=$ordermaster->save($_POST['id']);
		if($result)
		{
		  $GLOBALS['msg']="Update Successful";
		  disphtml("main();");
		}
		else
		{
		  $GLOBALS['msg']="Update Failed";
		  //disphtml("saveData(".$_POST['id'].");");
		  disphtml("main();");
		}
	}
	
//sms code

$sql_select="SELECT * from employee_master WHERE id='".$_POST['assigned_to']."'";
	 $qry=mysql_query($sql_select);
	 $data=mysql_fetch_array($qry);
	 $emp_name=$data['name'];  
	 $emp_phone=$data['phone_no'];


if($_POST['status']=='Assigned')
{

$numbers = array($emp_phone);
$sender="TTONGG";
			
$order="TT0000".$_POST['id'];
$name=$_POST['cust_name'];	
$phno=$_POST['cust_phone_no'];
$address=$_POST['cust_address'];
$service="Laptop Repairs";
$city="Mumbai";
$location=$_POST['cust_area'];
$date=$_POST['service_req_date'];
$time=$_POST['time_slot'];
$employee="TT";
$member="No";


$message="Dear User,\n";
$message.="Order No:".$order."\n";
$message.="Name:".$name."\n";
$message.="Phone No:".$phno."\n";
$message.="Address:".$address."\n";
$message.="Service Type:".$service."\n";
$message.="City:".$city."\n";
$message.="Location:".$location."\n";
$message.="Date:".$date."\n";
$message.="Time:".$time."\n";
$message.="Assigned To:".$employee."\n";
$message.="Member:".$member."\n";
		
try {
	$result = $textlocal->sendSms($numbers, $message, $sender);
} catch (Exception $e) {
	die('Error: ' . $e->getMessage());
}

}
//sms code ends

//picked up

if($_POST['status']=='PickedUp')
{
				

//mail code
		
$to = $_POST['cust_email'];
$subject = 'Picked Up Device Details';
$from = 'info@tinggtongg.com';
$bcc="akash.giri.09jul1989@gmail.com,myanjan@gmail.com";
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
	"BCC:".$bcc."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
//message for mail
					$message_email='<!DOCTYPE html>
					
<html>   <body>
<p style="border-style: double;">
<table>
					<tr>
							 <td bgcolor="white" style="padding:20px 30px 80px 30px">
								<table align="center" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;width:100%;max-width:1000px;padding:50px 0 0px 0px">
								   <tbody>
									  <tr>
										<td>
										<img src="http://tinggtongg.com/images/logo.png" style="height:80px; margin-left:-30px;"></td>
									  </tr>
									  <tr>
										 <td>
											<table align="left" border="0" cellpadding="0" cellspacing="0" style="width:100%;padding:0px 0 0 0">
											   <tbody>
											   <tr></tr>
												 <tr>
													 <td style="padding:0 0 0px 0px;font-family:Neris Light,arial;font-size:18px;min-height:auto" width="50%">Hello&nbsp;'.$ordermaster->cust_name.'</td>
												  <td align="right"><b >Order Number: TT0000'.$_POST['id'].'</b></td>
												  </tr>
											   </tbody>
											</table>
											</td>
											
									  </tr>
									  <tr>
										 <td style="padding:10px 0 10px 0">
											<table border="0" cellpadding="0" cellspacing="0" style="margin:30px 0 0px 0" width="100%">
											   <tbody>
												  <tr>
													 <td style="width:100px">
														<hr align="left" color="#EE3A37" size="1px" style="display:inline-block" width="100%">
													 </td>
													 <td style="width:50px;text-align:center;font-family:Roboto,sans-serif">
														<h6 style="display:inline;color:#EE3A37;font-size:18px;padding:0 0px 0 0px">Pick Up Details</h6>
													 </td>
													 <td style="width:100px">
														<hr align="right" color="#EE3A37" size="1px" style="display:inline-block" width="100%">
													 </td>
												  </tr>
											   </tbody>
											</table>
											<form style="font-family:Neris Thin,arial;font-size:15px;font-weight:400;padding:10px 0 20px 20px" target="_blank" onsubmit="try {return window.confirm(&quot;You are submitting information to an external page.\nAre you sure?&quot;);} catch (e) {return false;}">
											   <table border="0">
												  <tbody>
												  <tr>
													<td>Name :</td>
													<td>'.$_POST['cust_name'].'</td>
													</tr>
													<tr>
													<td>Date Picked Up:</td>
													<td>'.$_POST['service_req_date'].'</td>
													</tr>
													<tr>
													<td>Device Picked Up:</td>
													<td>Laptop/Computer</td>
													</tr>
													<tr>
													<td>Device Description:</td>
													<td>'.$_POST['service_desc'].'</td>
													</tr>

												  </tbody>
											   </table>
											</form>
										 </td>
									  </tr>
								   </tbody>
								</table>
								<table align="center" border="0" width="100%">
								   <tbody>
									  <tr>
										 <td align="center">
														<a href="http://www.tinggtongg.com" target="_blank">
														<img style="border-bottom:2px solid #EE3A37;border-bottom:2px solid #EE3A37;text-align:center;float:center" width="100%" src="http://tinggtongg.com/images/powered.png" alt="tinggtongg" class="CToWUd">
														</a>                     
										 </td>
									  </tr>
									  <tr>
										 <td>
											<table align="center">
											   <tbody>
												  <tr>
													 <td>
														<a href="https://twitter.com/tinggtonggindia" target="_blank">
														<img style="width:20px;padding:2px 0 0 0;border:0;display:inline" src="http://tinggtongg.com/images/twitter_tinggtongg.png" alt="Twitter" class="CToWUd">
														</a>
														<a href="https://www.facebook.com/tinggtonggindia" target="_blank">
														<img style="width:20px;padding:2px 0 0 0;border:0;display:inline" src="http://tinggtongg.com/images/facebook_tinggtongg.png" alt="Facebook" class="CToWUd">
														</a>
													 </td>
												  </tr>
											   </tbody>
											</table>
											<p align="center" style="font-family:Roboto,sans-serif;color:black;font-weight:300;font-size:15px">
											   <i>Corporate Office: A-601, Prithvi Enclave 1, Siddharth Nagar, Borivali East, Mumbai, 400066.</i>
											   <br>
											   <i>Contact Us on 9004514467 Or Mail Us on info@tinggtongg.com</i>
											</p>
											<p align="center" style="font-family:Roboto,sans-serif;color:black;font-weight:300;font-size:15px">
											   <i>Thanks for using our service!</i>
											</p>
										 </td>
									  </tr>
								   </tbody>
								</table>
							 </td>
						  </tr>
						  </table>
						  </p>
					   </body>
					</html>';

					 //message ends
					 
					
					// Sending email
					
					 try {
					
						$result = mail($to, $subject, $message_email, $headers);
						
						} catch (Exception $e) {
						die('Error: ' . $e->getMessage());
						}

//mail code ends		
					
		}

//picked up mail


	
	
}

else if($_POST['mode']=='delete' && isset($_POST['id']))	
{
  $ordermaster=new ordermaster();
  
  
  $result=$ordermaster->deleteData($_POST['id']);
  if($result)
	{
	  $GLOBALS['msg']="Delete Successful";
	}
	else
	{
	  $GLOBALS['msg']="Delete Failed";
	}
	disphtml("main();");
}

else    disphtml("main();");

ob_end_flush();

function main()
  {
	$ordermaster = new ordermaster();
	$employeemaster = new employeemaster();

	if($_POST[hold_page] > 0)
				$GLOBALS[start] = $_POST[hold_page];
	if($_REQUEST['mode']=="refresh"){
		$member_row = $_POST;
	}
	if ($_POST[search_mode]=="ALPHA")
	{
	$member_sql="SELECT *, STR_TO_DATE(service_date, '%d-%m-%Y') sd  FROM order_master where cust_city like '$_POST[txt_alpha]%'"  . "  ORDER BY sd desc LIMIT 50";
	$row=$ordermaster->search("select count(*) FROM order_master where cust_city like '$_POST[txt_alpha]%'"  . "  id desc LIMIT 50");
	$count=$row[0][0];
	}

	if ($_POST[search_mode]=="SEARCH")
	{
	 $member_sql="SELECT *, STR_TO_DATE(service_date, '%d-%m-%Y') sd FROM order_master ";
	 $member_row="select count(*) FROM order_master LIMIT 50";

	 if($_POST['search_type']=='cust_city')
	 {
	  $member_sql .="where cust_city like '".$_POST['txt_search']."%' ";
	  //$member_row .=" where cust_city like '".$_POST[txt_search]."%'" . "  ORDER BY id desc ";
	  }

	 if($_POST['search_type']=='cust_area')
	 {
	  $member_sql .="where cust_area like '".$_POST['txt_search']."%' ";
	  //$member_row .=" where cust_area like '".$_POST[txt_search]."%'" . "  ORDER BY id desc ";
	  }
	
	if($_POST['search_type']=='assigned_to')
	 {
	 
	 $assigned_to=0;
	 if($_POST['txt_search']=='Vinod')
	 {
	 $assigned_to=99;
	 }
	 if($_POST['txt_search']=='Kapinjal')
	 {
	 $assigned_to=100;
	 } 
	 
	 if($_POST['txt_search']=='Suraj')
	 {
	 $assigned_to=101;
	 }
	 
	 if($_POST['txt_search']=='Vikas')
	 {
	 $assigned_to=104;
	 } 
	 
	 if($_POST['txt_search']=='Tinggtongg')
	 {
	 $assigned_to=105;
	 } 
	 
	 
	 
	  $member_sql .="where lower(assigned_to) like lower('".$assigned_to."%') ";
	  //$member_row .=" where cust_area like '".$_POST[txt_search]."%'" . "  ORDER BY id desc ";
	  }  
	  
	 if($_POST['search_type']=='service_date')
	 {
	  $member_sql .="where service_date like '".$_POST['txt_search']."%' ";
	  //$member_row .=" where service_date like '".$_POST[txt_search]."%'" . "  ORDER BY id desc ";
	  }
	  
	 if($_POST['search_type']=='status')
	 {
	  $member_sql .="where status like '".$_POST['txt_search']."%' ";
	  //$member_row .=" where status like '".$_POST[txt_search]."%'" . "  ORDER BY id desc ";
	  }

	$member_sql .="  ORDER BY sd desc LIMIT 50";
	$row=$ordermaster->search($member_row);
	$count=$row[0][0];
	}

	if ($_POST[search_mode]=="")
	{
	//$result=$storemaster->row;

	$member_sql="SELECT *, STR_TO_DATE(service_date, '%d-%m-%Y') sd FROM order_master  ORDER BY sd desc LIMIT 50";
	$row=$ordermaster->search("select count(*) FROM order_master  ORDER BY id desc LIMIT 50");
	$count=$row[0][0];
	}

	$result=$ordermaster->search($member_sql);
?>
<style>
.tooltip {
    position: relative;
    display: inline-block;
    
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 800px;
	margin-top: -100px;
    background-color: #ffe87d;
    color: black;
    text-align: center;
    border-radius: 0px;
    padding: 5px 0;
	border-style: solid;
    border-width: 2px;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>

<form name="frmSearch" method="post" action="<?=$_SERVER['PHP_SELF']?>">
  <input type="hidden" name="search_mode" value="<?=$_POST['search_mode']?>">
  <input type="hidden" name="txt_alpha" value="<?=$_POST['txt_alpha']?>">
  <BR>
  <table width="98%" align="center" border="0" class="border" cellpadding="5" cellspacing="1">
    <tr class="TDHEAD">
      <td colspan="6">Search Panel</td>
    </tr>
    <tr class="content">
      <td colspan="3"></td>
      <td class="text_normal">Search By</td>
      <td>:</td>
      <td><select name="search_type" class="inplogin">
          <option value="">Select One</option>
          <option value="cust_city"<?=$_POST['search_type']=='cust_city' ? ' selected' : '';?>>Customer City</option>
          <option value="cust_area"<?=$_POST['search_type']=='cust_area' ? ' selected' : '';?>>Customer Area</option>
          <option value="status"<?=$_POST['search_type']=='status' ? ' selected' : '';?>>Status</option>
          <option value="service_date"<?=$_POST['search_type']=='service_date' ? ' selected' : '';?>>Service Date</option>
		  <option value="assigned_to"<?=$_POST['search_type']=='assigned_to' ? ' selected' : '';?>>Assigned To</option>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input name="txt_search" type="text" class="textbox" value="<?=stripslashes($_REQUEST['txt_search']);?>">
        &nbsp;&nbsp;
        <input type="button" class="inplogin" onClick="search_text()" value="Search">
        &nbsp;&nbsp;&nbsp;
        <input name="btnShowAll" type="button" class="inplogin" value="Show All" onClick="javascript:show_all();">
      </td>
    </tr>
    <!--<tr>
      <td colspan="6" align="center"><? DisplayAlphabet(); ?></td>
    </tr>-->
  </table>
  <br>
</form>
<script language="JavaScript">
function show_all()
{
	document.frmSearch.search_mode.value = "";	
	document.frmSearch.txt_search.value="";
	document.frmSearch.txt_alpha.value="";
	document.frmSearch.search_type.value="";
	document.frmSearch.submit();	
}

function search_text()
{
	if(document.frmSearch.search_type.value=="")
	{
		alert("Please Select A Search Type");
		return false;
	}

	if(document.frmSearch.txt_search.value.search(/\S/)==-1)
	{
		alert("Please Enter Search Criteria");
		return false;
	}
	document.frmSearch.search_mode.value = "SEARCH";
	document.frmSearch.submit();
}

function search_alpha(alpha)
{
	document.frmSearch.search_mode.value = "ALPHA";
	document.frmSearch.txt_search.value = '';
	document.frmSearch.txt_alpha.value = alpha;
	document.frmSearch.submit();
}	
</script>
<script language="javascript">
function addData()
{
	document.frm_opts.mode.value='add';
	document.frm_opts.submit();
}

function viewData(id)
{
	document.frm_opts.mode.value='view';
	document.frm_opts.id.value=id;
	document.frm_opts.submit();
}

function editData(id)
{
    document.frm_opts.mode.value='edit';
	document.frm_opts.id.value=id;
	document.frm_opts.submit();
}

function deleteData(id)
{
	var UserResp = window.confirm("Are you sure to remove this?");
	if( UserResp == true )
	{
		document.frm_opts.mode.value='delete';
		document.frm_opts.id.value=id;
		document.frm_opts.submit();
	}
}
</script>

<table width="98%" align="center" border="0" cellpadding="5" cellspacing="1">
  <tr>
    <td width="18%" align="center" class="ErrorText">Total records:<? echo $count;?></td>
    <td width="70%" align="center" class="ErrorText"><?php echo $GLOBALS['msg'];?></td>
    <!--<td width="5%" align="right"><a href="javascript:document.frm_opts.submit();" title=" Refresh the page"><img border="0" src="images/icon_reload.gif"></a></td>-->
    <!--<td align="right" width="5%"><a href="javascript:addData();" title=" Add spree"><img src="images/plus_icon.gif" border="0"></a></td>-->
  </tr>
</table>


<!--Add form-->
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="frmSave">
<table width="98%" align="center" border="0" cellpadding="5" cellspacing="1">
  <tr>
    <td width="10%" align="left"><input name="cust_name" placeholder="Name" type="text"  style="width:90%;height: 40px;outline: none;border-radius: 10px;text-align: center;"></td>
    <td width="10%" align="left"><input name="cust_phone_no" placeholder="Phone No(10 Digits) "  type="text"  style="width:90%;height: 40px;outline: none;border-radius: 10px;text-align: center;;"></td>
	<td width="10%" align="left">
	            <select name="time_slot" style="width:90%;height: 40px;border-radius: 10px;outline: none;text-align: center;">
				<option value="">Time Slot</option>
              <?php 
			    $sql = "select * from time_slot_master";
				$qry = mysql_query($sql);
				while($row=mysql_fetch_array($qry))
				{
			  ?>
                <option value="<?=$row['timeslot']?>" <?php echo $ordermaster->time_slot==$row['timeslot']?' selected':'';?>><?=$row['timeslot']?></option>
                <?php
                  }
				?>
              </select>

	
	</td>
	<td width="10%" align="left">
	        <input name="service_req_date"  placeholder="Date" id="demo2" type="text"  style="width:80%;height: 40px; outline: none;border-radius: 10px;text-align: center;">
            <img src="images2/cal.gif" onClick="javascript:NewCssCal('demo2','ddMMyyyy')" style="cursor:pointer"/>
			<script src="datetimepicker_css.js"></script>

	</td>
	<td width="10%" align="left">
	<input type="hidden" name="mode" value="save">
	<input type="text" name="cust_address" placeholder="Address" style="width:90%;height: 40px;outline: none;border-radius: 10px;text-align: center;">
	<input type="hidden" name="cust_city" value="Mumbai">
	<input type="hidden" name="cust_area" value="Mumbai">
	<input type="hidden" name="cust_email" value="">
	<input type="hidden" name="status" value="Unassigned">
	<input type="hidden" name="reject_reason" value="">
	<input type="hidden" name="assigned_to" value="">
	<input type="hidden" name="material_charge" value="">
	<input type="hidden" name="labour_charge" value="">
	<input type="hidden" name="quoted" value="">
	<input type="hidden" name="discount" value="">
	<input type="hidden" name="service_desc" value="">
	<input type="hidden" name="service_type" value="Laptop Repairs">
	<input type="hidden" name="id" value="-1" >
	</td>
	<td width="10%" align="left">
	<input name="submit" type="submit" value="Add" style="height: 40px;outline: none;width: 90%;border-radius:  10px;background-color: rgb(31, 226, 194);">
	</td>
  </tr>
</table>
</form>
<!--Add form-->


<table id="myTable" width="98%" align="center" border="0" cellpadding="5" cellspacing="2"  class="tablesorter">
<thead> 
  <tr>
	<th width="3%" align="left" bgcolor="#c4859d"><div align="left"><strong>Edit</strong><i class="fa fa-fw fa-sort"></i></div></th>
    <th width="2%" align="left" bgcolor="#c4859d"><div align="left"><strong>SL</strong><i class="fa fa-fw fa-sort"></i></div></th>
	<th width="20%"  align="left" bgcolor="#c4859d"><div align="left"><strong>Name<i class="fa fa-fw fa-sort"></i></strong></div></th>
	<th width="10%"  align="left" bgcolor="#c4859d"><div align="left"><strong>Phone No</strong><i class="fa fa-fw fa-sort"></i></div></th>
	<th width="30%"  align="left" bgcolor="#c4859d"><div align="left"><strong>Date:TimeSlot</strong><i class="fa fa-fw fa-sort"></i></div></th>
	<!--<th width="15%"  align="left" bgcolor="#c4859d"><div align="left"><strong>Area</strong><i class="fa fa-fw fa-sort"></i></div></th>-->
    <th width="20%"  align="left" bgcolor="#c4859d"><div align="left"><strong>Status</strong><i class="fa fa-fw fa-sort"></i></div></th>
    
    <th width="2%" align="left" bgcolor="#c4859d"><div align="left"><strong>Delete</strong><i class="fa fa-fw fa-sort"></i></div></th>
  </tr>
</thead> 
<tbody>
  <?php
	$i=0;
	$cnt=$GLOBALS[start]+1;
	while($result[$i]!=NULL)
	{
	?>
	
  <tr onMouseOver="this.bgColor='<?=SCROLL_COLOR;?>'" onMouseOut="this.bgColor=''" height="50">
  <!--Checkbox-->
<td valign="top" align="left" style="border: 1px solid #dddddd;">
	<div class="tooltip">
	<a title="Edit spree Details"><img src="images/edit_icon.gif" border="0"></a>
<span class="tooltiptext">
  	  
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="frmSave">
  <input type="hidden" name="mode" value="save">
  <input name="id" type="hidden" value="<?php echo stripslashes($result[$i]['id']);?>" >
  <!--<table width="90%" align="center" border="0" cellpadding="5" cellspacing="2" >
    <tr align="center">
      <td class="ErrorText"><?=$GLOBALS['msg']?></td>
    </tr>
  </table>-->
  <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="border">
    <tr>
      <td align="center"><table width="100%" align="center" cellpadding="5" cellspacing="2">
          <tr class="TDHEAD">
            <td colspan="6" style="padding-left:10px;" class="text_main_header"><?=$current_mode?>
              Order Information</td>
          </tr>
          <tr>
            <td colspan="3" align="right"><b><font color="#FF0000">All * marked fields are mandatory</font></b></td>
          </tr>
          
          
            <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Service Type</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            <select name="service_type" class="inplogin" style="width:200px;">
			<option value="Laptop Repairs">Laptop Repairs</option>
              <?php 
			    $sql = "select * from service_master";
				$qry = mysql_query($sql);
				while($row=mysql_fetch_array($qry))
				{
			  ?>
                <option value="<?=$row['service_title']?>" <?php echo $ordermaster->service_type==$row['service_title']?' selected':'';?>><?=$row['service_title']?></option>
                <?php
                  }
				?>
              </select>
            </td>
          
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Customer Name</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="cust_name" type="text" class="inplogin" value="<?php echo stripslashes($result[$i]['cust_name']);?>" style="width:200px;">
            </td>
          </tr>
           <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Cutomer Phone No</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            <input name="cust_phone_no" type="text" class="inplogin" value="<?php echo stripslashes($result[$i]['cust_phone_no']);?>" style="width:200px;">
            </td>
          
		  <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Service Required On</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            
            <input name="service_req_date"  id="demo2" type="text" class="inplogin" value="<?php echo stripslashes($result[$i]['service_date']);?>" style="width:200px;">
             <img src="images2/cal.gif" onClick="javascript:NewCssCal('demo2','ddMMyyyy')" style="cursor:pointer"/>
			<script src="datetimepicker_css.js"></script>
            </td>
          </tr>
		  
		  
		  
           <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Time Slot</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            <select name="time_slot" class="inplogin" style="width:200px;">
              <?php 
			    $sql = "select * from time_slot_master";
				$qry = mysql_query($sql);
				while($row=mysql_fetch_array($qry))
				{
			  ?>
                <option value="<?=$row['timeslot']?>" <?php echo $result[$i]['time_slot']==$row['timeslot']?' selected':'';?>><?=$row['timeslot']?></option>
                <?php
                  }
				?>
              </select>
            </td>
          
            <td width="30%" align="left" valign="top" class="tbllogin">Service Description</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
			<!--<input  name="service_desc" type="text" class="inplogin" value="<?php //echo $ordermaster->service_desc;?>" style="width:200px;">-->
			<textarea name="service_desc" cols="26" rows="6"><?php echo stripslashes($result[$i]['service_desc']);?></textarea>
            </td>
          </tr>
		  
		  
           <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Cutomer City</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
              <select name="cust_city" class="inplogin" onchange="javascript:showData(this.value)" style="width:200px;">
                 <option value="Mumbai">Mumbai</option>
              <?php
                $sql = "select * from city_master";
				$qry = mysql_query($sql);
				while($res=mysql_fetch_array($qry))
				{
			  ?>
                <option value="<?=$res['city_name']?>" <?php if($res['city_name']==$ordermaster->cust_city){echo 'selected';}?>><?=$res['city_name']?></option>
              <?php
                 }
			   ?>
              </select>
            </td>
          
		  <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Cutomer Area</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top" id="t1">
             <select name="cust_area" class="inplogin" style="width:200px;">
                  <option value="Mumbai">Mumbai</option>
                  <?php
                     $sql = "select * from area_master";
                     $qry = mysql_query($sql);
                     while($rs=mysql_fetch_array($qry))
                     {
                  ?>
                  <option value="<?=$rs['area_name']?>" <?php if($rs['area_name']==$result[$i]['cust_area']){echo 'selected';}?>><?=$rs['area_name']?></option>
                  <?php
                    }
                  ?>
              </select>
            </td>
             <td width="60%" align="left" valign="top" id="txtHint" style="display:none;">
             </td>
          </tr>
          
          <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Cutomer Address</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            <textarea name="cust_address" cols="26" rows="6"><?php echo stripslashes($result[$i]['cust_address']);?></textarea>
            </td>

			<td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Email ID</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="cust_email" type="text" class="inplogin" value="<?php echo stripslashes($result[$i]['email']);?>" style="width:200px;">
            </td>
          </tr>
		  
		  <tr> 
            <td class="tbllogin" align="left" valign="top"><font color="#FF0000">*</font>Assigne To</td>
			<td align="center" valign="top">:</td>
            <td valign="top"> 
				<select type="text" id="assigned_to" name="assigned_to" class="form-control"  placeholder="">
				<option value="99" <?php if(99==$result[$i]['assigned_to']){echo 'selected';}?>>Vinod</option>
				<option value="100" <?php if(100==$result[$i]['assigned_to']){echo 'selected';}?>>Kapinjal</option>
				<option value="101" <?php if(101==$result[$i]['assigned_to']){echo 'selected';}?>>Suraj</option>
				<option value="104" <?php if(104==$result[$i]['assigned_to']){echo 'selected';}?>>Vikas</option>
				<option value="105" <?php if(105==$result[$i]['assigned_to']){echo 'selected';}?>>Tinggtongg</option>
				</select>
			</td>				

            <td class="tbllogin" align="left" valign="top"><font color="#FF0000">*</font>Status</td>
            <td align="center" valign="top">:</td>
            <td valign="top"> 
            <select name="status" class="inplogin" id="s1" onchange="javascript:change();" style="width:200px;">
                <option value="Assigned" <?php echo $result[$i]['status']=='Assigned'?' selected':'';?>>Assigned</option>
                <option value="Rejected"<?php echo $result[$i]['status']=='Rejected'?' selected':'';?>>Rejected</option>
                <option value="Unassigned"<?php echo $result[$i]['status']==''?' selected':'';?>>Unassigned</option>
				<option value="Unassigned"<?php echo $result[$i]['status']=='Unassigned'?' selected':'';?>>Unassigned</option>
                <option value="Completed"<?php echo $result[$i]['status']=='Completed'?' selected':'';?>>Completed</option>
                <option value="Visited"<?php echo $result[$i]['status']=='Visited'?' selected':'';?>>Visited</option>
                <option value="PickedUp"<?php echo $result[$i]['status']=='PickedUp'?' selected':'';?>>PickedUp</option>
                <option value="FollowUp"<?php echo $result[$i]['status']=='FollowUp'?' selected':'';?>>FollowUp</option>
                <option value="Reassigned"<?php echo $result[$i]['status']=='Reassigned'?' selected':'';?>>Reassigned</option>
                <option value="Confirmed"<?php echo $result[$i]['status']=='Confirmed'?' selected':'';?>>Confirmed</option>
                <option value="Quoted"<?php echo $result[$i]['status']=='Quoted'?' selected':'';?>>Quoted</option>
              </select>
              </td>
          </tr>

		  
		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Material Charge</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="material_charge" type="text" class="inplogin" value="<?php echo stripslashes($result[$i]['material_charge']);?>" style="width:200px;">
            </td>

            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Labour Charge</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="labour_charge" type="text" class="inplogin" value="<?php echo stripslashes($result[$i]['labour_charge']);?>" style="width:200px;">
            </td>
          </tr>
		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Quoted</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="quoted" type="text" class="inplogin" value="<?php echo stripslashes($result[$i]['Quoted']);?>" style="width:200px;">
            </td>

            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Discount</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="discount" type="text" class="inplogin" value="<?php echo stripslashes($result[$i]['discount']);?>" style="width:200px;">
            </td>
          </tr>

		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"></td>
            <td width="3%" align="center" valign="top" class="tbllogin"></td>
            <td width="60%" align="left" valign="top">
            <textarea  style="display:none;" name="reject_reason" cols="26" rows="6" id="r1" disabled="disabled"><?php echo $result[$i]['reject_reason'];?></textarea>
            </td>
          </tr>
       
          <tr>

            <td class="point_txt" colspan=6 align=center  >
			<input name="submit" type="submit" class="inplogin" style="height: 30px;width: 100px;border-radius: 10px; background-color:rgb(31, 226, 194);" value="<?php echo $result[$i]['id']==-1?'Add':'Update'?>">
              &nbsp;
              <!--<input name="button" type="button" class="inplogin" onClick="javascript:window.location='admin_order_master.php';"  value="Cancel">-->
            </td>
          </tr>
		  <tr>
            <td colspan="3" align="right"><b><font color="#FF0000">Click outside to exit</font></b></td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</form>	  
	  
 </span>


	
	</div>
	</td>
	
	
  <!--Checkbox-->
  
  
    <td valign="top" align="center" style="border: 1px solid #dddddd;">
    <div class="tooltip">
	<?php if($result[$i]['status']=='Unassigned') {?>
    <a href="admin_assign_master.php?order=<?=$result[$i]['id']?>&service=<?=$result[$i]['service_type']?>&city=<?=$result[$i]['cust_city']?>&area=<?=$result[$i]['cust_area']?>&time=<?=$result[$i]['time_slot']?>&dt=<?=$result[$i]['service_date']?>" style="text-decoration:none;">
	<font size=4 color="#079e58"><?php echo "TT0000".$result[$i]['id'];?></font></a>
    <?php } else {?>
    <font size=3><?php echo "TT0000".$result[$i]['id'];?></font>
    <?php }
	
$assigned_to_row="";

if(99==$result[$i]['assigned_to'])
{
$assigned_to_row=":Vinod";
}	
if(100==$result[$i]['assigned_to'])
{
$assigned_to_row=":Kapinjal";
}	
if(101==$result[$i]['assigned_to'])
{
$assigned_to_row=":Suraj";
}	
if(104==$result[$i]['assigned_to'])
{
$assigned_to_row=":Vikas";
}	
if(105==$result[$i]['assigned_to'])
{
$assigned_to_row=":Tinggtongg";
}	

	
	?>
</div>
    </td>
	
	
	<td valign="top" align="left" style="border: 1px solid #dddddd;"><font size=3><?php echo stripslashes($result[$i]['cust_name']);?> </font></td>
	<td valign="top" align="left" style="border: 1px solid #dddddd;"><font size=3><?php echo stripslashes($result[$i]['cust_phone_no']);?> </font></td>
	<td valign="top" align="left" style="border: 1px solid #dddddd;"><font size=3><?php echo stripslashes($result[$i]['service_date']);?>:<?php echo stripslashes($result[$i]['time_slot']);?> </font></td>
	<!--<td valign="top" align="left" style="border: 1px solid #dddddd;"><font size=3><?php //echo stripslashes($result[$i]['cust_area']);?> </font></td>-->
    <td valign="top" align="left" style="border: 1px solid #dddddd;"><font size=3><?php echo stripslashes($result[$i]['status']);?> <b><?=$assigned_to_row?></b> </font></td>
    <!--<td valign="top" align="left" style="border: 1px solid #dddddd;"><a href="javascript:editData( <?php //echo $result[$i]['id'];?>);" title="Edit spree Details"><img src="images/edit_icon.gif" border="0"></a></td>-->
    <td align="left" valign="top" style="border: 1px solid #dddddd;"><a href="javascript:deleteData( <?php echo $result[$i]['id'];?>);" title="Delete spree Details"><img name="xx" src="images/delete_icon.gif" border="0"></a></td>
  </tr>

  <?php 
		$i++;
	} // end of while loop
	?>
	  </tbody>
</table>
<?php 
	if($count>0 && $count > $GLOBALS['show'])	
	{
?>
<table width="90%" align="center" border="0" cellpadding="5" cellspacing="2">
  <tr>
    <td><? pagination($count,"frm_opts");?></td>
  </tr>
</table>
<?php
	}
?>
<br>
<form name="frm_opts" action="<?=$_SERVER['PHP_SELF'];?>" method="post" >
  <input type="hidden" name="mode" value="">
  <input type="hidden" name="id" value="">
  <input type="hidden" name="pageNo" value="<?=$_POST['pageNo']?>">
  <input type="hidden" name="member_id" value="">
  <input type="hidden" name="search_type" value="<?=$_POST['search_type']?>">
  <input type="hidden" name="search_mode" value="<?=$_POST['search_mode']?>">
  <input type="hidden" name="txt_alpha" value="<?=$_POST['txt_alpha']?>">
  <input type="hidden" name="txt_search" value="<?=$_POST['txt_search']?>">
  <input type="hidden" name="hold_page" value="">
</form>
<?php

 } //End of main()

function saveData($id)
{ 
	if($id)
    {
	$ordermaster = new ordermaster();
	$ordermaster->showData($id);
	}		
?>
<script language="JavaScript">
function change()
{		
	if(document.getElementById('s1').value=="Rejected")
	{
		document.getElementById('r1').disabled = false;
	}
	else
	{
	   document.getElementById('r1').disabled =true;
	}
	
}
</script>
<script language="javascript">
function showData(str) {
//alert(str);
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			   document.getElementById("t1").style.display="none";
				document.getElementById("txtHint").style.display="block";
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","http://tinggtongg.com/admin/proccess.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="frmSave">
  <input type="hidden" name="mode" value="save">
  <input type="hidden" name="id" value="<?php echo $ordermaster->id;?>" >
  <table width="90%" align="center" border="0" cellpadding="5" cellspacing="2" >
    <tr align="center">
      <td class="ErrorText"><?=$GLOBALS['msg']?></td>
    </tr>
  </table>
  <table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" class="border">
    <tr>
      <td align="center"><table width="100%" align="center" cellpadding="5" cellspacing="2">
          <tr class="TDHEAD">
            <td colspan="3" style="padding-left:10px;" class="text_main_header"><?=$current_mode?>
              Order Information</td>
          </tr>
          <tr>
            <td colspan="3" align="right"><b><font color="#FF0000">All * marked fields are mandatory</font></b></td>
          </tr>
          
            <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Service Type</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            <select name="service_type" class="inplogin" style="width:200px;">
			<option value="Laptop Repairs">Laptop Repairs</option>
              <?php 
			    $sql = "select * from service_master";
				$qry = mysql_query($sql);
				while($row=mysql_fetch_array($qry))
				{
			  ?>
                <option value="<?=$row['service_title']?>" <?php echo $ordermaster->service_type==$row['service_title']?' selected':'';?>><?=$row['service_title']?></option>
                <?php
                  }
				?>
              </select>
            </td>
			</tr>
          
		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Customer Name</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="cust_name" type="text" class="inplogin" value="<?php echo $ordermaster->cust_name;?>" style="width:200px;">
            </td>
          </tr>
          
		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Cutomer Phone No</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            <input name="cust_phone_no" type="text" class="inplogin" value="<?php echo $ordermaster->cust_phone_no;?>" style="width:200px;">
            </td>
          </tr>
		
		<tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Service Required On</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            <input name="service_req_date"  id="demo2" type="text" class="inplogin" value="<?php echo $ordermaster->service_date;?>" style="width:200px;">
             <img src="images2/cal.gif" onClick="javascript:NewCssCal('demo2','ddMMyyyy')" style="cursor:pointer"/>
			<script src="datetimepicker_css.js"></script>
            </td>
          </tr>
          
		  
           <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Time Slot</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            <select name="time_slot" class="inplogin" style="width:200px;">
              <?php 
			    $sql = "select * from time_slot_master";
				$qry = mysql_query($sql);
				while($row=mysql_fetch_array($qry))
				{
			  ?>
                <option value="<?=$row['timeslot']?>" <?php echo $ordermaster->time_slot==$row['timeslot']?' selected':'';?>><?=$row['timeslot']?></option>
                <?php
                  }
				?>
              </select>
            </td>
			</tr>
          <tr>
            <td width="30%" align="left" valign="top" class="tbllogin">Service Description</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
			<textarea name="service_desc" cols="26" rows="6"><?php echo $ordermaster->service_desc;?></textarea>
            </td>
          </tr>
		  
          
           <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Cutomer City</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
              <select name="cust_city" class="inplogin" onchange="javascript:showData(this.value)" style="width:200px;">
                 <option value="Mumbai">Mumbai</option>
              <?php
                $sql = "select * from city_master";
				$qry = mysql_query($sql);
				while($res=mysql_fetch_array($qry))
				{
			  ?>
                <option value="<?=$res['city_name']?>" <?php if($res['city_name']==$ordermaster->cust_city){echo 'selected';}?>><?=$res['city_name']?></option>
              <?php
                 }
			   ?>
              </select>
            </td>
          </tr>
          
           <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Cutomer Area</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top" id="t1">
             <select name="cust_area" class="inplogin" style="width:200px;">
                  <option value="Mumbai">Mumbai</option>
                  <?php
                     $sql = "select * from area_master";
                     $qry = mysql_query($sql);
                     while($rs=mysql_fetch_array($qry))
                     {
                  ?>
                  <option value="<?=$rs['area_name']?>" <?php if($rs['area_name']==$ordermaster->cust_area){echo 'selected';}?>><?=$rs['area_name']?></option>
                  <?php
                    }
                  ?>
              </select>
            </td>
             <td width="60%" align="left" valign="top" id="txtHint" style="display:none;">
             </td>
          </tr>
          
          <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Cutomer Address</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top">
            <textarea name="cust_address" cols="26" rows="6"><?php echo $ordermaster->cust_address;?></textarea>
            </td>
          </tr>
          
		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Email ID</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="cust_email" type="text" class="inplogin" value="<?php echo $ordermaster->cust_email;?>" style="width:200px;">
            </td>
          </tr>
		  
		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Material Charge</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="material_charge" type="text" class="inplogin" value="<?php echo $ordermaster->material_charge;?>" style="width:200px;">
            </td>
          </tr>
		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Labour Charge</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="labour_charge" type="text" class="inplogin" value="<?php echo $ordermaster->labour_charge;?>" style="width:200px;">
            </td>
          </tr>
		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Quoted</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="quoted" type="text" class="inplogin" value="<?php echo $ordermaster->quoted;?>" style="width:200px;">
            </td>
          </tr>
		  
		  <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Discount</td>
            <td width="3%" align="center" valign="top" class="tbllogin">:</td>
            <td width="60%" align="left" valign="top"><input name="discount" type="text" class="inplogin" value="<?php echo $ordermaster->discount;?>" style="width:200px;">
            </td>
          </tr>

          <tr> 
            <td class="tbllogin" align="left" valign="top"><font color="#FF0000">*</font>Assigne To</td>
			<td align="center" valign="top">:</td>
            <td valign="top"> 
				<select type="text" id="assigned_to" name="assigned_to" class="form-control"  placeholder="">
				<option value="99" <?php if(99==$ordermaster->assigned_to){echo 'selected';}?>>Vinod</option>
				<option value="100" <?php if(100==$ordermaster->assigned_to){echo 'selected';}?>>Kapinjal</option>
				<option value="101" <?php if(101==$ordermaster->assigned_to){echo 'selected';}?>>Suraj</option>
				<option value="104" <?php if(104==$ordermaster->assigned_to){echo 'selected';}?>>Vikas</option>
				<option value="105" <?php if(105==$ordermaster->assigned_to){echo 'selected';}?>>Tinggtongg</option>
				</select>
			</td>				
			</tr>

		  
          <tr> 
            <td class="tbllogin" align="left" valign="top"><font color="#FF0000">*</font>Status</td>
            <td align="center" valign="top">:</td>
            <td valign="top"> 
            <select name="status" class="inplogin" id="s1" onchange="javascript:change();" style="width:200px;">
                <option value="Assigned" <?php echo $ordermaster->status=='Assigned'?' selected':'';?>>Assigned</option>
                <option value="Rejected"<?php echo $ordermaster->status=='Rejected'?' selected':'';?>>Rejected</option>
                <option value="Unassigned"<?php echo $ordermaster->status==''?' selected':'';?>>Unassigned</option>
                <option value="Completed"<?php echo $ordermaster->status=='Completed'?' selected':'';?>>Completed</option>
                <option value="Visited"<?php echo $ordermaster->status=='Visited'?' selected':'';?>>Visited</option>
                <option value="PickedUp"<?php echo $ordermaster->status=='PickedUp'?' selected':'';?>>PickedUp</option>
                <option value="FollowUp"<?php echo $ordermaster->status=='FollowUp'?' selected':'';?>>FollowUp</option>
                <option value="Reassigned"<?php echo $ordermaster->status=='Reassigned'?' selected':'';?>>Reassigned</option>
                <option value="Confirmed"<?php echo $ordermaster->status=='Confirmed'?' selected':'';?>>Confirmed</option>
                <option value="Quoted"<?php echo $ordermaster->status=='Quoted'?' selected':'';?>>Quoted</option>
              </select>
              </td>
          </tr>
          <tr><td colspan="3">&nbsp;</td></tr>

           <tr>
            <td width="30%" align="left" valign="top" class="tbllogin"><font color="#FF0000">*</font> Reject Reason</td>
            <td width="3%" align="center" valign="top" class="tbllogin"></td>
            <td width="60%" align="left" valign="top">
            <textarea name="reject_reason" cols="26" rows="6" id="r1" disabled="disabled"><?php echo $ordermaster->reject_reason;?></textarea>
            </td>
          </tr>
       
          <tr>
            <td height="32" >&nbsp;</td>
            <td >&nbsp;</td>
            <td class="point_txt"><input name="submit" type="submit" class="inplogin" value="<?php echo $ordermaster->id==-1?'Add':'Update'?>">
              &nbsp;
              <input name="button" type="button" class="inplogin" onClick="javascript:window.location='admin_order_master.php';"  value="Cancel">
            </td>
          </tr>
        </table>
        </td>
    </tr>
  </table>
</form>
<?php 
 } /////////////// End of function editData()
?>
