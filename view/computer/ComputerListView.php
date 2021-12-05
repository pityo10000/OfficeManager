<?php
require_once "view/DefaultView.php";

class ComputerListView extends DefaultView {

    public function __construct() {
        parent::__construct("Számítógépek");
    }

    public function show($computers) {
        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <a class="btn btn-default" href="' . UrlConstants::MAIN_URL . '">Vissza</a>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-1">
              <a class="btn btn-primary" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_NEW_COMPUTER . '">Új hozzáadása</a>      
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
                      <th scope="col">Tárhely</th>
                      <th scope="col">RAM</th>
                      <th scope="col">Tulajdonos</th>
                      <th scope="col">Műveletek</th>
                    </tr>
                  </thead>
                  <tbody>
            ';

        foreach ($computers as $computer) {
            echo '
                <tr>
                  <td>' . $computer->getId() .'</td>
                  <td>' . $computer->getBrand() .'</td>
                  <td>' . $computer->getModel() .'</td>
                  <td>' . $computer->getStorage() .'</td>
                  <td>' . $computer->getRam() .'</td>
                  <td>#' . $computer->getOwnerId() .'</td>
                  <td>
                    <a class="btn btn-primary" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_EDIT_COMPUTER . '&id=' . $computer->getId() . '">Szerkesztés</a>              
                    <a class="btn btn-danger" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_DELETE_COMPUTER . '&id=' . $computer->getId() . '">Törlés</a>              
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