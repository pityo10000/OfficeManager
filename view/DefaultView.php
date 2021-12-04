<?php


abstract class DefaultView {

    public function __construct($title) {
        echo '<!DOCTYPE html>
            <html>
                <head>
                    <title>' . $title . '</title>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
                    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                </head>
            <body>
            ';

            $this->buildMenu();

            echo '
            <center><h2>' . $title . '</h2></center>
            ';

    }

    private function buildMenu() {
        echo '
        <nav class="navbar navbar-light bg-light navbar-expand-md">
          <a class="navbar-brand" href="' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_ROOM_LIST . '">Szobák</a>
          <a class="navbar-brand" href="' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_ADDRESS_LIST . '">Címjegyzék</a>
          <a class="navbar-brand" href="' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_COMPUTER_LIST . '">Számítógépek</a>
          <a class="navbar-brand" href="' . UrlUtil::MAIN_URL . '?nav=' . UrlUtil::NAV_EMPLOYEE_LIST . '">Alkalmazottak</a>
        </nav>
        ';
    }

    public function __destruct() {
        echo "</body>
            </html>";
    }
}