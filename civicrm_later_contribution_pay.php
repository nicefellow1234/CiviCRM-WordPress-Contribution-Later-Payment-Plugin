<?php
ob_start();
/*
Plugin Name: CiviCRM Contribution Later Payment
Plugin URI: http://www.stackoverflow.com/cv/nicefellow1234
Description: This plugin helps in paying due contribution payments through a web form by entering Contribution ID.
Author: Umair Shah Yousafzai
Version: 1.0
Author URI: http://www.huntedhunter.com/mycv/
*/

function my_plugin_activate()
{
	// DO your activation task.
	
	 /* $post_id = wp_insert_post( array(
                    'post_status' => 'publish',
                    'post_type' => 'page',
                    'post_title' => 'Contribution Later Payment Page',
                    'post_content' => 'Pay Your Contribution Payment Now.'
                ) );


	if ($post_id) 
	{
	error_log("New Page Added.");
    } */
	
}
	
	register_activation_hook(__FILE__,"my_plugin_activate");
	

	function cl_pay() {
		
		
		
	
		
				
		if ($_POST['cl_check_email']) {
		
			$contact_email = $_POST["contact_email"];
		
			global $wpdb;
			$sql = $wpdb->prepare("SELECT * FROM civicrm_contact WHERE sort_name = %s", $contact_email);
			$results = $wpdb->get_results($sql);
			$count = count($results);
			$contact_id = $results[0]->id;
		
			if (!$count > 0 ) {
		
				$sql = $wpdb->prepare("SELECT * FROM civicrm_email WHERE email = %s", $contact_email);
				$results = $wpdb->get_results($sql);
				$count = count($results);
				$contact_id = $results[0]->contact_id;
			}		
				
		}
		
		if ($_POST['cl_check_phone']) {
		
			$contact_phone = $_POST["contact_phone"];
		
			global $wpdb;
			$sql = $wpdb->prepare("SELECT * FROM civicrm_phone WHERE phone = %s", $contact_phone);
			$results = $wpdb->get_results($sql);
			$count = count($results);
			$contact_id = $results[0]->contact_id;
		
		}
		
		if ($_POST['cl_check_full_name']) {
		
			$first_name = $_POST["first_name"];
			$last_name = $_POST["last_name"];
				
			$full_name = $first_name." ".$last_name;
				
			global $wpdb;
			$sql = $wpdb->prepare("SELECT * FROM civicrm_contact WHERE display_name = %s", $full_name);
			$results = $wpdb->get_results($sql);
			$count = count($results);
			$contact_id = $results[0]->id;
	
			//echo "<pre>";
			//print_r($results);
			//echo "</pre>";
				
		}
		
		if (isset($_POST['cl_check_full_name']) || isset($_POST['cl_check_phone']) || isset($_POST['cl_check_email'])) {
		
		$sql = $wpdb->prepare("SELECT * FROM civicrm_contribution WHERE contact_id = %s", $contact_id);
		$results = $wpdb->get_results($sql);
		$count = count($results);
		
		
		
	//	echo "<pre>";
	//	print_r($results);
	//	echo "<pre>";
		
		if ($count > 0) {
			$display_check = "none";
			$display_amount = "block";
		}
		
		}
		
		if ($_POST['cl_pay']) {
			
			$display_check = "none";
			$display_amount = "none";
			
			$paypal_email="nicefellow1234@gmail.com";
			$skrill_email = "nicefellow1234@gmail.com";
			
			}
		

		
	
		
		?>
		
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
   $('#choice').change(function () {
      if ( this.value === 'option_1' ) {
          $("#option_1").show("slow");
          $("#option_2").hide("slow");
          $("#option_3").hide("slow");
      }
      else if ( this.value === 'option_2' ) {
        $("#option_2").show("slow");
        $("#option_1").hide("slow");
        $("#option_3").hide("slow");
      }
        else if ( this.value === 'option_3' ) {
            $("#option_3").show("slow");
            $("#option_1").hide("slow");
            $("#option_2").hide("slow");
      } else if ( this.value === 'not_specified' ) {
        $("#option_1").hide("slow");
        $("#option_2").hide("slow");
        $("#option_3").hide("slow");
      }
   });
});

  
</script>
    

<style>

html {
	height: 100%;
	/*Image only BG fallback*/
	background: url('http://thecodeplayer.com/uploads/media/gs.png');
	/*background = gradient + image pattern combo*/
	background: 
		linear-gradient(rgba(196, 102, 0, 0.2), rgba(155, 89, 182, 0.2)), 
		url('http://thecodeplayer.com/uploads/media/gs.png');
}

body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, 
pre, form, fieldset, input, textarea, p, blockquote, th, td { 
  padding:0;
  margin:0;}

fieldset, img {border:0}

ol, ul, li {list-style:none}

:focus {outline:none}

body,
input,
textarea,
select {
  font-family: 'Open Sans', sans-serif;
  font-size: 16px;
  color: #4c4c4c;
}

