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

    public function showNew($rooms, $addresses, $supervisors) {
        $this->showEdit(null, $rooms, $addresses, $supervisors);
    }

    public function showEdit($employee, $rooms, $addresses, $supervisors) {
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
                    <form method="POST" action="' . UrlConstants::MAIN_URL . '" enctype="multipart/form-data">
                      <input type="hidden" name="operation" value="' . UrlConstants::OPERATION_CREATE_EMPLOYEE . '"/>
                    ';
                } else {
                    echo '
                    <form method="POST" action="' . UrlConstants::MAIN_URL . '" enctype="multipart/form-data">
                      <input type="hidden" name="id" value="' . $employee->getId() . '"/>
                    <input type="hidden" name="operation" value="' . UrlConstants::OPERATION_MODIFY_EMPLOYEE . '"/>
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
                      <div class="row form-group">
                        <label for="labourContract">Munkaszerződés</label>
                        <input type="file" class="form-control" id="labourContract" name="labourContract">';

                if ($employee->getLabourContract() != null && $employee->getLabourContract()->getId() != null) {
                    echo '<a target="_blank" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_DOWNLOAD_LABOUR_CONTRACT . '&id=' . $employee->getLabourContract()->getId() . '">Munkaszerződés letöltése</a>';
                }


                      echo '</div>
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
                      <div class=" form-group">
                          <p>
                              <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#addresses">
                              Lakcím szerkesztése
                              </button>
                          </p>
                          <div class="row">
                              <div class="collapse" id="addresses">
                                <select class="custom-select" name="homeAddressId">';

                    $selected = '';
                    if ($employee->getHomeAddressId() == null) {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="null">Nincs hozzárendelve lakcím</option>';

                    foreach ($addresses as $address) {
                        $selected = '';
                        if ($address->getId() == $employee->getHomeAddressId()) {
                            $selected = 'selected';
                        }
                        echo '<option value="' . $address->getId()  . '" ' . $selected . '>' . $address->getZipCode() . ', ' . $address->getCountry() . ', '
                            . $address->getCity() . ', ' . $address->getStreetName() . ' ' . $address->getStreetType() . ' ' . $address->getStreetNumber() . '</option>';
                    }

                    echo '</select>
                              </div>
                          </div>     
                      </div>
                      <div class=" form-group">
                          <p>
                              <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#supervisors">
                              Felettes szerkesztése
                              </button>
                          </p>
                          <div class="row">
                              <div class="collapse" id="supervisors">
                                <select class="custom-select" name="supervisorId">';

                    $selected = '';
                    if ($employee->getSupervisorId() == null) {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="null">Nincs hozzárendelve felettes</option>';

                    foreach ($supervisors as $supervisor) {
                        $selected = '';
                        if ($supervisor->getId() == $employee->getSupervisorId()) {
                            $selected = 'selected';
                        }
                        if ($supervisor->getId() != $employee->getId()) {
                            echo '<option value="' . $supervisor->getId()  . '" ' . $selected . '>#' . $supervisor->getId() . ', ' . $supervisor->getLastName() . ' '
                                . $supervisor->getFirstName() . ' (Munkakör: ' . $supervisor->getPost() . ')</option>';
                        }
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
                            <a class="btn btn-default" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_EMPLOYEE_LIST . '">Vissza</a>
                        </div>
                      </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        
        </div>
        ';
    }
}