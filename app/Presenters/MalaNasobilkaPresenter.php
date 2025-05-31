<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class MalaNasobilkaPresenter extends Nette\Application\UI\Presenter
{

    public $rows = null;
    public $cols = null;


    public function renderDefault(): void {
        //do something

        if(array_key_exists("submit", $_GET)) {
            $this->rows = $_GET["rows"];
            $this->cols = $_GET["cols"];
            if (isset($rows) && isset($cols)) {
                if (!is_numeric($rows) or !is_numeric($cols)) {
                    $this->rows = null;
                    $this->cols = null;
                }
            }
        }
    
        if (empty($this->rows) || empty($this->cols)) {
            //error message
            $this->flashMessage("Zadejte prosím počet řádků a sloupců.", "danger");
        }

        $this->template->rows = $this->rows;
        $this->template->cols = $this->cols;

        bdump($this->rows);
        bdump($this->cols);


    }


}
