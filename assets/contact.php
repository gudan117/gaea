<?php

/** 1. MAIN SETTINGS
*******************************************************************/


// ENTER YOUR EMAIL
$emailTo = "your@mail.com";


// ENTER IDENTIFIER
$emailIdentifier =  "Message sent via contact form from " . $_SERVER["SERVER_NAME"];


/** 2. MESSAGES
*******************************************************************/


// SUCCESS MESSAGE
$successMessage = "* Email Sent Successfully!";


/** 3. MAIN SCRIPT
*******************************************************************/


if($_POST) {

    $name = addslashes(trim($_POST['name']));
    $clientEmail = addslashes(trim($_POST['email']));
    $subject = addslashes(trim($_POST['subject']));
    $message = addslashes(trim($_POST['message']));

    $array = array('nameMessage' => '', 'emailMessage' => '', 'subjectMessage' => '', 'messageMessage' => '');

    if($name == '') {
    	$array['nameMessage'] = 'error';
    }
	
    if(!filter_var($clientEmail, FILTER_VALIDATE_EMAIL)) {
        $array['emailMessage'] = 'error';
    }
	
    if($subject == '') {
        $array['subjectMessage'] = 'error';
    }
	
    if($message == '') {
        $array['messageMessage'] = 'error';
    }
	
    if($name != '' && filter_var($clientEmail, FILTER_VALIDATE_EMAIL) && $subject != '' && $message != '') {	
		
		$array["succesMessage"] = $successMessage;
		
		$headers= "MIME-Version: 1.0" . "\r\n";
        $headers.= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers= "From: " . $name . " <" . $clientEmail .">\r\n";
		$headers.= "Reply-To: " . $clientEmail;
		
		$message = "Subject: " . $subject . "\r\n \r\n" . $message;
		
		mail($emailTo, $emailIdentifier, $message, $headers);
		
    }

    echo json_encode($array);

}

?>