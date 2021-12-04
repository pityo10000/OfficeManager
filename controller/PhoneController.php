<?php
require_once "service/PhoneService.php";
require_once "service/EmployeeService.php";
require_once "view/phone/PhoneListView.php";
require_once "view/phone/PhoneFormView.php";

class PhoneController {
    private $phoneService;
    private $employeeService;

    public function __construct() {
        $this->phoneService = new PhoneService();
        $this->employeeService = new EmployeeService();
    }

    public function showList() {
        $phones = $this->phoneService->findAll();
        $view = new PhoneListView();
        $view->show($phones);
    }

    public function showEditForm() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $employees = $this->employeeService->findAll();
            $phone = $this->phoneService->findById($id);
            $view = new PhoneFormView(false);
            $view->showEdit($phone, $employees);
        } else {
            echo "Nem található ilyen ID-val telefon";
        }
    }

    public function showNewForm() {
        $employees = $this->employeeService->findAll();
        $view = new PhoneFormView(true);
        $view->showNew($employees);
    }

    public function modifyPhone() {
        $id = $_POST['id'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $phoneNumber = $_POST['phoneNumber'];
        $ownerId = "null";
        if (isset($_POST['ownerId'])) {
            $ownerId = $_POST['ownerId'];
        }

        $this->phoneService->modifyById($id, $brand, $model, $ownerId, $phoneNumber);
        header('Location: ' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_PHONE_LIST);
    }

    public function createPhone() {
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $phoneNumber = $_POST['phoneNumber'];
        $ownerId = "null";
        if (isset($_POST['ownerId'])) {
            $ownerId = $_POST['ownerId'];
        }

        $this->phoneService->insert($brand, $model, $ownerId, $phoneNumber);
        header('Location: ' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_PHONE_LIST);
    }

    public function deletePhone() {
        $id = $_GET['id'];

        $this->phoneService->delete($id);
        header('Location: ' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_PHONE_LIST);
    }
}