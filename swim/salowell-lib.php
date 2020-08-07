<?php
	if(!isset($SWIM))$SWIM=array();
	if(!is_array($SWIM))$SWIM=array();
	if(!array_key_exists('dbPass',$SWIM)||!is_string($SWIM['dbPass']))$SWIM['dbPass']='';
	if(!array_key_exists('dbUsername',$SWIM)||!is_string($SWIM['dbUsername']))$SWIM['dbUsername']='';
	if(!array_key_exists('dbDatabaseName',$SWIM)||!is_string($SWIM['dbDatabaseName']))$SWIM['dbDatabaseName']='';
	if(!array_key_exists('basepath',$SWIM)||!is_string($SWIM['basepath']))$SWIM['basepath']='';
	if(!array_key_exists('passwordsalt',$SWIM)||!is_string($SWIM['passwordsalt']))$SWIM['passwordsalt']='';
	if(!array_key_exists('verifyregistrationurl',$SWIM)||!is_string($SWIM['verifyregistrationurl']))$SWIM['verifyregistrationurl']='';
	if(!array_key_exists('recoveraccounturl',$SWIM)||!is_string($SWIM['recoveraccounturl']))$SWIM['recoveraccounturl']='';
	if(!array_key_exists('version',$SWIM)||!is_string($SWIM['version']))$SWIM['version']='';
	if(!array_key_exists('stripe.com',$SWIM)||!is_array($SWIM['stripe.com']))$SWIM['stripe.com']=[];
	if(!array_key_exists('webhook_secret',$SWIM['stripe.com'])||!is_string($SWIM['stripe.com']['webhook_secret']))$SWIM['stripe.com']['webhook_secret']='';
	if(!array_key_exists('publishable_key',$SWIM['stripe.com'])||!is_string($SWIM['stripe.com']['publishable_key']))$SWIM['stripe.com']['publishable_key']='';
	if(!array_key_exists('secret_key',$SWIM['stripe.com'])||!is_string($SWIM['stripe.com']['secret_key']))$SWIM['stripe.com']['secret_key']='';

/*Adds all the stuff necessary for encryption to older versions of PHP*/
/*Adds the following functions to older versions of PHP: RandomCompat_substr, RandomCompat_strlen, RandomCompat_intval, random_bytes, random_int*/
/*Adds the following global PHP variables to older versions of PHP: PHP_VERSION_ID, RANDOM_COMPAT_READ_BUFFER*/
if(!is_callable('RandomCompat_substr')){if(defined('MB_OVERLOAD_STRING')&&((int)ini_get('mbstring.func_overload'))&MB_OVERLOAD_STRING){function RandomCompat_substr($binary_string,$start,$length=null){if(!is_string($binary_string))throw new TypeError('RandomCompat_substr(): First argument should be a string');if(!is_int($start))throw new TypeError('RandomCompat_substr(): Second argument should be an integer');if($length===null)$length=RandomCompat_strlen($binary_string)-$start;elseif(!is_int($length))throw new TypeError('RandomCompat_substr(): Third argument should be an integer, or omitted');if($start===RandomCompat_strlen($binary_string)&&$length===0)return '';if($start>RandomCompat_strlen($binary_string))return '';return (string)mb_substr((string)$binary_string,(int)$start,(int)$length,'8bit');}}else{function RandomCompat_substr($binary_string,$start,$length=null){if(!is_string($binary_string))throw new TypeError('RandomCompat_substr(): First argument should be a string');if(!is_int($start))throw new TypeError('RandomCompat_substr(): Second argument should be an integer');if($length!==null){if(!is_int($length))throw new TypeError('RandomCompat_substr(): Third argument should be an integer, or omitted');return (string)substr((string )$binary_string,(int)$start,(int)$length);}return (string)substr((string)$binary_string,(int)$start);}}}if(!defined('PHP_VERSION_ID')){$RandomCompatversion=array_map('intval',explode('.',PHP_VERSION));define('PHP_VERSION_ID',$RandomCompatversion[0]*10000+$RandomCompatversion[1]*100+$RandomCompatversion[2]);$RandomCompatversion=null;}if(PHP_VERSION_ID<70000){if(!defined('RANDOM_COMPAT_READ_BUFFER'))define('RANDOM_COMPAT_READ_BUFFER',8);if(!is_callable('RandomCompat_strlen')){if(defined('MB_OVERLOAD_STRING')&&((int)ini_get('mbstring.func_overload'))&MB_OVERLOAD_STRING){function RandomCompat_strlen($binary_string){if(!is_string($binary_string))throw new TypeError('RandomCompat_strlen() expects a string');return (int)mb_strlen($binary_string,'8bit');}}else{function RandomCompat_strlen($binary_string){if(!is_string($binary_string))throw new TypeError('RandomCompat_strlen() expects a string');return (int)strlen($binary_string);}}}if(!is_callable('RandomCompat_intval')){function RandomCompat_intval($number,$fail_open=false){if(is_int($number)||is_float($number))$number+=0;elseif(is_numeric($number))$number+=0;if(is_float($number)&&$number>~PHP_INT_MAX&&$number<PHP_INT_MAX)$number=(int)$number;if(is_int($number))return (int)$number;elseif(!$fail_open)throw new TypeError('Expected an integer.');return $number;}}if(!class_exists('Error',false)){class Error extends Exception{}}if(!class_exists('TypeError',false)){if(is_subclass_of('Error','Exception')){class TypeError extends Error{}}else{class TypeError extends Exception{}}}if(!is_callable('random_bytes')){if(extension_loaded('libsodium')){if(PHP_VERSION_ID>=50300&&is_callable('\\Sodium\\randombytes_buf')){if(!is_callable('random_bytes')){function random_bytes($bytes){try{$bytes=RandomCompat_intval($bytes);}catch(TypeError $ex){throw new TypeError('random_bytes(): $bytes must be an integer');}if($bytes<1)throw new Error('Length must be greater than 0');if($bytes>2147483647){$buf='';for($i=0;$i<$bytes;$i+=1073741824){$n=($bytes-$i)>1073741824?1073741824:$bytes-$i;$buf.=\Sodium\randombytes_buf($n);}}else $buf=\Sodium\randombytes_buf($bytes);if(is_string($buf))if(RandomCompat_strlen($buf)===$bytes)return $buf;throw new Exception('Could not gather sufficient random data');}}}elseif(method_exists('Sodium','randombytes_buf')){if(!is_callable('random_bytes')){function random_bytes($bytes){try{$bytes=RandomCompat_intval($bytes);}catch(TypeError $ex){throw new TypeError('random_bytes(): $bytes must be an integer');}if($bytes<1)throw new Error('Length must be greater than 0');$buf='';if($bytes>2147483647){for($i=0;$i<$bytes;$i+=1073741824){$n=($bytes-$i)>1073741824?1073741824:$bytes-$i;$buf.=Sodium::randombytes_buf((int)$n);}}else $buf.=Sodium::randombytes_buf((int)$bytes);if(is_string($buf))if(RandomCompat_strlen($buf)===$bytes)return $buf;throw new Exception('Could not gather sufficient random data');}}}}if(DIRECTORY_SEPARATOR==='/'){$RandomCompatUrandom=true;$RandomCompat_basedir=ini_get('open_basedir');if(!empty($RandomCompat_basedir)){$RandomCompat_open_basedir=explode(PATH_SEPARATOR,strtolower($RandomCompat_basedir));$RandomCompatUrandom=(array()!==array_intersect(array('/dev','/dev/','/dev/urandom'),$RandomCompat_open_basedir));$RandomCompat_open_basedir=null;}if(!is_callable('random_bytes')&&$RandomCompatUrandom&&@is_readable('/dev/urandom')){if(!defined('RANDOM_COMPAT_READ_BUFFER'))define('RANDOM_COMPAT_READ_BUFFER',8);if(!is_callable('random_bytes')){function random_bytes($bytes){static $fp=null;if(empty($fp)){if(DIRECTORY_SEPARATOR==='/'){if(!is_readable('/dev/urandom'))throw new Exception('Environment misconfiguration: '.'/dev/urandom cannot be read.');$fp=fopen('/dev/urandom','rb');if(is_resource($fp)){$st=fstat($fp);if(($st['mode']&0170000)!==020000){fclose($fp);$fp=false;}}}if(is_resource($fp)){if(is_callable('stream_set_read_buffer'))stream_set_read_buffer($fp,RANDOM_COMPAT_READ_BUFFER);if(is_callable('stream_set_chunk_size'))stream_set_chunk_size($fp,RANDOM_COMPAT_READ_BUFFER);}}try{$bytes=RandomCompat_intval($bytes);}catch(TypeError $ex){throw new TypeError('random_bytes(): $bytes must be an integer');}if($bytes<1)throw new Error('Length must be greater than 0');if(is_resource($fp)){$remaining=$bytes;$buf='';do{$read=fread($fp,$remaining);if(!is_string($read)){$buf=false;break;}$remaining-=RandomCompat_strlen($read);$buf.=$read;}while($remaining>0);if(is_string($buf))if(RandomCompat_strlen($buf)===$bytes)return $buf;}throw new Exception('Error reading from source device');}}}$RandomCompat_basedir=null;}else $RandomCompatUrandom=false;if(!is_callable('random_bytes')&&(DIRECTORY_SEPARATOR==='/'||PHP_VERSION_ID>=50307)&&(DIRECTORY_SEPARATOR!=='/'||(PHP_VERSION_ID<=50609||PHP_VERSION_ID>=50613))&&extension_loaded('mcrypt')){if(!is_callable('random_bytes')){function random_bytes($bytes){try{$bytes=RandomCompat_intval($bytes);}catch(TypeError $ex){throw new TypeError('random_bytes(): $bytes must be an integer');}if($bytes<1)throw new Error('Length must be greater than 0');$buf=@mcrypt_create_iv((int)$bytes,(int)MCRYPT_DEV_URANDOM);if(is_string($buf)&&RandomCompat_strlen($buf)===$bytes)return $buf;throw new Exception('Could not gather sufficient random data');}}}$RandomCompatUrandom=null;if(!is_callable('random_bytes')&&extension_loaded('com_dotnet')&&class_exists('COM')){$RandomCompat_disabled_classes=preg_split('#\s*,\s*#',strtolower(ini_get('disable_classes')));if(!in_array('com',$RandomCompat_disabled_classes)){try{$RandomCompatCOMtest=new COM('CAPICOM.Utilities.1');if(method_exists($RandomCompatCOMtest,'GetRandom')){if(!is_callable('random_bytes')){function random_bytes($bytes){try{$bytes=RandomCompat_intval($bytes);}catch(TypeError $ex){throw new TypeError('random_bytes(): $bytes must be an integer');}if($bytes<1)throw new Error('Length must be greater than 0');$buf='';if(!class_exists('COM'))throw new Error('COM does not exist');$util=new COM('CAPICOM.Utilities.1');$execCount=0;do{$buf.=base64_decode((string)$util->GetRandom($bytes,0));if(RandomCompat_strlen($buf)>=$bytes)return (string)RandomCompat_substr($buf,0,$bytes);++$execCount;}while($execCount<$bytes);throw new Exception('Could not gather sufficient random data');}}}}catch(com_exception $e){}}$RandomCompat_disabled_classes=null;$RandomCompatCOMtest=null;}if(!is_callable('random_bytes')){function random_bytes($length){unset($length);throw new Exception('There is no suitable CSPRNG installed on your system');return '';}}}if(!is_callable('random_int')){function random_int($min,$max){try{$min=RandomCompat_intval($min);}catch(TypeError $ex){throw new TypeError('random_int(): $min must be an integer');}try{$max=RandomCompat_intval($max);}catch(TypeError $ex){throw new TypeError('random_int(): $max must be an integer');}if($min>$max)throw new Error('Minimum value must be less than or equal to the maximum value');if($max===$min)return (int)$min;$attempts=$bits=$bytes=$mask=$valueShift=0;$range=$max-$min;if(!is_int($range)){$bytes=PHP_INT_SIZE;$mask=~0;}else{while($range>0){if($bits%8===0)++$bytes;++$bits;$range>>=1;$mask=$mask<<1|1;}$valueShift=$min;}$val=0;do{if($attempts>128)throw new Exception('random_int: RNG is broken - too many rejections');$randomByteString=random_bytes($bytes);$val&=0;for($i=0;$i<$bytes;++$i)$val|=ord($randomByteString[$i])<<($i*8);$val&=$mask;$val+=$valueShift;++$attempts;}while(!is_int($val)||$val>$max||$val<$min);return (int)$val;}}}

