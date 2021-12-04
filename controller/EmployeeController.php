<?php
require_once "service/EmployeeService.php";
require_once "service/RoomService.php";
require_once "view/employee/EmployeeListView.php";
require_once "view/employee/EmployeeFormView.php";

class EmployeeController {
    private $employeeService;
    private $roomService;

    public function __construct() {
        $this->employeeService = new EmployeeService();
        $this->roomService = new RoomService();
    }

    public function showList() {
        $employees = $this->employeeService->findAll();
        $view = new EmployeeListView();
        $view->show($employees);
    }

    public function showEditForm() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $employee = $this->employeeService->findById($id);
            $rooms = $this->roomService->findAll();
            $view = new EmployeeFormView(false);
            $view->showEdit($employee, $rooms);
        } else {
            echo "Nem található ilyen ID-val alkalmazott";
        }
    }

    public function showNewForm() {
        $rooms = $this->roomService->findAll();
        $view = new EmployeeFormView(true);
        $view->showNew($rooms);
    }

    public function modifyEmployee() {
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $post = $_POST['post'];

        $workingRoomId = "null";
        echo "heyho1: " . $workingRoomId;
        if (isset($_POST['workingRoomId'])) {
            echo "heyho2: " . $_POST['workingRoomId'];
            $workingRoomId = $_POST['workingRoomId'];
        }
        echo "heyho3: " . $workingRoomId;
        $supervisorId = "null";
        if (isset($_POST['supervisorId'])) {
            $supervisorId = $_POST['supervisorId'];
        }
        $addressId = "null";
        if (isset($_POST['addressId'])) {
            $addressId = $_POST['addressId'];
        }

        $this->employeeService->modifyById($id, $firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId);
//        header('Location: ' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_EMPLOYEE_LIST);
    }

    public function createEmployee() {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $post = $_POST['post'];

        $workingRoomId = "null";
        if (isset($_POST['workingRoomId'])) {
            $workingRoomId = $_POST['workingRoomId'];
        }
        $supervisorId = "null";
        if (isset($_POST['supervisorId'])) {
            $supervisorId = $_POST['supervisorId'];
        }
        $addressId = "null";
        if (isset($_POST['addressId'])) {
            $addressId = $_POST['addressId'];
        }

        $this->employeeService->insert($firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId);
        header('Location: ' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_EMPLOYEE_LIST);
    }

    public function deleteEmployee() {
        $id = $_GET['id'];

        $this->employeeService->delete($id);
        header('Location: ' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_EMPLOYEE_LIST);
    }
}