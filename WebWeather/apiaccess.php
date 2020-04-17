<?php


/*
if(isset($_GET["unit"])){
	
	$constant = 1;
	exit;
	
}else{
	$constant = 0;
}

*/



//Config API keys

$api_key_accuweather= "MOjGE9JEQob1JJNpv1JUJdFAuYytfqTF";
$api_key_openweather= "d4fe00827e9855d0d0e2442f3dd09be3";


// Define URLS
define("WEEK_DATA_SITE","dataservice.accuweather.com");
define("ACCUWEATHER_SERVICE_URI", WEEK_DATA_SITE."/forecasts/v1/daily/5day/<CITY_ID>?apikey=".$api_key_accuweather."&metric=True");

define("ACCUWEATHER_SERVICE_GETID_URI", WEEK_DATA_SITE."/locations/v1/cities/search?apikey=".$api_key_accuweather."&q=<CITY_NAME>");

define("MAIN_DATA_SITE","api.openweathermap.org");
define("OPENWEATHER_SERVICE_URI", MAIN_DATA_SITE."/data/2.5/weather?q=<CITY_NAME>&appid=".$api_key_openweather."&units=metric");



class WeatherData{

public $openweatherData ,$accuweatherData , $cityId ,$response;

public function retriveData($cityname){

$cityId = $this->getCiyId($cityname);
$this->getWeatherData($cityname);
$this->getWeekData($cityId);

}

//API to get City-Id
public function getCiyId($cityname){
	
//Curl Request for Accuweather to get City_id
$ch = curl_init();
$url = str_replace("<CITY_NAME>", $cityname, ACCUWEATHER_SERVICE_GETID_URI );
curl_setopt($ch , CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_VERBOSE,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);

$result=json_decode(curl_exec($ch),true);
$http_status = curl_getinfo($ch ,CURLINFO_HTTP_CODE);

// Check If key Expired or other error
if($http_status == 200){
	$this->cityId = $result;
$cityId = $this->cityId[0]['Key'];
	curl_close($ch);
	return $cityId;
	
}else {
	$errorMsg=$result['Code'];
	$errorDesc = $result['Message'];
	header("Location: ./error.php?msg=".$errorMsg."&desc=".$errorDesc);
	
	}

}

public function getWeekData($cityId){

//Curl Request for Accuweather 5 day data
$ch = curl_init();
$url = str_replace("<CITY_ID>", $cityId, ACCUWEATHER_SERVICE_URI);
//echo $url;
curl_setopt($ch , CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_VERBOSE,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);


$result = json_decode(curl_exec($ch), true);
$http_status = curl_getinfo($ch ,CURLINFO_HTTP_CODE);


//Check Response Code
if($http_status == 200){
  $this->accuweatherData =  $result;
  curl_close($ch);
	
}else {
	
	$errorMsg=$result['Code'];
	$errorDesc = $result['Message'];
		header("Location: ./error.php?msg=".$errorMsg."&desc=".$errorDesc);
	
}
	
}

public function getWeatherData($cityname){
	
//Curl Request for openweather one day Data
$ch = curl_init();
$url = str_replace("<CITY_NAME>", $cityname, OPENWEATHER_SERVICE_URI);
curl_setopt($ch , CURLOPT_HEADER,0);
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_VERBOSE,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);
$result = json_decode(curl_exec($ch),true);

$http_status = curl_getinfo($ch ,CURLINFO_HTTP_CODE);

if($http_status == 200){
	$this->openweatherData =$result;
	curl_close($ch);
}else{
	
	
	$errorMsg=$result['cod'];
	$errorDesc = $result['message'];
		header("Location: ./error.php?msg=".$errorMsg."&desc=".$errorDesc);
}



}

public function timestampToDate($dt){
	  //$dt = (int)$dt;
	$timestamp = new DateTime("@$dt");
	$date = $timestamp->format('n/j/Y');

	return $date;
}

public function timeStampToDay($dt){
	 $dt = (int)$dt;
	$timestamp = new DateTime("@$dt");
	$day = $timestamp->format('l,');
	return $day;
}


function tempConverter($temp ,$tempUnit) : string
{
	
	if($tempUnit== "0"){
		//Unit is C
		$temp  = (int)$temp;
		 return $temp."˚C";
		
	}else{
		//Unit is F
	   $temp = (int)($temp * 1.8 + 32);
	   
	   return $temp."˚F";
	}

}



public function setIconURl($icon_code){
	

	
		switch ($icon_code){
		//Match Open Weather Icons with Accuweather	
			case "01d":
			$icon_code = "01-s";
			break;
			
			case "01n":
			$icon_code = "33-s";
			break;
			
			case "02d":
			$icon_code = "02-s";
			break;		
			
			case "02n":
			$icon_code = "34-s";
			break;
						
			case "03d":
			$icon_code = "03-s";
			break;
						
			case "03n":
			$icon_code = "35-s";
			break;
			
			case "04d":
			$icon_code = "04-s";
			break;
						
			case "04n":
			$icon_code = "36-s";
			break;
			
			case "09d":
			$icon_code = "12-s";
			break;
			
			case "09n":
			$icon_code = "39-s";
			break;
			
			case "10d":
			case "10n":
			$icon_code = "18-s";
			break;
			
			case "11d":
			case "11n":
			$icon_code = "15-s";
			break;
			
			case "13d":
			case "13n":
			$icon_code = "22-s";
			break;
			
			case "50d":
			case "50n":
			$icon_code = "11-s";
			break;
			
			
		}
             $icon_code = (int)$icon_code;

			return "../resources/icons/accuweather/".$icon_code."-s.png";
}
}


?>