<?php 

interface IStore
{
	function PutItem($id, IObjSerializer $obj);
	function GetItem($id, IObjSerializer &$obj);
	function RemoveItem($id);
}

?>