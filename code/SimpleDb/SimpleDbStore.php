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


/* 		foreach ($response as &$value) {
			print($value);
		}

		$temp = new User();
		$temp->userId = com_create_guid();

		$tempArray = get_object_vars($temp);

		$resp = $_sdb->put_attributes(_DB_NAME, $temp->userId, $tempArray);
		
		$resp = $_sdb->put_attributes(_DB_NAME, 'example', array(
		    'key1' => 'value1',
		    'key2' => array(
		        'value1',
		        'value2',
		        'value3'
		    )));

		print($resp->isOK());

		$sql = "select * from " . _DB_NAME;
		
		
		
		// . " where Name = '$temp->userId'"
		
		$resp = $_sdb->select($sql); */
		

		//print('<pre>**************************</pre>');
		// print(isset($response->body->SelectResult));
		// $resp->body->SelectResult->next();
		// print_r($resp->body);
		//print('<pre>**************************</pre>');

		// var_dump($resp);
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
		$graph = $obj->ToGraph($obj);
						
		print("%");
		print_r($tempArray);
		
		$resp = $this->_sdb->put_attributes(_DB_NAME, $id, $tempArray, true);
		
		if ($resp->isOK())
		{
// 			print("putItem ok");
		}
	}
	
	public function GetItem($id)
	{
		$sql = "select * from " . _DB_NAME . " where ItemName() = '$id'";
		
// 		print($sql);
		
		$resp = $this->_sdb->select($sql);
		
		$ret = NULL;
		
		if ($resp->isOK())
		{
			$tmp = $resp->body->SelectResult->to_Array();
			$item = $tmp["Item"]["Attribute"];
			
			print_r($tmp["Item"]);
			
			$ret = array();
			
			foreach ( $item as $key => $value )
			{
				//print($value["Name"]  . "/" . $value["Value"] . ",");
				
				$ret[$value["Name"]] = $value["Value"];
				
// 				$ret[$value["Name"]] = $value["Value"];
			}
			
			
			
// 			$ret = $this->arrayToObject($ret["Item"]);
			
  			print_r($ret);
		}
		else
		{
// 			print("gettItem error");
		}
		
		return $ret;
	}
	
	public function RemoveItem($id)
	{
		$this->_sdb->remove_attributes(_DB_NAME, $temp->userId, $tempArray, true);		
	}
}

?>