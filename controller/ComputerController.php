<?php
require_once "service/ComputerService.php";
require_once "service/EmployeeService.php";
require_once "view/computer/ComputerListView.php";
require_once "view/computer/ComputerFormView.php";

class ComputerController {
    private $computerService;
    private $employeeService;

    public function __construct() {
        $this->computerService = new ComputerService();
        $this->employeeService = new EmployeeService();
    }

    public function showList() {
        $computers = $this->computerService->findAll();
        $view = new ComputerListView();
        $view->show($computers);
    }

    public function showEditForm() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $employees = $this->employeeService->findAll();
            $computer = $this->computerService->findById($id);
            $view = new ComputerFormView(false);
            $view->showEdit($computer, $employees);
        } else {
            echo "Nem található ilyen ID-val számítógép";
        }
    }

    public function showNewForm() {
        $employees = $this->employeeService->findAll();
        $view = new ComputerFormView(true);
        $view->showNew($employees);
    }

    public function modifyComputer() {
        $id = $_POST['id'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $storage = $_POST['storage'];
        $ram = $_POST['ram'];
        $ownerId = "null";
        if (isset($_POST['ownerId'])) {
            $ownerId = $_POST['ownerId'];
        }

        $this->computerService->modifyById($id, $brand, $model, $ownerId, $storage, $ram);
        header('Location: ' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_COMPUTER_LIST);
    }

    public function createComputer() {
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $storage = $_POST['storage'];
        $ram = $_POST['ram'];
        $ownerId = "null";
        if (isset($_POST['ownerId'])) {
            $ownerId = $_POST['ownerId'];
        }

        $this->computerService->insert($brand, $model, $ownerId, $storage, $ram);
        header('Location: ' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_COMPUTER_LIST);
    }

    public function deleteComputer() {
        $id = $_GET['id'];

        $this->computerService->delete($id);
        header('Location: ' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_COMPUTER_LIST);
    }
}