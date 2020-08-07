<?php
session_set_cookie_params(86400,'/','.cosmicunicorns.com',true);
	var_dump(session_start());
	var_dump(session_id());
	var_dump($_SESSION);

	if (!is_writable(session_save_path()))
	{
		echo 'Session save path "'.session_save_path().'" is not writable!'; 
	}
	else
	{
		echo 'IS WRITABLE!! YAY!';
	}
?>