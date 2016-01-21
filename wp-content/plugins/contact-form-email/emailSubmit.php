<?php
/*
	$nonce=$_REQUEST['_wpnonce'];
	echo $nonce;

    	if (! wp_verify_nonce($nonce) ) die("Security check");
*/
	$to = $_REQUEST['to_email'];
	$email = $_REQUEST['email'] ;
	$name= $_REQUEST['name'] ;
	$phone = $_REQUEST['phone'];
	$subject = $_REQUEST['subject'] ;
	$message = $_REQUEST['message'] ;
	$headers = 'From: '.$name.' Web Contact <'.$email.'>' . "\r\n";
	$referrer = $_SERVER['HTTP_REFERER'];
	/*
	echo $to;
	echo $email;
	echo $subject;
	echo $message;
	echo $headers;
	echo $referrer;
	*/
	
	mail( $to, $subject, $message, $headers);
?>
<html>
	<head>
		<title>
			Email Submission
		</title>
		<script type="text/JavaScript">
			<!--
			setTimeout("location.href = '<?php echo $referrer ?>';",2500);
			-->
		</script>
	</head>
	<div style="margin: auto; text-align: center;">
		<h1 style="margin-top: 40px;font-weight: 400;
  color: #13afeb;
  text-transform: none;
  font-size: 24px;
  word-wrap: break-word;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;">Thank you for contacting us. We will get back to you as soon as possible!</h1>
	</div>
</html>