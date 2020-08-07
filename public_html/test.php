<?php
	class session
	{
		/*
		 * @return {int} [0] New session started.
		 * @return {int} [1] Session already exists.
		 * @return {int} [2] Failed to start the session.
		 */
		public function start()
		{
			GLOBAL $_SESSION;

			if(!$this->sessionExists())
			{
				if(session_start())
				{
var_dump('start 2');
					if(!array_key_exists('userid',$_SESSION))
					{
var_dump('start 3');
						$_SESSION['userid']=null;
					}

					return 0;
				}

				return 2;
			}

			return 1;
		}

		public function sessionExists()
		{
			GLOBAL $_SESSION;
var_dump('sessionExists 0');
var_dump('session_id(): '.session_id());
var_dump('_SESSION: '.$_SESSION);
			if(session_id()==''||!isset($_SESSION))return false;
var_dump('sessionExists 1');

			return true;
		}

		/* Sets the user's ID into the session data.
		 * @return {int} [0] User ID successfully set.
		 * @return {int} [1] No session exists, thus the user ID could not be set.
		 */
		public function setUserId($id)
		{
			GLOBAL $_SESSION;
var_dump('setUserId '.$id);
var_dump('setUserId 0');


			if($this->sessionExists())
			{
var_dump('setUserId 1');
				$_SESSION['userid']=$id;
				return 0;
			}

			return 1;
		}

		/* Gets the user's current ID in the session data.
		 * @return [success] {boolean:true } User ID successfully returned.
		 * @return [success] {boolean:false} No session exists so no user ID could be returned
		 * @return null No session exists or the user is not currently logged in.
		 */
		public function getUserId(&$success=false)
		{
			GLOBAL $_SESSION;
var_dump('getUserId 0');
			if(!$this->sessionExists())
			{
var_dump('getUserId 1');
				$success=false;

				return null;
			}

			$success=true;

			return $_SESSION['userid'];
		}
	}

	$session=new session();
	$session->start();
	var_dump($session->getUserId());
	var_dump($session->setUserId(2119));
	var_dump($session->getUserId());

	//$session=new session();
	//var_dump($session->start());
	//var_dump($session->getUserId());
	//var_dump($session->setUserId(2119));
	//var_dump($session->getUserId());
 
	if (!is_writable(session_save_path()))
	{
		echo 'Session save path "'.session_save_path().'" is not writable!'; 
	}
	else
	{
		echo 'IS WRITABLE!! YAY!';
	}

var_dump(session_get_cookie_params());
//	session_start();
//	var_dump($_SESSION['number']);
//	$_SESSION['number']=219;
//	var_dump($_SESSION['number']);
?>