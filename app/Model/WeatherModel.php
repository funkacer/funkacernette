<?php
namespace App\Model;

use Nette;

abstract class State {

	static public $arrayShow = [
		'weather-icon' => 'Počasí',
		'main-temp' => 'Teplota (°C)',
		'main-feels_like' => 'Pocitová teplota',
		'main-temp_min' => 'Teplota min.',
		'main-temp_max' => 'Teplota max.',
		'main-pressure' => 'Tlak vzduchu (hPa)',
		'main-humidity' => 'Vlhkost (%)',
		'wind-speed' => 'Rychlost větru (m/s)',
		'wind-deg' => 'Směr větru (°)',
		'wind-gust' => 'Nárazy větru (m/s)',
		'clouds-all' => 'Oblačnost (%)',
		'pop' => 'Pravděpodobnost srážek (%)',
		'rain-3h' => 'Úhrn srážek déšť (mm)<sup>*</sup>',
		'snow-3h' => 'Úhrn srážek sníh (mm)<sup>*</sup>',
		'visibility' => 'Viditelnost (m)',
		'sys-pod' => 'Den / Noc'
	];

	abstract public function getShowValuePlus($argKey);

	//weather+forecast=state(společné)
	public $sWeatherId = null; //forecast list
	public $sWeatherMain = null; //forecast list
	public $sWeatherDescription = null; //forecast list
	public $sWeatherIcon = null; //forecast list
	public $sMainTemp = null; //forecast list
	public $sMainFeelsLike = null; //forecast list
	public $sMainTempMin = null; //forecast list
	public $sMainTempMax = null; //forecast list
	public $sMainPressure = null; //forecast list
	public $sMainHumidity = null; //forecast list
	public $sMainSeaLevel = null; //forecast list
	public $sMainGrndLevel = null; //forecast list
	public $sVisibility = null; //forecast list
	public $sWindSpeed = null; //forecast list
	public $sWindDeg = null; //forecast list
	public $sWindGust = null; //forecast list
	public $sCloudsAll = null; //forecast list
	public $sRain3h = null; //forecast list
	public $sSnow3h = null; //forecast list
	public $sDt = null; //forecast list
	public $sCod = null; //forecast
	

	public function __construct(
		$argSWeatherId,
		$argSWeatherMain,
		$argSWeatherDescription,
		$argSWeatherIcon,
		$argSMainTemp,
		$argSMainFeelsLike,
		$argSMainTempMin,
		$argSMainTempMax,
		$argSMainPressure,
		$argSMainHumidity,
		$argSMainSeaLevel,
		$argSMainGrndLevel,
		$argSVisibility,
		$argSWindSpeed,
		$argSWindDeg,
		$argSWindGust,
		$argSCloudsAll,
		$argSRain3h,
		$argSSnow3h,
		$argSDt,
		$argSCod
	)
	{
		$this->sWeatherId = $argSWeatherId;
		$this->sWeatherMain = $argSWeatherMain;
		$this->sWeatherDescription = $argSWeatherDescription;
		$this->sWeatherIcon = $argSWeatherIcon;
		$this->sMainTemp = $argSMainTemp;
		$this->sMainFeelsLike = $argSMainFeelsLike;
		$this->sMainTempMin = $argSMainTempMin;
		$this->sMainTempMax = $argSMainTempMax;
		$this->sMainPressure = $argSMainPressure;
		$this->sMainHumidity = $argSMainHumidity;
		$this->sMainSeaLevel = $argSMainSeaLevel;
		$this->sMainGrndLevel = $argSMainGrndLevel;
		$this->sVisibility = $argSVisibility;
		$this->sWindSpeed = $argSWindSpeed;
		$this->sWindDeg = $argSWindDeg;
		$this->sWindGust = $argSWindGust;
		$this->sCloudsAll = $argSCloudsAll;
		$this->sRain3h = $argSRain3h;
		$this->sSnow3h = $argSSnow3h;
		$this->sDt = $argSDt;
		$this->sCod = $argSCod;
	}

	public function getShowValue($argKey) {
		$output = null;
		if ($argKey == 'weather-icon') {
			$output = "<img src='./img/{$this->sWeatherIcon}@2x.png' alt='icon'>";
		}
		if ($argKey == 'main-temp') {
			$output = $this->sMainTemp;
		}
		if ($argKey == 'main-feels_like') {
			$output = $this->sMainFeelsLike;
		}
		if ($argKey == 'main-temp_min') {
			$output = $this->sMainTempMin;
		}
		if ($argKey == 'main-temp_max') {
			$output = $this->sMainTempMax;
		}
		if ($argKey == 'main-pressure') {
			//tento tlak je stejný jako $fMainSeaLevel
			$output = $this->sMainPressure;
		}
		if ($argKey == 'main-humidity') {
			$output = $this->sMainHumidity;
		}
		if ($argKey == 'clouds-all') {
			$output = $this->sCloudsAll;
		}
		if ($argKey == 'wind-speed') {
			$output = $this->sWindSpeed;
		}
		if ($argKey == 'wind-deg') {
			$output = $this->sWindDeg;
		}
		if ($argKey == 'wind-gust') {
			$output = $this->sWindGust;
		}
		if ($argKey == 'visibility') {
			$output = $this->sVisibility;
		}
		/*
		if ($argKey == 'pop') {
			$output = $this->sPop;
		}
		if ($argKey == 'rain-3h') {
			$output = $this->sRain1h;
		}
		if ($argKey == 'snow-3h') {
			$output = $this->sSnow1h;
		}
		if ($argKey == 'sys-pod') {
			$output = $this->sSysPod;
		}
		*/
		$outputPlus = $this->getShowValuePlus($argKey);
		if (isset($outputPlus)){
			$output = $outputPlus;
		}
		if (!isset($output)){
			$output = ".";
		}
		return $output;
	}

