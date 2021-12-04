<?php
require_once "repository/RoomRepository.php";

class RoomService {
    private $roomRepository;

    public function __construct() {
        $this->roomRepository = new RoomRepository();
    }

    function findAll() {
        return $this->roomRepository->findAll();
    }

    function findById($id) {
        return $this->roomRepository->findById($id);
    }

    function modifyRoomById($id, $floor, $doorNumber, $capacity) {
        $this->roomRepository->updateById($id, $floor, $doorNumber, $capacity);
    }

    function insert($floor, $doorNumber, $capacity) {
        $this->roomRepository->insert($floor, $doorNumber, $capacity);
    }

    function delete($id) {
        $this->roomRepository->delete($id);
    }

}