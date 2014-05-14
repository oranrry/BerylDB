<?php

session_start();
if(isset($_SESSION["userId"]))
{
	unset($_SESSION["userId"]);
}

echo("<script>location.href='/index.php';</script>");

?>