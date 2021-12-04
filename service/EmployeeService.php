<?php
require_once "repository/EmployeeRepository.php";

class EmployeeService {
    private $employeeRepository;

    public function __construct() {
        $this->employeeRepository = new EmployeeRepository();
    }

    function findAll() {
        return $this->employeeRepository->findAll();
    }

    function findById($id) {
        return $this->employeeRepository->findById($id);
    }

    function modifyById($id, $firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId) {
        $this->employeeRepository->updateById($id, $firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId);
    }

    function insert($firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId) {
        $this->employeeRepository->insert($firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId);
    }

    function delete($id) {
        $this->employeeRepository->delete($id);
    }
}