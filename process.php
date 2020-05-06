<?php 
	//set time zone
	date_default_timezone_set("Asia/Colombo");
	
 	$sendObj = new \stdClass();
	if (isset($_POST['name']) && $_POST['comment']) {
		

	   $myFile = "comments.json";
	   $arr_data = array(); // create empty array
	try{
		   //Get form data
		   $formdata = array(
		      'name'=> $_POST['name'],
		      'comment'=> $_POST['comment'],
		   );

		   //Get data from existing json file
		   $jsondata = file_get_contents($myFile);

		   // converts json data into array
		   $arr_data = json_decode($jsondata, true);

		   print_r($formdata);

		   // Push user data to array
		   // array_push($arr_data,$formdata);
			$arr_data[] = $formdata;
	       //Convert updated array to JSON
		   $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);
		   
		   //write json data into data.json file
		   if(file_put_contents($myFile, $jsondata)) {
		        $sendObj->massage = "Done";
		        $sendObj->user = $_POST['name'];
		        $sendObj->comment = $_POST['comment'];
		    }
		   else 
		        // echo "error";
		    $sendObj->massage = "Error";
			$sendObj->cause = "Unable to save data on server";

	   }
	   catch (Exception $e) {
		    $sendObj->massage = "Error";
			$sendObj->cause = "Exception occured " . $e->getMessage();

            // echo 'Caught exception: ',  $e->getMessage(), "\n";
	   }		
	}else{
		$sendObj->massage = "Error";
		$sendObj->cause = "no necessary data";

	}
	
 ?>