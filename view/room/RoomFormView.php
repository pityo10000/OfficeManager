<?php
require_once 'view/DefaultView.php';
require_once 'model/Room.php';


class RoomFormView extends DefaultView {
    private $isNewItem;

    public function __construct($isNewItem) {
        $this->isNewItem = $isNewItem;
        if ($this->isNewItem) {
            parent::__construct("Új szoba");
        } else {
            parent::__construct("Szoba szerkesztése");
        }
    }

    public function showNew() {
        $this->showEdit(null);
    }

    public function showEdit($room) {
        if ($room == null) {
            $room = new Room();
        } else {
            echo '<br/><center><h4>Szoba azonosító: ' . $room->getId() . '</center></h4>';
        }

        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">';

                if ($this->isNewItem) {
                    echo '
                    <form method="POST" action="' . UrlConstants::MAIN_URL . '">
                      <input type="hidden" name="operation" value="' . UrlConstants::OPERATION_CREATE_ROOM . '"/>
                    ';
                } else {
                    echo '
                    <form method="POST" action="' . UrlConstants::MAIN_URL . '">
                      <input type="hidden" name="id" value="' . $room->getId() . '"/>
                    <input type="hidden" name="operation" value="' . UrlConstants::OPERATION_MODIFY_ROOM . '"/>
                      ';
                }
                      echo '<div class="form-group">
                        <label for="floor">Emelet</label>
                        <input type="number" class="form-control" id="floor" name="floor" value="' . $room->getFloor() . '" required>
                      </div>
                      <div class="form-group">
                        <label for="doorNumber">Ajtó száma</label>
                        <input type="number" class="form-control" id="doorNumber" name="doorNumber" value="' . $room->getDoorNumber() . '" required>
                      </div>
                      <div class="form-group">
                        <label for="capacity">Létszám</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" value="' . $room->getCapacity() . '" required>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-primary">Mentés</button>
                        </div>
                        <div class="col-md-9"></div>
                        <div class="col-md-1">
                            <a class="btn btn-default" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_ROOM_LIST . '">Vissza</a>
                        </div>
                      </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        
        </div>
        ';
    }
}