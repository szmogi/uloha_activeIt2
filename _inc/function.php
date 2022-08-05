<?php

require_once 'config.php';


	// Converts a date to a timestamp.
	function time_form($data)
	{
		// Returns the timestamp of a date.
		$data = strtotime($data);
		$data = str_replace(' ', '&nbsp;', date('j M Y, G:i', $data));


		return $data;
	}


	// Converts a date to Y - M - d.
	function date_time($date)
	{
		$date = strtotime($date);
		$date = date('Y-m-d', $date);
	}


	// Strips slashes and htmlspecialchars.
	function test_input($data)
	{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}



	function validateIban($iban)
	{

		$api_key = "b4601f7cf505709d9036a681ff7fea37512f6fe3";

		$ibanApiUrl = "https://api.ibanapi.com/v1/validate/" . $iban . "?api_key=" . $api_key;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $ibanApiUrl);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($ch);
		curl_close($ch);

		return $data = json_decode($response);
	}











    




			
	

