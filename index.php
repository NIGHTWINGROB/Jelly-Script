	<?php

	require_once(dirname(__FILE__) . '/cfx_loaders/system.Loaders.php');
	$curl_handle=curl_init();
	
	// get product delivery address
		$delivery_latitude = 31.128340122952533;
		$delivery_longitude = -97.7334447;

		// Tomtom API endpoint and key
		$api_endpoint = "http://api.tomtom.com/search/2/search/ink.json";
		$api_key = "Ult26hJrDSqGRAY2qj9pPIRxrhfAcPc7";

		// parameters for API call
		$params = array(
			"key" => $api_key,
			"lat" => "lat=" . $delivery_latitude,
			"lon" => "lon=" . $delivery_longitude,
			"radius" => "=1000",
			"limit" => "=5"
			
		);

		// create a cURL handle
		$ch = curl_init();

		// set API endpoint and parameters
		curl_setopt($ch, CURLOPT_URL, $api_endpoint."?".http_build_query($params));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// execute API call and get response
		$response = curl_exec($ch);

		// decode response as JSON
		$delivery_order_data = json_decode($response, true);
		var_dump($delivery_order_data);

		// check for errors
		if(curl_errno($ch)) {
			echo "Error: " . curl_error($ch);
		} else {
			// display points of interest
			echo "<h2>Points of Interest</h2>";
			foreach($delivery_order_data['results'] as $result) {
				echo "<p>" . $result['poi']['name'] . "</p>";
			}
		}

		// close cURL handle
		curl_close($ch);
	?>