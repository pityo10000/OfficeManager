<?php


class Room {
    private $id;
    private $doorNumber;
    private $capacity;
    private $floor;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDoorNumber() {
        return $this->doorNumber;
    }

    public function setDoorNumber($doorNumber) {
        $this->doorNumber = $doorNumber;
    }

    public function getCapacity() {
        return $this->capacity;
    }

    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }

    public function getFloor() {
        return $this->floor;
    }

    public function setFloor($floor) {
        $this->floor = $floor;
    }

}