	public function ulozDoDb () {
		/*
		$prikaz = $GLOBALS["instanceDb"]->prepare("SELECT id FROM weather WHERE w_id = ?");
		$prikaz->execute([$this->wId]);
		$data = $prikaz->fetch();
		var_dump($data);
		*/

		/*
		$prikaz = $GLOBALS["instanceDb"]->prepare("INSERT INTO weather SET creatat = NOW(), changeat = NOW(), w_lon = ?, w_lat = ?,
		w_weather_id = ?,
		w_weather_main = ?,
		w_weather_description = ?,
		w_weather_icon = ?,
		w_base = ?,
		w_main_temp = ?,
		w_main_feels_like = ?,
		w_main_temp_min = ?,
		w_main_temp_max = ?,
		w_main_pressure = ?,
		w_main_humidity = ?,
		w_main_sea_level = ?,
		w_main_grnd_level = ?,
		w_visibility = ?,
		w_wind_speed = ?,
		w_wind_deg = ?,
		w_wind_gust = ?,
		w_clouds = ?,
		w_rain_1h = ?,
		w_rain_3h = ?,
		w_snow_1h = ?,
		w_snow_3h = ?,
		w_dt = ?,
		w_sys_type = ?,
		w_sys_id = ?,
		w_sys_country = ?,
		w_sys_sunrise = ?,
		w_sys_sunset = ?,
		w_timezone = ?,
		w_id = ?,
		w_name = ?,
		w_cod = ?");
		*/

		
		/*
		$prikaz->execute([$this->wLon, $this->wLat,
		$this->wWeatherId,
		$this->wWeatherMain,
		$this->wWeatherDescription,
		$this->wWeatherIcon,
		$this->wBase,
		$this->wMainTemp,
		$this->wMainFeelsLike,
		$this->wMainTempMin,
		$this->wMainTempMax,
		$this->wMainPressure,
		$this->wMainHumidity,
		$this->wMainSeaLevel,
		$this->wMainGrndLevel,
		$this->wVisibility,
		$this->wWindSpeed,
		$this->wWindDeg,
		$this->wWindGust,
		$this->wClouds,
		$this->wRain1h,
		$this->wRain3h,
		$this->wSnow1h,
		$this->wSnow3h,
		$this->wDt,
		$this->wSysType,
		$this->wSysId,
		$this->wSysCountry,
		$this->wSysSunrise,
		$this->wSysSunset,
		$this->wTimezone,
		$this->wId,
		$this->wName,
		$this->wCod]);
		*/
	}

}

class Weather extends State {

	//weather
	public $wLon = null;
	public $wLat = null;
	public $wBase = null;
	public $wRain1h = null;
	public $wSnow1h = null;
	public $wSysType = null;
	public $wSysId = null;
	public $wSysCountry = null;
	public $wSysSunrise = null;
	public $wSysSunset = null;
	public $wTimezone = null;
	public $wId = null;
	public $wName = null;

	public function __construct(
		$argWLon,
		$argWLat,
		$argWWeatherId,
		$argWWeatherMain,
		$argWWeatherDescription,
		$argWWeatherIcon,
		$argWBase,
		$argWMainTemp,
		$argWMainFeelsLike,
		$argWMainTempMin,
		$argWMainTempMax,
		$argWMainPressure,
		$argWMainHumidity,
		$argWMainSeaLevel,
		$argWMainGrndLevel,
		$argWVisibility,
		$argWWindSpeed,
		$argWWindDeg,
		$argWWindGust,
		$argWCloudsAll,
		$argWRain1h,
		$argWRain3h,
		$argWSnow1h,
		$argWSnow3h,
		$argWDt,
		$argWSysType,
		$argWSysId,
		$argWSysCountry,
		$argWSysSunrise,
		$argWSysSunset,
		$argWTimezone,
		$argWId,
		$argWName,
		$argWCod
	)
	{
		parent::__construct(
			$argWWeatherId,
			$argWWeatherMain,
			$argWWeatherDescription,
			$argWWeatherIcon,
			$argWMainTemp,
			$argWMainFeelsLike,
			$argWMainTempMin,
			$argWMainTempMax,
			$argWMainPressure,
			$argWMainHumidity,
			$argWMainSeaLevel,
			$argWMainGrndLevel,
			$argWVisibility,
			$argWWindSpeed,
			$argWWindDeg,
			$argWWindGust,
			$argWCloudsAll,
			$argWRain3h,
			$argWSnow3h,
			$argWDt,
			$argWCod
		);

		$this->wLon = $argWLon;
		$this->wLat = $argWLat;
		$this->wBase = $argWBase;
		$this->wRain1h = $argWRain1h;
		$this->wSnow1h = $argWSnow1h;
		$this->wSysType = $argWSysType;
		$this->wSysId = $argWSysId;
		$this->wSysCountry = $argWSysCountry;
		$this->wSysSunrise = $argWSysSunrise;
		$this->wSysSunset = $argWSysSunset;
		$this->wTimezone = $argWTimezone;
		$this->wId = $argWId;
		$this->wName = $argWName;
		
	}

	public function getShowValuePlus($argKey) {
		$output = null;
		if ($argKey == 'pop') {
			//ve weather neexistuje pravděpodobnost srážek
			$output = ".";
		}
		if ($argKey == 'rain-3h') {
			//ve weather neexistuje 3h, jen 1h
			$output = $this->wRain1h;
		}
		if ($argKey == 'snow-3h') {
			//ve weather neexistuje 3h, jen 1h
			$output = $this->wSnow1h;
		}
		if ($argKey == 'sys-pod') {
			//ve weather neexistuje, musím nějak vytvořit
			if (substr($this->sWeatherIcon, -1) == 'd') {
				$output = "Den";
			} else if (substr($this->sWeatherIcon, -1) == 'n') {
				$output = "Noc";
			} else {
				$output = ".";
			}
		}
		return $output;
	}
	
}

class Forecast extends State {

	//forecast
	public $fMessage = null;
	public $fCnt = null;

