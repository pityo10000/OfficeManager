<?php


class Employee {
    private $id;
    private $firstName;
    private $lastName;
    private $post;
    private $workingRoomId;
    private $supervisorId;
    private $addressId;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getPost() {
        return $this->post;
    }

    public function setPost($post) {
        $this->post = $post;
    }

    public function getWorkingRoomId() {
        return $this->workingRoomId;
    }

    public function setWorkingRoomId($workingRoomId) {
        $this->workingRoomId = $workingRoomId;
    }

    public function getSupervisorId() {
        return $this->supervisorId;
    }

    public function setSupervisorId($supervisorId) {
        $this->supervisorId = $supervisorId;
    }

    public function getAddressId() {
        return $this->addressId;
    }

    public function setAddressId($addressId) {
        $this->addressId = $addressId;
    }
}