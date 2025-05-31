<?php
    /*
    $instanceDb = new PDO(
        "mysql:host=uvdb65.active24.cz;dbname=funkacerweather;charset=utf8",
        "funkacerweather",
        "Vq7cF8qVZK",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    */
    $instanceDb = new PDO(
        "mysql:host=localhost:8889;dbname=weather;charset=utf8",
        "root",
        "root",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    

    class Weather {
        protected $id;
        protected $creatat;
        protected $changeat;
        protected $wLon;
        protected $wLat;
        protected $wWeatherId;
        protected $wWeatherMain;
        protected $wWeatherDescription;
        protected $wWeatherIcon;
        protected $wBase;
        protected $wMainTemp;
        protected $wMainFeelsLike;
        protected $wMainTempMin;
        protected $wMainTempMax;
        protected $wMainPressure;
        protected $wMainHumidity;
        protected $wMainSeaLevel;
        protected $wMainGrndLevel;
        protected $wVisibility;
        protected $wWindSpeed;
        protected $wWindDeg;
        protected $wWindGust;
        protected $wClouds;
        protected $wRain1h;
        protected $wRain3h;
        protected $wSnow1h;
        protected $wSnow3h;
        protected $wDt;
        protected $wSysType;
        protected $wSysId;
        protected $wSysCountry;
        protected $wSysSunrise;
        protected $wSysSunset;
        protected $wTimezone;
        protected $wId;
        protected $wName;
        protected $wCod;

        public function __construct($argId,
            $argCreatat,
            $argChangeat,
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
            $argWClouds,
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
            $this->id = $argId;
            $this->creatat = $argCreatat;
            $this->changeat = $argChangeat;
            $this->wLon = $argWLon;
            $this->wLat = $argWLat;
            $this->wWeatherId = $argWWeatherId;
            $this->wWeatherMain = $argWWeatherMain;
            $this->wWeatherDescription = $argWWeatherDescription;
            $this->wWeatherIcon = $argWWeatherIcon;
            $this->wBase = $argWBase;
            $this->wMainTemp = $argWMainTemp;
            $this->wMainFeelsLike = $argWMainFeelsLike;
            $this->wMainTempMin = $argWMainTempMin;
            $this->wMainTempMax = $argWMainTempMax;
            $this->wMainPressure = $argWMainPressure;
            $this->wMainHumidity = $argWMainHumidity;
            $this->wMainSeaLevel = $argWMainSeaLevel;
            $this->wMainGrndLevel = $argWMainGrndLevel;
            $this->wVisibility = $argWVisibility;
            $this->wWindSpeed = $argWWindSpeed;
            $this->wWindDeg = $argWWindDeg;
            $this->wWindGust = $argWWindGust;
            $this->wClouds = $argWClouds;
            $this->wRain1h = $argWRain1h;
            $this->wRain3h = $argWRain3h;
            $this->wSnow1h = $argWSnow1h;
            $this->wSnow3h = $argWSnow3h;
            $this->wDt = $argWDt;
            $this->wSysType = $argWSysType;
            $this->wSysId = $argWSysId;
            $this->wSysCountry = $argWSysCountry;
            $this->wSysSunrise = $argWSysSunrise;
            $this->wSysSunset = $argWSysSunset;
            $this->wTimezone = $argWTimezone;
            $this->wId = $argWId;
            $this->wName = $argWName;
            $this->wCod = $argWCod;
        }

        public function ulozDoDb () {
            /*
            $prikaz = $GLOBALS["instanceDb"]->prepare("SELECT id FROM weather WHERE w_id = ?");
            $prikaz->execute([$this->wId]);
            $data = $prikaz->fetch();
            var_dump($data);
            */
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
        }
    }
?>