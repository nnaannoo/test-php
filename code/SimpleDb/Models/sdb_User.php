 <?php 

 	include_once '/code/Models/User.php';
 	include_once '/code/Contracts/IObjSerializer.php';
 
	use Models\User;

	class sdb_User extends User implements \IObjSerializer
 	{
 		public function GetTypeName() { return "user"; }
 		
 		public function FromGraph($graph)
 		{
 			$item = $graph["Item"]["Attribute"];
 			
//   			print("<p>");
//   			print_r($graph);
//   			print("</p>");
 			
  			$this->InfoItems = array();
 			
			foreach ($item as $key => $value)
			{				
// 				print("<p>");
// 				print_r($key);
// 				print_r($value["Name"]);
// 				print("::");
// 				print_r($value["Value"]);
// 				print("</p>");

				switch ($value["Name"])
				{
					case "UserId":
						$this->UserId = $value["Value"];
						break;
					case "InfoItems":
						$tmp = explode(":", $value["Value"]);
						$this->InfoItems[$tmp[0]] = $tmp[1];  
						break;			
				}
			}  			
 		}
 		
 		public function ToGraph()
 		{
 			$ret = array();
 			
 			$ret["UserId"] = $this->UserId;
 			$ret["InfoItems"] = array();
 			
 			foreach ( $this->InfoItems as $key => $value )
 			{
 				array_push($ret["InfoItems"], $key . ":" . $value);
 			}
 			
//  			print("ToGraph:<br>");
//  			print_r($ret);
 			
 			return $ret;
 		}
 	}
 
 ?>