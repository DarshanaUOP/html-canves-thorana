<?php 
	date_default_timezone_set("Asia/Colombo");
	$dateAndTimeC = date('Y-m-d h:i:sa');
	$ipAddressC = $_SERVER['REMOTE_ADDR'];
    $browserC = $_SERVER['HTTP_USER_AGENT'];

	$sendObj = new \stdClass();
	if (isset($_POST)) {
		$str_data = file_get_contents("comments.json");
		$data = json_decode($str_data,true);
		// die($data);
		// foreach ($data as $key => $value) {
		// 	echo($value['name']);
		// }
		$myFile = "logs.json";
		$arr_data = array(); // create empty array
		try{
			   //Get form data
			   $formdata = array(
			      'date' =>$dateAndTimeC,
			      'IP' => $ipAddressC,
			      'browser' => $browserC
			   );
			   
			   //Get data from existing json file
			   $jsondata = file_get_contents($myFile);

			   // converts json data into array
			   $arr_data = json_decode($jsondata, true);

			   // print_r($formdata);

			   // Push user data to array
			   // array_push($arr_data,$formdata);
				$arr_data[] = $formdata;
		       //Convert updated array to JSON
			   $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
			   
			   //write json data into data.json file
			   if(file_put_contents($myFile, $jsondata)) {
			        
			   }
			    // echo "error";

			}catch (Exception $e) {
		        // echo 'Caught exception: ',  $e->getMessage(), "\n";
		   }

			die(json_encode($data));
	}


	
 ?>