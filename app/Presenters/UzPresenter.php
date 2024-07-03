<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class UzPresenter extends Nette\Application\UI\Presenter
{

    /**
     * @inject
     * @var \App\Models\UzModel
     */
    public $model;

    //public $historie = [];

    function __construct() {
        //$this->config = \Nette\Neon\Neon::decode(file_get_contents('../app/config/common.neon'))['parameters']['config'];
    }



    public function renderDefault(int $myId = -1, $showAnswer = 0, $randomId = 0, $zpet = 0): void {
        //do something

        /*

        if(array_key_exists("submit", $_GET)) {
            $rows = $_GET["rows"];
            $cols = $_GET["cols"];
            if (isset($rows) && isset($cols)) {
                if (!is_numeric($rows) or !is_numeric($cols)) {
                    $rows = null;
                    $cols = null;
                }
            }
            if (isset($rows) && isset($cols)) {
                $this->template->rows = $rows;
                $this->template->cols = $cols;
            } else {
                //error message
            }
        }
        */

        $allData = $this->model->getAllData();

        //$data = $allData->fetchPairs('id');
        $pocetOtazek = count($allData);
        bdump($pocetOtazek, "počet");

        if ($myId == -1) {
            if (isset($_SESSION) && array_key_exists('historie', $_SESSION) && sizeof($_SESSION['historie']) > 0) {
                $myId = $_SESSION['historie'][sizeof($_SESSION['historie']) - 1];
            } else {
                $myId = 1;
            }
        } else if ($myId == 0) {
            $myId = $pocetOtazek;
        } else if ($myId > $pocetOtazek) {
            $myId = 1;
        } else if ($randomId && !$showAnswer && !$zpet) {
            $myId = random_int(1, 300);
        } else if ($zpet && isset($_SESSION) && array_key_exists('historie', $_SESSION) && sizeof($_SESSION['historie']) > 0) {
            if ($_SESSION['historie'][sizeof($_SESSION['historie']) - 1] != $myId) {
                $myId = $_SESSION['historie'][sizeof($_SESSION['historie']) - 1];
                array_pop($_SESSION['historie']);
            } else {
                array_pop($_SESSION['historie']);
                if (sizeof($_SESSION['historie']) > 0) {
                    $myId = $_SESSION['historie'][sizeof($_SESSION['historie']) - 1];
                    array_pop($_SESSION['historie']);
                }
            }
            
        }

        if (isset($_SESSION) && array_key_exists('historie', $_SESSION) && sizeof($_SESSION['historie']) > 0) {
            if($_SESSION['historie'][sizeof($_SESSION['historie']) - 1] != $myId && !$showAnswer) {
                $_SESSION['historie'][] = $myId;
            }
        } else {
            $_SESSION['historie'] = [$myId];
        }
        //bdump($_SESSION['historie']);

        /*
        foreach ($allData as $rowId=>$row) {
            if ($rowId == $myId) {
                foreach ($row as $columnId=>$column) {
                    bdump( $column, strval($columnId));
                }
            }
        }
        */

        $rowData = $allData->get($myId);
        foreach ($rowData as $columnId=>$column) {
            bdump( $column, strval($columnId));
        }

        $this->template->rowData = $rowData;
        $this->template->myId = $myId;
        $this->template->showAnswer = $showAnswer;
        $this->template->randomId = $randomId;
        //$this->template->zpet = 0;

    }


}