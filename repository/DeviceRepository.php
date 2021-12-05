<?php


abstract class DeviceRepository extends DefaultRepository {
    public function getNextId() {
        return parent::retrieveNextId("DEVICE");
    }

}