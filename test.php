
<?php 

	include "code/config.factory.php";
	include "code/store/simpleDbConnector.php";

?>

<html>
<head>
<title>PHP Test</title>
</head>
<body>
	<?php echo '<p>Hello World</p>'; ?>
	<?php echo '<p>Hola Mundo</p>'; ?>
	
	<?php 
	
		$user = new User();
		$user->userId = com_create_guid();
		$user->infoItems["test"] = 'test';
	
		$temp = new SimpleDbConnector();
		$temp->putItem($user->userId, $user);
		
		$user2 = $temp->getItem($user->userId);
		
		print_r($user2);

		
	
	?>
	
</body>
</html>