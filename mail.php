<?php 
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");
	   
	    $firstname = $lastname = $email = $phone = $city = $related = $type = "";
	    
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
        $email = trim($_POST['email']);
        $phone = $_POST['phone'];
		$city = $_POST['city'];
        $related = $_POST['related'];
		$type = $_POST['type'];

		require 'PHPMailer/PHPMailerAutoload.php';
		$mail = new PHPMailer;
		
		// Success Message
		$success = "
		<div class='wow fadeInRight' data-wow-duration='4s' data-wow-delay='.3s' data-wow-offset='100'> 
        <div class='row'>
        <div class='thankyou'>
        <h1 class='headline-text'>Thank You!</h1>
        <p class='pt-40'>We have received your details and will get back to you shortly.</p>
          </div>
        </div></div>	
        ";
		// Error Message
		 $error = "
		 <div class='wow fadeInRight' data-wow-duration='4s' data-wow-delay='.3s' data-wow-offset='100'> 
        <div class='row'>
        <div class='thankyou'>
		<h1 class='headline-text'>Sorry</h1>
        <p class='pt-40'>Something went wrong and we are looking into it.
        <br> However, you can write to us at contact@thestagingco.in</p>
          </div>
        </div></div>
        "; 
		
		// SMTP configuration
		$mail->IsSMTP();
		$mail->Port = 25;
		$mail->Host = 'localhost';
		$mail->SMTPAuth = true;
		$mail->Username = "contact@thestagingco.in";
		$mail->Password = "stagingco2019";
		$mail->SMTPSecure = false;
		$mail->SMTPAutoTLS = false;
		
		$mail->setFrom("$email","The Staging Co");

		$mail->addAddress('gauravvshharma@gmail.com');
		$mail->addAddress('contact@thestagingco.in');
		
		
        	$headers    =   'MIME-Version: 1.0' . "\r\n";

                    //  Additional headers
        $headers    .=  "From: The Staging Co <contact@thestagingco.in>\r\n";
        $headers    .=  "To: $firstname $lastname <$email>\r\n";

		
		$mailContent = 
        "Name: $firstname $lastname" .   
        PHP_EOL . PHP_EOL .
		"Email: $email" . 
		PHP_EOL . PHP_EOL .
		"Phone No: $phone" . 
        PHP_EOL . PHP_EOL .
        "City: $city" .  
        PHP_EOL . PHP_EOL .
        "Relation with Property: $related" .
        PHP_EOL . PHP_EOL .
        "Type of Property: $type" ;

		$mail->Subject = "New Consultation";
		$mail->isHTML(false);
		$mail->Body = $mailContent;


		if($mail->send()) {
		echo "$success";
		}  else {
			echo "$error";	
		}
	} else {
		echo "$error";
	}
?>