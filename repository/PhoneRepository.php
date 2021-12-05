<?php
require_once "model/Phone.php";
require_once "model/Device.php";
require_once "repository/DefaultRepository.php";

class PhoneRepository extends DeviceRepository {
    function findAll() {
        $results = $this->runQuery("
        SELECT D.ID, D.BRAND, D.MODEL, D.OWNER_ID, P.PHONE_NUMBER
        FROM PHONE P
        LEFT JOIN DEVICE D ON D.ID = P.ID        
        ");
        $phones = array();
        while ($result = $results->fetch_assoc()) {
            $phone = $this->resultToPhone($result);
            array_push($phones, $phone);
        }
        return $phones;
    }

    function findById($id) {
        $results = $this->runQuery("
        SELECT D.ID, D.BRAND, D.MODEL, D.OWNER_ID, P.PHONE_NUMBER
        FROM PHONE P
        LEFT JOIN DEVICE D ON D.ID = P.ID        
        WHERE D.ID = " . $id
        );

        if ($results->num_rows <= 0) {
            return null;
        }

        $result = $results->fetch_assoc();
        $phone = $this->resultToPhone($result);
        return $phone;
    }

    private function resultToPhone($result) {
        $phone = new Phone();
        $phone->setId($result["ID"]);
        $phone->setBrand($result["BRAND"]);
        $phone->setModel($result["MODEL"]);
        $phone->setOwnerId($result["OWNER_ID"]);
        $phone->setPhoneNumber($result["PHONE_NUMBER"]);
        return $phone;
    }

    function updateById($id, $brand, $model, $ownerId, $phoneNumber) {
        $this->runQuery("UPDATE DEVICE D SET D.BRAND='" . $brand. "', D.MODEL='" . $model . "', D.OWNER_ID = "
            . $ownerId . " WHERE D.ID = " . $id);
        $this->runQuery("UPDATE PHONE P SET P.PHONE_NUMBER='" . $phoneNumber. "' WHERE P.ID = "
        . $id);
    }

    function insert($brand, $model, $ownerId, $phoneNumber) {
        $newId = $this->getNextId();
        if ($newId == null) {
            $newId = 1;
        }
        $this->runQuery("INSERT INTO DEVICE (ID, BRAND, MODEL, OWNER_ID) VALUE (" . $newId . ",
        '" . $brand . "', '" . $model . "', " . $ownerId . ")");
        $this->runQuery("INSERT INTO PHONE (ID, PHONE_NUMBER) VALUE (" . $newId . ", '" . $phoneNumber . "')");
    }

    function delete($id) {
        $this->runQuery('DELETE FROM DEVICE WHERE ID = ' . $id);
        $this->runQuery('DELETE FROM PHONE WHERE ID = ' . $id);
    }
}