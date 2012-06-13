
<?php 

	include_once "code/ConfigIni.php";
	include_once "code/Factory.php";

?>

<html>
<head>
<title>PHP Test</title>
</head>
<body>
	<?php echo '<p>Hello World</p>'; ?>
	<?php echo '<p>Hola Mundo</p>'; ?>
	
	<?php 
		
		$store = Factory::Get("store");

		$user = Factory::Get("user");
		$user->userId = "1";
		
		print_r($user);
		
// 		$user->infoItems["test"] = 'testvalue';
// 		$user->infoItems["pepe"] = 'pepevalue';
	
// 		print("user");
// 		print_r($user);	
		
// 		
// 		$temp->putItem($user->userId, $user);
		
		
		
// 		print("get user: " . $user->userId);		
// 		$user2 = $temp->getItem($user->userId);
// 		print_r($user2->userId);
		
		exit;
		
			
	
	?>
	
</body>
</html>