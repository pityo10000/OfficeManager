<?php
require_once "repository/DefaultRepository.php";

class FileRepository extends DefaultRepository {

    function getNextId() {
        return $this->retrieveNextId("FILE");
    }

    function insert($id, $filename) {
        $this->runQuery("INSERT INTO FILE (ID, FILE_NAME) VALUES (" . $id . ",'" . $filename . "')");
    }

    function findById($id) {
        $results = $this->runQuery("SELECT F.ID, F.FILE_NAME FROM FILE F WHERE F.ID = " . $id);

        if ($results->num_rows <= 0) {
            return null;
        }

        $result = $results->fetch_assoc();
        $file = $this->resultToFile($result);
        return $file;
    }

    private function resultToFile($result) {
        $file = new File();
        $file->setId($result["ID"]);
        $file->setFileName($result["FILE_NAME"]);
        return $file;
    }
}