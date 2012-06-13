 <?php 

 	include_once '/code/Models/User.php';
 	include_once '/code/Contracts/IObjSerializer.php';
 
	use Models\User;

	class sdb_User extends User implements \IObjSerializer
 	{
 		public function GetTypeName() { return "user"; }
 		
 		public function ToObj($graph)
 		{
 			print_r($graph);
 		}
 		
 		public function ToGraph($obj)
 		{
 			$ret = get_object_vars($this); 			
 			return $ret;
 		}
 	}
 
 ?>