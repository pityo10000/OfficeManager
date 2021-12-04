<?php

require_once 'util/UrlUtil.php';
require_once 'controller/RoomController.php';
require_once 'controller/AddressController.php';
require_once 'controller/ComputerController.php';
require_once 'controller/EmployeeController.php';
require_once 'view/HomeView.php';

class Router {
    static function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            self::handlePost();
        } else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            self::handleGet();
        }
    }

    private static function handleGet() {
        if (isset($_GET['nav'])) {
            $nav = $_GET['nav'];
            switch ($nav) {
                case UrlUtil::NAV_ROOM_LIST:
                    $controller = new RoomController();
                    $controller->showList();
                    break;
                case UrlUtil::NAV_EDIT_ROOM:
                    $controller = new RoomController();
                    $controller->showEditForm();
                    break;
                case UrlUtil::NAV_NEW_ROOM:
                    $controller = new RoomController();
                    $controller->showNewForm();
                    break;
                case UrlUtil::NAV_DELETE_ROOM:
                    $controller = new RoomController();
                    $controller->deleteRoom();
                    break;
                case UrlUtil::NAV_ADDRESS_LIST:
                    $controller = new AddressController();
                    $controller->showList();
                    break;
                case UrlUtil::NAV_NEW_ADDRESS:
                    $controller = new AddressController();
                    $controller->showNewForm();
                    break;
                case UrlUtil::NAV_DELETE_ADDRESS:
                    $controller = new AddressController();
                    $controller->deleteAddress();
                    break;
                case UrlUtil::NAV_COMPUTER_LIST:
                    $controller = new ComputerController();
                    $controller->showList();
                    break;
                case UrlUtil::NAV_EDIT_COMPUTER:
                    $controller = new ComputerController();
                    $controller->showEditForm();
                    break;
                case UrlUtil::NAV_NEW_COMPUTER:
                    $controller = new ComputerController();
                    $controller->showNewForm();
                    break;
                case UrlUtil::NAV_DELETE_COMPUTER:
                    $controller = new ComputerController();
                    $controller->deleteComputer();
                    break;
                case UrlUtil::NAV_EMPLOYEE_LIST:
                    $controller = new EmployeeController();
                    $controller->showList();
                    break;
                case UrlUtil::NAV_EDIT_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->showEditForm();
                    break;
                case UrlUtil::NAV_NEW_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->showNewForm();
                    break;
                case UrlUtil::NAV_DELETE_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->deleteEmployee();
                    break;
                default:
                    print('404');
            }
        } else {
            $homeView = new HomeView();
            $homeView->show();
        }
    }

    private static function handlePost() {
        if (isset($_POST['operation'])) {
            $operation = $_POST['operation'];

            switch ($operation) {
                case UrlUtil::OPERATION_MODIFY_ROOM:
                    $controller = new RoomController();
                    $controller->modifyRoom();
                    break;
                case UrlUtil::OPERATION_CREATE_ROOM:
                    $controller = new RoomController();
                    $controller->createRoom();
                    break;
                case UrlUtil::OPERATION_CREATE_ADDRESS:
                    $controller = new AddressController();
                    $controller->createAddress();
                    break;
                case UrlUtil::OPERATION_MODIFY_COMPUTER:
                    $controller = new ComputerController();
                    $controller->modifyComputer();
                    break;
                case UrlUtil::OPERATION_CREATE_COMPUTER:
                    $controller = new ComputerController();
                    $controller->createComputer();
                    break;
                case UrlUtil::OPERATION_MODIFY_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->modifyEmployee();
                    break;
                case UrlUtil::OPERATION_CREATE_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->createEmployee();
                    break;
            }
        }
    }
}