p {
  font-size: 13px;
  width: 370px;
  display: inline-block;
  margin-left: 18px;
}
h1.testboxh1 {
  font-size: 32px;
  font-weight: 300;
  color: #4c4c4c;
  text-align: center;
  padding-top: 10px;
  margin-bottom: 10px;
}

html{
  background-color: #ffffff;
}

.testbox {
  margin: 20px auto;
  width: 455px; 
  -webkit-border-radius: 8px/7px; 
  -moz-border-radius: 8px/7px; 
  border-radius: 8px/7px; 
  background-color: #ebebeb; 
  -webkit-box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
  -moz-box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
  box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
  border: solid 1px #cbc9c9;
}

input[type=radio] {
  visibility: hidden;
}

form{
  margin: 0 30px;
text-align:center;
}

label.radio {
	cursor: pointer;
  text-indent: 35px;
  overflow: visible;
  display: inline-block;
  position: relative;
  margin-bottom: 15px;
}

label.radio:before {
  background: #3a57af;
  content:'';
  position: absolute;
  top:2px;
  left: 0;
  width: 20px;
  height: 20px;
  border-radius: 100%;
}

label.radio:after {
	opacity: 0;
	content: '';
	position: absolute;
	width: 0.5em;
	height: 0.30em;
	background: transparent;
	top: 7.5px;
	left: 4.5px;
	border: 3px solid #ffffff;
	border-top: none;
	border-right: none;

	-webkit-transform: rotate(-45deg);
	-moz-transform: rotate(-45deg);
	-o-transform: rotate(-45deg);
	-ms-transform: rotate(-45deg);
	transform: rotate(-45deg);
}

input[type=radio]:checked + label:after {
	opacity: 1;
}

hr{
  color: #a9a9a9;
}

input[type=text],input[type=password],select {
text-align:center;
  width: 200px; 
  height: 39px; 
  -webkit-border-radius: 0px 4px 4px 0px/5px 5px 4px 4px; 
  -moz-border-radius: 0px 4px 4px 0px/0px 0px 4px 4px; 
  border-radius: 0px 4px 4px 0px/5px 5px 4px 4px; 
  background-color: #fff; 
  -webkit-box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  -moz-box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  border: solid 1px #cbc9c9;
  margin-left: -5px;
  margin-top: 13px; 
  padding-left: 10px;
}

input[type=password]{
  margin-bottom: 25px;
}

#icon {
  width: 30px;
height:20px;
  background-color: #3a57af;
  padding: 8px 0px 8px 15px;
  margin-left: 15px;
  margin-top: -10px;
  -webkit-border-radius: 4px 0px 0px 4px; 
  -moz-border-radius: 4px 0px 0px 4px; 
  border-radius: 4px 0px 0px 4px;
  color: white;
  -webkit-box-shadow: 1px 2px 5px rgba(0,0,0,.09);
  -moz-box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
  border: solid 0px #cbc9c9;
}

.gender {
  margin-left: 30px;
  margin-bottom: 30px;
}

.accounttype{
  margin-left: 8px;
  margin-top: 20px;
}

input.button {
text-align:center;
  font-size: 14px;
  font-weight: 600;
  color: white;
padding : 8px 30px 8px 30px;
  text-decoration: none;
  -webkit-border-radius: 5px; 
  -moz-border-radius: 5px; 
  border-radius: 5px; 
  background-color: #3a57af; 
  -webkit-box-shadow: 0 3px rgba(58,87,175,.75); 
  -moz-box-shadow: 0 3px rgba(58,87,175,.75); 
  box-shadow: 0 3px rgba(58,87,175,.75);
  transition: all 0.1s linear 0s; 


}

input.button:hover {
  top: 3px;
  background-color:#2e458b;
  -webkit-box-shadow: none; 
  -moz-box-shadow: none; 
  box-shadow: none;
  
}


</style>

</br></br></br></br>
<div class="testbox">
  <h1 class="testboxh1">Pay Due Contribution Pay</h1>

<div class="pay_check" style="display:<?php if (!isset($display_check)) {echo "block";} else {echo $display_check; }?>;">
  <form action="" method="post" >
    <!---<div class="accounttype">
      <input type="radio" value="None" id="radioOne" name="account" checked/>
      <label for="radioOne" class="radio" chec>Personal</label>
      <input type="radio" value="None" id="radioTwo" name="account" />
      <label for="radioTwo" class="radio">Company</label>
    </div> --->
    <center><h3>::Search By::</h3></center>
      <select name="choice" id="choice">
    <option value="not_specified">Not Specified</option>
  <option value="option_1">Contact Email</option>
  <option value="option_2">Contact Phone</option>
  <option value="option_3">Full Name</option>
  </select>
  </br></br>
    <div id="option_1" style="display:none;">
    <center><h3 style="padding-top: 10px;">::Enter Contact Email::</h3></center>
     <form action="" method="post" >
    <input type="text" name="contact_email" placeholder="Contact Email" style="width:250px;"></br>
     </br> <input type="submit" name="cl_check_email" class="button" value="Check">
     </form>
    </div>
    <div id="option_2" style="display:none;">
    <center><h3 style="padding-top: 10px;">::Enter Contact Phone No::</h3></center>
     <form action="" method="post" >
