<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\WeatherModel;
use Nette;
//use Nette\Application\UI\Form;

class Thumbnail1 {

	protected $id;
	protected $menu;
	protected $color;
	protected $picture;
	protected $reference;
	protected $order;

	public function __construct ($argId, $argMenu, $argColor, $argPicture, $argReference, $argOrder) {
		$this->id = $argId;
		$this->menu = $argMenu;
		$this->color = $argColor;
		$this->picture = $argPicture;
		$this->reference = $argReference;
		$this->order = $argOrder;
	}

	public function getId () {
		return $this->id;
	}

	public function getMenu () {
		return $this->menu;
	}

	public function getColor () {
		return $this->color;
	}

	public function getPicture () {
		return $this->picture;
	}

	public function getReference () {
		return $this->reference;
	}

	public function getOrder () {
		return $this->order;
	}
}

final class WeatherPresenter extends Nette\Application\UI\Presenter
{
    /* Původní
	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

	// ...
    public function renderDefault(): void
    {
        $this->template->posts = $this->database
            ->table('posts')
            ->order('created_at DESC')
            ->limit(5);
    }
    */

    private WeatherModel $facade;

	public function __construct(WeatherModel $facade)
	{
		$this->facade = $facade;
	}

	public function renderDefault(): void
	{
		$poleObrazku = scandir("./img/");
		$this->template->poleObrazku = $poleObrazku;

		//https://play.google.com/store/apps/details?id=funkacer.ceskesvatkykalendar
		$poleThumbnails = [
			'weather' => new Thumbnail1 ("weather", "Předpověď počasí", "black", "weather_picture.png", "https://funkacer.cz/weather-app/", 1),
			'kalendar' => new Thumbnail1 ("kalendar", "České svátky kalendář", "black", "app_picture.png", "https://play.google.com/store/apps/details?id=funkacer.ceskesvatkykalendar", 2),
			'penzion' => new Thumbnail1 ("penzion", "Prima-penzion", "black", "primapenzion-main.jpg", "https://funkacer.cz/prima-penzion/", 3),
			'prevodnik' => new Thumbnail1 ("prevodnik", "Převodník teplot", "black", "temp_picture.png", "PrevodnikTeplot:default", 4),
			'nasobilka' => new Thumbnail1 ("nasobilka", "Malá násobilka", "black", "nasobilka_picture.png", "MalaNasobilka:default", 5),
			'strom' => new Thumbnail1 ("strom", "Strom produktů", "black", "strom_picture.png", "Strom:default", 6),
			'uz' => new Thumbnail1 ("uz", "Úřednická zkouška", "black", "uz_picture.png", "Uz:default", 7)
		];
		$this->template->poleThumbnails = $poleThumbnails;

		$this->template->posts = $this->facade
			->getPublicArticles()
			->limit(5);
	}

	public function renderGetweather(): void
	{
		//$weather = $this->facade->getWeather("Praha");
		$weatherForecast = $this->facade->getWeatherForecast("Praha");

		bdump($weatherForecast);

		$this->facade->truncateDb();

		foreach($weatherForecast as $wF) {
			$this->facade->ulozDoDb($wF);
		}

		echo json_encode(['stav' => "OK", 'datum' => date('Y-m-d H:i:s')]);
	}

	public function renderGetday(int $myId = -1): void
	{
		bdump($myId);
		$allData = $this->facade->getDay($myId);
        $data = array();

        foreach ($allData as $rowId=>$rowData) {
            /*
            echo '<pre>';

            print_r($rowId);

            echo '</pre>';
            */
            //$rowData = $allData->get($myId);

            $row = array();
            
            foreach ($rowData as $columnId=>$column) {
                //bdump( $column, strval($columnId));

                /*
                echo '<pre>';

                print_r($columnId);
                echo '</br>';
                print_r($column);

                echo '</pre>';
                */

				if (is_numeric($column)) {
					$temp = strval(round($column, 1));
					if (!str_contains($temp, ".")) {
						$temp = $temp . ".0";
					}
					$row[$columnId] = $temp;
				} else {
					$row[$columnId] = $column;
				}

                
            }

            $data[$rowId] = $row;
        }

        //$this->template->rowData = json_encode($json_data);

        echo(json_encode($data));
	}

	public function renderGetall(): void
	{
		
		$allData = $this->facade->getAll();
        $data = array();

        foreach ($allData as $rowId=>$rowData) {

			//if ($rowId = "1") {
				/*
				echo '<pre>';

				print_r($rowId);

				echo '</pre>';
				*/
				//$rowData = $allData->get($myId);

				$row = array();
				
				foreach ($rowData as $columnId=>$column) {
					//bdump( $column, strval($columnId));

					/*
					echo '<pre>';

					print_r($columnId);
					echo '</br>';
					print_r($column);

					echo '</pre>';
					*/

					if (is_numeric($column)) {
						$temp = strval(round($column, 1));
						if (!str_contains($temp, ".")) {
							$temp = $temp . ".0";
						}
						$row[$columnId] = $temp;
					} else {
						$row[$columnId] = $column;
					}

					
				}
			//}

            $data[$rowId] = $row;
        }

        //$this->template->rowData = json_encode($json_data);

        echo(json_encode($data));
	}


}


