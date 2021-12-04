<?php
require_once 'view/DefaultView.php';
require_once 'model/Employee.php';


class EmployeeFormView extends DefaultView {
    private $isNewItem;

    public function __construct($isNewItem) {
        $this->isNewItem = $isNewItem;
        if ($this->isNewItem) {
            parent::__construct("Új alkalmazott");
        } else {
            parent::__construct("Alkalmazott szerkesztése");
        }
    }

    public function showNew($rooms) {
        $this->showEdit(null, $rooms);
    }

    public function showEdit($employee, $rooms) {
        if ($employee == null) {
            $employee = new Employee();
        } else {
            echo '<br/><center><h4>Alkalmazott azonosító: ' . $employee->getId() . '</center></h4>';
        }

        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">';

                if ($this->isNewItem) {
                    echo '
                    <form method="POST" action="' . UrlUtil::MAIN_URL . '">
                      <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_CREATE_EMPLOYEE . '"/>
                    ';
                } else {
                    echo '
                    <form method="POST" action="' . UrlUtil::MAIN_URL . '">
                      <input type="hidden" name="id" value="' . $employee->getId() . '"/>
                    <input type="hidden" name="operation" value="' . UrlUtil::OPERATION_MODIFY_EMPLOYEE . '"/>
                      ';
                }
                      echo '<div class="row form-group">
                        <label for="lastName">Vezetéknév</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="' . $employee->getLastName() . '" required>
                      </div>
                      <div class="row form-group">
                        <label for="firstName">Keresztnév</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="' . $employee->getFirstName() . '" required>
                      </div>
                      <div class="row form-group">
                        <label for="post">Munkakör</label>
                        <input type="text" class="form-control" id="post" name="post" value="' . $employee->getPost() . '" required>
                      </div>
                      <div class=" form-group">
                          <p>
                              <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#rooms">
                              Dolgozószoba szerkesztése
                              </button>
                          </p>
                          <div class="row">
                              <div class="collapse" id="rooms">
                                <select class="custom-select" name="workingRoomId">';

                    $selected = '';
                    if ($employee->getWorkingRoomId() == null) {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="null">Nincs hozzárendelve szoba</option>';

                    foreach ($rooms as $room) {
                        $selected = '';
                        if ($room->getId() == $employee->getWorkingRoomId()) {
                            $selected = 'selected';
                        }
                        echo '<option value="' . $room->getId()  . '" ' . $selected . '>Emelet: ' . $room->getFloor() . ', Ajtó: '
                            . $room->getDoorNumber() . '</option>';
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
                            <a class="btn btn-default" href="' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_EMPLOYEE_LIST . '">Vissza</a>
                        </div>
                      </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        
        </div>
        ';
    }
}