	//forecast list
	public $fPop = null;
	public $fSysPod = null;
	public $fDtTxt = null;

	//forecast
	public $fCityId = null;
	public $fCityName = null;
	public $fCityCoordLat = null;
	public $fCityCoordLon = null;
	public $fCityCountry = null;
	public $fCityPopulation = null;
	public $fCityTimezone = null;
	public $fCitySunrise = null;
	public $fCitySunset = null;

	public function __construct(
		$argFCod,
		$argFMessage,
		$argFCnt,
		$argFCityId,
		$argFCityName,
		$argFCityCoordLat,
		$argFCityCoordLon,
		$argFCityCountry,
		$argFCityPopulation,
		$argFCityTimezone,
		$argFCitySunrise,
		$argFCitySunset,
		$argFDt,
		$argFMainTemp,
		$argFMainFeelsLike,
		$argFMainTempMin,
		$argFMainTempMax,
		$argFMainPressure,
		$argFMainHumidity,
		$argFMainSeaLevel,
		$argFMainGrndLevel,
		$argFWeatherId,
		$argFWeatherMain,
		$argFWeatherDescription,
		$argFWeatherIcon,
		$argFCloudsAll,
		$argFWindSpeed,
		$argFWindDeg,
		$argFWindGust,
		$argFVisibility,
		$argFPop,
		$argFRain3h,
		$argFSnow3h,
		$argFSysPod,
		$argFDtTxt
	)
	{
		parent::__construct(
			$argFWeatherId,
			$argFWeatherMain,
			$argFWeatherDescription,
			$argFWeatherIcon,
			$argFMainTemp,
			$argFMainFeelsLike,
			$argFMainTempMin,
			$argFMainTempMax,
			$argFMainPressure,
			$argFMainHumidity,
			$argFMainSeaLevel,
			$argFMainGrndLevel,
			$argFVisibility,
			$argFWindSpeed,
			$argFWindDeg,
			$argFWindGust,
			$argFCloudsAll,
			$argFRain3h,
			$argFSnow3h,
			$argFDt,
			$argFCod
		);
		
		$this->fMessage = $argFMessage;
		$this->fCnt = $argFCnt;
		$this->fPop = $argFPop;
		$this->fSysPod = $argFSysPod;
		$this->fDtTxt = $argFDtTxt;
		$this->fCityId = $argFCityId;
		$this->fCityName = $argFCityName;
		$this->fCityCoordLat = $argFCityCoordLat;
		$this->fCityCoordLon = $argFCityCoordLon;
		$this->fCityCountry = $argFCityCountry;
		$this->fCityPopulation = $argFCityPopulation;
		$this->fCityTimezone = $argFCityTimezone;
		$this->fCitySunrise = $argFCitySunrise;
		$this->fCitySunset = $argFCitySunset;
		
	}

	public function getShowValuePlus($argKey) {
		$output = null;
		if ($argKey == 'pop') {
			$valueToShow = $this->fPop * 100;
			$output = $valueToShow;
		}
		if ($argKey == 'rain-3h') {
			$output = $this->sRain3h;
		}
		if ($argKey == 'snow-3h') {
			$output = $this->sSnow3h;
		}
		if ($argKey == 'sys-pod') {
			if ($this->fSysPod == 'd') {
				$output = "Den";
			} else if ($this->fSysPod == 'n') {
				$output = "Noc";
			} else {
				$output = ".";
			}
		}
		return $output;
	}
	
}

final class WeatherModel
{
	use Nette\SmartObject;

	private Nette\Database\Explorer $database;
    //private Nette\Database\Explorer $openweathermap;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

	public function getPublicArticles()
	{
		return $this->database
			->table('posts')
			->where('created_at < ', new \DateTime)
			->order('created_at DESC');
	}

    public function getApi() {
        return \Nette\Neon\Neon::decode(file_get_contents('../home/app/schema/openweathermap.neon'));
        //return \Nette\Neon\Neon::decode(file_get_contents('../app/schema/openweathermap.neon'));   
    }

	function getWeatherForecast($mesto) {

        $api = $this->getApi();
        //bdump($api['openweathermap']['appid']);

        $json = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$mesto."&APPID=".$api['openweathermap']['appid']."&units=metric");

        $obj = json_decode($json);

        //var_dump($obj);

        //$weather = [];

        $weatherForecasts = [];

        $wLon = null;
        $wLat = null;
        $wWeatherId = null;
        $wWeatherMain = null;
        $wWeatherDescription = null;
        $wWeatherIcon = null;
        $wBase = null;
        $wMainTemp = null;
        $wMainFeelsLike = null;
        $wMainTempMin = null;
        $wMainTempMax = null;
        $wMainPressure = null;
        $wMainHumidity = null;
        $wMainSeaLevel = null;
        $wMainGrndLevel = null;
        $wVisibility = null;
        $wWindSpeed = null;
        $wWindDeg = null;
        $wWindGust = null;
        $wCloudsAll = null;
        $wRain1h = null;
        $wRain3h = null;
        $wSnow1h = null;
        $wSnow3h = null;
        $wDt = null;
        $wSysType = null;
        $wSysId = null;
        $wSysCountry = null;
        $wSysSunrise = null;
        $wSysSunset = null;
        $wTimezone = null;
        $wId = null;
        $wName = null;
        $wCod = null;

        if (isset($obj->{'coord'})) {
            if (isset($obj->{'coord'}->{'lon'})) {
                //echo "coord->lon: ".$obj->{'coord'}->{'lon'}."<br />";
                $wLon = $obj->{'coord'}->{'lon'};
            }
            if (isset($obj->{'coord'}->{'lat'})) {
                //echo "coord->lat: ".$obj->{'coord'}->{'lat'}."<br />";
                $wLat = $obj->{'coord'}->{'lat'};
            }
        }