<input type="text" name="contact_phone" placeholder="Contact Phone No" style="width:250px;"> </br>
 </br> <input type="submit" name="cl_check_phone" class="button" value="Check">
     </form>
    </div>
      <div id="option_3" style="display:none;">
       <form action="" method="post" >
    <center><h3 style="padding-top: 10px;">::Enter Full Name::</h3></center>
    <input type="text" name="first_name" placeholder="First Name">
    <input type="text" name="last_name" placeholder="Last Name"></br>
     </br> <input type="submit" name="cl_check_full_name" class="button" value="Check">
     </form>
    </div>
  
  </br></br>
    
<!-- <label id="icon" for="cl_id"><i class="fa fa-tag "  style="padding-right: 13px;"></i></label>
  <input type="text" name="cl_id" id="cl_id" placeholder="Contribution ID" required/></br> -->
   
  
</div>

<div class="cl_pay" style="text-align:center;display:<?php if (!isset($display_amount)) {echo "none";} else {echo $display_amount; }?>;">
    
    
    
      <hr>
    
    <p>Note : The Page Will Be Reloaded Automatically In Next 20 Seconds If You Don't Select A Due Payment To Pay That.</p>   </br></br>
      <?php for ($x=0;$x <= $count;$x++)
   
      {
      	
      	$payment_status = $results[$x]->contribution_status_id;
      	
      	$payment_type = $results[$x]->financial_type_id;
      	
      	if ($payment_status == "2") {
      	
      	?>
  <form action="" method="post" style="display: inline;" >
  <label id="icon" for="cl_pay" style="border-radius:4px;padding-right: 40px;padding-left: 40px;background-color:#422252;"><i class="fa fa-usd " style="">
   <strong><?php echo $results[$x]->total_amount; ?></strong></i></label>
    <input type="hidden" name="amount" value="<?php echo $results[$x]->total_amount; ?>">
     <input type="hidden" name="payment_type" value="<?php echo $payment_type; ?>">
    <input type="submit" name="cl_pay" class="button" value="Pay">
  </form>
  </br>  </br>
  
  <meta http-equiv="refresh" content="20">
  
  <?php

      	} elseif ($payment_status == "1") { ?>
      	
      	  <form action="" method="post" style="display: inline;" >
  <label id="icon" for="cl_pay" style="border-radius:4px;padding-right: 40px;padding-left: 40px;background-color:#422252;"><i class="fa fa-usd " style="">
   <strong><?php echo $results[$x]->total_amount; ?></strong></i></label>
    <input type="submit" name="cl_pay" class="button" disabled value="Paid">
  </form>
  </br>  </br>
  
    <meta http-equiv="refresh" content="20">
      	
     <?php  		
      	}
      	
      	
      	
      	} ?>
  
  
</div>

<?php if (isset($paypal_email) && isset($skrill_email)) { ?>

</br></br>
<center>
 <label id="icon" for="cl_pay" style="border-radius:4px;padding-right: 40px;padding-left: 40px;background-color:#422252;"><i class="fa fa-usd " style="">
   <strong><?php echo $_POST['amount']; ?></strong></i></label>
   </center>
   </br>

	  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" name="frmPayPal1">
    <input type="hidden" name="business" value="<?php echo $paypal_email; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="<?php if ($_POST['payment_type'] == 1) { echo "Donation"; } ?> Due Payment Invoice">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
    <input type="hidden" name="rm" value="2" />
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="<?php echo "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[REQUEST_URI]); ?>">
    <input type="hidden" name="return" value="<?php echo "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[REQUEST_URI]); ?>">
    <input type="submit" name="submit" value="Pay Through PayPal" class="button" alt="PayPal - The safer, easier way to pay online!">
    </form> 
    
    </br>
    
     <form action="https://www.moneybookers.com/app/payment.pl" method="post">
  <input type="hidden" name="pay_to_email" value="<?php echo $skrill_email; ?>"/>
  <input type="hidden" name="status_url" value="<?php echo "http://$_SERVER[HTTP_HOST]".dirname($_SERVER[REQUEST_URI]); ?>"/> 
  <input type="hidden" name="language" value="EN"/>
  <input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>"/>
  <input type="hidden" name="currency" value="USD"/>
  <input type="hidden" name="detail1_description" value="<?php if ($_POST['payment_type'] == 1) { echo "Donation"; } ?> Due Payment Invoice"/>
  <input type="hidden" name="detail1_text" value="<?php if ($_POST['payment_type'] == 1) { echo "Donation"; } ?> Due Payment Invoice"/>
 <input type="submit" value="Pay Through Skrill" alt="Skrill - Pay online, safely and easily.!" class="button">
</form>

  </br>
    </br>
    
    


<?php  }  ?>


</div>

		<?php 
				
		
		
	}
	
add_shortcode("cl-pay", "cl_pay");



function my_plugin_deactivate()
{
	// DO your activation task.
	error_log("My Plugin Got Deactivated.");
}

register_deactivation_hook(__FILE__,"my_plugin_deactivate");

?>