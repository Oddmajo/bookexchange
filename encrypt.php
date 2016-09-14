<?php
	function checkPassword($password)
	{
		$uppercase = false; //should have at least 1
		$lowercase = false; //should have at least 1
		$number = false; //should have at least 1
		
		//iterate through $password, and set the above to true when that requirement is fulfilled
		$len = strlen($password);
		
		//the string should be at least length 6
		if($len < 6)
			return false;
		
		//make sure there is 1 uppercase, 1 lowercase, and 1 number
		for($i = 0; $i < $len; $i++)
		{
			$curr = ord($password[$i]);
			
			if($number == false)
			{
				if($curr >= 48 && $curr <= 57)
					$number = true;
			}
			if($uppercase == false)
			{
				if($curr >= 65 && $curr <= 90)
					$uppercase = true;
			}
			if($lowercase == false)
			{
				if($curr >= 97 && $curr <= 122)
					$lowercase = true;
			}
			if($uppercase == true && $lowercase == true && $number == true)
				return true;
		}
		return false;
	}
	
	function encryptPassword($password)
	{
		$len = strlen($password);
		$len = $len/2;
		$newpassword = $password . substr($password, 0, $len);
		$password = md5($newpassword);
		return $password;
	}



?>