        if (isset($obj->{'weather'}[0])) {
            if (isset($obj->{'weather'}[0]->{'id'})) {
            //echo "weather[0]->id: ".$obj->{'weather'}[0]->{'id'}."<br />";
            $wWeatherId = $obj->{'weather'}[0]->{'id'};
            }
            if (isset($obj->{'weather'}[0]->{'main'})) {
            //echo "weather[0]->main: ".$obj->{'weather'}[0]->{'main'}."<br />";
            $wWeatherMain = $obj->{'weather'}[0]->{'main'};
            }
            if (isset($obj->{'weather'}[0]->{'description'})) {
            //echo "weather[0]->description: ".$obj->{'weather'}[0]->{'description'}."<br />";
            $wWeatherDescription = $obj->{'weather'}[0]->{'description'};
            }
            if (isset($obj->{'weather'}[0]->{'icon'})) {
            //echo "weather[0]->icon: ".$obj->{'weather'}[0]->{'icon'}."<br />";
            $wWeatherIcon = $obj->{'weather'}[0]->{'icon'};
            }
        }
        
        if (isset($obj->{'base'})) {
            //echo "base: ".$obj->{'base'}."<br />";
            $wBase = $obj->{'base'};
        }
        
        if (isset($obj->{'main'})) {
            if (isset($obj->{'main'}->{'temp'})) {
                //echo "main->temp: ".$obj->{'main'}->{'temp'}."<br />";
                $wMainTemp = $obj->{'main'}->{'temp'};
            }
            if (isset($obj->{'main'}->{'feels_like'})) {
                //echo "main->feels_like: ".$obj->{'main'}->{'feels_like'}."<br />";
                $wMainFeelsLike = $obj->{'main'}->{'feels_like'};
            }
            if (isset($obj->{'main'}->{'temp_min'})) {
                //echo "main->temp_min: ".$obj->{'main'}->{'temp_min'}."<br />";
                $wMainTempMin = $obj->{'main'}->{'temp_min'};
            }
            if (isset($obj->{'main'}->{'temp_max'})) {
                //echo "main->temp_max: ".$obj->{'main'}->{'temp_max'}."<br />";
                $wMainTempMax = $obj->{'main'}->{'temp_max'};
            }
            if (isset($obj->{'main'}->{'pressure'})) {
                //echo "main->pressure: ".$obj->{'main'}->{'pressure'}."<br />";
                $wMainPressure = $obj->{'main'}->{'pressure'};
            }
            if (isset($obj->{'main'}->{'humidity'})) {
                //echo "main->humidity: ".$obj->{'main'}->{'humidity'}."<br />";
                $wMainHumidity = $obj->{'main'}->{'humidity'};
            }
            if (isset($obj->{'main'}->{'sea_level'})) {
                //echo "main->sea_level: ".$obj->{'main'}->{'sea_level'}."<br />";
                $wMainSeaLevel = $obj->{'main'}->{'sea_level'};
            }
            if (isset($obj->{'main'}->{'grnd_level'})) {
                //echo "main->grnd_level: ".$obj->{'main'}->{'grnd_level'}."<br />";
                $wMainGrndLevel = $obj->{'main'}->{'grnd_level'};
            }
        }
        
        if (isset($obj->{'visibility'})) {
            //echo "visibility: ".$obj->{'visibility'}."<br />";
            $wVisibility = $obj->{'visibility'};
        }

        if (isset($obj->{'wind'})) {
            if (isset($obj->{'wind'}->{'speed'})) {
                //echo "wind->speed: ".$obj->{'wind'}->{'speed'}."<br />";
                $wWindSpeed = $obj->{'wind'}->{'speed'};
            }
            if (isset($obj->{'wind'}->{'deg'})) {
                //echo "wind->deg: ".$obj->{'wind'}->{'deg'}."<br />";
                $wWindDeg = $obj->{'wind'}->{'deg'};
            }
            if (isset($obj->{'wind'}->{'gust'})) {
                //echo "wind->gust: ".$obj->{'wind'}->{'gust'}."<br />";
                $wWindGust = $obj->{'wind'}->{'gust'};
            }
        }
        
        if (isset($obj->{'clouds'})) {
            if (isset($obj->{'clouds'}->{'all'})) {
                //echo "clouds->all: ".$obj->{'clouds'}->{'all'}."<br />";
                $wCloudsAll = $obj->{'clouds'}->{'all'};
            }
        }

        if (isset($obj->{'rain'})) {
            if (isset($obj->{'rain'}->{'1h'})) {
                //echo "rain->1h: ".$obj->{'rain'}->{'1h'}."<br />";
                $wRain1h = $obj->{'rain'}->{'1h'};
            }
            if (isset($obj->{'rain'}->{'3h'})) {
                //echo "rain->3h: ".$obj->{'rain'}->{'3h'}."<br />";
                $wRain3h = $obj->{'rain'}->{'3h'};
            }
        }

        if (isset($obj->{'snow'})) {
            if (isset($obj->{'snow'}->{'1h'})) {
                //echo "snow->1h: ".$obj->{'snow'}->{'1h'}."<br />";
                $wSnow1h = $obj->{'snow'}->{'1h'};
            }
            if (isset($obj->{'snow'}->{'3h'})) {
                //echo "snow->3h: ".$obj->{'snow'}->{'3h'}."<br />";
                $wSnow3h = $obj->{'snow'}->{'3h'};
            }
        }

        if (isset($obj->{'dt'})) {
            //echo "dt: ".$obj->{'dt'}." (".date("Y-m-d H:i:s", $obj->{'dt'}).")";
            if (isset($obj->{'timezone'})) {
                //echo " (local dt: ".date("Y-m-d H:i:s", $obj->{'dt'} + $obj->{'timezone'}).")";
            }
            //echo "<br />";
            $wDt = $obj->{'dt'};
        }

