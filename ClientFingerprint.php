<?php

class ClientFingerprint
{
	
	const SESSION_KEY = 'fingerprint';
		
	static $incomingFingerprint;  //HTTP headers: hash of ip and useragent
	static $storedFingerprint;	//stored inside session ID, PHPSESSID
	 
	public static function process()
	{			
		self::$incomingFingerprint = md5($_SERVER['REMOTE_ADDR']
		.$_SERVER['HTTP_USER_AGENT']);

		self::$storedFingerprint = $_SESSION[self::SESSION_KEY] ?? NULL;
	
		if (empty(self::$storedFingerprint)) {  //create fingerprint for new session ID
			self::$storedFingerprint = self::$incomingFingerprint;
			$_SESSION[self::SESSION_KEY] = self::$storedFingerprint;
		}
		$instance = new self;
		return $instance->validate();

	}

	/*
      compare fingerprint between incoming and stored 
      fingerprints that belongs to the same session ID 
	*/
	private function validate()  
	{
			if (self::$incomingFingerprint != self::$storedFingerprint) {
			 	session_destroy();
			 	return false;
			
			} else {
				return true;
			}
			
	}

	
}