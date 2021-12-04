<?php
require_once "repository/AddressRepository.php";

class AddressService {
    private $addressRepository;

    public function __construct() {
        $this->addressRepository = new AddressRepository();
    }

    function findAll() {
        return $this->addressRepository->findAll();
    }

    function findById($id) {
        return $this->addressRepository->findById($id);
    }

    function insert($streetName, $streetType, $streetNumber, $zipCode, $city, $country) {
        $this->addressRepository->insert($streetName, $streetType, $streetNumber, $zipCode, $city, $country);
    }

    function delete($id) {
        $this->addressRepository->delete($id);
    }

}