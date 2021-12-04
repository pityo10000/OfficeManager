<?php
require_once "model/Employee.php";
require_once "repository/DefaultRepository.php";

class EmployeeRepository extends DefaultRepository {

    function findAll() {
        $results = $this->runQuery("SELECT E.ID, E.FIRST_NAME, E.LAST_NAME, E.POST, E.WORKING_ROOM_ID, 
        E.SUPERVISOR_ID, E.ADDRESS_ID FROM EMPLOYEE E");
        $employees = array();
        while ($result = $results->fetch_assoc()) {
            $employee = $this->resultToEmployee($result);
            array_push($employees, $employee);
        }
        return $employees;
    }

    function findById($id) {
        $results = $this->runQuery("SELECT E.ID, E.FIRST_NAME, E.LAST_NAME, E.POST, E.WORKING_ROOM_ID, 
        E.SUPERVISOR_ID, E.ADDRESS_ID FROM EMPLOYEE E WHERE E.ID = " . $id);

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
        return $employee;
    }

    function updateById($id, $firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId) {
        $this->runQuery("UPDATE EMPLOYEE E SET E.FIRST_NAME = '" . $firstName . "', E.LAST_NAME = '" . $lastName . "', E.POST = '"
            . $post . "', E.WORKING_ROOM_ID = " . $workingRoomId . ", E.SUPERVISOR_ID = " . $supervisorId . ",
            E.ADDRESS_ID = " . $addressId . " WHERE E.ID = " . $id);
    }

    function insert($firstName, $lastName, $post, $workingRoomId, $supervisorId, $addressId) {
        $this->runQuery("INSERT INTO EMPLOYEE (FIRST_NAME, LAST_NAME, POST, WORKING_ROOM_ID, SUPERVISOR_ID, ADDRESS_ID) VALUE ('"
            . $firstName . "', '" . $lastName . "', '" . $post . "', " . $workingRoomId . ", "
            . $supervisorId . ", " . $addressId . ")");
    }

    function delete($id) {
        $this->runQuery('DELETE FROM EMPLOYEE WHERE ID = ' . $id);
    }

}