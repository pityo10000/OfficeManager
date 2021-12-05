<?php
require_once "view/DefaultView.php";

class AddressListView extends DefaultView {

    public function __construct() {
        parent::__construct("Címjegyzék");
    }

    public function show($addresses) {
        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <a class="btn btn-default" href="' . UrlConstants::MAIN_URL . '">Vissza</a>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-1">
              <a class="btn btn-primary" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_NEW_ADDRESS . '">Új hozzáadása</a>      
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
            <div class="card">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Azonosító</th>
                      <th scope="col">Irányítószám</th>
                      <th scope="col">Ország</th>
                      <th scope="col">Város</th>
                      <th scope="col">Utca neve</th>
                      <th scope="col">Utca típusa</th>
                      <th scope="col">Házszám</th>
                      <th scope="col">Műveletek</th>
                    </tr>
                  </thead>
                  <tbody>
            ';

        foreach ($addresses as $address) {
            echo '
                <tr>
                  <td>' . $address->getId() .'</td>
                  <td>' . $address->getZipCode() .'</td>
                  <td>' . $address->getCountry() .'</td>
                  <td>' . $address->getCity() .'</td>
                  <td>' . $address->getStreetName() .'</td>
                  <td>' . $address->getStreetType() .'</td>
                  <td>' . $address->getStreetNumber() .'</td>
                  <td>
                    <a class="btn btn-danger" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_DELETE_ADDRESS . '&id=' . $address->getId() . '">Törlés</a>              
                  </td>
                </tr>
            ';
        }

        echo '
                    </div>
                    <div class="col-md-2"></div>
                </div>
                </tbody>
            </table>
        </div>
        ';
    }
}