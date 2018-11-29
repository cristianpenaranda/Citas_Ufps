<?php
	if(isset($_SESSION["Tipo"]) || isset($_SESSION["Usuario"])){
		session_destroy();
		header("Location:Login");
	}
?>