        if (isset($obj->{'sys'})) {
            if (isset($obj->{'sys'}->{'type'})) {
                //echo "sys->type: ".$obj->{'sys'}->{'type'}."<br />";
                $wSysType = $obj->{'sys'}->{'type'};
            }
            if (isset($obj->{'sys'}->{'id'})) {
                //echo "sys->id: ".$obj->{'sys'}->{'id'}."<br />";
                $wSysId = $obj->{'sys'}->{'id'};
            }
            if (isset($obj->{'sys'}->{'country'})) {
                //echo "sys->country: ".$obj->{'sys'}->{'country'}."<br />";
                $wSysCountry = $obj->{'sys'}->{'country'};
            }
            if (isset($obj->{'sys'}->{'sunrise'})) {
                //echo "sys->sunrise: ".$obj->{'sys'}->{'sunrise'}." (".date("Y-m-d H:i:s", $obj->{'sys'}->{'sunrise'}).")";
                if (isset($obj->{'timezone'})) {
                    //echo " (local sunrise: ".date("Y-m-d H:i:s", $obj->{'sys'}->{'sunrise'} + $obj->{'timezone'}).")";
                }
                //echo "<br />";
                $wSysSunrise = $obj->{'sys'}->{'sunrise'};
            }
            if (isset($obj->{'sys'}->{'sunset'})) {
                //echo "sys->sunset: ".$obj->{'sys'}->{'sunset'}." (".date("Y-m-d H:i:s", $obj->{'sys'}->{'sunset'}).")";
                if (isset($obj->{'timezone'})) {
                    //echo " (local sunset: ".date("Y-m-d H:i:s", $obj->{'sys'}->{'sunset'} + $obj->{'timezone'}).")";
                }
                //echo "<br />";
                $wSysSunset = $obj->{'sys'}->{'sunset'};
            }
        }

        if (isset($obj->{'timezone'})) {
            //echo "timezone: ".$obj->{'timezone'}."<br />";
            $wTimezone = $obj->{'timezone'};
        }

        if (isset($obj->{'id'})) {
            //echo "id: ".$obj->{'id'}."<br />";
            $wId = $obj->{'id'};
        }

        if (isset($obj->{'name'})) {
            //echo "name: ".$obj->{'name'}."<br />";
            $wName = $obj->{'name'};
        }

        if (isset($obj->{'cod'})) {
            //echo "cod: ".$obj->{'cod'}."<br />";
            $wCod = $obj->{'cod'};
        }

        $weather = new Weather(
            $wLon,
            $wLat,
            $wWeatherId,
            $wWeatherMain,
            $wWeatherDescription,
            $wWeatherIcon,
            $wBase,
            $wMainTemp,
            $wMainFeelsLike,
            $wMainTempMin,
            $wMainTempMax,
            $wMainPressure,
            $wMainHumidity,
            $wMainSeaLevel,
            $wMainGrndLevel,
            $wVisibility,
            $wWindSpeed,
            $wWindDeg,
            $wWindGust,
            $wCloudsAll,
            $wRain1h,
            $wRain3h,
            $wSnow1h,
            $wSnow3h,
            $wDt,
            $wSysType,
            $wSysId,
            $wSysCountry,
            $wSysSunrise,
            $wSysSunset,
            $wTimezone,
            $wId,
            $wName,
            $wCod
        );

        $weatherForecasts[$wDt] = $weather;

        $api = $this->getApi();
        //bdump($api['openweathermap']['appid']);

        $json = file_get_contents("https://api.openweathermap.org/data/2.5/forecast?q=".$mesto."&APPID=".$api['openweathermap']['appid']."&units=metric");
        
        $obj = json_decode($json);

        //var_dump($obj);

        //$forecast = [];

        $fCod = null;
        $fMessage = null;
        $fCnt = null;

        if (isset($obj->{'cod'})) {
            //echo "cod: ".$obj->{'cod'}."<br />";
            $fCod = $obj->{'cod'};
        }

        if (isset($obj->{'message'})) {
            //echo "message: ".$obj->{'message'}."<br />";
            $fMessage = $obj->{'message'};
        }

        if (isset($obj->{'cnt'})) {
            //echo "cnt: ".$obj->{'cnt'}."<br />";
            $fCnt = $obj->{'cnt'};
        }

        $fCityId = null;
        $fCityName = null;
        $fCityCoordLat = null;
        $fCityCoordLon = null;
        $fCityCountry = null;
        $fCityPopulation = null;
        $fCityTimezone = null;
        $fCitySunrise = null;
        $fCitySunset = null;

        if (isset($obj->{'city'})) {
            if (isset($obj->{'city'}->{'id'})) {
                //echo "city->id: ".$obj->{'city'}->{'id'}."<br />";
                $fCityId = $obj->{'city'}->{'id'};
            }
            if (isset($obj->{'city'}->{'name'})) {
                //echo "city->name: ".$obj->{'city'}->{'name'}."<br />";
                $fCityName = $obj->{'city'}->{'name'};
            }
            if (isset($obj->{'city'}->{'coord'})) {
                if (isset($obj->{'city'}->{'coord'}->{'lat'})) {
                    //echo "city->coord->lat: ".$obj->{'city'}->{'coord'}->{'lat'}."<br />";
                    $fCityCoordLat = $obj->{'city'}->{'coord'}->{'lat'};
                }
                if (isset($obj->{'city'}->{'coord'}->{'lon'})) {
                    //echo "city->coord->lon: ".$obj->{'city'}->{'coord'}->{'lon'}."<br />";
                    $fCityCoordLon = $obj->{'city'}->{'coord'}->{'lon'};
                }
            }
            if (isset($obj->{'city'}->{'country'})) {
                //echo "city->country: ".$obj->{'city'}->{'country'}."<br />";
                $fCityCountry = $obj->{'city'}->{'country'};
            }
            if (isset($obj->{'city'}->{'population'})) {
                //echo "city->population: ".$obj->{'city'}->{'population'}."<br />";
                $fCityPopulation = $obj->{'city'}->{'population'};
            }
            if (isset($obj->{'city'}->{'timezone'})) {
                //echo "city->timezone: ".$obj->{'city'}->{'timezone'}."<br />";
                $fCityTimezone = $obj->{'city'}->{'timezone'};
            }
            if (isset($obj->{'city'}->{'sunrise'})) {
                //echo "city->sunrise: ".$obj->{'city'}->{'sunrise'}." (".date("Y-m-d H:i:s", $obj->{'city'}->{'sunrise'}).")";
                if (isset($obj->{'city'}->{'timezone'})) {
                    //echo " (local sunrise: ".date("Y-m-d H:i:s", $obj->{'city'}->{'sunrise'} + $obj->{'city'}->{'timezone'}).")";
                }
                //echo "<br />";
                $fCitySunrise = $obj->{'city'}->{'sunrise'};
            }
            if (isset($obj->{'city'}->{'sunset'})) {
                //echo "city->sunset: ".$obj->{'city'}->{'sunset'}." (".date("Y-m-d H:i:s", $obj->{'city'}->{'sunset'}).")";
                if (isset($obj->{'city'}->{'timezone'})) {
                    //echo " (local sunset: ".date("Y-m-d H:i:s", $obj->{'city'}->{'sunset'} + $obj->{'city'}->{'timezone'}).")";
                }
                //echo "<br />";
                $fCitySunset = $obj->{'city'}->{'sunset'};
            }   
        }

