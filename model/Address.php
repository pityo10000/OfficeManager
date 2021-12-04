<?php


class Address {
    private $id;
    private $streetNumber;
    private $zipCode;
    private $city;
    private $country;
    private $streetName;
    private $streetType;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getStreetNumber() {
        return $this->streetNumber;
    }

    public function setStreetNumber($streetNumber) {
        $this->streetNumber = $streetNumber;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getStreetName() {
        return $this->streetName;
    }

    public function setStreetName($streetName) {
        $this->streetName = $streetName;
    }

    public function getStreetType() {
        return $this->streetType;
    }

    public function setStreetType($streetType) {
        $this->streetType = $streetType;
    }



}