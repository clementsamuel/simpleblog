<?php require_once 'swiftmailer/lib/swift_required.php';
			$transport=Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl')
			->setUsername('$email')
			->setPassword('@holymount@');
			$mailer=Swift_Mailer::newInstance($transport);
			$message=Swift_Message::newInstance('password')
			->setFrom(array('clement290695@gmail.com' => 'ABC')) 
			->setTo(array($email)) 
			->setBody($body,"text/html");
			
			$result=$mailer->send($message);?>