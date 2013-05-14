<?php
	$user = "";
 	$passwords = array(
		"hunter2",
		"swordfish",
		"123456",
		"Joshua",
		"rosebud",
		"letmein",
		"xyzzy",
		"password",
		"iloveyou",
        "abc123",
        "mellon",
        "chair"
		);
	$password = array_rand($passwords);
	$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
	$host = explode(".",$host);
	$onstunet = false;
	if($host[1]=="stunet"){
		$onstunet = true;
		$device = substr($host[0],0,3);
		$user = substr($host[0],3);
	 	$data = array();
	   shell_exec("finger ".$user."@central",$data);   
   	$line = $data[5];
   	$line = explode(":",$line);
		$name=$line[2];
		$name=explode(" ",$name);
		$name=trim($name[1]);
	} else {
		$foo = 1;
		while($foo<4){
			$letter = chr(97 + mt_rand(0, 25));
			$user .= $letter;
			$foo++;
		} 
		$user .= rand(2,15);
		$name = "you";
	}
?>
