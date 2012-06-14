
<?php 

	include_once "code/config.inc.php";
	include_once "code/Factory.php";
	include_once "code/Logger.php";

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
		$user->UserId = "1";
		$user->InfoItems["Name"] = "Jose";
		$user->InfoItems["LastName"] = "Blanco";


		$store->PutItem($user->UserId, $user);
		
		$newUser = Factory::Get("user");
		$tmpUser = $store->GetItem("1", $newUser);

		print("<br>");
		print_r($user);		
		
		print("<br>");
		print_r($newUser);
		
		$store->RemoveItem("1");
		
		exit;	
	
	?>
	
</body>
</html>