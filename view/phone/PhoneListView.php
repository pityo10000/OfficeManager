<?php
require_once "view/DefaultView.php";

class PhoneListView extends DefaultView {

    public function __construct() {
        parent::__construct("Telefonok");
    }

    public function show($phones) {
        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <a class="btn btn-default" href="' . UrlConstants::MAIN_URL . '">Vissza</a>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-1">
              <a class="btn btn-primary" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_NEW_PHONE . '">Új hozzáadása</a>      
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
                      <th scope="col">Márka</th>
                      <th scope="col">Modell</th>
                      <th scope="col">Telefonszám</th>
                      <th scope="col">Tulajdonos</th>
                      <th scope="col">Műveletek</th>
                    </tr>
                  </thead>
                  <tbody>
            ';

        foreach ($phones as $phone) {
            echo '
                <tr>
                  <td>' . $phone->getId() .'</td>
                  <td>' . $phone->getBrand() .'</td>
                  <td>' . $phone->getModel() .'</td>
                  <td>' . $phone->getPhoneNumber() .'</td>
                  <td>#' . $phone->getOwnerId() .'</td>
                  <td>
                    <a class="btn btn-primary" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_EDIT_PHONE . '&id=' . $phone->getId() . '">Szerkesztés</a>              
                    <a class="btn btn-danger" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_DELETE_PHONE . '&id=' . $phone->getId() . '">Törlés</a>              
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