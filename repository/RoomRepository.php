<?php
require_once "model/Room.php";
require_once "repository/DefaultRepository.php";

class RoomRepository extends DefaultRepository {

    function findAll() {
        $results = $this->runQuery("SELECT R.ID, R.DOOR_NUMBER, R.CAPACITY, R.FLOOR, (
            SELECT COUNT(E.ID)
            FROM employee E
            WHERE E.WORKING_ROOM_ID = R.ID
            ) AS EMPLOYEE_COUNT
        FROM ROOM R");
        $rooms = array();
        while ($result = $results->fetch_assoc()) {
            $room = $this->resultToRoom($result);
            array_push($rooms, $room);
        }
        return $rooms;
    }

    function findById($id) {
        $results = $this->runQuery("SELECT R.ID, R.DOOR_NUMBER, R.CAPACITY, R.FLOOR FROM ROOM R WHERE R.ID = " . $id);

        if ($results->num_rows <= 0) {
            return null;
        }

        $result = $results->fetch_assoc();
        $room = $this->resultToRoom($result);
        return $room;
    }

    private function resultToRoom($result) {
        $room = new Room();
        $room->setId($result["ID"]);
        $room->setDoorNumber($result["DOOR_NUMBER"]);
        $room->setCapacity($result["CAPACITY"]);
        $room->setFloor($result["FLOOR"]);
        if (isset($result["EMPLOYEE_COUNT"])) {
            $room->setEmployeeCount($result["EMPLOYEE_COUNT"]);
        }
        return $room;
    }

    function updateById($id, $floor, $doorNumber, $capacity) {
        $this->runQuery('UPDATE ROOM R SET R.DOOR_NUMBER=' . $doorNumber. ', R.CAPACITY=' . $capacity . ',
         R.FLOOR=' . $floor . ' WHERE R.ID = ' . $id);
    }

    function insert($floor, $doorNumber, $capacity) {
        $this->runQuery('INSERT INTO ROOM (DOOR_NUMBER, CAPACITY, FLOOR) VALUE (' . $doorNumber . ', 
        ' . $capacity . ', ' . $floor . ')');
    }

    function delete($id) {
        $this->runQuery('DELETE FROM ROOM WHERE ID = ' . $id);
    }

}