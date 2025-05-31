<?php

    session_start();

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
        protected $sWeatherId = null; //forecast list
        protected $sWeatherMain = null; //forecast list
        protected $sWeatherDescription = null; //forecast list
        protected $sWeatherIcon = null; //forecast list
        protected $sMainTemp = null; //forecast list
        protected $sMainFeelsLike = null; //forecast list
        protected $sMainTempMin = null; //forecast list
        protected $sMainTempMax = null; //forecast list
        protected $sMainPressure = null; //forecast list
        protected $sMainHumidity = null; //forecast list
        protected $sMainSeaLevel = null; //forecast list
        protected $sMainGrndLevel = null; //forecast list
        protected $sVisibility = null; //forecast list
        protected $sWindSpeed = null; //forecast list
        protected $sWindDeg = null; //forecast list
        protected $sWindGust = null; //forecast list
        protected $sCloudsAll = null; //forecast list
        protected $sRain3h = null; //forecast list
        protected $sSnow3h = null; //forecast list
        protected $sDt = null; //forecast list
        protected $sCod = null; //forecast
        

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

    }

    class Weather extends State {

        //weather
        protected $wLon = null;
        protected $wLat = null;
        protected $wBase = null;
        protected $wRain1h = null;
        protected $wSnow1h = null;
        protected $wSysType = null;
        protected $wSysId = null;
        protected $wSysCountry = null;
        protected $wSysSunrise = null;
        protected $wSysSunset = null;
        protected $wTimezone = null;
        protected $wId = null;
        protected $wName = null;

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
        protected $fMessage = null;
        protected $fCnt = null;

        //forecast list
        protected $fPop = null;
        protected $fSysPod = null;
        protected $fDtTxt = null;

        //forecast
        protected $fCityId = null;
        protected $fCityName = null;
        protected $fCityCoordLat = null;
        protected $fCityCoordLon = null;
        protected $fCityCountry = null;
        protected $fCityPopulation = null;
        protected $fCityTimezone = null;
        protected $fCitySunrise = null;
        protected $fCitySunset = null;

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

    function getWeatherForecast($mesto) {

        $json = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$mesto."&APPID=xxx&units=metric");

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

        $json = file_get_contents("https://api.openweathermap.org/data/2.5/forecast?q=".$mesto."&APPID=xxx&units=metric");
        
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


    /*
    spl_autoload_register(function ($class_name) {
        include 'functions.php';
    });
    */

    //require_once "./functions.php";

    $mesto = "Praha";
    //$mesto = "Washington";

    //var_dump($_GET);

    if (array_key_exists("refresh", $_GET)) {
        unset($_SESSION["date"]);
        unset($_SESSION["weather-forecast"]);
        unset($_SESSION["update"]);
        //vycistit url
        header("Location: ?");
    }

    if (array_key_exists("date", $_GET)) {
        $_SESSION["date"] = $_GET["date"];
    }

    if (!array_key_exists("weather-forecast", $_SESSION)) {

        //$_SESSION["weather"] = getWeather($mesto);
        $_SESSION["weather-forecast"] = getWeatherForecast($mesto);

        //automaticky nastavím zobrazení předpovědi na první den
        $poleForecastDays = [];
        foreach ($_SESSION["weather-forecast"] AS $fDt => $forecast) {
            $forecastDate = date("Y-m-d H:i:s", $fDt);
            $forecastDay = substr($forecastDate, 0, 10);
            //echo $forecastDate, " ", substr($forecastDate, 0, 10);
            //echo "<br />";
            if (!in_array($forecastDay, $poleForecastDays) ) {
                $poleForecastDays[$fDt] = $forecastDay;
            }
        }
        //$_SESSION["date"] = $poleForecastDays[0];
        //nedám první index ale nejmenší hodnotu klíče (první datum)
        $_SESSION["date"] = $poleForecastDays[min(array_keys($poleForecastDays))];

        //date("d. m. Y H:i:s")
        $_SESSION["update"] = time();
      
    }

    //pokud by zůstalo prázdné, žádná předpověď se nezobrazí
    $poleSelectForcasts = [];
    foreach($_SESSION["weather-forecast"] AS $fDt => $forecast) {
        $forecastDate = date("Y-m-d H:i:s", $fDt);
        //assume $_SESSION["date"] is always available when here
        if ($_SESSION["date"] == substr($forecastDate, 0, 10)) {
            //$poleSelectDates[] = $forecastDate;
            $poleSelectForcasts[$fDt] = $forecast;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Předpověď počasí</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/all.min.css">
</head>
<body>

    <div class="header">
        <ul>
            <li>
                <h1>Předpověď počasí (<a href="#">Praha</a>)</h1>
            </li>
            <li>
                <?php
                    $update = date('d. m. Y H:i:s', $_SESSION["update"]);
                    echo "<h2><a href='?refresh=true'>$update&nbsp;<i class='fa-solid fa-arrows-rotate'></i></a></h2>";
                ?>
            </li>
        </ul>
    </div>

    <div class="menu">
        <ul>

        <!--  
        <form action="" method="get">
            <label for="aaa">Předpověď na: </label>
            <select name="date" id="aaa">
                
                <?php

                    $poleForecastDays = [];
                    foreach ($_SESSION["weather-forecast"] AS $fDt => $forecast) {
                        $forecastDate = date("Y-m-d H:i:s", $fDt);
                        $forecastDay = substr($forecastDate, 0, 10);
                        //echo $forecastDate, " ", substr($forecastDate, 0, 10);
                        //echo "<br />";
                        if (!in_array($forecastDay, $poleForecastDays) ) {
                            $poleForecastDays[$fDt] = $forecastDay;
                        }
                    }
                    
                    foreach ($poleForecastDays AS $forecastDay) {
                        $selected = "";
                        if ($_SESSION["date"] == $forecastDay) {
                            $selected = "selected = 'selected'";
                        }
                        echo "<option value='$forecastDay' $selected>$forecastDay</option>";
                    }

                ?>
            </select>
            <input type="submit" value="Zobrazit">
        </form>
        -->

            <?php 
                $poleForecastDays = [];
                foreach ($_SESSION["weather-forecast"] AS $fDt => $forecast) {
                    $forecastDate = date("Y-m-d H:i:s", $fDt);
                    $forecastDay = substr($forecastDate, 0, 10);
                    //echo $forecastDate, " ", substr($forecastDate, 0, 10);
                    //echo "<br />";
                    if (!in_array($forecastDay, $poleForecastDays) ) {
                        $poleForecastDays[$fDt] = $forecastDay;
                    }
                }
                /*
                foreach ($poleForecastDays AS $forecastDay) {
                    $selected = "";
                    if ($_SESSION["date"] == $forecastDay) {
                        $selected = "selected = 'selected'";
                    }
                    echo "<option value='$forecastDay' $selected>$forecastDay</option>";
                }
                */
                foreach ($poleForecastDays AS $fDt => $forecastDay) {
                    //potrebuji den v tydnu
                    $forecastDayInWeek = date("w", $fDt);
                    switch ($forecastDayInWeek) {
                        case 0:
                            $forecastDayInWeekCzech = "Ne";
                            break;
                        case 1:
                            $forecastDayInWeekCzech = "Po";
                            break;
                        case 2:
                            $forecastDayInWeekCzech = "Út";
                            break;
                        case 3:
                            $forecastDayInWeekCzech = "St";
                            break;
                        case 4:
                            $forecastDayInWeekCzech = "Čt";
                            break;
                        case 5:
                            $forecastDayInWeekCzech = "Pá";
                            break;
                        case 6:
                            $forecastDayInWeekCzech = "So";
                            break;
                    }
                    if ($_SESSION["date"] == $forecastDay) {
                        echo "<li class = 'selected'><a href='?date=$forecastDay'>$forecastDay ($forecastDayInWeekCzech)</a></li>";
                    } else {
                        echo "<li class = 'unselected'><a href='?date=$forecastDay'>$forecastDay ($forecastDayInWeekCzech)</a></li>";
                    }
                    
                }

            ?>

        </ol>
    </div>

    <br />

    <?php
        //nastavím strukturu tabulky
        $rows[0][] = "<th></th>"; //první sloupec na prvním řádku
        //u prvního datumu ještě napřed přidám sloupec "Nyní"
        /*
        if($_SESSION["date"] == $poleForecastDays[min(array_keys($poleForecastDays))]) {
            $rows[0][] = "<th>Nyní</th>"; //druhý sloupec na prvním řádku
        }
        */
        $columnIndex = 0;
        //var_dump($poleSelectForcasts);
        foreach($poleSelectForcasts AS $fDt => $objWeatherForecast) {
            $selectDate = date("Y-m-d H:i:s", $fDt);
            $rows[0][] = "<th>".substr($selectDate,11,5)."</th>";   //na první řádek přidám datum
            $rowIndex = 1; //od řádku jedna jsou hodnoty
            //foreach ($forecastValues AS $key => $value) {
            foreach (State::$arrayShow AS $key => $value) {
                if ($columnIndex == 0) {
                    //u prvního datumu ještě napřed přidám názvy hodnot
                    //$rows[$rowIndex] = [];
                    $rows[$rowIndex][] = "<th>".$value."</th>";
                }
                //var_dump($objWeatherForecast);
                //$rows[$rowIndex][] = "<td>"."."."</td>";
                $rows[$rowIndex][] = "<td>".$objWeatherForecast->getShowValue($key)."</td>";
                $rowIndex++;
            }
            $columnIndex++;
        }
        //var_dump($rows);

        //textový výpis
        /*
        foreach($poleSelectForcasts AS $selectDate => $forecastValues) {
            foreach ($forecastValues AS $key => $value) {
                echo "{$value['name']} pro $selectDate: {$value['value']} <br />";
            }
        }
        */

        echo "<table>";
        foreach($rows AS $row) {
            echo "<tr>";
            foreach($row AS $column) {
                echo $column;
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "<div class='footer'><sup>*</sup> Aktuální stav počasí zobrazuje hodnotu v mm/1h, předpovědi se uvádějí v mm/3h.</div>";

    ?>

</body>
</html>

