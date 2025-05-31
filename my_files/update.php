<?php
    require_once "data.php";

    $json = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=Praha&APPID=xxx&units=metric");

    $obj = json_decode($json);

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
    $wClouds = null;
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
            echo "coord->lon: ".$obj->{'coord'}->{'lon'}."<br />";
            $wLon = $obj->{'coord'}->{'lon'};
        }
        if (isset($obj->{'coord'}->{'lat'})) {
            echo "coord->lat: ".$obj->{'coord'}->{'lat'}."<br />";
            $wLat = $obj->{'coord'}->{'lat'};
        }
    }

    if (isset($obj->{'weather'}[0])) {
        if (isset($obj->{'weather'}[0]->{'id'})) {
          echo "weather[0]->id: ".$obj->{'weather'}[0]->{'id'}."<br />";
          $wWeatherId = $obj->{'weather'}[0]->{'id'};
        }
        if (isset($obj->{'weather'}[0]->{'main'})) {
          echo "weather[0]->main: ".$obj->{'weather'}[0]->{'main'}."<br />";
          $wWeatherMain = $obj->{'weather'}[0]->{'main'};
        }
        if (isset($obj->{'weather'}[0]->{'description'})) {
          echo "weather[0]->description: ".$obj->{'weather'}[0]->{'description'}."<br />";
          $wWeatherDescription = $obj->{'weather'}[0]->{'description'};
        }
        if (isset($obj->{'weather'}[0]->{'icon'})) {
          echo "weather[0]->icon: ".$obj->{'weather'}[0]->{'icon'}."<br />";
          $wWeatherIcon = $obj->{'weather'}[0]->{'icon'};
        }
    }
      
    if (isset($obj->{'base'})) {
        echo "base: ".$obj->{'base'}."<br />";
        $wBase = $obj->{'base'};
    }
    
    if (isset($obj->{'main'})) {
        if (isset($obj->{'main'}->{'temp'})) {
            echo "main->temp: ".$obj->{'main'}->{'temp'}."<br />";
            $wMainTemp = $obj->{'main'}->{'temp'};
        }
        if (isset($obj->{'main'}->{'feels_like'})) {
            echo "main->feels_like: ".$obj->{'main'}->{'feels_like'}."<br />";
            $wMainFeelsLike = $obj->{'main'}->{'feels_like'};
        }
        if (isset($obj->{'main'}->{'temp_min'})) {
            echo "main->temp_min: ".$obj->{'main'}->{'temp_min'}."<br />";
            $wMainTempMin = $obj->{'main'}->{'temp_min'};
        }
        if (isset($obj->{'main'}->{'temp_max'})) {
            echo "main->temp_max: ".$obj->{'main'}->{'temp_max'}."<br />";
            $wMainTempMax = $obj->{'main'}->{'temp_max'};
        }
        if (isset($obj->{'main'}->{'pressure'})) {
            echo "main->pressure: ".$obj->{'main'}->{'pressure'}."<br />";
            $wMainPressure = $obj->{'main'}->{'pressure'};
        }
        if (isset($obj->{'main'}->{'humidity'})) {
            echo "main->humidity: ".$obj->{'main'}->{'humidity'}."<br />";
            $wMainHumidity = $obj->{'main'}->{'humidity'};
        }
        if (isset($obj->{'main'}->{'sea_level'})) {
            echo "main->sea_level: ".$obj->{'main'}->{'sea_level'}."<br />";
            $wMainSeaLevel = $obj->{'main'}->{'sea_level'};
        }
        if (isset($obj->{'main'}->{'grnd_level'})) {
            echo "main->grnd_level: ".$obj->{'main'}->{'grnd_level'}."<br />";
            $wMainGrndLevel = $obj->{'main'}->{'grnd_level'};
        }
    }
    
    if (isset($obj->{'visibility'})) {
        echo "visibility: ".$obj->{'visibility'}."<br />";
        $wVisibility = $obj->{'visibility'};
    }

    if (isset($obj->{'wind'})) {
        if (isset($obj->{'wind'}->{'speed'})) {
            echo "wind->speed: ".$obj->{'wind'}->{'speed'}."<br />";
            $wWindSpeed = $obj->{'wind'}->{'speed'};
        }
        if (isset($obj->{'wind'}->{'deg'})) {
            echo "wind->deg: ".$obj->{'wind'}->{'deg'}."<br />";
            $wWindDeg = $obj->{'wind'}->{'deg'};
        }
        if (isset($obj->{'wind'}->{'gust'})) {
            echo "wind->gust: ".$obj->{'wind'}->{'gust'}."<br />";
            $wWindGust = $obj->{'wind'}->{'gust'};
        }
    }
    
    if (isset($obj->{'clouds'})) {
        echo "clouds->all: ".$obj->{'clouds'}->{'all'}."<br />";
        $wClouds = $obj->{'clouds'}->{'all'};
    }

    if (isset($obj->{'rain'})) {
        if (isset($obj->{'rain'}->{'1h'})) {
            echo "rain->1h: ".$obj->{'rain'}->{'1h'}."<br />";
            $wRain1h = $obj->{'rain'}->{'1h'};
        }
        if (isset($obj->{'rain'}->{'3h'})) {
            echo "rain->3h: ".$obj->{'rain'}->{'3h'}."<br />";
            $wRain3h = $obj->{'rain'}->{'3h'};
        }
    }

    if (isset($obj->{'snow'})) {
        if (isset($obj->{'snow'}->{'1h'})) {
            echo "snow->1h: ".$obj->{'snow'}->{'1h'}."<br />";
            $wSnow1h = $obj->{'snow'}->{'1h'};
        }
        if (isset($obj->{'snow'}->{'3h'})) {
            echo "snow->3h: ".$obj->{'snow'}->{'3h'}."<br />";
            $wSnow3h = $obj->{'snow'}->{'3h'};
        }
    }

    if (isset($obj->{'dt'})) {
        echo "dt: ".$obj->{'dt'}." (".date("Y-m-d H:i:s", $obj->{'dt'}).")";
        if (isset($obj->{'timezone'})) {
            echo " (local dt: ".date("Y-m-d H:i:s", $obj->{'dt'} + $obj->{'timezone'}).")";
        }
        echo "<br />";
        $wDt = $obj->{'dt'};
    }

    if (isset($obj->{'sys'})) {
        if (isset($obj->{'sys'}->{'type'})) {
            echo "sys->type: ".$obj->{'sys'}->{'type'}."<br />";
            $wSysType = $obj->{'sys'}->{'type'};
        }
        if (isset($obj->{'sys'}->{'id'})) {
            echo "sys->id: ".$obj->{'sys'}->{'id'}."<br />";
            $wSysId = $obj->{'sys'}->{'id'};
        }
        if (isset($obj->{'sys'}->{'country'})) {
            echo "sys->country: ".$obj->{'sys'}->{'country'}."<br />";
            $wSysCountry = $obj->{'sys'}->{'country'};
        }
        if (isset($obj->{'sys'}->{'sunrise'})) {
            echo "sys->sunrise: ".$obj->{'sys'}->{'sunrise'}." (".date("Y-m-d H:i:s", $obj->{'sys'}->{'sunrise'}).")";
            if (isset($obj->{'timezone'})) {
                echo " (local sunrise: ".date("Y-m-d H:i:s", $obj->{'sys'}->{'sunrise'} + $obj->{'timezone'}).")";
            }
            echo "<br />";
            $wSysSunrise = $obj->{'sys'}->{'sunrise'};
        }
        if (isset($obj->{'sys'}->{'sunset'})) {
            echo "sys->sunset: ".$obj->{'sys'}->{'sunset'}." (".date("Y-m-d H:i:s", $obj->{'sys'}->{'sunset'}).")";
            if (isset($obj->{'timezone'})) {
                echo " (local sunset: ".date("Y-m-d H:i:s", $obj->{'sys'}->{'sunset'} + $obj->{'timezone'}).")";
            }
            echo "<br />";
            $wSysSunset = $obj->{'sys'}->{'sunset'};
        }
    }

    if (isset($obj->{'timezone'})) {
        echo "timezone: ".$obj->{'timezone'}."<br />";
        $wTimezone = $obj->{'timezone'};
    }

    if (isset($obj->{'id'})) {
        echo "id: ".$obj->{'id'}."<br />";
        $wId = $obj->{'id'};
    }

    if (isset($obj->{'name'})) {
        echo "name: ".$obj->{'name'}."<br />";
        $wName = $obj->{'name'};
    }

    if (isset($obj->{'cod'})) {
        echo "cod: ".$obj->{'cod'}."<br />";
        $wCod = $obj->{'cod'};
    }

    $weather = new Weather(null, null, null, $wLon, $wLat,
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
    $wClouds,
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
    $wCod);

    $weather->ulozDoDb();


?>