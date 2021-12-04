<?php
require_once "model/Address.php";
require_once "repository/DefaultRepository.php";

class AddressRepository extends DefaultRepository {

    function findAll() {
        $results = $this->runQuery("SELECT A.ID, A.STREET_NAME, A.STREET_TYPE, A.STREET_NUMBER, A.ZIP_CODE, A.CITY, A.COUNTRY FROM ADDRESS A");
        $addresses = array();
        while ($result = $results->fetch_assoc()) {
            $address = $this->resultToAddress($result);
            array_push($addresses, $address);
        }
        return $addresses;
    }

    function findById($id) {
        $results = $this->runQuery("SELECT A.ID, A.STREET_NAME, A.STREET_TYPE, A.STREET_NUMBER, A.ZIP_CODE, A.CITY, A.COUNTRY FROM ADDRESS A WHERE A.ID = " . $id);

        if ($results->num_rows <= 0) {
            return null;
        }

        $result = $results->fetch_assoc();
        $address = $this->resultToAddress($result);
        return $address;
    }

    private function resultToAddress($result) {
        $address = new Address();
        $address->setId($result["ID"]);
        $address->setStreetName($result["STREET_NAME"]);
        $address->setStreetType($result["STREET_TYPE"]);
        $address->setStreetNumber($result["STREET_NUMBER"]);
        $address->setZipCode($result["ZIP_CODE"]);
        $address->setCity($result["CITY"]);
        $address->setCountry($result["COUNTRY"]);
        return $address;
    }

    function insert($streetName, $streetType, $streetNumber, $zipCode, $city, $country) {
        $this->runQuery('INSERT INTO ADDRESS (STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE
            (' . $streetName . ', ' . $streetType . ', ' . $streetNumber . ', ' . $zipCode . ', ' . $city . ', ' . $country . ')');
    }

    function delete($id) {
        $this->runQuery('DELETE FROM ADDRESS WHERE ID = ' . $id);
    }

}