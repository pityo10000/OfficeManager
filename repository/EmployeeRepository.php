<?php
require_once "model/Employee.php";
require_once "model/File.php";
require_once "repository/DefaultRepository.php";

class EmployeeRepository extends DefaultRepository {

    function findAll() {
        $results = $this->runQuery("SELECT E.ID, E.FIRST_NAME, E.LAST_NAME, E.POST, E.WORKING_ROOM_ID, 
        E.SUPERVISOR_ID, E.ADDRESS_ID, F.ID AS FILE_ID, F.FILE_NAME
        FROM EMPLOYEE E
        LEFT JOIN FILE F ON E.LABOUR_CONTRACT_ID = F.ID");
        $employees = array();
        while ($result = $results->fetch_assoc()) {
            $employee = $this->resultToEmployee($result);
            array_push($employees, $employee);
        }
        return $employees;
    }

    function findById($id) {
        $results = $this->runQuery("SELECT E.ID, E.FIRST_NAME, E.LAST_NAME, E.POST, E.WORKING_ROOM_ID, 
        E.SUPERVISOR_ID, E.ADDRESS_ID, F.ID AS FILE_ID, F.FILE_NAME
        FROM EMPLOYEE E
        LEFT JOIN FILE F ON E.LABOUR_CONTRACT_ID = F.ID
        WHERE E.ID = " . $id);

        if ($results->num_rows <= 0) {
            return null;
        }

        $result = $results->fetch_assoc();
        $employee = $this->resultToEmployee($result);
        return $employee;
    }

    private function resultToEmployee($result) {
        $employee = new Employee();
        $employee->setId($result["ID"]);
        $employee->setFirstName($result["FIRST_NAME"]);
        $employee->setLastName($result["LAST_NAME"]);
        $employee->setPost($result["POST"]);
        $employee->setWorkingRoomId($result["WORKING_ROOM_ID"]);
        $employee->setSupervisorId($result["SUPERVISOR_ID"]);
        $employee->setHomeAddressId($result["ADDRESS_ID"]);

        $labourContract = new File();
        $labourContract->setId($result["FILE_ID"]);
        $labourContract->setFileName($result["FILE_NAME"]);

        $employee->setLabourContract($labourContract);
        return $employee;
    }

    function updateById($id, $firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId, $labourContractId) {
        $this->runQuery("UPDATE EMPLOYEE E SET E.FIRST_NAME = '" . $firstName . "', E.LAST_NAME = '" . $lastName . "', E.POST = '"
            . $post . "', E.WORKING_ROOM_ID = " . $workingRoomId . ", E.SUPERVISOR_ID = " . $supervisorId . ",
            E.ADDRESS_ID = " . $addressId . ", E.LABOUR_CONTRACT_ID = " . $labourContractId . " WHERE E.ID = " . $id);
    }

    function insert($firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId, $labourContractId) {
        $this->runQuery("INSERT INTO EMPLOYEE (FIRST_NAME, LAST_NAME, POST, WORKING_ROOM_ID, SUPERVISOR_ID, ADDRESS_ID, LABOUR_CONTRACT_ID) VALUE ('"
            . $firstName . "', '" . $lastName . "', '" . $post . "', " . $workingRoomId . ", "
            . $supervisorId . ", " . $addressId . ", " . $labourContractId . ")");
    }

    function delete($id) {
        $this->runQuery('DELETE FROM EMPLOYEE WHERE ID = ' . $id);
    }

}