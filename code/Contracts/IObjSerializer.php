<?php

interface IObjSerializer
{
	function GetTypeName();
	
	function ToObj($graph);
	function ToGraph($obj);
}

?>