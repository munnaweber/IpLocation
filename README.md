<a href="https://github.com/MunnaAhmed/IpLocation/issues"><img src="https://img.shields.io/github/issues/MunnaAhmed/IpLocation"><a/>
<a href="https://github.com/MunnaAhmed/IpLocation/network/members"><img src="https://img.shields.io/github/forks/MunnaAhmed/IpLocation"><a/>
<a href="https://github.com/MunnaAhmed/IpLocation/stargazers"><img src="https://img.shields.io/github/stars/MunnaAhmed/IpLocation"><a/>
<a href="https://packagist.org/packages/munna/iplocation"><img src="https://img.shields.io/github/license/MunnaAhmed/IpLocation"><a/>


# Ip Location Tracking
Tracking location info by ip address.

## Installing IpLocaiton

Next, run the Composer command to install the latest stable version:

```bash
composer require munna/iplocation
```

## Create A Class Instance

to create a class instance 
```php

// Use this as namespace
use Munna\IpLocation\IpLocation;

// Set Your Ip Address
$ip = "YOUR_IP_ADDRESS";

//this is optional. Find this api key by visiting https://ipinfo.io/account/home?service=google&loginState=create
$api_key = "API_TOKEN"; 

//If you have this api_key 
$location = new IpLocation($ip, $api_key);

// If you do not have this api_key pass only ip
$location = new IpLocation($ip);

// Finally init the class
$location->init();
```

After init class instance. You will be get the all of these data.

## Provided Data

```php
// Get Ip Address
$ip = $location->ip;

//full info as an array
$info = $location->info();

// get region name
$region = $location->region;

// get country
$country = $location->country;

// get city name If you set api_key when create instance
$cityName = $location->city;

// get ioc name
$loc = $location->loc;

// get postal
$postal = $location->postal;

// get flag url
$flag = $location->flag;

// get timeZone
$timeZone = $location->timeZone;
```

## JSON data sample For All Info

```json
{
    "ip": "27.147.201.241",
    "hostname": "dhknat-27.147.201.241.link3.net",
    "city": "Dhaka",
    "country": "BD",
    "region": "Dhaka",
    "loc": "23.7104,90.4074",
    "postal": "1000",
    "org": "AS23688 Link3 Technologies Ltd.",
    "flag": "https://raw.githubusercontent.com/MunnaAhmed/Flags/main/bd.png"
}
```

## License
This package is open-sources and licensed under the [MIT license](https://opensource.org/licenses/MIT).

Thank you very much. Please give a star.
