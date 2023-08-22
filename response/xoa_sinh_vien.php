<?php
require_once '../controller/SinhVienController.php';
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
    if ($action === "delete" && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST["id"];
        if (intval($id) > 0) {
            $response = SinhVienController::delete($id);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}
