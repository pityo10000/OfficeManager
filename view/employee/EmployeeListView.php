<?php
require_once "view/DefaultView.php";

class EmployeeListView extends DefaultView {

    public function __construct() {
        parent::__construct("Alkalmazott");
    }

    public function show($employees) {
        echo '
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-2">
                <a class="btn btn-default" href="' . UrlConstants::MAIN_URL . '">Vissza</a>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-1">
              <a class="btn btn-primary" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_NEW_EMPLOYEE . '">Új hozzáadása</a>      
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
                      <th scope="col">Vezetéknév</th>
                      <th scope="col">Keresztnév</th>
                      <th scope="col">Munkakör</th>
                      <th scope="col">Műveletek</th>
                    </tr>
                  </thead>
                  <tbody>
            ';

        foreach ($employees as $employee) {
            echo '
                <tr>
                  <td>' . $employee->getId() .'</td>
                  <td>' . $employee->getLastName() .'</td>
                  <td>' . $employee->getFirstName() .'</td>
                  <td>' . $employee->getPost() .'</td>
                  <td>
                    <a class="btn btn-primary" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_EDIT_EMPLOYEE . '&id=' . $employee->getId() . '">Szerkesztés</a>              
                    <a class="btn btn-danger" href="' . UrlConstants::MAIN_URL . '?nav=' . UrlConstants::NAV_DELETE_EMPLOYEE . '&id=' . $employee->getId() . '">Törlés</a>              
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