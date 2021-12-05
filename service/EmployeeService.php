<?php
require_once "repository/EmployeeRepository.php";
require_once "repository/FileRepository.php";

class EmployeeService {
    private $employeeRepository;
    private $fileRepository;

    public function __construct() {
        $this->employeeRepository = new EmployeeRepository();
        $this->fileRepository = new FileRepository();
    }

    function findAll() {
        return $this->employeeRepository->findAll();
    }

    function findById($id) {
        return $this->employeeRepository->findById($id);
    }

    function modifyById($id, $firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId, $file, $filename) {
        echo "File upload begins...";
        $labourContractId = $this->fileRepository->getNextId();

        $destination = "uploads/" . $labourContractId . "_" . $filename;
        if ($file != null && move_uploaded_file($file, $destination)) {
            $this->fileRepository->insert($labourContractId, $filename);
            echo "file upload succeeded";
        }
        echo "after file upload";
        $this->employeeRepository->updateById($id, $firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId, $labourContractId);
    }

    function insert($firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId, $file, $destination) {
        echo "File upload begins...";
        $labourContractId = $this->fileRepository->getNextId();
        if ($file != null && move_uploaded_file($file, $destination . "_" . $labourContractId)) {
            $this->fileRepository->insert($labourContractId, $file);
            echo "file upload succeeded";
        }
        echo "after file upload";
        $this->employeeRepository->insert($firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId, $labourContractId);
    }

    function delete($id) {
        $this->employeeRepository->delete($id);
    }
}