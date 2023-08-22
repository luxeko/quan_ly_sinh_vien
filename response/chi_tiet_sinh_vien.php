<?php
require_once '../controller/SinhVienController.php';
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
    if ($action === "detail" && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $id = $_GET["id"];
        if (intval($id) > 0) {
            $response = SinhVienController::detail($id);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}
