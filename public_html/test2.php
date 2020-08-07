<?php

function startASession()
{
	GLOBAL $_SESSION;

	session_start();
	$_SESSION['userid']=222;
}

	startASession();
	var_dump($_SESSION['userid']);
	var_dump('session_id(): '.session_id());

	if (!is_writable(session_save_path()))
	{
		echo 'Session save path "'.session_save_path().'" is not writable!'; 
	}
	else
	{
		echo 'IS WRITABLE!! YAY!';
	}
//	session_start();
//	var_dump($_SESSION['number']);
//	$_SESSION['number']=219;
//	var_dump($_SESSION['number']);
?>