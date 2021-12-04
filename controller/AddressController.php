<?php
require_once "service/AddressService.php";
require_once "view/address/AddressListView.php";
require_once "view/address/AddressFormView.php";

class AddressController {
    private $addressService;

    public function __construct() {
        $this->addressService = new AddressService();
    }

    public function showList() {
        $addresses = $this->addressService->findAll();
        $view = new AddressListView();
        $view->show($addresses);
    }

    public function showNewForm() {
        $view = new AddressFormView();
        $view->showNew();
    }

    public function createAddress() {
        $streetName = $_POST['streetName'];
        $streetType = $_POST['streetType'];
        $streetNumber = $_POST['streetNumber'];
        $zipCode = $_POST['zipCode'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        $this->addressService->insert($streetName, $streetType, $streetNumber, $zipCode, $city, $country);
//        header('Location: ' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_ADDRESS_LIST);
    }

    public function deleteAddress() {
        $id = $_GET['id'];

        $this->addressService->delete($id);
        header('Location: ' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_ADDRESS_LIST);
    }
}