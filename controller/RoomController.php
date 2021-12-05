<?php
require_once "service/RoomService.php";
require_once "view/room/RoomListView.php";
require_once "view/room/RoomFormView.php";

class RoomController {
    private $roomService;

    public function __construct() {
        $this->roomService = new RoomService();
    }

    public function showList() {
        $rooms = $this->roomService->findAll();
        $view = new RoomListView();
        $view->show($rooms);
    }

    public function showEditForm() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $room = $this->roomService->findById($id);
            $view = new RoomFormView(false);
            $view->showEdit($room);
        } else {
            echo "Nem található ilyen ID-val szoba";
        }
    }

    public function showNewForm() {
        $view = new RoomFormView(true);
        $view->showNew();
    }

    public function modifyRoom() {
        $id = $_POST['id'];
        $floor = $_POST['floor'];
        $doorNumber = $_POST['doorNumber'];
        $capacity = $_POST['capacity'];

        $this->roomService->modifyRoomById($id, $floor, $doorNumber, $capacity);
        header('Location: ' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_ROOM_LIST);
    }

    public function createRoom() {
        $floor = $_POST['floor'];
        $doorNumber = $_POST['doorNumber'];
        $capacity = $_POST['capacity'];

        $this->roomService->insert($floor, $doorNumber, $capacity);
        header('Location: ' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_ROOM_LIST);
    }

    public function deleteRoom() {
        $id = $_GET['id'];

        $this->roomService->delete($id);
        header('Location: ' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_ROOM_LIST);
    }
}