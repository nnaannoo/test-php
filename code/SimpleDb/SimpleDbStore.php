<?php

/*%******************************************************************************************%*/
// SETUP

// Enable full-blown error reporting. http://twitter.com/rasmus/status/7448448829
error_reporting(-1);

include_once 'code/Contracts/IStore.php';

// Include the SDK
require_once 'AWSSDKforPHP/sdk.class.php';

class SimpleDbStore implements IStore
{
	private $_sdb;

	function __construct()
	{
		$this->_sdb = new AmazonSDB();
		$response = $this->_sdb->get_domain_list(_DB_NAME);
	}

	function arrayToObject($array) {
		if(!is_array($array)) {
			return $array;
		}
	
		$object = new stdClass();
		if (is_array($array) && count($array) > 0) {
			foreach ($array as $name=>$value) {
				$name = strtolower(trim($name));
				if (!empty($name)) {
					$object->$name = arrayToObject($value);
				}
			}
			return $object;
		}
		else {
			return FALSE;
		}
	}	
	
	function AttrToArray($select) {
		$results = array();
		$x = 0;
		foreach($select->body->GetAttributesResult as $result) {
			foreach ($result as $field) {
				if (array_key_exists($field, $results[$x])) {
					$results[$x][ (string) $field->Name ][] = (string) $field->Value;
				} else {
					$results[$x][ (string) $field->Name ] = (string) $field->Value;
				}
			}
			$x++;
		}
		return $results;
	}

	public function __destruct()
	{

	}
	
	public function PutItem($id, IObjSerializer $obj)
	{	
		$graph = $obj->ToGraph();
		
		print_r($graph);
		
		$resp = $this->_sdb->put_attributes(_DB_NAME, $id, $graph, true);
		
		if ($resp->isOK())
		{
// 			print("putItem ok");
		}
	}
	
	public function GetItem($id, IObjSerializer &$obj)
	{
		$sql = "select * from " . _DB_NAME;

// 		. " where ItemName() = '$id'";
		$resp = $this->_sdb->select($sql);
		
		$ret = NULL;
		
		if ($resp->isOK())
		{
			$tmp = $resp->body->SelectResult->to_Array();
			$obj->FromGraph($tmp);
		}
 	}
	
	public function RemoveItem($id)
	{
		$this->_sdb->delete_attributes(_DB_NAME, $id);		
	}
}

?>