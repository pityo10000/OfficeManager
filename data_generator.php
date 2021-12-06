<?php

generateRoom();
echo "</br>";
generateAddress();
echo "</br>";
generateEmployee();
echo "</br>";
generateComputer();
echo "</br>";
generatePhone();
echo "</br>";


function generateRoom() {
    $id = 1;

    for ($floor = 0; $floor < 3; $floor++) {
        for ($j = 1; $j < 10; $j++) {
            $doorNumber = $j;
            echo "INSERT INTO ROOM (ID, DOOR_NUMBER, CAPACITY, FLOOR) VALUE (" . $id++ . ", '" . $doorNumber . "', '" . rand(1,10) . "', '" . $floor . "');";
            echo "</br>";
        }
    }
}

function generateComputer() {
        for ($id = 1; $id < 30; $id++) {
            echo "INSERT INTO DEVICE (ID, BRAND, MODEL) VALUE (" . $id . ", 'DELL', 'D" . rand(1,100) . "');";
            echo "</br>";
            echo "INSERT INTO COMPUTER (ID, STORAGE, RAM) VALUE (" . $id . ", '256GB SSD', '8GB');";
            echo "</br>";
        }
}

function generatePhone() {
        $phoneNumberPostfix = 1111;
        for ($id = 30; $id < 60; $id++) {
            echo "INSERT INTO DEVICE (ID, BRAND, MODEL) VALUE (" . $id . ", 'DELL', 'D" . rand(1,100) . "');";
            echo "</br>";
            echo "INSERT INTO PHONE (ID, PHONE_NUMBER) VALUE (" . $id . ", '+36-1-460-" . $phoneNumberPostfix++ . "');";
            echo "</br>";
        }
}

function generateAddress() {
    echo "INSERT INTO ADDRESS (ID, STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE (1, 'Bánat', 'utca', '1', '1111', 'Budapest', 'Magyarország');";
    echo "</br>";
    echo "INSERT INTO ADDRESS (ID, STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE (2, 'Varga', 'tér', '1', '1231', 'Budapest', 'Magyarország');";
    echo "</br>";
    echo "INSERT INTO ADDRESS (ID, STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE (3, 'Károlyi', 'sétány', '1', '1125', 'Budapest', 'Magyarország');";
    echo "</br>";
    echo "INSERT INTO ADDRESS (ID, STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE (4, 'Bartók', 'út', '1', '1116', 'Budapest', 'Magyarország');";
    echo "</br>";
    echo "INSERT INTO ADDRESS (ID, STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE (5, 'Tóth', 'utca', '1', '1141', 'Budapest', 'Magyarország');";
    echo "</br>";
    echo "INSERT INTO ADDRESS (ID, STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE (6, 'Üllői', 'út', '1', '1151', 'Budapest', 'Magyarország');";
    echo "</br>";
    echo "INSERT INTO ADDRESS (ID, STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE (7, 'Szegedi', 'utca', '1', '1117', 'Budapest', 'Magyarország');";
    echo "</br>";
    echo "INSERT INTO ADDRESS (ID, STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE (8, 'Béla', 'körút', '1', '1118', 'Budapest', 'Magyarország');";
    echo "</br>";
    echo "INSERT INTO ADDRESS (ID, STREET_NAME, STREET_TYPE, STREET_NUMBER, ZIP_CODE, CITY, COUNTRY) VALUE (9, 'János', 'út', '1', '1201', 'Budapest', 'Magyarország');";
    echo "</br>";
}

function generateEmployee() {
    $lastNames = ['Nagy', 'Kovács', 'Tóth', 'Szabó', 'Horváth', 'Varga', 'Kiss', 'Molnár', 'Németh', 'Farkas', 'Balogh',
        'Papp', 'Lakatos', 'Takács', 'Juhász', 'Mészáros', 'Oláh', 'Simon', 'Rácz', 'Fekete', 'Szilágyi', 'Török', 'Fehér',
        'Balázs', 'Gál', 'Kis', 'Szűcs', 'Kocsis', 'Orsós', 'Pintér'];
    $firstNames = ["Dávid", "Dániel", "Bence", "Máté", "Tamás", "Péter", "Balázs", "Ádám", "Márk", "László", "Zoltán",
        "Viktória", "Vivien", "Anna", "Alexandra", "Fanni", "Dóra", "Réka", "Petra", "Eszter"];
    $posts = ["Könyvelő", "Értékesítő", "Biztonsági őr", "Büfés", "Takarító"];
    $roomId = rand(1,27);

    for ($id = 1; $id < 50; $id++) {
        echo "INSERT INTO EMPLOYEE (ID, FIRST_NAME, LAST_NAME, POST, WORKING_ROOM_ID, ADDRESS_ID) VALUE (" . $id . ", '"
            . $firstNames[array_rand($firstNames)] . "', '" . $lastNames[array_rand($lastNames)] . "', '" . $posts[array_rand($posts)] . "', "
            . rand(1,27) . ", " . rand(1, 9) . ");";
        echo "</br>";
    }

}
