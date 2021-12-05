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

    public function showNew($employees) {
        $this->showEdit(null, $employees);
    }

    public function showEdit($computer, $employees) {
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
                    <form method="POST" action="' . UrlConstants::MAIN_URL . '">
                      <input type="hidden" name="operation" value="' . UrlConstants::OPERATION_CREATE_COMPUTER . '"/>
                    ';
                } else {
                    echo '
                    <form method="POST" action="' . UrlConstants::MAIN_URL . '">
                      <input type="hidden" name="id" value="' . $computer->getId() . '"/>
                    <input type="hidden" name="operation" value="' . UrlConstants::OPERATION_MODIFY_COMPUTER . '"/>
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
                      
                      <div class=" form-group">
                          <p>
                              <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#employees">
                              Tulajdonos szerkesztése
                              </button>
                          </p>
                          <div class="row">
                              <div class="collapse" id="employees">
                                <select class="custom-select" name="ownerId">';

                    $selected = '';
                    if ($computer->getOwnerId() == null) {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="null">Nincs hozzárendelve tulajdonos</option>';

                    foreach ($employees as $employee) {
                        $selected = '';
                        if ($employee->getId() == $computer->getOwnerId()) {
                            $selected = 'selected';
                        }
                        echo '<option value="' . $employee->getId()  . '" ' . $selected . '>#' . $employee->getId() . ', ' . $employee->getLastName() . ' '
                            . $employee->getFirstName() . ' (Munkakör: ' . $employee->getPost() . ')</option>';
                    }

                    echo '</select>
                              </div>
                          </div>     
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-primary">Mentés</button>
                        </div>
                        <div class="col-md-9"></div>
                        <div class="col-md-1">
                            <a class="btn btn-default" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_COMPUTER_LIST . '">Vissza</a>
                        </div>
                      </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        
        </div>
        ';
    }
}