<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class GopasPresenter extends Nette\Application\UI\Presenter
{

    /**
     * @inject
     * @var \App\Models\GopasModel
     */
    public $model;

    //public $historie = [];

    function __construct() {
        //$this->config = \Nette\Neon\Neon::decode(file_get_contents('../app/config/common.neon'))['parameters']['config'];
    }



    public function renderDefault(): void {
        //do something

        $allData = $this->model->getAllData();
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

                $row[$columnId] = $column;
            }

            $data[$rowId] = $row;
        }

        //$this->template->rowData = json_encode($json_data);

        echo(json_encode($data));

    }


}