<?php
	session_start();

	//header("Location: index.php");

	$tName=$_REQUEST["username"];
	$tPass=$_REQUEST["password"];
	$datecurrent = date("d/m/Y");

	$wsdl = "https://passport.psu.ac.th/authentication/authentication.asmx?wsdl";
	$client = new SoapClient($wsdl,
	array(
		"trace" => 1,	// enable trace to view what is happening
		"exceptions" => 0,	// disable exceptions
		"cache_wsdl" => 0)); // disable any caching on the wsdl, encase you alter the wsdl server

	$params = array('username' => $tName,'password' => $tPass);
	$data = $client->Authenticate($params);

	if ($data->AuthenticateResult == 1) {
		$staff =$client->GetUserDetails($params);
		$staff_detail = $staff->GetUserDetailsResult;
		$user=$staff_detail->string[0];
		$staff_id=$staff_detail->string[3];
		$id_card=$staff_detail->string[5];
		$fac_id=$staff_detail->string[7];
		$email=$staff_detail->string[13];

		echo $staff_detail->string[0] . " " . $staff_detail->string[1] . " " . $staff_detail->string[2] . " " . $staff_detail->string[3] . " " . $staff_detail->string[4] . " " . $staff_detail->string[5] . " " . $staff_detail->string[6] . " " . $staff_detail->string[7] . " " . $staff_detail->string[8] . " " . $staff_detail->string[9] . " " . $staff_detail->string[10] . " " . $staff_detail->string[11] . " " . $staff_detail->string[12] . " " . $staff_detail->string[13] . " " . $staff_detail->string[14];

		if (substr($staff_id,0,1) != '0'){ //���������繹ѡ�֡������staff ������� ��.�͡���
			$_SESSION['username'] = $tName;
			$_SESSION['id_card'] = $id_card;
			//$_SESSION['id_card'] = $staff_id
			//header("Location: ../404.html");
			//exit;
		} else {
			if ($fac_id=='F11'){
				$_SESSION['username'] = $tName;
				$_SESSION['id_card'] = $id_card;
			}
			$_SESSION['username'] = $tName;
			$_SESSION['id_card'] = $id_card;

			//header("Location: ../500.html");
			//exit;	
		}
	} else {
		//redirect('index.php','refresh');
		header("Location: ../blank.html");
		exit;
	}
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
