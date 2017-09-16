<?php
	// Message Vars 
	$msg = '';
	$msgClass = '';
	
	//Check For Submit
	if(filter_has_var(INPUT_POST, 'submit')){
		//Get Form Data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$message = htmlspecialchars($_POST['message']);

		// Check Required Fields
		if(!empty($email) && !empty($name) && !empty($message)){
		//Passed
	    // Check Email
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			// Failed
			$msg = 'Please use a valid email address.';  //you can msg text between ''
			$msgClass ='alert-fail'; //style in css doc
			
		}else {
			//Passed Validation
			// Recipient Email
			$toEmail = 'enteryourEmail'; //Change this email to your intended email address. 
			$subject = 'Contact Request From' .$name;
			$body = '<h2>Contact Request</h2>
					<h4>Name:</h4><p>'.$name.'</p>
					<h4>Email:</h4><p>'.$email.'</p>
					<h4>Message:</h4><p>'.$message.'</p>
					
					';
			
			//Email Headers
			$headers = "MIME-Version: 1.0" ."\r\n";
			$headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";
			
			//Additional Headers
			$headers .= "From: " .$name. "<" .$email. ">". "\r\n";
			
			if(mail($toEmail, $subject, $body, $headers)){
				//Email Sent
				$msg = 'Your Email has been sent.';  //you can msg text between ''
				$msgClass ='alert-success'; //style in css doc
			} else{
				//Failed
				$msg = 'Your Email was not sent.'; //you can msg text between ''
				$msgClass ='alert-fail'; //style in css doc
		}
		}
			
					
		} else {
		// Failed
			$msg = 'Please fill in all fields';  //you can msg text between ''
			$msgClass ='alert-fail'; //style in css doc
		}
	}
?>
<!doctype html>
<html>
<head>
	<title>Contact Me</title>
		<link rel="icon" href=""/> <!-- Link to your favicon if you have one  !-->
		<link href="style.css" rel="stylesheet" type="text/css"> <!-- Your Custom CSS file  !-->
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet"> <!-- Choose a font-family from https://fonts.google.com/  !-->
		<script src="https://use.fontawesome.com/1168fc4330.js"></script> <!-- Optional, Use Font Awesome Icons :) from http://fontawesome.io/  !-->
</head>
<body>

<!-- Your Nav Bar (Close Window only works if form is first opened in a new tab)  !-->
<!-- nav can be fully customized or completely removed, it is an optional element !-->

	<nav class="nav-head">		
		<div class="nav-titles">
		<a class="navbar-brand" href="javascript:window.close()">Close Window [ X ]</a>
		</div>				
	</nav>
	
	
<!-- Contact Form  !-->
	
<div class="container">
<center>
  <p>&nbsp;</p>
  <p>&nbsp;</p> <!-- link to your logo if you have one, Optional !-->
</center>
<h1 class="center"> Contact [ Your Name ] </h1><!-- Heading  !-->
	<div class="form-container"><?php if($msg != ''): ?>
  <div class="alert <?php echo $msgClass; ?>"><?php echo $msg ?></div>
	<?php endif; ?><!-- Beginning of contact form  !-->
		<form method="post" action="<?php echo $_SERVER['../contact-form/PHP_SELF'] ?>">
		<div class="form-group">
			<label>Name:</label>
			<input type="text" name="name" class="form-inputs" value="<?php echo isset($_POST['name']) ? $name : ''; ?> ">
		</div>
		<div class="form-group">
			<label>Email:</label>
			<input type="text" name="email" class="form-inputs" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
		</div>
		<div class="form-group">
			<label>Message:</label>
			<textarea name="message" class="form-inputs-textarea">
			<?php echo isset($_POST['$message']) ? $message : ''; ?>
			</textarea><!-- Closing Form  !-->
		</div>
		<br />
		<button type="submit" name="submit" class="submit-btn">Submit</button>
		<p>&nbsp;</p>
		  <p>&nbsp;</p>
		  <p>&nbsp;</p>
      </form>
	</div>
</div>

	<?php include('../footer.php'); ?>

</body>
</html>