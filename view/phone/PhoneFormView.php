<?php
require_once 'view/DefaultView.php';
require_once 'model/Phone.php';


class PhoneFormView extends DefaultView {
    private $isNewItem;

    public function __construct($isNewItem) {
        $this->isNewItem = $isNewItem;
        if ($this->isNewItem) {
            parent::__construct("Új telefon");
        } else {
            parent::__construct("Telefon szerkesztése");
        }
    }

    public function showNew($employees) {
        $this->showEdit(null, $employees);
    }

    public function showEdit($phone, $employees) {
        if ($phone == null) {
            $phone = new Phone();
        } else {
            echo '<br/><center><h4>Számítógép azonosító: ' . $phone->getId() . '</center></h4>';
        }

        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">';

                if ($this->isNewItem) {
                    echo '
                    <form method="POST" action="' . UrlUtil::MAIN_URL . '">
                      <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_CREATE_PHONE . '"/>
                    ';
                } else {
                    echo '
                    <form method="POST" action="' . UrlUtil::MAIN_URL . '">
                      <input type="hidden" name="id" value="' . $phone->getId() . '"/>
                    <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_MODIFY_PHONE . '"/>
                      ';
                }
                      echo '<div class="form-group">
                        <label for="floor">Márka</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="' . $phone->getBrand() . '" required>
                      </div>
                      <div class="form-group">
                        <label for="doorNumber">Modell</label>
                        <input type="text" class="form-control" id="model" name="model" value="' . $phone->getModel() . '" required>
                      </div>
                      <div class="form-group">
                        <label for="phoneNumber">Telefonszám</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="' . $phone->getPhoneNumber() . '" required>
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
                    if ($phone->getOwnerId() == null) {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="null">Nincs hozzárendelve tulajdonos</option>';

                    foreach ($employees as $employee) {
                        $selected = '';
                        if ($employee->getId() == $phone->getOwnerId()) {
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
                            <a class="btn btn-default" href="' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_PHONE_LIST . '">Vissza</a>
                        </div>
                      </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        
        </div>
        ';
    }
}