//Tests whether the input value can be cast to a string (or already is a string)
function canBeString($var){return $var===null||is_scalar($var)||(is_object($var)&&method_exists($var,'__toString'));}

//Implodes an array alogn with its keys. Similiar to implode() but this one has two glues: one between the Key and Value, and another between each of those pairs.
//return 1 [array] must be an array.
//return 2 [glue1] must be a string.
//return 3 [glue2] must be a string.
//return 4 One of the values inside [array] can't be converted to a string.
function implodeKeyVals($array,$glue1,$glue2){if(!is_array($array))return 1;if(!is_string($glue1))return 2;if(!is_string($glue2))return 3;$keys=array_keys($array);$index=0;$str='';foreach($array AS $k=>$v){if(!canBeString($v))return 4;if($index!==0)$str.=$glue2;$str.=$keys[$index].$glue1.$v;++$index;}return $str;}

//Takes an input array and returns a new array where each value was a key in the input array.
function arrayToArrayOfKeys($arr)
{
	if(!is_array($arr))return 1;

	$result=array();

	foreach($arr AS $k=>$v)array_push($result,$k);

	return $result;
}

	//Checks $searchArr to see if any value from $needleArr is within $searchArr
	//return true: at least one of the values from $needleArr was found within $searchArr.
	//return false: none of the values from $needleArr were found within $searchArr.
	//return 1: $searchArr was not an array.
	//return 2: $needleArr was not an array.
	function atLeastOneMatch($searchArr,$needleArr){if(!is_array($searchArr))return 1;if(!is_array($needleArr))return 2;foreach($needleArr AS $k=>$v)if(in_array($v,$searchArr))return true;return false;}

	function clampInt($val,$min,$max)
	{
		return max($min, min($max, $val));
	}

	function randomBits($min=1,$max=64)
	{
		if(!is_int($min))$min=64;
		if(!is_int($max))$max=64;

		if($min<=0)$min=1;
		if($max<=0)$max=1;

		if($min>$max)
		{
			$tmp=$min;
			$min=$max;
			$max=$tmp;
		}

		return openssl_random_pseudo_bytes(random_int($min,$max));
	}

	//return: false on failure
	//return int on success (the int/returned val is the unix timestamp)
	function toUnix($year,$month=1,$day=1,$hour=0,$minute=0,$second=0)
	{
		return strtotime($year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':'.$second);
	}

	function validateDate($day,$month,$year)
	{
		$dateTxt=str_pad($day,2,'0',STR_PAD_LEFT).'-'.str_pad($month,2,'0',STR_PAD_LEFT).'-'.$year;
		$format='d-m-Y';
		$date=DateTime::createFromFormat($format,$dateTxt);
//var_dump('date');
//var_dump($date);
//var_dump($date->format($format));
//var_dump($dateTxt);
		return $date && $date->format($format)===$dateTxt;
	}

	/*
	 * Splits an email string into a 2D array and returns the result.
	 * This function will take any valid email string, split it into two parts and return the result as an array ([username,domain]).
	 * @param  {string} [email] An email address to split into a domain and username.
	 * @return {array(string,string)} Email was successfully split into 2 parts. [0] is the username, [1] is the domain name.
	 * @return {int} [0] The value passed in for [email] was not a valid email string.
	 */
	function splitEmailDomainAndUsername($email){if(filter_var($email,FILTER_VALIDATE_EMAIL)){$email=trim($email);$exp=explode('@',$email);$email=array('','');$index=0;$last=count($exp)-1;$email[1]=$exp[$last];while($index < $last){$email[0].=$exp[$index];++$index;}return $email;}return 0;}

	/*
	 * Finds if the given email is in the database.
	 * Searches the main email and domain table for the given email address.
	 * @param  {string} [email] The email address to search for.
	 * @return {object:database} [db] The database object to use for the email search.
	 * @return {bool} [true] The [email] was found inside the database's main email table.
	 */
	function domainInDatabase($domain,$db)
	{
		$email=splitEmailDomainAndUsername($email);

		if(!is_array($email))return 1;

		$db->query('SELECT ');
	}

	/*
	 * Finds if the given email is in the database.
	 * Searches the main email and domain table for the given email address.
	 * @param  {string} [email] The email address to search for.
	 * @return {object:database} [db] The database object to use for the email search.
	 * @return {bool} [true] The [email] was found inside the database's main email table.
	 */
	function emailInDatabase($email,$db)
	{
		$email=splitEmailDomainAndUsername($email);

		if(!is_array($email))return 1;
	}

	/*
	 * Log the user in via an email+password combination.
	 * This function is the first step in allowing a user to register. This function takes the user's email and adds it to the database in temporary tables. This function will return the unique key given to a user's registration and can be sent to them via email or any other method.
	 * @param  {string} [urlKey] The key the user used to confirm their account.
	 * @param  {string} [dbCon] a database connection object.
	 * @return {int} [Success: 0] User successfully logged in.
	 * @return {int} [Error  : 1] The [dbCon] input is not an instance of database.
	 * @return {int} [Error  : 2] The [session] input is not an instance of session.
	 * @return {int} [Error  : 3] Invalid format passed in for [email].
	 * @return {int} [Error  : 4] Password must be a string value.
	 * @return {int} [Error  : 5] No database connection has been established.
	 * @return {int} [Error  : 6] An error occurred while searching the domains table. Call $this->error() for additional information.
	 * @return {int} [Error  : 7] The domain for the given email address does not exist in the database therefore no user account could be using it.
	 * @return {int} [Error  : 8] An error occurred while searching the emails table. Call $this->error() for additional information.
	 * @return {int} [Error  : 9] The email name for the given email address does not exist in the database therefore no user account could be using it.
	 * @return {int} [Error  :10] An error occurred while searching the useremails table. Call $this->error() for additional information.
	 * @return {int} [Error  :11] The email address isn't currently linked to any user accounts.
	 * @return {int} [Error  :12] The given email addresss is currently disabled/not linked to any user account.
	 * @return {int} [Error  :13] An error occurred while searching the users table. Call $this->error() for additional information.
	 * @return {int} [Error  :14] The user account that's linked to the email address does not exist in the database.
	 * @return {int} [Error  :15] Password does not match the one supplied by the user.
	 * @return {int} [Error  :16] The user account associated with this login is currently disabled.
	 * @return {int} [Error  :17] No session exists, thus the user could not be logged in.
	 */
	function loginEmailPass($email,$password,$dbCon,$session)
	{
		GLOBAL $SWIM;

		if(!($dbCon instanceof database))return 1;
		if(!($session instanceof session))return 2;

		$email=splitEmailDomainAndUsername($email);

		if(!is_array($email))return 3;

		if(!is_string($password))return 4;//Password must be a string value.
      
		$dbCon->tablePrefix('');
		$dbCon->tableName('domains');
		$selects=array('id');
		$search=array('name'=>$email[1]);
		$domainId=$dbCon->get($selects,$search);
  
		if($domainId===8)return 5;//No database connection has been established.
		else if($domainId===9)return 6;//An error occurred while searching the domains table. Call $this->error() for additional information.
		else if($domainId===10)return 7;//The domain for the given email address does not exist in the database therefore no user account could be using it.

		$domainId=mysqli_fetch_row($domainId)[0];

		$dbCon->tableName('emails');
		$selects=array('id');
		$search=array('name'=>$email[0],'domain'=>$domainId);
		$emailId=$dbCon->get($selects,$search);

		if($emailId===9)return 8;//An error occurred while searching the emails table. Call $this->error() for additional information.
		else if($emailId===10)return 9;//The email name for the given email address does not exist in the database therefore no user account could be using it.

		$emailId=mysqli_fetch_row($emailId)[0];

		$dbCon->tableName('useremails');
		$selects=array('id','user','status');
		$search=array('status'=>1,'email'=>$emailId);
		$userEmail=$dbCon->get($selects,$search);

		if($userEmail===9)return 10;//An error occurred while searching the useremails table. Call $this->error() for additional information.
		else if($userEmail===10)return 11;//The email address isn't currently linked to any user accounts.

		$userEmail=mysqli_fetch_assoc($userEmail);

		if($userEmail['status']===0)return 12;//The given email addresss is currently disabled/not linked to any user account.

		$dbCon->tableName('users');
		$selects=array('id','status','role','password');
		$search=array('id'=>$userEmail['user']);
		$users=$dbCon->get($selects,$search);

		if($users===9)return 13;//An error occurred while searching the users table. Call $this->error() for additional information.
		else if($users===10)return 14;//The user account that's linked to the email address does not exist in the database.

		$users=mysqli_fetch_assoc($users);

		if(!password_verify($SWIM['passwordsalt'].$password,$users['password']))return 15;//Password does not match the one supplied by the user.

		if($users['status']===0)return 16;//The user account associated with this login is currently disabled.
       
        $session->setRole($users['role']);

		$result=$session->setUserId($users['id']);

		if($result===1)return 17;//No session exists, thus the user could not be logged in.

		return 0;//User successfully logged in.
	}

	function logout($session)
	{
		if(!($session instanceof session))return 1;

		$session->setUserId(null);
	}

	/*
	 * Confirms the user's registration.
	 * This function is the first step in allowing a user to register. This function takes the user's email and adds it to the database in temporary tables. This function will return the unique key given to a user's registration and can be sent to them via email or any other method.
	 * @param  {string} [urlKey] The key the user used to confirm their account.
	 * @param  {string} [dbCon] a database connection object.
	 * @return {int} [Success: 0] User registration successfully validated.
	 * @return {int} [Error  : 1] The [dbCon] input is Not a database object.
	 * @return {int} [Error  : 2] URL key must be a string.
	 * @return {int} [Error  : 3] Invalid urlkey format. must be id-key format.
	 * @return {int} [Error  : 4] A connection to the database has not yet been established.
	 * @return {int} [Error  : 5] An error occurred while trying to search for the user's confirmation key in the database. Call $this->error() for additional information.
	 * @return {int} [Error  : 6] Invalid confirmation key
	 * @return {int} [Error  : 7] Confirmation Key has been disabled.
	 * @return {int} [Error  : 8] Error occurred while retrieving the email from the database.
	 * @return {int} [Error  : 9] An error occurred while searching the prereg_users table. Call $this->error() for additional information.
	 * @return {int} [Error  : 10] prereg_users row doesn't exist in the database.
	 * @return {int} [Error  :11] An error occurred while searching for the user's IP address in the database. Call $this->error() for additional information.
	 * @return {int} [Error  :12] An error occurred while trying to select the timestamp within the database while handling the IP address. Call the $this->error() method for more information.
	 * @return {int} [Error  :13] An error occurred while trying to insert the timestamp into the database while handling the ip table. Call the $this->error() method for more information.
	 * @return {int} [Error  :14] An error occurred while trying to select the newly inserted timestamp while handling the ip table. Call the $this->error() method for more information.
	 * @return {int} [Error  :15] An error occurred while trying to insert the new data into the ip table. Call the $this->error() method for more information.
	 * @return {int} [Error  :16] An error occurred while trying to select the values newly inserted into the ip table. Call the $this->error() method for more information.
	 * @return {int} [Error  :17] An error occurred while searching for the user's email address domain in the database. Call $this->error() for additional information.
	 * @return {int} [Error  :18] An error occurred while trying to select the timestamp within the database while handling the domains table. Call the $this->error() method for more information.
	 * @return {int} [Error  :19] An error occurred while trying to insert the timestamp into the database while handling the domains table. Call the $this->error() method for more information.
	 * @return {int} [Error  :20] An error occurred while trying to select the newly inserted timestamp while handling the domains table. Call the $this->error() method for more information.
	 * @return {int} [Error  :21] An error occurred while trying to insert the new data into the domains table. Call the $this->error() method for more information.
	 * @return {int} [Error  :22] An error occurred while trying to select the values newly inserted into the domains table. Call the $this->error() method for more information.
	 * @return {int} [Error  :23] An error occurred while searching for the user's email in the database. Call $this->error() for additional information.
	 * @return {int} [Error  :24] An error occurred while trying to select the timestamp within the database while handling the emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :25] An error occurred while trying to insert the timestamp into the database while handling the emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :26] An error occurred while trying to select the newly inserted timestamp while handling the emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :27] An error occurred while trying to insert the new data into the emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :28] An error occurred while trying to select the values newly inserted into the emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :29] An error occurred while searching for the users table in the database. Call $this->error() for additional information.
	 * @return {int} [Error  :30] An error occurred while trying to select the timestamp within the database while handling the users table. Call the $this->error() method for more information.
	 * @return {int} [Error  :31] An error occurred while trying to insert the timestamp into the database while handling the users table. Call the $this->error() method for more information.
	 * @return {int} [Error  :32] An error occurred while trying to select the newly inserted timestamp while handling the users table. Call the $this->error() method for more information.
	 * @return {int} [Error  :33] An error occurred while trying to insert the new data into the users table. Call the $this->error() method for more information.
	 * @return {int} [Error  :34] An error occurred while trying to select the values newly inserted into the users table. Call the $this->error() method for more information.
	 * @return {int} [Error  :35] Email is already registered to a user account.
	 * @return {int} [Error  :36] An error occurred while searching the useremails table. Call $this->error() for additional information.
	 * @return {int} [Error  :37] An error occurred while trying to select the timestamp within the database while handling the useremails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :38] An error occurred while trying to insert the timestamp into the database while handling the useremails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :39] An error occurred while trying to select the newly inserted timestamp while handling the useremails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :40] An error occurred while trying to insert the new data into the useremails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :41] An error occurred while trying to select the values newly inserted into the useremails table. Call the $this->error() method for more information.
	 */
	function verifyAndRegisterUser($urlKey,$dbCon)
	{
		if(!($dbCon instanceof database))return 1;

		if(!is_string($urlKey))return 2;

		$urlKey=explode('-',$urlKey);

		if(count($urlKey)!==2)return 3;

		$select=array('status');
		$search=array('id'=>$urlKey[0],'key'=>$urlKey[1]);

		$dbCon->tableName('prereg_confirmation');
		$result=$dbCon->get($select,$search);

		if($result===8)return 4;
		else if($result===9)return 5;
		else if($result===10)return 6;

		$result=mysqli_fetch_assoc($result);

		if($result['status']==0)return 7;

		$dbCon->query("SELECT `prereg_useremails`.`user` AS `user`, `prereg_emails`.`name` AS `email`, `prereg_domains`.`name` AS `domain` FROM `prereg_confirmation` AS pc LEFT JOIN prereg_confirmation ON prereg_confirmation.id='".$dbCon->escape($urlKey[0])."' LEFT JOIN prereg_userconfirmation ON prereg_confirmation.id=prereg_userconfirmation.confirmation LEFT JOIN prereg_useremails ON prereg_userconfirmation.user=prereg_useremails.user LEFT JOIN prereg_emails ON prereg_useremails.email=prereg_emails.id LEFT JOIN prereg_domains ON prereg_emails.domain=prereg_domains.id");
		$result=$dbCon->exe();

		if(mysqli_num_rows($result)===0)return 8;
		$result=mysqli_fetch_assoc($result);

		$preRegSelect=array('id');
		$preRegWhere=array('id'=>$result['user']);

		$dbCon->tableName('prereg_users');
		$preRegUser=$dbCon->get($preRegSelect,$preRegWhere);

		if($preRegUser===9)return 9;
		else if($preRegUser===10)return 10;

		$preRegUser=mysqli_fetch_assoc($preRegUser);

		$ip=inet_pton($_SERVER['REMOTE_ADDR']);

		$dbCon->tableName('ip');
		$ipId=$dbCon->insertGet(array('ip'=>$ip),array('ip'=>$ip),array('id'),'timestmap');

		if($ipId===13)return 11;
		else if($ipId===14)return 12;
		else if($ipId===15)return 13;
		else if($ipId===16)return 14;
		else if($ipId===17)return 15;
		else if($ipId===18)return 16;

		$ipId=mysqli_fetch_assoc($ipId)['id'];

		$dbCon->tableName('domains');
		$domainId=$dbCon->insertGet(array('name'=>$result['domain']),array('name'=>$result['domain'],'ip'=>$ipId),array('id'),'timestamp');

		if($domainId===13)return 17;
		else if($domainId===14)return 18;
		else if($domainId===15)return 19;
		else if($domainId===16)return 20;
		else if($domainId===17)return 21;
		else if($domainId===18)return 22;

		$domainId=mysqli_fetch_assoc($domainId)['id'];

		$dbCon->tableName('emails');
		$emailId=$dbCon->insertGet(array('name'=>$result['email']),array('name'=>$result['email'],'domain'=>$domainId,'ip'=>$ipId),array('id'),'timestamp');

		if($emailId===13)return 23;
		else if($emailId===14)return 24;
		else if($emailId===15)return 25;
		else if($emailId===16)return 26;
		else if($emailId===17)return 27;
		else if($emailId===18)return 28;

		$emailId=mysqli_fetch_assoc($emailId)['id'];

		$dbCon->tableName('users');
		$userId=$dbCon->insertGet(array('id'=>0),array('ip'=>$ipId),array('id'),'timestamp');

		if($userId===13)return 29;
		else if($userId===14)return 30;
		else if($userId===15)return 31;
		else if($userId===16)return 32;
		else if($userId===17)return 33;
		else if($userId===18)return 34;

		$userId=mysqli_fetch_array($userId)[0];

		$dbCon->tableName('useremails');
		$userEmailsId=$dbCon->inDatabase(array('status'=>1,'email'=>$emailId));

		if($userEmailsId>0)return 35;

		$dbCon->tableName('useremails');
		$userEmails=$dbCon->insertGet(array('email'=>$emailId),array('email'=>$emailId,'user'=>$userId,'ip'=>$ipId),array('id'),'timestamp');

		if($userEmails===13)return 36;
		else if($userEmails===14)return 37;
		else if($userEmails===15)return 38;
		else if($userEmails===16)return 39;
		else if($userEmails===17)return 40;
		else if($userEmails===18)return 41;

		$userEmailsId=mysqli_fetch_assoc($userEmailsId)['id'];

		return 0;
	}

	/* TESTING DONE
	 * Begins the user registration process.
	 * This function is the first step in allowing a user to register. This function takes the user's email and adds it to the database in temporary tables. This function will return the unique key given to a user's registration and can be sent to them via email or any other method.
	 * @param  {string} [toEmail] The email address to use for the registration process.
	 * @param  {string} [url] The URL/link to the page the user will use to validate their account.
	 * @return {string} Email was successfully processed and the user's unique key returned.
	 * @return {int} [Success: 0] Email successfully sent.
	 * @return {int} [Success: 1] Email successfully resent.
	 * @return {int} [Error  : 2] Invalid [toEmail] Format.
	 * @return {int} [Error  : 3] Invalid [fromEmail] Format.
	 * @return {int} [Error  : 4] The [dbcon] parameter is not an instance of database.
	 * @return {int} [Error  : 5] No database connection is currently established.
	 * @return {int} [Error  : 6] The [toEmail] is already registered to a user account.
	 * @return {int} [Error  : 7] Invalid IP address format supplied by the user to $_SERVER['REMOTE_ADDR'].
	 * @return {int} [Error  : 8] An error occurred while searching for the IP address in the database. Call $this->error() for additional information.
	 * @return {int} [Error  : 9] An error occurred while trying to select the timestamp from the databnase during the IP address insertion. Call the $this->error() method for more information.
	 * @return {int} [Error  :10] An error occurred while trying to insert the timestamp into the database during the IP address insertion. Call the $this->error() method for more information.
	 * @return {int} [Error  :11] An error occurred while trying to select the newly inserted timestamp from the database during the IP address insertion. Call the $this->error() method for more information.
	 * @return {int} [Error  :12] An error occurred while trying to insert the IP address into the database. Call the $this->error() method for more information.
	 * @return {int} [Error  :13] An error occurred while trying to select the newly inserted IP address from the database. Call the $this->error() method for more information.
	 * @return {int} [Error  :14] An error prevented the email from being resent.
	 * @return {int} [Error  :15] An error occurred while searching prereg_domains. Call $this->error() for additional information.
	 * @return {int} [Error  :16] An error occurred while trying to select the timestamp while handling the prereg_domains table. Call the $this->error() method for more information.
	 * @return {int} [Error  :17] An error occurred while trying to insert the timestamp while handling the prereg_domains table. Call the $this->error() method for more information.
	 * @return {int} [Error  :18] An error occurred while trying to select the newly inserted timestamp while handling the prereg_domains table. Call the $this->error() method for more information.
	 * @return {int} [Error  :19] An error occurred while trying to insert new values into the prereg_domains table. Call the $this->error() method for more information.
	 * @return {int} [Error  :20] An error occurred while trying to select the newly inserted prereg_domains values. Call the $this->error() method for more information.
	 * @return {int} [Error  :21] An error occurred while searching the prereg_emails table. Call $this->error() for additional information.
	 * @return {int} [Error  :22] An error occurred while trying to select the timestamp while handling the prereg_emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :23] An error occurred while trying to insert the new timestamp while handling the prereg_emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :24] An error occurred while trying to select the newly inserted timestamp while handling the prereg_emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :25] An error occurred while trying to insert the new values into the prereg_emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :26] An error occurred while trying to select the newly inserted values in the prereg_emails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :27] An error occurred while searching the timestamp table. Call $this->error() for additional information.
	 * @return {int} [Error  :28] An error occurred while trying to insert the new timestamp into the database.. Call the $this->error() method for more information.
	 * @return {int} [Error  :29] An error occurred while trying to select the newly inserted timestamp from the database. Call the $this->error() method for more information.
	 * @return {int} [Error  :30] An error occurred while trying to insert data into the prereg_users table. Call the $this->error() method for more information.
	 * @return {int} [Error  :31] An error occurred while trying to insert data into the prereg_confirmation table. Call the $this->error() method for more information.
	 * @return {int} [Error  :32] An error occurred while searching the prereg_useremails table. Call $this->error() for additional information.
	 * @return {int} [Error  :33] An error occurred while trying to select the timestamp while handling the prereg_useremails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :34] An error occurred while trying to insert the timestamp while handling the prereg_useremails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :35] An error occurred while trying to select the newly inserted timestamp while handling the prereg_useremails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :36] An error occurred while trying to insert values into the prereg_useremails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :37] An error occurred while trying to select the newly inserted values from the prereg_useremails table. Call the $this->error() method for more information.
	 * @return {int} [Error  :38] An error occurred while trying to insert data into the prereg_userconfirmation table. Call the $this->error() method for more information.
	 * @return {int} [Error  :39] An error prevented the registration email from being sent.
	 */
	function startUserRegistration($toEmail,$dbCon,$fromEmail,$url)
	{
		$toEmail=splitEmailDomainAndUsername($toEmail);

		if(!is_array($toEmail))return 2;

		$fromEmail=splitEmailDomainAndUsername($fromEmail);

		if(!is_array($fromEmail))return 3;

		if(!($dbCon instanceof database))return 4;

		$dbCon->tableName('domains');
		$domainId=$dbCon->inDatabase(array('name'=>$toEmail[1]));

		if($domainId===-5)return 5;

		if($domainId>0)
		{
			$dbCon->tableName('emails');
			$emailId=$dbCon->inDatabase(array('name'=>$toEmail[0],'domain'=>$domainId));

			if($emailId>0)
			{
				$dbCon->tableName('useremails');
				$userEmailsId=$dbCon->inDatabase(array('status'=>1,'email'=>$emailId));

				if($userEmailsId>0)return 6;
			}
		}

		$ip=inet_pton($_SERVER['REMOTE_ADDR']);

		if($ip===false)return 7;

		$new=false;

		$dbCon->tableName('ip');
		$ipId=$dbCon->insertGet(array('ip'=>$ip),array('ip'=>$ip),array('id'),'timestamp',$new);

		if($ipId===13)return 8;
		else if($ipId===14)return 9;
		else if($ipId===15)return 10;
		else if($ipId===16)return 11;
		else if($ipId===17)return 12;
		else if($ipId===18)return 13;

		$ipId=mysqli_fetch_assoc($ipId)['id'];

		$sendMail=new email();
		$sendMail->to(implode('@',$toEmail));
		$sendMail->subject('Registration');
$sendMail->from(implode('@',$fromEmail));
		$sendMail->htmlOn();

		$dbCon->tableName('prereg_domains');
		$preRegDomainId=$dbCon->inDatabase(array('name'=>$toEmail[1]));

		if($preRegDomainId>0)
		{
			$dbCon->tableName('prereg_emails');
			$preRegEmailId=$dbCon->inDatabase(array('name'=>$toEmail[0],'domain'=>$preRegDomainId));

			if($preRegEmailId>0)
			{
				$dbCon->tableName('prereg_useremails');
				$preRegUserEmailsId=$dbCon->inDatabase(array('status'=>1,'email'=>$preRegEmailId));

				if($preRegUserEmailsId>0)
				{
					$dbCon->query("SELECT `pc`.`key` AS `key`, `pc`.`id` AS id FROM `prereg_useremails` LEFT JOIN prereg_users ON prereg_useremails.user=prereg_users.id LEFT JOIN prereg_userconfirmation ON prereg_users.id=prereg_userconfirmation.user LEFT JOIN prereg_confirmation AS pc ON prereg_userconfirmation.confirmation=pc.id WHERE prereg_useremails.id='".$preRegUserEmailsId."'");
					$result=mysqli_fetch_assoc($dbCon->exe());

					$sendMail->message('<a href="'.$url.urlencode($result['id'].'-'.$result['key']).'">Click here to confirm your email.</a>');
					$result=$sendMail->send();

					if($result===0)return 1;
					return 14;
				}
			}
		}

		$dbCon->tableName('prereg_domains');
		$preRegDomainId=$dbCon->insertGet(array('name'=>$toEmail[1]),array('name'=>$toEmail[1],'ip'=>$ipId),array('id'),'timestamp');

		if($preRegDomainId===13)return 15;
		else if($preRegDomainId===14)return 16;
		else if($preRegDomainId===15)return 17;
		else if($preRegDomainId===16)return 18;
		else if($preRegDomainId===17)return 19;
		else if($preRegDomainId===18)return 20;

		$preRegDomainId=mysqli_fetch_assoc($preRegDomainId)['id'];

		$dbCon->tableName('prereg_emails');
		$preRegEmailId=$dbCon->insertGet(array('name'=>$toEmail[0]),array('name'=>$toEmail[0],'domain'=>$preRegDomainId,'ip'=>$ipId),array('id'),'timestamp');

		if($preRegEmailId===13)return 21;
		else if($preRegEmailId===14)return 22;
		else if($preRegEmailId===15)return 23;
		else if($preRegEmailId===16)return 24;
		else if($preRegEmailId===17)return 25;
		else if($preRegEmailId===18)return 26;

		$preRegEmailId=mysqli_fetch_assoc($preRegEmailId)['id'];

		$time=time();
		$dbCon->tableName('timestamps');
		$timestampId=$dbCon->insertGet(array('timestamp'=>$time),array('timestamp'=>$time),array('id'));

		if($timestampId===13)return 27;
		else if($timestampId===17)return 28;
		else if($timestampId===18)return 29;

		$timestampId=mysqli_fetch_assoc($timestampId)['id'];

		$dbCon->query("INSERT INTO prereg_users(ip,timestamp) VALUES('".$dbCon->escape($ipId)."','".$dbCon->escape($timestampId)."')");
		$preRegUserId=$dbCon->exe();

		if($preRegUserId===false)return 30;

		$preRegUserId=mysqli_insert_id($dbCon->link());

		$keyBin=randomBits(random_int(32,64),random_int(32,64));
		$keyHex=bin2hex($keyBin);

		$dbCon->query("INSERT INTO `prereg_confirmation`(`key`,`ip`,`timestamp`) VALUES('".$keyHex."','".$dbCon->escape($ipId)."','".$dbCon->escape($timestampId)."')");
		$preRegConfirmationId=$dbCon->exe();

		if($preRegConfirmationId===false)return 31;
		$preRegConfirmationId=mysqli_insert_id($dbCon->link());

		$dbCon->tableName('prereg_useremails');
		$preRegUserEmailId=$dbCon->insertGet(array('email'=>$preRegEmailId,'user'=>$preRegUserId),array('email'=>$preRegEmailId,'user'=>$preRegUserId,'ip'=>$ipId,'timestamp'=>$timestampId),array('id'));

		if($preRegUserEmailId===13)return 32;
		else if($preRegUserEmailId===14)return 33;
		else if($preRegUserEmailId===15)return 34;
		else if($preRegUserEmailId===16)return 35;
		else if($preRegUserEmailId===17)return 36;
		else if($preRegUserEmailId===18)return 37;

		$preRegUserEmailId=mysqli_fetch_assoc($preRegUserEmailId)['id'];

		$dbCon->query("INSERT INTO prereg_userconfirmation(confirmation,user,ip,timestamp) VALUES('".$preRegConfirmationId."','".$preRegUserId."','".$dbCon->escape($ipId)."','".$dbCon->escape($timestampId)."')");
		$preRegConfirmationId=$dbCon->exe();
		if($preRegConfirmationId===false)return 38;
		$preRegConfirmationId=mysqli_insert_id($dbCon->link());

		$sendMail->message('<a href="'.$url.urlencode($preRegConfirmationId.'-'.$keyHex).'">Click here to confirm your email.</a>');
		$result=$sendMail->send();

		if($result===0)return 0;

		return 39;
	}




	function recoverAccount($password,$passwordConfirm,$key,$dbCon)
	{
		if(!is_string($password))return 1;
		if(!is_string($passwordConfirm))return 2;
		if(!is_string($key))return 2;

		$password=trim($password);
		$passwordConfirm=trim($passwordConfirm);
		$key=trim($key);


	}

	/* 
	 * Begins the process that allows a user to recover their account.
	 * This function is the first step in allowing a user to recover their account.
	 * @param  {string} [toEmail] The email address to use for the registration process.
	 * @param  {string} [url] The URL/link to the page the user will use to validate their account.
	 * @return {string} Email was successfully processed and the user's unique key returned.
	 * @return {int} [Success: 0] Account recovery email successfully sent.
	 * @return {int} [Success: 1] Invalid format passed in for the [toEmail] email address.
	 * @return {int} [Error  : 2] Invalid format passed in for the [fromEmail] email address.
	 * @return {int} [Error  : 3] The value passed in for [dbCon] must be an instance of database but it currently is not.
	 * @return {int} [Error  : 4] Invalid IP address format supplied by the user to $_SERVER['REMOTE_ADDR'].
	 * @return {int} [Error  : 5] No database connection is currently established.
	 * @return {int} [Error  : 6] An error occurred while searching the ip table. Call $this->error() for additional information.
	 * @return {int} [Error  : 7] An error occurred while trying to select the timestamp while handling the ip table. Call the $this->error() method for more information.
	 * @return {int} [Error  : 8] An error occurred while trying to insert the timestamp while handling the ip table. Call the $this->error() method for more information.
	 * @return {int} [Error  : 9] An error occurred while trying to select the newly inserted timestamp while handling the ip table. Call the $this->error() method for more information.
	 * @return {int} [Error  :10] An error occurred while trying to insert new values into the ip table. Call the $this->error() method for more information.
	 * @return {int} [Error  :11] An error occurred while trying to select the newly inserted ip values. Call the $this->error() method for more information.
	 * @return {int} [Error  :12] An error occurred while searching the useremails table. Call $this->error() for additional information.
	 * @return {int} [Error  :13] No results were matched to the [search] input. (email is not registered to an account)
	 * @return {int} [Error  :14] An error occurred while searching the recoveraccount table. Call $this->error() for additional information.
	 * @return {int} [Error  :15] An error occurred while trying to select the timestamp while handling the recoveraccount table. Call the $this->error() method for more information.
	 * @return {int} [Error  :16] An error occurred while trying to insert the timestamp while handling the recoveraccount table. Call the $this->error() method for more information.
	 * @return {int} [Error  :17] An error occurred while trying to select the newly inserted timestamp while handling the recoveraccount table. Call the $this->error() method for more information.
	 * @return {int} [Error  :18] An error occurred while trying to insert new values into the recoveraccount table. Call the $this->error() method for more information.
	 * @return {int} [Error  :19] An error occurred while trying to select the newly inserted recoveraccount values. Call the $this->error() method for more information.
	 * @return {int} [Error  :20] An error prevented the account recovery email from being sent. Try again.
	 * @return {int} [Error  :21] The email address is not in the database therefore there can't be an account associated with it.
	 * @return {int} [Error  :22] The email's domain is not in the database therefore there can't be an account associated with the given email address.
	 */
	function startAccountRecovery($toEmail,$dbCon,$fromEmail,$url)
	{
		GLOBAL $SWIM;

		$toEmail=splitEmailDomainAndUsername($toEmail);

		if(!is_array($toEmail))return 1;

		$fromEmail=splitEmailDomainAndUsername($fromEmail);

		if(!is_array($fromEmail))return 2;

		if(!($dbCon instanceof database))return 3;

		$dbCon->tablePrefix('');

		$ip=inet_pton($_SERVER['REMOTE_ADDR']);

		if($ip===false)return 4;
		$dbCon->tableName('ip');
		$ipId=$dbCon->insertGet(array('ip'=>$ip),array('ip'=>$ip),array('id'),'timestamp',$new);

		if($ipId===12)return 5;
		else if($ipId===13)return 6;
		else if($ipId===14)return 7;
		else if($ipId===15)return 8;
		else if($ipId===16)return 9;
		else if($ipId===17)return 10;
		else if($ipId===18)return 11;

		$ipId=mysqli_fetch_assoc($ipId)['id'];

		$dbCon->tableName('domains');
		$domainId=$dbCon->inDatabase(array('name'=>$toEmail[1]));

		if($domainId>0)
		{
			$dbCon->tableName('emails');
			$emailId=$dbCon->inDatabase(array('name'=>$toEmail[0],'domain'=>$domainId));

			if($emailId>0)
			{
				$dbCon->tableName('useremails');

				$selects=array('id','status','email','user');
				$search=array('status'=>1,'email'=>$emailId);

				$useremail=$dbCon->get($selects,$search);
				if($useremail===9)return 12;
				else if($useremail===10)return 13;

				$useremail=mysqli_fetch_assoc($useremail);

				$keyBin=randomBits(random_int(32,64),random_int(32,64));
				$keyHex=bin2hex($keyBin);

				$dbCon->tableName('recoveraccount');
				$recoveraccount=$dbCon->insertGet(array('status'=>1,'user'=>$useremail['user']),array('key'=>$keyHex,'user'=>$useremail['user'],'ip'=>$ipId),array('id','key'),'timestamp');

				if($recoveraccount===13)return 14;
				else if($recoveraccount===14)return 15;
				else if($recoveraccount===15)return 16;
				else if($recoveraccount===16)return 17;
				else if($recoveraccount===17)return 18;
				else if($recoveraccount===18)return 19;

				$recoveraccount=mysqli_fetch_assoc($recoveraccount);

				$sendMail=new email();
				$sendMail->to(implode('@',$toEmail));
				$sendMail->subject('Account Recovery.');
				$sendMail->from(implode('@',$fromEmail));
				$sendMail->htmlOn();

				$sendMail->message('<a href="'.$url.urlencode($recoveraccount['id'].'-'.$recoveraccount['key']).'">Click here to change your password.</a>');
				$result=$sendMail->send();

				if($result===0)return 0;

				return 20;
			}

			return 21;
		}

		return 22;
	}

	function newDBPreregConf($dbCon,$key,$selects=array(),$ipId=null,$timestampId=null)
	{
		if(is_string($selects))$selects=array($selects);
		if(!is_array($selects))$selects=array();
		if(!in_array('id',$selects))array_push($selects,'id');

		$selects=$dbCon->escape($selects);
		$selects='`'.implode($selects,'`,`').'`';

		$dbCon->query('INSERT INTO prereg_confirmation(key,ip,timestamp) VALUES(\''.$dbCon->escape($key).'\',\''.$dbCon->escape($ipId).'\',\''.$dbCon->escape($timestampId).'\')');
		$result=$dbCon->exe();

		if($result===false)return -1;

		$dbCon->query('SELECT '.$selects.' FROM prereg_confirmation WHERE prereg_confirmation.id='.mysqli_insert_id($dbCon->link()));
		$result=$dbCon->exe();

		if(mysqli_num_rows($result)>0)return mysqli_fetch_assoc($result);

		return -2;
	}

	//Creates a new timestamp in the database timestamp table.
	function newDBTimestamp($dbCon, $selects=array())
	{
		if(is_string($selects))$selects=array($selects);
		if(!is_array($selects))$selects=array();
		if(!in_array('id',$selects))array_push($selects,'id');

		$selects=$dbCon->escape($selects);
		$selects='`'.implode($selects,'`,`').'`';

		$dbCon->query('INSERT INTO timestamps(timestamp) VALUES('.time().')');
		$result=$dbCon->exe();

		if($result===false)return -1;

		$dbCon->query('SELECT '.$selects.' FROM timestamps WHERE timestamps.id='.mysqli_insert_id($dbCon->link()));
		$result=$dbCon->exe();

		if(mysqli_num_rows($result)>0)return mysqli_fetch_assoc($result);

		return -2;
	}

	function insertGetPreregDomains($domain,$dbCon,$timestampDbId,$selects=array())
	{
		if(is_string($selects))$selects=array($selects);
		if(!is_array($selects))$selects=array();
		if(!in_array('id',$selects))array_push($selects,'id');

		$selects=$dbCon->escape($selects);
		$selects='`'.implode($selects,'`,`').'`';

		if(!filter_var($domain,FILTER_VALIDATE_DOMAIN))return 1;

		$domain=trim($domain);

		if(!is_int($timestampDbId)||$timestampDbId<=0)
		{
			$timestampDbId=newDBTimestamp($dbCon);
			$timestampDbId=$timestampId['id'];
		}

		$dbCon->query('INSERT INTO prereg_domains(timestamp) VALUES('.time().')');
		$result=$dbCon->exe();

		if($result===false)return -1;

		$dbCon->query('SELECT '.$selects.' FROM timestamps WHERE timestamps.id='.mysqli_insert_id($dbCon->link()));
		$result=$dbCon->exe();

		if(mysqli_num_rows($result)>0)return mysqli_fetch_assoc($result);

		return -2;
	}

	//Checks if the search value exists, if it does it returns the row, if it does not it inserts the new values and returns the new row.
	function dbInsertGet($dbCon,$searchTable,$searchColumns,$searchValues,$insertColumns,$insertValues)
	{
	}

	//Inserts the IP if it doesn't exist and returns the resulting rows specified by $selects
	//Alternatively, if the IP doesn't exist in the database, then it is first inserted before the rows are retrieved.
	function insertGetIpInDb($ip,$dbCon,$timestampDbId,$selects=null)
	{
		$ip=inet_pton($ip);

		if($ip!==false)
		{
			if(is_string($selects))$selects=array($selects);

			if(!is_array($selects))$selects=array();

			if(!in_array('id',$selects))array_push($selects,'id');

			foreach($selects AS $k=>$v)
			{
				if(!is_string($v))return 6;//One of the indexes in $selects was not a string.
			}

			$selects=$dbCon->escape($selects);

			$selects='`'.implode($selects,'`,`').'`';

			$dbCon->query('SELECT '.$selects.' FROM ip WHERE ip.ip=\''.$ip.'\'');
			$result=$dbCon->exe();

			if(mysqli_num_rows($result)>0)return mysqli_fetch_assoc($result);

			if(!is_int($timestampDbId)||$timestampDbId<=0)
			{
				$timestampDbId=newDBTimestamp($dbCon);
				$timestampDbId=$timestampId['id'];
			}

			$dbCon->query('INSERT INTO ip(ip,timestamp) VALUES(\''.$ip.'\','.$timestampId.')');
			$result=$dbCon->exe();

			if($result===false)return -2;//failed to insert the IP into the database.

			$dbCon->query('SELECT '.$selects.' FROM ip WHERE ip.id='.mysqli_insert_id($dbCon->link()));
			$result=$dbCon->exe();

			if(mysqli_num_rows($result)>0)return mysqli_fetch_assoc($result);

			return -3;//Failed to retrieve the IP address after successfully inserting it into the database.
		}

		return -1;//Invalid IP format.
	}


	//Retrieves a value from the given array and given index. If the index doesn't exist then default is returned.
	function getIndexVal($arr,$key,$default='')
	{
		$arr=(array)$arr;
		$key=(string)$key;

		return isset($arr[$key])?$arr[$key]:$default;
	}

	function format_phone_us($phone)
	{
		if(!isset($phone{3})) { return ''; }

		$phone=preg_replace("/[^0-9]/","",$phone);
		$length=strlen($phone);

		switch($length)
		{
			case 7:
				return preg_replace("/([0-9]{3})([0-9]{4})/","$1-$2",$phone);
				break;
			case 10:
				return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/","($1) $2-$3",$phone);
				break;
			case 11:
				return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/","+$1($2) $3-$4",$phone);
				break;
			default:
				return $phone;
			break;
		}
	}


