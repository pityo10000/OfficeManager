<?php

require_once 'constants/UrlConstants.php';
require_once 'controller/RoomController.php';
require_once 'controller/AddressController.php';
require_once 'controller/ComputerController.php';
require_once 'controller/PhoneController.php';
require_once 'controller/EmployeeController.php';
require_once 'controller/FileController.php';
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
                case UrlConstants::NAV_ROOM_LIST:
                    $controller = new RoomController();
                    $controller->showList();
                    break;
                case UrlConstants::NAV_EDIT_ROOM:
                    $controller = new RoomController();
                    $controller->showEditForm();
                    break;
                case UrlConstants::NAV_NEW_ROOM:
                    $controller = new RoomController();
                    $controller->showNewForm();
                    break;
                case UrlConstants::NAV_DELETE_ROOM:
                    $controller = new RoomController();
                    $controller->deleteRoom();
                    break;

                case UrlConstants::NAV_ADDRESS_LIST:
                    $controller = new AddressController();
                    $controller->showList();
                    break;
                case UrlConstants::NAV_NEW_ADDRESS:
                    $controller = new AddressController();
                    $controller->showNewForm();
                    break;
                case UrlConstants::NAV_DELETE_ADDRESS:
                    $controller = new AddressController();
                    $controller->deleteAddress();
                    break;

                case UrlConstants::NAV_COMPUTER_LIST:
                    $controller = new ComputerController();
                    $controller->showList();
                    break;
                case UrlConstants::NAV_EDIT_COMPUTER:
                    $controller = new ComputerController();
                    $controller->showEditForm();
                    break;
                case UrlConstants::NAV_NEW_COMPUTER:
                    $controller = new ComputerController();
                    $controller->showNewForm();
                    break;
                case UrlConstants::NAV_DELETE_COMPUTER:
                    $controller = new ComputerController();
                    $controller->deleteComputer();
                    break;

                case UrlConstants::NAV_PHONE_LIST:
                    $controller = new PhoneController();
                    $controller->showList();
                    break;
                case UrlConstants::NAV_EDIT_PHONE:
                    $controller = new PhoneController();
                    $controller->showEditForm();
                    break;
                case UrlConstants::NAV_NEW_PHONE:
                    $controller = new PhoneController();
                    $controller->showNewForm();
                    break;
                case UrlConstants::NAV_DELETE_PHONE:
                    $controller = new PhoneController();
                    $controller->deletePhone();
                    break;

                case UrlConstants::NAV_EMPLOYEE_LIST:
                    $controller = new EmployeeController();
                    $controller->showList();
                    break;
                case UrlConstants::NAV_EDIT_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->showEditForm();
                    break;
                case UrlConstants::NAV_NEW_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->showNewForm();
                    break;
                case UrlConstants::NAV_DELETE_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->deleteEmployee();
                    break;

                case UrlConstants::NAV_DOWNLOAD_LABOUR_CONTRACT:
                    $controller = new FileController();
                    $controller->downloadFile();
                    exit();
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
                case UrlConstants::OPERATION_MODIFY_ROOM:
                    $controller = new RoomController();
                    $controller->modifyRoom();
                    break;
                case UrlConstants::OPERATION_CREATE_ROOM:
                    $controller = new RoomController();
                    $controller->createRoom();
                    break;

                case UrlConstants::OPERATION_CREATE_ADDRESS:
                    $controller = new AddressController();
                    $controller->createAddress();
                    break;

                case UrlConstants::OPERATION_MODIFY_COMPUTER:
                    $controller = new ComputerController();
                    $controller->modifyComputer();
                    break;
                case UrlConstants::OPERATION_CREATE_COMPUTER:
                    $controller = new ComputerController();
                    $controller->createComputer();
                    break;

                case UrlConstants::OPERATION_MODIFY_PHONE:
                    $controller = new PhoneController();
                    $controller->modifyPhone();
                    break;
                case UrlConstants::OPERATION_CREATE_PHONE:
                    $controller = new PhoneController();
                    $controller->createPhone();
                    break;

                case UrlConstants::OPERATION_MODIFY_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->modifyEmployee();
                    break;
                case UrlConstants::OPERATION_CREATE_EMPLOYEE:
                    $controller = new EmployeeController();
                    $controller->createEmployee();
                    break;
            }
        }
    }
}