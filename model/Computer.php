<?php
require_once 'model/Device.php';


class Computer extends Device {
    private $storage;
    private $ram;

    public function getStorage() {
        return $this->storage;
    }

    public function setStorage($storage) {
        $this->storage = $storage;
    }

    public function getRam() {
        return $this->ram;
    }

    public function setRam($ram) {
        $this->ram = $ram;
    }


}