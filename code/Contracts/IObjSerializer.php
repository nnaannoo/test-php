<?php

interface IObjSerializer
{
	function GetTypeName();
	
	function FromGraph($graph);
	function ToGraph();
}

?>