<?php 
namespace Munna\IpLocation;
use Munna\IpLocation\Exceptions\IpLocationException;

class IpLocation{
    public $apiKey;
    public $ip;
    public $continent;
    public $countryName;
    public $ipJson;
    public $ioc;
    public $region;
    public $countryCode;
    public $nationality;
    public $lanugage;
    public $official_lanugages;
    public $geo;
    public $currency;
    public $flag;
    public $lat;
    public $long;
    public $map;
    // Extra Info
    public $cityName;
    public $zipCode;
    public $timeZone;
    // Consttuctor
    public function __construct($ip, $key = null){
        if($ip == null){
            throw new IpLocationException("Please use an IP address to create instance");
        }
        $this->ip = $ip;
        if($key){
            if (!preg_match('/^[0-9a-z]{64}$/', $key)) {
                throw new IpLocationException("Invalid IPInfoDB API key.");
            }
            $this->apiKey = $key;
        }
    }

    // init function
    public function init(){
        $url = "https://api.ipgeolocationapi.com/geolocate/".$this->ip;
        try{
            $info = file_get_contents($url);
            $data = json_decode($info, true);
            if(isset($data['message']) && $data['message'] == "Could not geocode request."){
                throw new IpLocationException("Could not geocode request. May Be IP address is invalid");
            }
            $data = json_decode($info);
            $this->continent = $data->continent ?: null;
            $this->countryName = $data->name ?: null;
            $this->ioc = $data->ioc ?: null;
            $this->region = $data->region ?: null;
            $this->countryCode = $data->un_locode ?: null;
            $this->nationality = $data->nationality ?: null;
            $this->lanugage = $data->languages_official[0] ?: null;
            $this->official_lanugages = $data->languages_official ?: null;
            $this->geo = $data->geo ?: null;
            $this->lat = $data->geo->latitude ?: null;
            $this->long = $data->geo->longitude ?: null;
            $this->currency = $data->currency_code ?: null;
            $this->map = "https://www.google.com/maps/@$this->lat,$this->long,17z";
            $this->flag = 'https://raw.githubusercontent.com/MunnaAhmed/Flags/main/'.strtolower($data->un_locode).'.png';
        }catch(Exception $e){
            throw new IpLocationException("Location Parsing Problem. Please try again later");
        }

        if($this->apiKey != null){
            $this->getAddress();
        }
    }

    public function info(){
        return [
            "ip" => $this->ip,
            "region" => $this->region,
            "continent" => $this->continent,
            "countryName" => $this->countryName,
            "cityName" => $this->cityName,
            "zipCode" => $this->zipCode,
            "timeZone" => $this->timeZone,
            "countryCode" => $this->countryCode,
            "nationality" => $this->nationality,
            "currency" => $this->currency,
            "ioc" => $this->ioc,
            "flag" => $this->flag,
            "lat" => $this->lat,
            "long" => $this->long,
            "map" => $this->map,
            "geo" => $this->geo,
            "lanugage" => $this->lanugage,
            "official_lanugages" => $this->official_lanugages,
        ];
    }

	public function getCountry(){
        $ip = $this->ip;
		$response = @file_get_contents('http://api.ipinfodb.com/v3/ip-country?key=' . $this->apiKey . '&ip=' . $ip . '&format=json');
		if (($json = json_decode($response, true)) === null) {
			$json['statusCode'] = 'ERROR';
			return false;
		}
		$json['statusCode'] = 'OK';
		return response()->json($json);
	}

	public function getCity(){
        $ip = $this->ip;
		$response = @file_get_contents('http://api.ipinfodb.com/v3/ip-city?key=' . $this->apiKey . '&ip=' . $ip . '&format=json');
		if (($json = json_decode($response, true)) === null) {
			$json['statusCode'] = 'ERROR';
			return false;
		}
		$json['statusCode'] = 'OK';
		return response()->json($json);
	}
    
    public function getAddress(){
        $ip = $this->ip;
		$response = @file_get_contents('http://api.ipinfodb.com/v3/ip-city?key=' . $this->apiKey . '&ip=' . $ip . '&format=json');
		if (($json = json_decode($response, true)) === null) {
			$json['statusCode'] = 'ERROR';
			return false;
		}
        $json['statusCode'] = 'OK';
        $this->cityName = $json['cityName'];
        $this->zipCode = $json['zipCode'];
        $this->timeZone = $json['timeZone'];
		return response()->json(['cityName' => $this->cityName, 'zipCode' => $this->zipCode, 'tiemZone' => $this->timeZone]);
	}

}