//Add a function that gets the file and returns it as an array of all the files for the given name value. That way all return values are uniforn in the sense the user can just loop through that array to get each of the files regardless of whether it was a single file input or multiple!
	class request
	{
		function isPost()
		{
			if($_SERVER['REQUEST_METHOD']==='POST')return true;

			return false;
		}

		function isGet()
		{
			if($_SERVER['REQUEST_METHOD']==='GET')return true;

			return false;
		}

		//$name: the post's name field/value
		//$default: the default value to assign to the post if it's not set inside $_POST
		function getPost($name,$default=null)
		{
			GLOBAL $_POST;

			if($this->postExists($name))return $_POST[$name];

			return $default;
		}

		//$name: the get's name field/value
		//$default: the default value to assign to the get if it's not set inside $_GET
		function getGet($name,$default=null)
		{
			GLOBAL $_GET;

			if($this->getExists($name))return $_GET[$name];

			return $default;
		}

		//$name: the files's name field/value
		//$default: the default value to assign to the get if it's not set inside $_FILES
		function getFile($name,$default=null)
		{
			GLOBAL $_FILES;

			if($this->fileExists($name))return $_FILES[$name];

			return $default;
		}

		function postIsString($name)
		{
			GLOBAL $_POST;

			if($this->postExists($name))
			{
				$name=(String)$name;

				if(is_string($_POST[$name]))return true;
			}

			return false;
		}

		function postIsArray($name)
		{
			GLOBAL $_POST;

			if($this->postExists($name))
			{
				$name=(String)$name;

				if(is_array($_POST[$name]))return true;
			}

			return false;
		}

		function getIsString($name)
		{
			GLOBAL $_GET;

			if($this->postExists($name))
			{
				$name=(String)$name;

				if(is_string($_GET[$name]))return true;
			}

			return false;
		}

		function getIsArray($name)
		{
			GLOBAL $_GET;

			if($this->postExists($name))
			{
				$name=(String)$name;

				if(is_array($_GET[$name]))return true;
			}

			return false;
		}

		//Detects if the given file is an array. If it is, that means there are multiple files associated with the given input.
		function fileIsArray($name)
		{
			if($this->fileExists($name)&&is_array($_FILES[$name]['name']))return true;

			return false;
		}

		//Checks if the given post value exists.
		//Notes: Blank space is retained in an inputs "name" parameter
		function postExists($name)
		{
			GLOBAL $_SERVER,$_POST;

			if(!canBeString($name))return false;
			$name=(String)$name;

			if($this->isPost()&&array_key_exists($name,$_POST))return true;

			return false;
		}

		//Checks if the given post value exists.
		//Notes: Blank space is retained in an inputs "name" parameter
		function getExists($name)
		{
			GLOBAL $_SERVER,$_GET;

			if(!canBeString($name))return false;
			$name=(String)$name;

			if($this->isGet()&&array_key_exists($name,$_GET))return true;

			return false;
		}

		//returns true if there's an error with the file or the file doesn't exist.
		function fileError($name)
		{
			GLOBAL $_FILES;

			if(!$this->fileExists($name))return true;

			if($_FILES['pythonfile']['error']>0)return true;

			return false;
		}

		//Checks if the given file field exists.
		//Notes: Blank space is retained in an inputs "name" parameter
		function fileExists($name)
		{
			GLOBAL $_SERVER,$_FILES;

			if(!canBeString($name))return false;
			$name=(String)$name;

			if($this->isPost()&&array_key_exists($name,$_FILES))return true;

			return false;
		}
	}


	//On non window's computers this class can only use PHP.ini's current SMTP server settings. (in fact, even Windows computers too as I'm not going to bother making it able to use Windows' custom settings)
	//Should I add CC, BCC, and To header support?)
	//https://www.php.net/manual/en/function.mail.php
	//$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
	//$headers[] = 'From: Birthday Reminder <birthday@example.com>';
	//$headers[] = 'Cc: birthdayarchive@example.com';
	//$headers[] = 'Bcc: birthdaycheck@example.com';
	class email
	{
		private $smtpServer='';
		private $smtpPort='';
		private $to=array();
		private $from='';
		private $message='';
		private $subject='';
		private $html=false;

		/* Adds a name and/or email to the "To" field.
		 * @param  {string} [email] string representing the email address to add to the list of "To" email addresses.
		 * @param  {string} [name]  string representing the name to use when sending an email to this address.
		 * @return {int} [Success:0] To [name] and/or to [email] successfully added.
		 * @return {int} [Error  :1] The [email] input must be a string
		 * @return {int} [Error  :2] The [email] input was not a properly formatted email address.
		 */
		function to($email,$name=null){if(!is_string($email))return 1;$email=trim($email);if(is_string($name))$name=trim($name);else{$name=null;}if(!filter_var($email,FILTER_VALIDATE_EMAIL))return 2;if($name===null||$name==='')array_push($this->to,$email);else{if(!array_key_exists($name,$this->to))$this->to[$name]=array();array_push($this->to[$name],$email);}return 0;}

		function subject($subject)
		{
			if(!is_string($subject))return 1;

			$subject=trim($subject);

			if($subject==='')return 2;

			$this->subject=$subject;
		}

		/* Set the "From" field to the given [name] and/or [email].
		 * @param  {string} [email] string representing the email address to set as the "From" email addresses.
		 * @param  {string} [name]  string representing the name to use in the "From" field when sending this email.
		 * @return {int} [Success:0] From [name] and/or to [email] successfully added.
		 * @return {int} [Error  :1] The [email] input must be a string
		 * @return {int} [Error  :2] The [email] input was not a properly formatted email address.
		 */
		function from($email,$name=null){if(!is_string($email))return 1;$email=trim($email);if(is_string($name))$name=trim($name);else{$name=null;}if(!filter_var($email,FILTER_VALIDATE_EMAIL))return 2;if($name===null||$name==='')$this->from=$email;else{$this->from=$name.' <'.$email.'>';}$this->from='From: '.$this->from;return 0;}

		function clearTo(){$this->to=array();}

		function htmlOn()
		{
			$this->html=true;
		}

		function htmlOff()
		{
			$this->html=false;
		}

		function message($message)
		{
			if(!is_string($message))return 1;

			$message=trim($message);

			if($message==='')return 2;

			$this->message=$message;
		}

		/* Send the email based on all the parameters saved to this class in its current state.
		 * @return {int} [0] Email successfully sent.
		 * @return {int} [1] There are no To email addresses but there must be at least 1.
		 * @return {int} [2] Missing a $from email address.
		 * @return {int} [3] The $message was left empty.
		 * @return {int} [4] There were no $to email addresses provided.
		 * @return {int} [5] An error prevented the email from being sent.
		 */
		function send()
		{
			$return=0;
			$headers=array();
			$to='';

			if(count($this->to)===0)return 1;

			if($this->from==='')return 2;

			if($this->message==='')$return=3;

			if(count($this->to)===0)return 4;

			if($this->subject==='')return 5;

			if($this->html)array_push($headers,'MIME-Version: 1.0','Content-type: text/html; charset=iso-8859-1');

			array_push($headers,$this->from);

			foreach($this->to AS $key=>$val)
			{
				if(is_string($val))
				{
					if(strlen($to)!==0)$to.=', ';

					$to.=$val;
				}
				else
				{
					foreach($val AS $v)
					{
						if(strlen($to)!==0)$to.=', ';

						$to.=$key.' <'.$v.'>';
					}
				}
			}

			if($return===0)
			{
				$message=wordwrap($this->message,70,"\r\n");

				if(count($headers)===0)
				{
					mail($to,$this->subject,$message);
				}
				else
				{
					$headers=implode("\r\n",$headers);
					if(!mail($to,$this->subject,$message,$headers))$return=5;
				}
			}

			return $return;
		}
	}

	/* This function establishes a connection to a database and makes it easier to handle all the possible errors that can occur.
	 * This function connects to a databse, By default it uses the values in $SWIM. but if the [dbName], [dbUserName], or [dbPass] parameters are provided it will use those instead.
	 * If any of the parameters are different than what's currently defined in the [db] parameter then the current connection established by [db] is closed and a new one is open using the new parameters.
	 * [db] will also be modified.
	 * @param  {}             [db] any value is allowed for this input. If it's an existing database object then no new object will need to be created.
	 * @param  {boolean/null} [persistant] Whether or not the database connection should be persistant.
	 * @param  {string/null}  [dbName] The database name. This will replace the current name in [db] and force a reconnect if it's different.
	 * @param  {string/null}  [dbUserName] The database user name. This will replace the current name in [db] and force a reconnect if it's different.
	 * @param  {string/null}  [dbPass] The database password. This will replace the current name in [db] and force a reconnect if it's different.
	 * @return {int} [Success:0] New connection successfully opened.
	 * @return {int} [Success:1] A connection with the given settings already exists therefore there's no reason to re-open it.
	 * @return {int} [Error  :2] [persistant] must be a boolean or null value.
	 * @return {int} [Error  :3] [dbName] must be a string or null value.
	 * @return {int} [Error  :4] [dbUserName] must be a string or null value.
	 * @return {int} [Error  :5] [dbPass] must be a string or null value.
	 * @return {int} [Error  :6] An error occurred while trying to close the previous database connection.
	 * @return {int} [Error  :7] Failed to open a new connection to the database.
	 */
	function iniDatabase(&$db,$persistant=null,$dbName=null,$dbUserName=null,$dbPass=null){if(!($db instanceof database))$db=new database();if(!is_bool($persistant)&&!is_null($persistant))return 2;if(!is_string($dbName)&&!is_null($dbName))return 3;if(!is_string($dbUserName)&&!is_null($dbUserName))return 4;if(!is_string($dbPass)&&!is_null($dbPass))return 5;if($dbName===null)$dbName=$db->getDatabaseName();if($dbUserName===null)$dbUserName=$db->getUserName();if($dbPass===null)$dbPass=$db->getPassword();if($persistant===null)$persistant=$db->getPersistant();$dbName=trim($dbName);$dbUserName=trim($dbUserName);$dbPass=trim($dbPass);if($db->getDatabaseName()!==$dbName||$db->getUserName()!==$dbUserName||$db->getPassword()!==$dbPass||$db->getPersistant()!==$persistant){$db->databaseName($dbName);$db->username($dbUserName);$db->password($dbPass);if($db->disconnect()===2)return 6;}if($db->link()===false){if(!$db->connect($persistant))return 7;}else{return 1;}return 0;}

	class database
	{
		private $server='localhost';
		private $username='';
		private $password='';
		private $dbName='';
		private $tableName='';
		private $tablePrefix='';
		private $createTableColumns=array();
		private $link=false;
		private $sql='';
		private $timestampTable='timestamps';
		private $persistant=false;

		public function sql()
		{
			return $this->sql;
		}

/* Inserts a new row if the search is not found, otherwise it updates the row. The resulting selects are returned either way.
 * @param  {array(column=>value)} [search ] An array of strings where each key represents a column and the column's value is the search term. if this parameter is not set then this function only performs an insertion.
 * @param  {array(column=>value)} [insertUpdate] An array of strings. Each key represents a table column, each column's value represents the value to insert or update on that column
 * @param  {array(string)}        [selects] An array of strings where each value represents the columns you wish to retrieve.
 * @param  {string}               [timestamp] string or array representing the timestamp column(s) for this table. If it's empty or a non string value then the timestamp will be ignored for this function. if it's not an empty string then a timestamp will be generated if and only if an insertion is performed within this function.
 * @param  {boolean}              [new] A reference value that will be set to false if no insertion was performed or true if an insertion was performed.
 * @return {array}                an associative array of the retrieved and/or updated values.
 * @return {int} [Error:1 ] The [inserts] input must be an array.
 * @return {int} [Error:2 ] The [inserts] array must not be empty.
 * @return {int} [Error:3 ] One of the keys in the [inserts] array was found to be a non string value.
 * @return {int} [Error:4 ] One of the values within the [inserts] array was found to not be an int, float, or string value.
 * @return {int} [Error:5 ] One of the values within the [selects] array was found to be a non string value.
 * @return {int} [Error:6 ] One of the values within [selects] was found to be an empty string.
 * @return {int} [Error:7 ] The [search] input was found to be a non array value.
 * @return {int} [Error:8 ] The [search] input was found to be an empty array.
 * @return {int} [Error:9 ] One of the keys in the [search] input was found to be a non string value.
 * @return {int} [Error:10] One of the values in the [search] input was found to not be a string, int, or float.
 * @return {int} [Error:11] No table currently set to perform the selection on.
 * @return {int} [Error:12] A connection to the database has not yet been established therefore the query cannot be performed.
 * @return {int} [Error:13] An error occurred while searching for the given values in the database. Call $this->error() for additional information.
 * @return {int} [Error:14] An error occurred while trying to select the [search] values within the database while handling the timestmap. Call the $this->error() method for more information.
 * @return {int} [Error:15] An error occurred while trying to insert the [inserts] values into the database while handling the timestamp. Call the $this->error() method for more information.
 * @return {int} [Error:16] An error occurred while trying to select the [selects] values from the newly inserted [inserts] in the database while handling the timestamp. Call the $this->error() method for more information.
 * @return {int} [Error:17] An error occurred while trying to insert the [inserts] values into the database. Call the $this->error() method for more information.
 * @return {int} [Error:18] An error occurred while trying to select the [selects] values from the newly inserted [inserts] in the database. Call the $this->error() method for more information.
 * @return {int} [Error:19] An error occured while trying to update the row(s). Call the $this->error() method for more information.
 */
function insertUpdateGet($search,$insertUpdates,$selects,$timestamp,&$new=false){$result=$this->insertGet($search,$insertUpdates,$selects,'timestamp',$new);if(is_int($result))return $result;$result=mysqli_fetch_assoc($result);if(!$new){$columns=arrayToArrayOfKeys($insertUpdates);foreach($columns AS $k=>$v)$columns[$k]=trim($v);$str='';$str=implodeKeyVals($insertUpdates,"`='","',`");$this->query("UPDATE `".$this->escape($this->tablePrefix.$this->tableName)."` SET `".$str."' WHERE id='".$result['id']."'");if($this->exe()===false)return 19;foreach($columns AS $k=>$v)$result[$v]=$insertUpdates[$v];}return $result;}

//return 1: invalid IP address passed in to $_SERVER['REMOTE_ADDR']
//return 2 One of the values within the [selects] array was found to be a non string value.
//return 3 One of the values within [selects] was found to be an empty string.
//return 4 A connection to the database has not yet been established therefore the query cannot be performed.
//return 5 An error occurred while searching for the IP address in the database. Call $this->error() for additional information.
//return 6 An error occurred while trying to select the [search] values within the database while handling the timestamp during the IP address insertion. Call the $this->error() method for more information.
//return 7 An error occurred while trying to insert the [inserts] values into the database while handling the timestamp during the IP address insertion. Call the $this->error() method for more information.
//return 8 An error occurred while trying to select the [selects] values from the newly inserted [inserts] in the database while handling the timestamp during the IP address insertion. Call the $this->error() method for more information.
//return 9 An error occurred while trying to insert the new IP address. Call the $this->error() method for more information.
//return 10 An error occurred while trying to select the [selects] values from the newly inserted IP address in the database. Call the $this->error() method for more information.
public function ip($selects=array())
{
	$ip=inet_pton($_SERVER['REMOTE_ADDR']);

	if($ip===false)return 1;

	$this->tablePrefix('');
	$this->tableName('ip');

	$ip=$this->insertGet(array('ip'=>$ip),array('ip'=>$ip),$selects,'timestamp');

	if($ip===5)return 2;
	else if($ip===6)return 3;
	else if($ip===12)return 4;
	else if($ip===13)return 5;
	else if($ip===14)return 6;
	else if($ip===15)return 7;
	else if($ip===16)return 8;
	else if($ip===17)return 9;
	else if($ip===18)return 10;

	return mysqli_fetch_assoc($ip);
}




//return 1 One of the values within the [selects] array was found to be a non string value.
//return 2 One of the values within [selects] was found to be an empty string.
//return 3 A connection to the database has not yet been established therefore the query cannot be performed.
//return 4 An error occurred while searching for the timestamp in the database. Call $this->error() for additional information.
//return 5 An error occurred while trying to insert the new timestamp. Call the $this->error() method for more information.
//return 6 An error occurred while trying to select the [selects] values from the newly inserted timestamp in the database. Call the $this->error() method for more information.
public function timestamp($selects=array())
{
	$this->tablePrefix('');
	$this->tableName('timestamps');

	$timestamp=time();

	$timestamp=$this->insertGet(array('timestamp'=>$timestamp),array('timestamp'=>$timestamp),$selects);

	if($timestamp===5)return 1;
	else if($timestamp===6)return 2;
	else if($timestamp===12)return 3;
	else if($timestamp===13)return 4;
	else if($timestamp===17)return 5;
	else if($timestamp===18)return 6;

	return mysqli_fetch_assoc($timestamp);
}


		public function getPersistant()
		{
			return $this->persistant;
		}

		/* Sets the database server/host.
		 * @param {string} [host     ] The database host name/server name.
		 * @return {int}   [Success:0] Database host successfully set.
		 * @return {int}   [Error  :1] [host] was a non string value but a string value is required.
		 * @return {int}   [Error  :2] [host] was a empty string
		 */
		public function host($host){if(!is_string($host))return 1;$host=trim($host);if($host==='')return 2;$this->server=trim($host);return 0;}

		/* Performs an insertion and retrieval of data or just a retrieval if the search data already exists. returns a mysqli result object on success.
		 * @param  {array(column=>value)} [search ] An array of strings where each key represents a column and the column's value is the search term. if this parameter is not set then this function only performs an insertion.
		 * @param  {array(column=>value)} [inserts] An array of strings. Each key represents a table column, each column's value represents the value to insert on that column
		 * @param  {array(string)}        [selects] An array of strings where each value represents the columns you wish to retrieve.
		 * @param  {string}               [timestamp] string or array representing the timestamp column(s) for this table. If it's empty or a non string value then the timestamp will be ignored for this function. if it's not an empty string then a timestamp will be generated if and only if an insertion is performed within this function.
		 * @param  {boolean}              [new] A reference value that will be set to false if no insertion was performed or true if an insertion was performed.
		 * @return {object}               [mysqli] retrieval successful. This function will now return a mysqli result object.
		 * @return {int} [Error:1 ] The [inserts] input must be an array.
		 * @return {int} [Error:2 ] The [inserts] array must not be empty.
		 * @return {int} [Error:3 ] One of the keys in the [inserts] array was found to be a non string value.
		 * @return {int} [Error:4 ] One of the values within the [inserts] array was found to not be an int, float, or string value.
		 * @return {int} [Error:5 ] One of the values within the [selects] array was found to be a non string value.
		 * @return {int} [Error:6 ] One of the values within [selects] was found to be an empty string.
		 * @return {int} [Error:7 ] The [search] input was found to be a non array value.
		 * @return {int} [Error:8 ] The [search] input was found to be an empty array.
		 * @return {int} [Error:9 ] One of the keys in the [search] input was found to be a non string value.
		 * @return {int} [Error:10] One of the values in the [search] input was found to not be a string, int, or float.
		 * @return {int} [Error:11] No table currently set to perform the selection on.
		 * @return {int} [Error:12] A connection to the database has not yet been established therefore the query cannot be performed.
		 * @return {int} [Error:13] An error occurred while searching for the given values in the database. Call $this->error() for additional information.
		 * @return {int} [Error:14] An error occurred while trying to select the [search] values within the database while handling the timestmap. Call the $this->error() method for more information.
		 * @return {int} [Error:15] An error occurred while trying to insert the [inserts] values into the database while handling the timestamp. Call the $this->error() method for more information.
		 * @return {int} [Error:16] An error occurred while trying to select the [selects] values from the newly inserted [inserts] in the database while handling the timestamp. Call the $this->error() method for more information.
		 * @return {int} [Error:17] An error occurred while trying to insert the [inserts] values into the database. Call the $this->error() method for more information.
		 * @return {int} [Error:18] An error occurred while trying to select the [selects] values from the newly inserted [inserts] in the database. Call the $this->error() method for more information.
		 */
		public function insertGet($search,$inserts,$selects=array(),$timestamp='',&$new=false){$table=$this->escape($this->tablePrefix.$this->tableName);if(!is_array($inserts))return 1;if(count($inserts)===0)return 2;foreach($inserts AS $k => $v){if(!is_string($k))return 3;if(!is_string($v)&&!is_int($v)&&!is_float($v))return 4;$v=strval($v);$inserts[$k]=$this->escape($v);}$result=$this->get($selects,$search,true);$isInt=is_int($result);if($isInt&&$result!==10)return $result+4;else if(!$isInt){$new=false;return $result;}if(is_array($timestamp)){$tmp=array();foreach($timestamp AS $k=>$v)if(is_string($v))array_push($tmp,trim($v));$timestamp=$tmp;}else if(is_string($timestamp)){$timestamp=trim($timestamp);if($timestamp==='')$timestamp=array();else{$timestamp=array($timestamp);}}else{$timestamp=array();}$arrOfKeys=arrayToArrayOfKeys($inserts);if(count($timestamp)!==0&&!atLeastOneMatch($timestamp,$arrOfKeys)){$table=$this->getTableName();$this->tableName('timestamps');$time=time();$timestampId=$this->insertGet(array('timestamp'=>$time),array('timestamp'=>$time),array('id'));if($timestampId===14)return 14;else if($timestampId===15)return 15;else if($timestampId===16)return 16;$timestampId=mysqli_fetch_assoc($timestampId);$timestampId=$timestampId['id'];$this->tableName($table);foreach($timestamp AS $k=>$v)$inserts[$v]=$timestampId;}$colStr='';$valStr='';foreach($inserts AS $k => $v){if($colStr!=='')$colStr.='`,`';if($valStr!=='')$valStr.="','";$colStr.=$k;$valStr.=$v;}$colStr='`'.$colStr.'`';$valStr="'".$valStr."'";$this->query('INSERT INTO `'.$table.'`('.$colStr.') VALUES('.$valStr.')');$result=$this->exe();if($result===false)return 17;$this->query('SELECT '.$selects.' FROM `'.$table."` WHERE `id`='".mysqli_insert_id($this->link())."'");$result=$this->exe();if(mysqli_num_rows($result)>0){$new=true;return $result;}return 18;}

		/* Searches this database for the given values and returns the given result as a mysqli object.
		 * @param  {array(string)}                                  [selects      ] An array of strings where each value represents the columns you wish to retrieve.
		 * @param  {array(column{string}=>value{string/int/float})} [search       ] An array of strings where each key represents a column and the column's value is the search term. if this parameter is not set then this function only performs an insertion.
		 * @param  {array({string})}                                [modifySelects] True if you want the [selects] input to be modified into a string. False if not. This is useful so that the calling function doesn't have to create its own [selects] string.
		 * @param  {array({string})}                                [modifySearch ] True if you want the [search] input to be modified into a string. False if not. This is useful so that the calling function doesn't have to create its own [search] string.
		 * @return {object} [mysqli ] retrieval successful. This function will now return a mysqli result object.
		 * @return {int}    [Error:1] One of the values within the [selects] array was found to be a non string value.
		 * @return {int}    [Error:2] One of the values within [selects] was found to be an empty string.
		 * @return {int}    [Error:3] The [search] input was found to be a non array value.
		 * @return {int}    [Error:4] The [search] input was found to be an empty array.
		 * @return {int}    [Error:5] One of the keys in the [search] input was found to be a non string value.
		 * @return {int}    [Error:6] One of the values in the [search] input was found to not be a string, int, or float.
		 * @return {int}    [Error:7] No table currently set to perform the selection on.
		 * @return {int}    [Error:8] A connection to the database has not yet been established therefore the query cannot be performed.
		 * @return {int}    [Error:9] An error occurred while searching for the given values in the database. Call $this->error() for additional information.
		 * @return {int}    [Error:10] No results were matched to the [search] input.
		 */
		public function get(&$selects,&$search,$modifySelects=false,$modifySearch=false){$newSelects=$selects;if(!is_array($newSelects))$newSelects=array();foreach($newSelects AS $k => $v){if(!is_string($v))return 1;$newSelects[$k]=$this->escape(trim($v));if($newSelects[$k]==='')return 2;}if(!in_array('id',$newSelects))array_push($newSelects,'id');$selectStr='';foreach($newSelects AS $k => $v){if($selectStr!=='')$selectStr.=',';$selectStr.='`'.$v.'`';}if($modifySelects)$selects=$selectStr;if(!is_array($search))return 3;if(count($search)===0)return 4;$newSearch=$search;$newSelects=$selects;foreach($newSearch AS $k => $v){if(!is_string($k))return 5;if(!is_string($v)&&!is_int($v)&&!is_float($v))return 6;$v=strval($v);$newSearch[$k]=$this->escape($v);/*Trim messes up binary strings. Plus: What if the user WANTS whitespace.*/}$searchStr='';$table=$this->escape($this->tablePrefix.$this->tableName);foreach($newSearch AS $k => $v){if($searchStr!=='')$searchStr.=' AND ';$searchStr.= '`'.$table.'`.`'.$k."`='".$v."'";}if($modifySearch)$search=$searchStr;$this->query('SELECT '.$selectStr.' FROM `'.$table.'` WHERE '.$searchStr);if($this->tableName===''&&$this->tablePrefix==='')return 7;if($this->link===false)return 8;$result=$this->exe();if(!$result)return 9;if(mysqli_num_rows($result)>0)return $result;return 10;}

		//Creates a new timestamp in the database and returns the result.
		public function newTimestamp($selects=array())
		{
			$time=time();

			if(!is_array($selects))$selects=array();

			foreach($selects AS $k => $v)
			{
				if(!is_string($k))return ;

				if(!is_string($v)&&!is_int($v)&&!is_float($v))return 1;

				$selects[$k]=$this->escape(trim($v));
			}

			if(!in_array('id',$selects))array_push($selects,'id');

			$return=insertGet(array('timestamp'=>$time),array('timestamp'=>$time),$selects,'');

			if(!is_int($return))return $return;

//handle error message here.
		}

		public function password($password)
		{
			if(!is_string($password))return 1;

			$this->password=trim($password);

			return 0;
		}

		public function username($username)
		{
			if(!is_string($username))return 1;

			$this->username=trim($username);

			return 0;
		}

		/*Retest this function (I added $permanent/$this->persistant checks.
		 * @return {bool:true}  Database connection successfully established
		 * @return {bool:false} Failed to establish a database connection.
		 */
		public function connect($permanent=null){if(!is_bool($permanent))$permanent=$this->persistant;$host=$this->server;if($permanent)$host='p:'.$host;$this->link=mysqli_connect($host,$this->username,$this->password,$this->dbName);if($this->link===false)return false;return true;}

		/*
		 * @return {int} [0] Connection successfully closed.
		 * @return {int} [1] There is no active connection therefore there is nothing to disconnect from.
		 * @return {int} [2] An error prevented the connection from being closed.
		 */
		public function disconnect()
		{
			if($this->link!==false)
			{
				$result=mysqli_close($this->link);

				if(!$result)return 2;
$this->link=false;
				return 0;
			}

			return 1;
		}


		public function tableName($name)
		{
			if(!is_string($name))return 1;

			$name=trim($name);

			$this->tableName=$name;

			return 0;
		}

		public function clearTableName()
		{
			$this->tableName='';
		}

		public function getTableName()
		{
			return $this->tableName;
		}

		public function tablePrefix($prefix)
		{
			if(!is_string($prefix))return 1;

			$prefix=trim($prefix);

			$this->tablePrefix=$prefix;

			return 0;
		}

		public function clearTablePrefix()
		{
			$this->tablePrefix='';
		}

		public function getTablePrefix()
		{
			return $this->tablePrefix;
		}

		public function databaseName($name)
		{
			if(!is_string($name))return 1;

			$name=trim($name);

			$this->dbName=$name;

			return 0;
		}

		public function getDatabaseName()
		{
			return $this->dbName;
		}

		public function getUserName()
		{
			return $this->username;
		}

		public function getPassword()
		{
			return $this->password;
		}

		/* Checks if the given [search] values are in the database and returns the id/row the values were found on. If they aren't found then a value less than 0 will be returned.
		 * @param {array(string=>string/int/float)} [search] An array where the keys are the columns to search within the database and the values are the values to search for within those columns.
		 * @return {int}   [>0] The given [search] values were found within the database. The returned integer is the ID of the row that was found.
		 * @return {int}   [-1] The value passed in for [search] was found to be a non array value.
		 * @return {int}   [-2] The value passed in for [search] was found to be an empty array.
		 * @return {int}   [-3] One of the values passed in for [search] was found to not be a string, float, or integer.
		 * @return {int}   [-4] One of the columns/keys in [search] was found to be a non string value.
		 * @return {int}   [-5] No database connection is currently established.
		 * @return {int}   [-6] No tables currently set to perform the selection against.
		 * @return {int}   [-7] The values passed in for [search] were not found in the database.
		 */
///Test this function and the error messages ONE MORE TIME, then you can safely delete this comment.
		public function inDatabase($search){if(!is_array($search))return -1;if(count($search)===0)return -2;foreach($search AS $k => $v){if(!is_string($v)&&!is_int($v)&&!is_float($v))return -3;if(!is_string($k))return -4;$v=strval($v);$value[$k]='`'.$this->escape(trim($k))."`='".$this->escape($v)."'";}if($this->link===false)return -5;if($this->tablePrefix===''&&$this->tableName==='')return -6;$this->query('SELECT id FROM `'.$this->escape($this->tableName.$this->tablePrefix).'` WHERE '.implode(' AND ',$value).' LIMIT 1');$result=$this->exe();if(mysqli_num_rows($result)===0)return -7;return mysqli_fetch_row($result)[0];}

		/*
		 * @param {string} [name]         Name to give the new table.
		 * @param {string} [type]         Type of data this column will hold.
		 * @param {array}  [parameters=null] The parameters to pass into the column. Each intry in the array must be ain integer or string.
		 * @param {array}  [options=null] The extra options to give the column. Each entry in the array must be a string. (options are values such as UNSIGNED, ZEROFILL, NOT NULL, AUTO_INCREMENT, etc)
		 * @param {string} [default=null] The default value to give this column. If you wish to give it 'NULL' then pass 'NULL' as a string, otherwise a literal null value will cause no default to be set.
		 * @param {int}    [default=null] The default value to give this column. If you wish to give it 'NULL' then pass 'NULL' as a string, otherwise a literal null value will cause no default to be set.
		 * @param {int}    [escapeDefault=true] whether or not [default] will be escaped. Be careful with this. It's useful to set to 'false' in the event [default] is a sql function call.
*$index? (Find out what this variable is for again).
		 * @return {int}   [0]
		 */
		public function createTableColumn($name, $type, $parameters=null, $options=null, $default=null,$escapeDefault=true, $index=false)
		{
			if(!is_string($name))return 1;

			$name=trim($name);

			if($name==='')return 2;

			if(!is_string($type))return 3;

			$type=trim($type);

			if($type==='')return 4;

			if(!is_bool($index))return 5;

			if(is_string($default))
			{
				$default=trim($default);

//if($default==='')return 6;
				$default=$this->escape($default);

				if(is_int($default))return 7;

				if($escapeDefault)$default="'".$default."'";
			}
			else if($default!==null&&!is_int($default)&&!is_float($default))return 8;

			$column=array($name,$type,array(),array(),$default,$index);

			if(!is_array($parameters))
			{
				if(!is_null($parameters))return 9;
			}
			else
			{
				foreach($parameters AS $k=>$v)
				{
					if(is_string($v))$v=$this->escape($v);
					else if(!is_int($v))return 10;

					$parameters[$k]=$v;

					array_push($column[2],$parameters[$k]);
				}
			}

			if(!is_array($options))
			{
				if(!is_null($options))return 11;
			}
			else
			{
				foreach($options AS $k=>$v)
				{
					if(is_string($v))$v=strtoupper(trim($this->escape($v)));
					else{return 12;}

					if(is_int($v))return 13;

					$options[$k]=$v;

					array_push($column[3],$options[$k]);
				}
			}

			array_push($this->createTableColumns,$column);

			return 0;
		}

		public function createTable()
		{
			$this->sql='CREATE TABLE ';
			$parameters='';
			$indexes='';
			$structure='';

			if($this->tableName==='')return 1;

			$this->sql.='`'.$this->escape($this->tablePrefix.$this->tableName).'` (';

			foreach($this->createTableColumns AS $k=>$v)
			{
				$parameters='';

				if($structure!=='')$structure.=',';

				$structure.='`'.$this->escape($v[0]).'` ';
				$structure.=$v[1];

				if(count($v[2])>0)
				{
					foreach($v[2] as $k2=>$v2)
					{
						if(strlen($parameters)>0)$parameters.=',';
						else{$parameters='(';}

						$parameters.=$v2;
					}

					$parameters.=')';
				}

				$structure.=$parameters;

				foreach($v[3] as $k2=>$v2)$structure.=' '.$v2;

				if($v[4]!==null)$structure.=' DEFAULT '.$v[4];

				$index='';

				if($v[5]&&!in_array('UNIQUE',$v[3]))
				{
					$index=', INDEX `'.$v[0].'`(`'.$v[0].'`)';
				}

				$structure.=$index;
			}

			$this->sql.=$structure.')';

			$this->exe();
		}

		public function link()
		{
			return $this->link;
		}

		public function query($query)
		{
			$this->sql=$query;
		}

		//Returns FALSE on failure. For successful SELECT, SHOW, DESCRIBE or EXPLAIN queries mysqli_query() will return a mysqli_result object. For other successful queries mysqli_query() will return TRUE.
		//return 1: error, no database connection is currently established.
		public function exe()
		{
			if($this->link===false)return 1;

			return mysqli_query($this->link,$this->sql);
		}

		/*
		 * @param  {string} [value] The string value to escape.
		 * @return {string}         String value successfully escaped.
		 * @return {int   } [0    ] The given [value] must be a string or an array of strings but it was found to be of a differenet type.
		 * @return {int   } [1    ] There is currently no link to the database but a link must have been previously established in order to properly escape the given string
		 * @return {int   } [2    ] An error occurred while trying to escape the input [value]
		 */
		public function escape($value)
		{
			if($this->link===false)return 1;

			if(is_string($value)||is_int($value)||is_float($value))
			{
				$return=mysqli_real_escape_string($this->link,$value);

				if($return===null)return 2;
			}
			else if(is_array($value))
			{

				$return=array();

				foreach($value as $k=>$v)
				{
					if(!is_string($v)&&!is_int($value)&&!is_float($value))return 3;

					array_push($return,mysqli_real_escape_string($this->link,$v));
				}
			}
			else{return 0;}

			return $return;
		}

		public function clearCreateTableColumns()
		{
			$this->createTableColumns=array();
		}

		public function createTableUnique($column)
		{
			if(!is_string($column))return 0;

			$column=trim($column);

			if($column==='')return 1;

			$this->createTableUnique=$column;
		}

		public function clearCreateTable()
		{
			$this->clearCreateTableColumns();
			$this->createTableName('');
		}

//add error handling here.
		public function error()
		{
			return mysqli_error($this->link);
		}
	}