        //$forecast['poleForecastDates'] = [];
        //$forecast['poleForecasts'] = [];

        if (isset($obj->{'list'})) {
            $listIndex = 0;
            foreach ($obj->{'list'} AS $listObj) {

                $fDt = null;
                $fMainTemp = null;
                $fMainFeelsLike = null;
                $fMainTempMin = null;
                $fMainTempMax = null;
                $fMainPressure = null;
                $fMainHumidity = null;
                $fMainSeaLevel = null;
                $fMainGrndLevel = null;
                $fWeatherId = null;
                $fWeatherMain = null;
                $fWeatherDescription = null;
                $fWeatherIcon = null;
                $fCloudsAll = null;
                $fWindSpeed = null;
                $fWindDeg = null;
                $fWindGust = null;
                $fVisibility = null;
                $fPop = null;
                $fRain3h = null;
                $fSnow3h = null;
                $fSysPod = null;
                $fDtTxt = null;

                //echo "<hr />";
                //var_dump($listObj);
                //echo "List index: {$listIndex}<br />";

                if (isset($listObj->{'dt'})) {
                    //echo "dt: ".$listObj->{'dt'}." (".date("Y-m-d H:i:s", $listObj->{'dt'}).")";
                    if (isset($obj->{'city'}->{'timezone'})) {
                        //echo " (local dt: ".date("Y-m-d H:i:s", $listObj->{'dt'} + $obj->{'city'}->{'timezone'}).")";
                        //$forecastDate = date("Y-m-d H:i:s", $listObj->{'dt'} + $obj->{'city'}->{'timezone'});
                        //$forecastDate = date("Y-m-d H:i:s", $listObj->{'dt'});
                    } else {
                        // $forecastDate = date("Y-m-d H:i:s", $listObj->{'dt'});
                    }
                    //echo "<br />";
                    $fDt = $listObj->{'dt'};
                }

                if (isset($listObj->{'main'})) {
                    if (isset($listObj->{'main'}->{'temp'})) {
                        //echo "main->temp: ".$listObj->{'main'}->{'temp'}."<br />";
                        $fMainTemp = $listObj->{'main'}->{'temp'};
                    }
                    if (isset($listObj->{'main'}->{'feels_like'})) {
                        //echo "main->feels_like: ".$listObj->{'main'}->{'feels_like'}."<br />";
                        $fMainFeelsLike = $listObj->{'main'}->{'feels_like'};
                    }
                    if (isset($listObj->{'main'}->{'temp_min'})) {
                        //echo "main->temp_min: ".$listObj->{'main'}->{'temp_min'}."<br />";
                        $fMainTempMin = $listObj->{'main'}->{'temp_min'};
                    }
                    if (isset($listObj->{'main'}->{'temp_max'})) {
                        //echo "main->temp_max: ".$listObj->{'main'}->{'temp_max'}."<br />";
                        $fMainTempMax = $listObj->{'main'}->{'temp_max'};
                    }
                    if (isset($listObj->{'main'}->{'pressure'})) {
                        //echo "main->pressure: ".$listObj->{'main'}->{'pressure'}."<br />";
                        $fMainPressure = $listObj->{'main'}->{'pressure'};
                    }
                    if (isset($listObj->{'main'}->{'humidity'})) {
                        //echo "main->humidity: ".$listObj->{'main'}->{'humidity'}."<br />";
                        $fMainHumidity = $listObj->{'main'}->{'humidity'};
                    }
                    if (isset($listObj->{'main'}->{'sea_level'})) {
                        //echo "main->sea_level: ".$listObj->{'main'}->{'sea_level'}."<br />";
                        $fMainSeaLevel = $listObj->{'main'}->{'sea_level'};
                    }
                    if (isset($listObj->{'main'}->{'grnd_level'})) {
                        //echo "main->grnd_level: ".$listObj->{'main'}->{'grnd_level'}."<br />";
                        $fMainGrndLevel = $listObj->{'main'}->{'grnd_level'};
                    }
                }

                if (isset($listObj->{'weather'}[0])) {
                    if (isset($listObj->{'weather'}[0]->{'id'})) {
                    //echo "weather[0]->id: ".$listObj->{'weather'}[0]->{'id'}."<br />";
                    $fWeatherId = $listObj->{'weather'}[0]->{'id'};
                    }
                    if (isset($listObj->{'weather'}[0]->{'main'})) {
                    //echo "weather[0]->main: ".$listObj->{'weather'}[0]->{'main'}."<br />";
                    $fWeatherMain = $listObj->{'weather'}[0]->{'main'};
                    }
                    if (isset($listObj->{'weather'}[0]->{'description'})) {
                    //echo "weather[0]->description: ".$listObj->{'weather'}[0]->{'description'}."<br />";
                    $fWeatherDescription = $listObj->{'weather'}[0]->{'description'};
                    }
                    if (isset($listObj->{'weather'}[0]->{'icon'})) {
                    //echo "weather[0]->icon: ".$listObj->{'weather'}[0]->{'icon'}."<br />";
                    $fWeatherIcon = $listObj->{'weather'}[0]->{'icon'};
                    }
                }

                if (isset($listObj->{'clouds'})) {
                    if (isset($listObj->{'clouds'}->{'all'})) {
                        //echo "clouds->all: ".$listObj->{'clouds'}->{'all'}."<br />";
                        $fCloudsAll = $listObj->{'clouds'}->{'all'};
                    }
                }

                if (isset($listObj->{'wind'})) {
                    if (isset($listObj->{'wind'}->{'speed'})) {
                        //echo "wind->speed: ".$listObj->{'wind'}->{'speed'}."<br />";
                        $fWindSpeed = $listObj->{'wind'}->{'speed'};
                    }
                    if (isset($listObj->{'wind'}->{'deg'})) {
                        //echo "wind->deg: ".$listObj->{'wind'}->{'deg'}."<br />";
                        $fWindDeg = $listObj->{'wind'}->{'deg'};
                    }
                    if (isset($listObj->{'wind'}->{'gust'})) {
                        //echo "wind->gust: ".$listObj->{'wind'}->{'gust'}."<br />";
                        $fWindGust = $listObj->{'wind'}->{'gust'};
                    }
                }

                if (isset($listObj->{'visibility'})) {
                    //echo "visibility: ".$listObj->{'visibility'}."<br />";
                    $fVisibility = $listObj->{'visibility'};
                }

                if (isset($listObj->{'pop'})) {
                    //echo "pop: ".$listObj->{'pop'}."<br />";
                    $fPop = $listObj->{'pop'};
                }

                $fRain3h = null;
                if (isset($listObj->{'rain'})) {
                    if (isset($listObj->{'rain'}->{'3h'})) {
                        //echo "rain->3h: ".$listObj->{'rain'}->{'3h'}."<br />";
                        $fRain3h = $listObj->{'rain'}->{'3h'};
                    }
                }

                $fSnow3h = null;
                if (isset($listObj->{'snow'})) {
                    if (isset($listObj->{'snow'}->{'3h'})) {
                        //echo "snow->3h: ".$listObj->{'snow'}->{'3h'}."<br />";
                        $fSnow3h = $listObj->{'snow'}->{'3h'};
                    }
                }

                if (isset($listObj->{'sys'})) {
                    if (isset($listObj->{'sys'}->{'pod'})) {
                        //echo "sys->pod: ".$listObj->{'sys'}->{'pod'}."<br />";
                        $fSysPod = $listObj->{'sys'}->{'pod'};
                    }
                }

                if (isset($listObj->{'dt_txt'})) {
                    //echo "dt_txt: ".$listObj->{'dt_txt'}."<br />";
                    $fDtTxt = $listObj->{'dt_txt'};
                }

                $forecast = new Forecast(
                    $fCod,
                    $fMessage,
                    $fCnt,
                    $fCityId,
                    $fCityName,
                    $fCityCoordLat,
                    $fCityCoordLon,
                    $fCityCountry,
                    $fCityPopulation,
                    $fCityTimezone,
                    $fCitySunrise,
                    $fCitySunset,
                    $fDt,
                    $fMainTemp,
                    $fMainFeelsLike,
                    $fMainTempMin,
                    $fMainTempMax,
                    $fMainPressure,
                    $fMainHumidity,
                    $fMainSeaLevel,
                    $fMainGrndLevel,
                    $fWeatherId,
                    $fWeatherMain,
                    $fWeatherDescription,
                    $fWeatherIcon,
                    $fCloudsAll,
                    $fWindSpeed,
                    $fWindDeg,
                    $fWindGust,
                    $fVisibility,
                    $fPop,
                    $fRain3h,
                    $fSnow3h,
                    $fSysPod,
                    $fDtTxt
                );

                $weatherForecasts[$fDt] = $forecast;

                $listIndex++;
            
            }
        }

