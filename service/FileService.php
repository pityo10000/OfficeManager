<?php
require_once 'repository/FileRepository.php';


class FileService {
    private $fileRepository;

    public function __construct() {
        $this->fileRepository = new FileRepository();
    }

    public function downloadFile($id) {
        $file = $this->fileRepository->findById($id);
        $filepath = 'uploads/' . $id . "_" . $file->getFileName();
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            ob_clean();
            flush();
            readfile($filepath);
        }
    }

}