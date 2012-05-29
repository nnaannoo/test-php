<?php

/*%******************************************************************************************%*/
// SETUP

// Enable full-blown error reporting. http://twitter.com/rasmus/status/7448448829
error_reporting(-1);

include_once 'code/models/user.php';

// Include the SDK
require_once 'AWSSDKforPHP/sdk.class.php';


class SimpleDbConnector
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
	
	public function putItem($id, $obj)
	{
		$tempArray = get_object_vars($obj);
		
		$this->_sdb->put_attributes(_DB_NAME, $id, $tempArray, true);
	}
	
	public function getItem($id)
	{
		$sql = "select * from " . _DB_NAME . " where ItemName() = '$id'";
		
		print($sql);
		
		$resp = $this->_sdb->select(_DB_NAME, $sql);
		
		print_r($resp->body->SelectResult);
		
		$ret = NULL;
		
		if ($resp->isOK())
		{
			$ret = $resp->body->SelectResult;
		}
		
		return $ret;
	}
	
	public function removeItem()
	{
		$this->_sdb->remove_attributes(_DB_NAME, $temp->userId, $tempArray, true);		
	}
}

?>