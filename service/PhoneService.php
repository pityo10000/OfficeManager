<?php
require_once "repository/DeviceRepository.php";

class PhoneService {
    private $phoneRepository;

    public function __construct() {
        $this->phoneRepository = new PhoneRepository();
    }

    function findAll() {
        return $this->phoneRepository->findAll();
    }

    function findById($id) {
        return $this->phoneRepository->findById($id);
    }

    function modifyById($id, $brand, $model, $ownerId, $phoneNumber) {
        $this->phoneRepository->updateById($id, $brand, $model, $ownerId, $phoneNumber);
    }

    function insert($brand, $model, $ownerId, $phoneNumber) {
        $this->phoneRepository->insert($brand, $model, $ownerId, $phoneNumber);
    }

    function delete($id) {
        $this->phoneRepository->delete($id);
    }
}