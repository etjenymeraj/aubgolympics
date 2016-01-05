<?php 

	/* ==========================  Define variables ========================== */

	#Your e-mail address
	define("__TO__", "besimdauti24@gmail.com");

	#Message subject
	define("__SUBJECT__", "examples.com = From:");

	#Success message
	define('__SUCCESS_MESSAGE__', "Your message has been sent. Thank you!");

	#Error message 
	define('__ERROR_MESSAGE__', "Error, your message hasn't been sent");

	#Messege when one or more fields are empty
	define('__MESSAGE_EMPTY_FILDS__', "Please fill out all fields");

	/* ========================  End Define variables ======================== */

	//Send mail function
	function send_mail($to,$subject,$message,$headers){
		if(@mail($to,$subject,$message,$headers)){
			echo json_encode(array('info' => 'success', 'msg' => __SUCCESS_MESSAGE__));
		} else {
			echo json_encode(array('info' => 'error', 'msg' => __ERROR_MESSAGE__));
		}
	}

	//Check e-mail validation
	function check_email($email){
		if(!@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
			return false;
		} else {
			return true;
		}
	}

	//Get post data
	if(isset($_POST['last-name']) and isset($_POST['mail']) and isset($_POST['your-comment'])){
		$name 	 = $_POST['first-name'].' '.$_POST['last-name'];
		$mail 	 = $_POST['mail'];
		$tell  = $_POST['tel-number'];
		$type  = $_POST['type'];
		$budget  = $_POST['budget'];
		$time  = $_POST['time'];
		$area  = $_POST['your-area'];
		$comment = $_POST['your-comment'];

		if($name == '') {
			echo json_encode(array('info' => 'error', 'msg' => "Please enter your name."));
			exit();
		} else if($mail == '' or check_email($mail) == false){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter valid e-mail."));
			exit();
		} else if($tell == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter your tell number."));
			exit();
		}else if($type == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please chose your type."));
			exit();
		}else if($budget == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please chose your budget."));
			exit();
		}else if($time == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please chose your time."));
			exit();
		}else if($area == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please chose your Area."));
			exit();
		}else if($comment == ''){
			echo json_encode(array('info' => 'error', 'msg' => "Please enter your message."));
			exit();
		} else {
			//Send Mail
			$to = __TO__;
			$subject = __SUBJECT__ . ' ' . $name;
			$message = '
			<html>
			<head>
			  <title>Mail from '. $name .'</title>
			</head>
			<body>
			  <table style="width: 500px; font-family: arial; font-size: 14px;" border="1">
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Name:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $name .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">E-mail:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $mail .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Phone:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $tell .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Type:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $type .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Budget:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $budget .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Your Area:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $are .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Time to bedone:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $time .'</td>
				</tr>
				<tr style="height: 32px;">
				  <th align="right" style="width:150px; padding-right:5px;">Description:</th>
				  <td align="left" style="padding-left:5px; line-height: 20px;">'. $comment .'</td>
				</tr>
			  </table>
			</body>
			</html>
			';

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= 'From: ' . $mail . "\r\n";

			send_mail($to,$subject,$message,$headers);
		}
	} else {
		echo json_encode(array('info' => 'error', 'msg' => __MESSAGE_EMPTY_FILDS__));
	}
 ?>