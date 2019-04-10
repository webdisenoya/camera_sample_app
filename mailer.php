<?php

	$autoloader = __DIR__.'/vendor/autoload.php';

	$config = [
		'host'=>'smtp.example.org',
		'port'=>25,
		'username'=>"",
		'password'=>"",
		'from'=>['john@doe.com' => 'John Doe']
		'to'=>['john@doe.com' => 'John Doe']
	];

	$name = (isset($_POST['name']))?$_POST['name']:null;
	$email = (isset($_POST['email']))?$_POST['email']:null;
	$picture = (isset($_POST['picture']))?$_POST['picture']:null;

	$date = new DateTime();
	$result = $date->format('Y-m-d H:i:s');
	$image_path = __DIR__."/files/".md5($result);
	
 	public function base64_to_image($base64_string, $output_file) 
    {
        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 

        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );

        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );

        // clean up the file resource
        fclose( $ifp ); 

        return $output_file; 
    }

    function sendEmail(
    	$subject="Message name",
    	$email_to=[
    		'receiver@domain.org', 
    		'other@domain.org' => 'A name'
    	],
    	$messageBody='Here is the message itself',
    	$attachment=null,
    	$attachment_name=null
    )
   	{

		// Create the Transport
		$transport = (new Swift_SmtpTransport($config['host'], $config['port']))
		  ->setUsername($config['username'])
		  ->setPassword($config['password']);

		// Create the Mailer using your created Transport
		$mailer = new Swift_Mailer($transport);

		// Create a message
		$message = (new Swift_Message($subject))
		  ->setFrom($config['from'])
		  ->setTo($email_to)
		  ->setBody($messageBody)
		  ->attach(Swift_Attachment::fromPath($attachment)->setFilename($attachment_name));

		// Send the message
		$result = $mailer->send($message);


   	}


   	
   	if($email != null && $name != null && $picture != null)
   	{
   		$response = ['success' => true];


   		try
   		{

   			base64_to_image($picture, $image_path);

		   	sendEmail(
		    	$subject="Message name",
		    	$email_to=array_merge(
		    		$config['to'],
		    		[$email=>$name]
		    	),
		    	$messageBody='Here is the message itself',
		    	$attachment=$image_path,
		    	$attachment_name="attachment"
		    );

		    header('Content-Type: application/json');
			print json_encode($response);
   		}
   		catch (exception $e) 
   		{
   			$response['success'] = false;
   			print json_encode($response);
   		}
   		
   	}
   	







?>
