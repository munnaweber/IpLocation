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

//this is optional. Find this api key by visiting https://ipinfodb.com/
$api_key = "API_KEY"; 

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

// get continent
$continent = $location->continent;

// get country name
$countryName = $location->countryName;

// get city name If you set api_key when create instance
$cityName = $location->cityName;

// get zip code If you set api_key when create instance
$zipCode = $location->zipCode;

// get timezone If you set api_key when create instance
$timeZone = $location->timeZone;

// get country code
$countryCode = $location->countryCode;

// get nationality
$nationality = $location->nationality;

// get currency name
$currency = $location->currency;

// get ioc name
$ioc = $location->ioc;

// get flag url
$flag = $location->flag;

// get latitude
$lat = $location->lat;

// get longitude
$long = $location->long;

// get map info by google map
$map = $location->map;

// get more geo info
$geo = $location->geo;

// get main language
$lanugage = $location->lanugage;

// More supported languages
$official_lanugages = $location->official_lanugages;
```

## License
This package is open-sources and licensed under the [MIT license](https://opensource.org/licenses/MIT).

Thank you very much.