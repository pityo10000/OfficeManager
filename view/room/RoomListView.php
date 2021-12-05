<?php
require_once "view/DefaultView.php";

class RoomListView extends DefaultView {

    public function __construct() {
        parent::__construct("Szobák");
    }

    public function show($rooms) {
        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <a class="btn btn-default" href="' . UrlConstants::MAIN_URL . '">Vissza</a>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-1">
              <a class="btn btn-primary" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_NEW_ROOM . '">Új hozzáadása</a>      
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <div class="card">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Emelet</th>
                      <th scope="col">Ajtó száma</th>
                      <th scope="col">Létszám</th>
                      <th scope="col">Férőhely</th>
                      <th scope="col">Műveletek</th>
                    </tr>
                  </thead>
                  <tbody>
            ';

        foreach ($rooms as $room) {
            $overloaded = "";
            if ($room->getCapacity() < $room->getEmployeeCount()) {
                $overloaded = ' style="color: red; font-weight: bold;" ';
            }
            echo '
                <tr>
                  <td>' . $room->getFloor() .'</td>
                  <td>' . $room->getDoorNumber() .'</td>
                  <td' . $overloaded . '>' . $room->getEmployeeCount() .'</td>
                  <td>' . $room->getCapacity() .'</td>
                  <td>
                    <a class="btn btn-primary" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_EDIT_ROOM . '&id=' . $room->getId() . '">Szerkesztés</a>              
                    <a class="btn btn-danger" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_DELETE_ROOM . '&id=' . $room->getId() . '">Törlés</a>              
                  </td>
                </tr>
            ';
        }

        echo '
                    </div>
                    <div class="col-md-2"></div>
                </div>
                </tbody>
            </table>
        </div>
        ';
    }
}