<?php
require_once "service/FileService.php";

class FileController {
    private $fileService;

    function __construct() {
        $this->fileService = new FileService();
    }

    public function downloadFile() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->fileService->downloadFile($id);
        }
    }
}