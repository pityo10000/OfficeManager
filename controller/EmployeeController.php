<?php
require_once "service/EmployeeService.php";
require_once "service/RoomService.php";
require_once "service/AddressService.php";
require_once "view/employee/EmployeeListView.php";
require_once "view/employee/EmployeeFormView.php";

class EmployeeController {
    private $employeeService;
    private $roomService;
    private $addressService;

    public function __construct() {
        $this->employeeService = new EmployeeService();
        $this->roomService = new RoomService();
        $this->addressService = new AddressService();
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
            $addresses = $this->addressService->findAll();
            $supervisors = $this->employeeService->findAll();
            $view = new EmployeeFormView(false);
            $view->showEdit($employee, $rooms, $addresses, $supervisors);
        } else {
            echo "Nem található ilyen ID-val alkalmazott";
        }
    }

    public function showNewForm() {
        $rooms = $this->roomService->findAll();
        $addresses = $this->addressService->findAll();
        $supervisors = $this->employeeService->findAll();
        $view = new EmployeeFormView(true);
        $view->showNew($rooms, $addresses, $supervisors);
    }

    public function modifyEmployee() {
        $id = $_POST['id'];
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
        if (isset($_POST['homeAddressId'])) {
            $addressId = $_POST['homeAddressId'];
        }

        $file = null;
        $filename = null;

        if (isset($_FILES['labourContract'])) {
            $filename = $_FILES['labourContract']['name'];
            $file = $_FILES['labourContract']['tmp_name'];
        }

        $this->employeeService->modifyById($id, $firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId, $file, $filename);
        header('Location: ' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_EMPLOYEE_LIST);
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
        if (isset($_POST['homeAddressId'])) {
            $addressId = $_POST['homeAddressId'];
        }

        $file = null;
        $filename = null;

        if (isset($_FILES['labourContract'])) {
            $filename = $_FILES['labourContract']['name'];
            $file = $_FILES['labourContract']['tmp_name'];
        }

        $this->employeeService->insert($firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId, $file, $filename);
        header('Location: ' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_EMPLOYEE_LIST);
    }

    public function deleteEmployee() {
        $id = $_GET['id'];

        $this->employeeService->delete($id);
        header('Location: ' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_EMPLOYEE_LIST);
    }
}