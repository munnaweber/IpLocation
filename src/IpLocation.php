<?php
namespace Munna\IpLocation;
use Exception;
use Munna\IpLocation\Exceptions\IpLocationException;

class IpLocation{
    public $apiKey;
    public $ip;
    public $hostname;
    public $city;
    public $region;
    public $country;
    public $loc;
    public $org;
    public $postal;
    public $flag;
    public $timeZone;

    // Consttuctor
    public function __construct($ip, $key = null){
        if($ip == null){
            throw new IpLocationException("Please use an IP address to create instance");
        }
        $this->ip = $ip;
        $this->apiKey = $key;
    }

    // init function
    public function init(){
        $url = "https://ipinfo.io/".$this->ip;
        if ($this->apiKey != null) {
            $url .= "?token=".$this->apiKey;
        }

        $info = file_get_contents($url);
        $data = json_decode($info, true);
        if(isset($data['message']) && $data['message'] == "Could not geocode request."){
            throw new IpLocationException("Could not geocode request. May Be IP address is invalid");
        }
        $data = json_decode($info);

        $this->ip = $data->ip ?: null;
        $this->hostname = $data->hostname ?: null;
        $this->city = $data->city ?: null;
        $this->loc = $data->loc ?: null;
        $this->region = $data->region ?: null;
        $this->country = $data->country ?: null;
        $this->org = $data->org ?: null;
        $this->postal = $data->postal ?: null;
        $this->timeZone = $data->timezone ?: null;
        $this->flag = 'https://raw.githubusercontent.com/MunnaAhmed/Flags/main/'.strtolower($data->country).'.png';

        try{

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
            "hostname" => $this->hostname,
            "city" => $this->city,
            "country" => $this->country,
            "region" => $this->region,
            "loc" => $this->loc,
            "postal" => $this->postal,
            "org" => $this->org,
            "flag" => $this->flag
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
        $this->timeZone = $json['timeZone'];
		return response()->json(['cityName' => null, 'zipCode' => null, 'tiemZone' => $this->timeZone]);
	}

}
