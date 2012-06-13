<?php 

interface IStore
{
	function PutItem($id, IObjSerializer $obj);
	function GetItem($id);
	function RemoveItem($id);
}

?>