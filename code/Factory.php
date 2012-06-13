<?php 

include_once 'SimpleDb/Models/sdb_User.php';
include_once 'SimpleDb/SimpleDbStore.php';

class Factory
{
	public static function Get($className) {
		
		$ret = NULL;
		
		switch ($className) {
			case "user":
				$ret = new sdb_User();
				break;
				
			case "userCredential":
				
				break;
				
			case "userProfile":
				
				break;				
			case "relationship":
				
				break;
				
			case "store":
				$ret = new SimpleDbStore();
				break;
		}
		
		return $ret;
	}
}

?>