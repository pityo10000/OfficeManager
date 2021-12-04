<?php


class HomeView extends DefaultView {

    public function __construct() {
        parent::__construct("Office Manager");
    }

    public function show() {
        echo '
            <center>
            <br/>
                <h1>Üdvözöljük!</h1>                        
            </br>
        ';
    }
}