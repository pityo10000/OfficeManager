<?php
require_once 'view/DefaultView.php';
require_once 'model/Address.php';


class AddressFormView extends DefaultView {

    public function __construct() {
        parent::__construct("Új cím");
    }

    public function showNew() {
        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">';

                    echo '
                    <form method="POST" action="' . UrlConstants::MAIN_URL . '">
                        <input type="hidden" name="operation" value="' . UrlConstants::OPERATION_CREATE_ADDRESS . '"/>
                        <div class="row form-group">
                        <label for="zipCode">Irányítószám</label>
                        <input type="text" class="form-control" id="zipCode" name="zipCode" required>
                      </div>
                      <div class="row form-group">
                        <label for="country">Ország</label>
                        <input type="text" class="form-control" id="country" name="country" required>
                      </div>
                      <div class="row form-group">
                        <label for="doorNumber">Város</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                      </div>
                      <div class="row form-group">
                        <label for="streetName">Utca neve</label>
                        <input type="text" class="form-control" id="streetName" name="streetName" required>
                      </div>
                      <div class="row form-group">
                        <label for="streetType">Utca típusa</label>
                        <input type="text" class="form-control" id="streetType" name="streetType" required>
                      </div>
                      <div class="row form-group">
                        <label for="streetNumber">Házszám</label>
                        <input type="text" class="form-control" id="streetNumber" name="streetNumber" required>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-primary">Mentés</button>
                        </div>
                        <div class="col-md-9"></div>
                        <div class="col-md-1">
                            <a class="btn btn-default" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_ADDRESS_LIST . '">Vissza</a>
                        </div>
                      </div>
                </form>
            </div>
            <div class="col-md-2"></div>
        
        </div>
        ';
    }
}