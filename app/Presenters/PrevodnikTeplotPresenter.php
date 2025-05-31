<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class PrevodnikTeplotPresenter extends Nette\Application\UI\Presenter
{

    /**
     * @inject
     * @var \App\Models\PrevodnikTeplotModel
     */
    public $model;

    public $stupneC = 0;
    public $stupneF = 32;

    public function renderDefault(): void {
        //do something

        if (array_key_exists("submit-c", $_POST)) {
            if (is_numeric($_POST["stupne-c"])) {
                //pokud je parametr číslo, provedeme výpočet
                $this->stupneC = $_POST["stupne-c"];
                //funkce z libmatika
                $this->stupneF = round($this->model->cNaF($this->stupneC), 5);
            } else {
                //jinak vytvoříme proměnnou chyba
                $this->flashMessage("Zadali jste špatný data pro stupně C.", "danger");
            }
            
        }

        if (array_key_exists("submit-f", $_POST)) {
            if (is_numeric($_POST["stupne-f"])) {
                //pokud je parametr číslo, provedeme výpočet
                $this->stupneF = $_POST["stupne-f"];
                //funkce z libmatika
                $this->stupneC = round($this->model->fNaC($this->stupneF), 5);
            } else {
                //jinak vytvoříme proměnnou chyba
                $this->flashMessage("Zadali jste špatný data pro stupně F.", "danger");
            }

        }

        $this->template->stupneC = $this->stupneC;
        $this->template->stupneF = $this->stupneF;

    }


}