        return $weatherForecasts;
    }


    function truncateDb() {
        $this->database->query('TRUNCATE TABLE `weather`');
    }

	function ulozDoDb($wF) {

        if (is_a($wF, 'App\Model\Weather')) {
            $this->database->table('weather')->insert([
                'creatat' => new \DateTime,
                'changeat' => new \DateTime,
                'w_lon' => $wF->wLon,
                'w_lat' => $wF->wLat,
                's_weather_id' => $wF->sWeatherId,
                's_weather_main' => $wF->sWeatherMain,
                's_weather_description' => $wF->sWeatherDescription,
                's_weather_icon' => $wF->sWeatherIcon,
                'w_base' => $wF->wBase,
                's_main_temp' => $wF->sMainTemp,
                's_main_feels_like' => $wF->sMainFeelsLike,
                's_main_temp_min' => $wF->sMainTempMin,
                's_main_temp_max' => $wF->sMainTempMax,
                's_main_pressure' => $wF->sMainPressure,
                's_main_humidity' => $wF->sMainHumidity,
                's_main_sea_level' => $wF->sMainSeaLevel,
                's_main_grnd_level' => $wF->sMainGrndLevel,
                's_visibility' => $wF->sVisibility,
                's_wind_speed' => $wF->sWindSpeed,
                's_wind_deg' => $wF->sWindDeg,
                's_wind_gust' => $wF->sWindGust,
                's_clouds' => $wF->sCloudsAll,
                'w_rain_1h' => $wF->wRain1h,
                's_rain_3h' => $wF->sRain3h,
                'w_snow_1h' => $wF->wSnow1h,
                's_snow_3h' => $wF->sSnow3h,
                's_dt' => $wF->sDt,
                'w_sys_type' => $wF->wSysType,
                'w_sys_id' => $wF->wSysId,
                'w_sys_country' => $wF->wSysCountry,
                'w_sys_sunrise' => $wF->wSysSunrise,
                'w_sys_sunset' => $wF->wSysSunset,
                'w_timezone' => $wF->wTimezone,
                'w_id' => $wF->wId,
                'w_name' => $wF->wName,
                's_cod' => $wF->sCod
            ]);
        } else {
            $this->database->table('weather')->insert([
                'creatat' => new \DateTime,
                'changeat' => new \DateTime,
                's_weather_id' => $wF->sWeatherId,
                's_weather_main' => $wF->sWeatherMain,
                's_weather_description' => $wF->sWeatherDescription,
                's_weather_icon' => $wF->sWeatherIcon,
                's_main_temp' => $wF->sMainTemp,
                's_main_feels_like' => $wF->sMainFeelsLike,
                's_main_temp_min' => $wF->sMainTempMin,
                's_main_temp_max' => $wF->sMainTempMax,
                's_main_pressure' => $wF->sMainPressure,
                's_main_humidity' => $wF->sMainHumidity,
                's_main_sea_level' => $wF->sMainSeaLevel,
                's_main_grnd_level' => $wF->sMainGrndLevel,
                's_visibility' => $wF->sVisibility,
                's_wind_speed' => $wF->sWindSpeed,
                's_wind_deg' => $wF->sWindDeg,
                's_wind_gust' => $wF->sWindGust,
                's_clouds' => $wF->sCloudsAll,
                's_rain_3h' => $wF->sRain3h,
                's_snow_3h' => $wF->sSnow3h,
                's_dt' => $wF->sDt,
                's_cod' => $wF->sCod,
                'f_message' => $wF->fMessage,
                'f_cnt' => $wF->fCnt,
                //'f_temp_kf' => $wF->fTempKf,
                'f_pop' => $wF->fPop,
                'f_pod' => $wF->fSysPod,
                'f_dt_txt' => $wF->fDtTxt
            ]);
        }
		
	}

    function getDay($myId) {

        
        if ($myId == 0) {
            return $this->database->query('SELECT MIN(`s_main_temp`) temp_min, MAX(`s_main_temp`) temp_max, 
            CASE WHEN min(`s_weather_id`) < 600 THEN "Rain" 
            WHEN min(`s_weather_id`) >= 600 and min(`s_weather_id`) < 700 THEN "Snow" 
            WHEN max(`s_weather_id`) >= 800 and max(`s_weather_id`) <= 803 THEN "Clear" 
            ELSE "Clouds" END w_main, 
            "now" as datum 
            FROM `weather` WHERE `f_dt_txt` is null;');
        } elseif ($myId > 0) {
            return $this->database->query("SELECT MIN(`s_main_temp`) temp_min, MAX(`s_main_temp`) temp_max, 
            CASE WHEN min(`s_weather_id`) < 600 THEN \"Rain\" 
            WHEN min(`s_weather_id`) >= 600 and min(`s_weather_id`) < 700 THEN \"Snow\" 
            WHEN max(`s_weather_id`) >= 800 and max(`s_weather_id`) <= 803 THEN \"Clear\" 
            ELSE \"Clouds\" END w_main, 
            date(DATE_ADD(now(), INTERVAL $myId-1 DAY)) datum 
            FROM `weather` 
            WHERE `f_dt_txt` LIKE CONCAT(date(DATE_ADD(now(), INTERVAL $myId-1 DAY)), '%');");
        } else {
            return $this->database->query('SELECT MIN(`s_main_temp`) temp_min, MAX(`s_main_temp`) temp_max,
            CASE
            WHEN min(`s_weather_id`) < 600 THEN "Rain"
            WHEN min(`s_weather_id`) >= 600 and min(`s_weather_id`) < 700 THEN "Snow"
            WHEN max(`s_weather_id`) >= 800 and max(`s_weather_id`) <= 803 THEN "Clear"
            ELSE "Clouds" END w_main, 
            "24 hours" as datum 
            FROM `weather` WHERE s_dt <= (SELECT s_dt FROM `weather` WHERE id = 1) + 86400;');
        }

    }

    function getAll() {

        /*

        return $this->database
			->table('weather');
			//->where('created_at < ', new \DateTime)
			//->order('id ASC');

        */

        return $this->database->query('select
    case when datum IS NULL then "0T" else datum end as datum,
    case when datum IS NULL then "Now" WHEN DAYOFWEEK(datum) = 1 THEN "NE" WHEN DAYOFWEEK(datum) = 2 THEN "PO"
    WHEN DAYOFWEEK(datum) = 3 THEN "UT" WHEN DAYOFWEEK(datum) = 4 THEN "ST" WHEN DAYOFWEEK(datum) = 5 THEN "CT"
    WHEN DAYOFWEEK(datum) = 6 THEN "PA" WHEN DAYOFWEEK(datum) = 7 THEN "SO" else "?" end as den,
	temp_min, temp_max, w_main /*, f_dt_txt_min, f_dt_txt_max*/ from
(SELECT SUBSTRING(`f_dt_txt`, 1, 10) as datum , MIN(`s_main_temp`) temp_min, MAX(`s_main_temp`) temp_max,
    CASE WHEN min(`s_weather_id`) < 600 THEN "Rain" WHEN min(`s_weather_id`) >= 600 and min(`s_weather_id`) < 700 THEN "Snow" 
    WHEN max(`s_weather_id`) >= 800 and max(`s_weather_id`) <= 803 THEN "Clear" ELSE "Clouds" END w_main,
    min(`f_dt_txt`) as f_dt_txt_min, max(`f_dt_txt`) as f_dt_txt_max FROM `weather` GROUP BY SUBSTRING(`f_dt_txt`, 1, 10)) t1
WHERE `f_dt_txt_max` IS NULL OR SUBSTRING(`f_dt_txt_max`, 12, 13) > "12"
ORDER BY datum;');

    }

}
