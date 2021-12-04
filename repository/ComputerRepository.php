<?php
require_once "model/Computer.php";
require_once "model/Device.php";
require_once "repository/DefaultRepository.php";

class ComputerRepository extends DefaultRepository {
    function findAll() {
        $results = $this->runQuery("
        SELECT D.ID, D.BRAND, D.MODEL, D.OWNER_ID, C.RAM, C.STORAGE
        FROM COMPUTER C
        LEFT JOIN DEVICE D ON D.ID = C.ID        
        ");
        $computers = array();
        while ($result = $results->fetch_assoc()) {
            $computer = $this->resultToComputer($result);
            array_push($computers, $computer);
        }
        return $computers;
    }

    function findById($id) {
        $results = $this->runQuery("
        SELECT D.ID, D.BRAND, D.MODEL, D.OWNER_ID, C.RAM, C.STORAGE
        FROM COMPUTER C
        LEFT JOIN DEVICE D ON D.ID = C.ID        
        WHERE D.ID = " . $id
        );

        if ($results->num_rows <= 0) {
            return null;
        }

        $result = $results->fetch_assoc();
        $computer = $this->resultToComputer($result);
        return $computer;
    }

    private function resultToComputer($result) {
        $computer = new Computer();
        $computer->setId($result["ID"]);
        $computer->setBrand($result["BRAND"]);
        $computer->setModel($result["MODEL"]);
        $computer->setOwnerId($result["OWNER_ID"]);
        $computer->setRam($result["RAM"]);
        $computer->setStorage($result["STORAGE"]);
        return $computer;
    }

    function updateById($id, $brand, $model, $ownerId, $storage, $ram) {
        $this->runQuery("UPDATE DEVICE D SET D.BRAND='" . $brand. "', D.MODEL='" . $model . "', D.OWNER_ID = "
            . $ownerId . " WHERE D.ID = " . $id);
        $this->runQuery("UPDATE COMPUTER C SET C.STORAGE='" . $storage. "', C.RAM='" . $ram . "' WHERE C.ID = "
        . $id);
    }

    function insert($brand, $model, $ownerId, $storage, $ram) {
        $newId = $this->getMaxId("DEVICE");
        if ($newId == null) {
            $newId = 0;
        }
        $newId++;
        $this->runQuery("INSERT INTO DEVICE (ID, BRAND, MODEL, OWNER_ID) VALUE (" . $newId . ",
        '" . $brand . "', '" . $model . "', " . $ownerId . ")");
        $this->runQuery("INSERT INTO COMPUTER (ID, STORAGE, RAM) VALUE (" . $newId . ",
        '" . $storage . "', '" . $ram . "')");
    }

    function delete($id) {
        $this->runQuery('DELETE FROM DEVICE WHERE ID = ' . $id);
        $this->runQuery('DELETE FROM COMPUTER WHERE ID = ' . $id);
    }
}