//$SWIM['stripe.com']['webhook_secret']='';
//$SWIM['stripe.com']['publishable_key']='';
//$SWIM['stripe.com']['secret_key']='';
//require $SWIM['basepath'].'../swim/stripe/init.php';
//header('Content-Type: application/json');
	class stripe
	{
		private static $currencyCodes=[];
		private $currencyCode='USD';
		private $totalPrice=50;

		//$code: the currency code string: 'USD', etc etc etc. https://stripe.com/docs/currencies
		private function addCurrencyType($code,$minimum)
		{
			if(!canBeString($code))
			{
				http_response_code(400);
				json_encode(['error'=>'Invalid value passed in to stripe->addCurrencyType->code: '.$code]);
				exit();
			}

//change is_numeric to something more robust: something that TRULY checks whether or not $minimum is an integer or can be converted to an integer.
			if(!is_numeric($minimum))
			{
				http_response_code(400);
				json_encode(['error'=>'Invalid value passed in to stripe->addCurrencyType->minimum: '.$minimum]);
				exit();
			}

			$code=trim(strtoupper((string)$code));
			$minimum=(int)$minimum;

			if(!array_key_exists($code,self::$currencyCodes))self::$currencyCodes[$code]=[];

			self::$currencyCodes[$code]['minimum']=$minimum;
		}

		public function setTotal($total)
		{
//change is_numeric to something more robust: something that TRULY checks whether or not $total is an integer or can be converted to an integer.
			if(!is_numeric($total))
			{
				http_response_code(400);
				json_encode(['error'=>'Invalid value passed in to stripe->setTotal->total: '.$total]);
				exit();
			}

			$total=(int)$total;

			if($total<self::$currencyCodes[$this->currencyCode]['minimum'])
			{
				http_response_code(400);
				json_encode(['error'=>"Amount passed in to stripe->setTotal->total is too low for stripe's minimum allowed amount: ".$total]);
				exit();
			}

			$this->totalPrice=$total;
		}

		function __construct()
		{
			$this->addCurrencyType('USD',50);

			$this->setCurrency('USD',50);
		}

		function setCurrency($currencyCode,$total=NULL)
		{
			if(!canBeString($currencyCode))
			{
				http_response_code(400);
				json_encode(['error'=>'Invalid value passed in to stripe->setCurrency->currencyCode: '.$currencyCode]);
				exit();
			}

			$currencyCode=trim(strtoupper((string)$currencyCode));

			if(!array_key_exists($currencyCode,self::$currencyCodes))
			{
				http_response_code(400);
				json_encode(['error'=>'Currency code does not exist: '.$currencyCode]);
				exit();
			}

			$this->currencyCode=$currencyCode;

			if($total===NULL)$total=$this->totalPrice;

			$this->setTotal($total);
		}

///This function isn't needed yet. Eventually I shold add it to integrate into my customer's admin panels!!!
//This will basically create a new endpoint every time it's called... so be careful of how you use it.
function createWebhook()
{
GLOBAL $SWIM;
\Stripe\Stripe::setApiKey($SWIM['stripe.com']['secret_key']);

$endpoint=\Stripe\WebhookEndpoint::create(
[
	'url'=>'http://MY-IP-ADDRESS-WAS-HERE/cosmicunicornsv1/public_html/stripetest/stripe-webhook.php',
	'enabled_events'=>
	[
		'charge.failed',
		'charge.succeeded',
	],
]);

return $endpoint;
}



		//This should always be called before charging the card. Specifically in the javascript file
		//I would recommend calling json_encode() on the result returned from this function if you wish to echo it out as a string value. Perhaps to retrieve from an async request.
		function createPaymentIntent()
		{
			GLOBAL $SWIM;

			$request=new request();

			\Stripe\Stripe::setApiKey($SWIM['stripe.com']['secret_key']);


			if(!$request->isPost()||json_last_error()!==JSON_ERROR_NONE)
			{
				http_response_code(400);
				return ['error'=>'Invalid request.'];
			}

			$paymentIntent=\Stripe\PaymentIntent::create(
			[
				'amount'=>$this->totalPrice,
				'currency'=>$this->currencyCode
			]);
//for now, keep the 'clienetSecret' entry until you change it in the javascript library.
			return [
				'paymentintentresponse'=>$paymentIntent,
				'error'=>null,
				'publishableKey'=>$SWIM['stripe.com']['publishable_key'],
				'clientSecret'=>$paymentIntent->client_secret
			];
		}

/////////////////////////////////////////
//Add the ability to set a chargeID from a local/class variable that can be set from a setChargeID function if the input, $chargeId, isn't a string.
//Add ability to set refund amount.
		function refund($chargeId=NULL)
		{
			GLOBAL $SWIM;

			$request=new request();

			\Stripe\Stripe::setApiKey($SWIM['stripe.com']['secret_key']);

			$refund=\Stripe\Refund::create(
			[
				'charge' => $chargeId,
			]);

			return $refund;
		}
////////////////////////////////////////
		
		//https://dashboard.stripe.com/test/webhooks
		//returns [false,error message] if the webhook is invalid
		//returns [true, webhook event] if it's valid.
		function verifyWebhook($webhookSecret)
		{
			GLOBAL $SWIM;

			$request=new request();

			\Stripe\Stripe::setApiKey($SWIM['stripe.com']['secret_key']);
			$input=file_get_contents('php://input');

			if(!$request->isPost()||json_last_error()!==JSON_ERROR_NONE)
			{
				http_response_code(400);
				return json_encode(['error'=>'Invalid request.']);
			}

			$event=null;

			try
			{
///////////////////Make sure to modify $config['stripe_webhook_secret']
				//Make sure the event is coming from Stripe by checking the signature header
				$event=\Stripe\Webhook::constructEvent($input,$_SERVER['HTTP_STRIPE_SIGNATURE'],$webhookSecret);
			}
			catch(Exception $e)
			{
				//http_response_code(403);
				return [false,$e->getMessage()];
				//die(json_encode(['error'=>$e->getMessage()]));
			}

			return [true,$event];
			//$details='';

			//Fulfill any orders, e-mail receipts, etc
			//To cancel the payment you will need to issue a Refund (https://stripe.com/docs/api/refunds)
			//if($event->type=='payment_intent.succeeded')$details='Payment received!';
			//else if($event->type=='payment_intent.payment_failed')$details='Payment failed.';

			//$output=[
			//	'status'=>'success',
			//	'details'=>$details
			//];

			//echo json_encode($output,JSON_PRETTY_PRINT);
		}
/*
		//The amount to chage on the card (amount is in pennies, use an integer value only!)
		//
		function chargeCard($amount)
		{
			GLOBAL $SWIM;

\Stripe\Stripe::setApiKey('sk_test_svzUBjY0OffuHabP1aS5i15m00brLesgRO');

$charge=\Stripe\Charge::create(
[
	'amount' => $amount,
	'currency' => 'usd',
	'source' => 'tok_visa',
	'receipt_email' => 'darkragenemesis@hotmail.com',
	'description'=>'Charge for book number 219',
	'shipping'=>
	[
		'address'=>'2714 Red Lion Square',
		'name'=>'Shawn Lowell',
		//'carrier'=>('Fedex'||'UPS'||'USPS'),
		'phone'=>'8632870900'
	]
]);

		}
*/
		function cardSource()
		{

/*
ayment_method_details.type
string
The type of transaction-specific details of the payment method used in the payment, one of ach_credit_transfer, ach_debit, alipay, bancontact, card, card_present, eps, giropay, ideal, klarna, multibanco, p24, sepa_debit, sofort, stripe_account, or wechat. An additional hash is included on payment_method_details with a name matching this value. It contains information specific to the payment method.
*/
{
	
}
		}
	}


//Add a feature that allows a unique session identifier. useful in the event multiple sites/logins are used on a single hosting instance!!!.
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
					if(!array_key_exists('userid',$_SESSION))$_SESSION['userid']=null;

					return 0;
				}

				return 2;
			}

			return 1;
		}

		public function sessionExists()
		{
			if(session_id()==''||!isset($_SESSION))return false;

			return true;
		}

		/* Sets the user's ID into the session data.
		 * @return {int} [0] User ID successfully set.
		 * @return {int} [1] No session exists, thus the user ID could not be set.
		 */
		public function setUserId($id)
		{

			if($this->sessionExists())
			{
				$_SESSION['userid']=$id;
				return 0;
			}

			return 1;
		}

		public function setRole($role)
		{

			if($this->sessionExists())
			{
				$_SESSION['role']=$role;
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
			if(!$this->sessionExists())
			{
				$success=false;

				return null;
			}

			$success=true;

			return $_SESSION['userid'];
		}
		public function getRole(&$success=false)
		{
			if(!$this->sessionExists())
			{
				$success=false;

				return null;
			}

			$success=true;

			return isset($_SESSION['role'])?$_SESSION['role']:1;
		}
	
	}

	
?>