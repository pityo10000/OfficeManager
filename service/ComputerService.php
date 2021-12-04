<?php
require_once "repository/ComputerRepository.php";

class ComputerService {
    private $computerRepository;

    public function __construct() {
        $this->computerRepository = new ComputerRepository();
    }

    function findAll() {
        return $this->computerRepository->findAll();
    }

    function findById($id) {
        return $this->computerRepository->findById($id);
    }

    function modifyById($id, $brand, $model, $ownerId, $storage, $ram) {
        $this->computerRepository->updateById($id, $brand, $model, $ownerId, $storage, $ram);
    }

    function insert($brand, $model, $ownerId, $storage, $ram) {
        $this->computerRepository->insert($brand, $model, $ownerId, $storage, $ram);
    }

    function delete($id) {
        $this->computerRepository->delete($id);
    }
}