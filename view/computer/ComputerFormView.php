<?php
require_once 'view/DefaultView.php';
require_once 'model/Computer.php';


class ComputerFormView extends DefaultView {
    private $isNewItem;

    public function __construct($isNewItem) {
        $this->isNewItem = $isNewItem;
        if ($this->isNewItem) {
            parent::__construct("Új számítógép");
        } else {
            parent::__construct("Számítógép szerkesztése");
        }
    }

    public function showNew() {
        $this->showEdit(null);
    }

    public function showEdit($computer) {
        if ($computer == null) {
            $computer = new Computer();
        } else {
            echo '<br/><center><h4>Számítógép azonosító: ' . $computer->getId() . '</center></h4>';
        }

        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">';

                if ($this->isNewItem) {
                    echo '
                    <form method="POST" action="' . UrlUtil::MAIN_URL . '">
                      <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_CREATE_COMPUTER . '"/>
                    ';
                } else {
                    echo '
                    <form method="POST" action="' . UrlUtil::MAIN_URL . '">
                      <input type="hidden" name="id" value="' . $computer->getId() . '"/>
                    <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_MODIFY_COMPUTER . '"/>
                      ';
                }
                      echo '<div class="form-group">
                        <label for="floor">Márka</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="' . $computer->getBrand() . '" required>
                      </div>
                      <div class="form-group">
                        <label for="doorNumber">Modell</label>
                        <input type="text" class="form-control" id="model" name="model" value="' . $computer->getModel() . '" required>
                      </div>
                      <div class="form-group">
                        <label for="capacity">Tárhely</label>
                        <input type="text" class="form-control" id="storage" name="storage" value="' . $computer->getStorage() . '" required>
                      </div>
                      <div class="form-group">
                        <label for="doorNumber">RAM</label>
                        <input type="text" class="form-control" id="ram" name="ram" value="' . $computer->getRam() . '" required>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-primary">Mentés</button>
                        </div>
                        <div class="col-md-9"></div>
                        <div class="col-md-1">
                            <a class="btn btn-default" href="' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_COMPUTER_LIST . '">Vissza</a>
                        </div>
                      </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        
        </div>
        ';
    }
}