<?php
session_start();
require_once('../controller/SinhVienController.php');
require_once('../entity/SinhVien.php');
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
    $tenSV = $_POST['tenSV'];
    $diaChi = $_POST['diaChi'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $lop = $_POST['lop'];
    $khoa = $_POST['khoa'];
    $id = $_POST['id'];
    $sinhVien = new SinhVien();
    $sinhVien->set_tenSV($tenSV);
    $sinhVien->set_diaChi($diaChi);
    $sinhVien->set_ngaySinh($ngaySinh);
    $sinhVien->set_gioiTinh($gioiTinh);
    $sinhVien->set_lop($lop);
    $sinhVien->set_khoa($khoa);

    if ($action === "insert") {
        $response = SinhVienController::create($sinhVien);
    } else {
        $response = SinhVienController::update($sinhVien, $id);
    }
    if ($response['status'] === true) {
        $_SESSION["message"] = $response['message'];
        $_SESSION["title"] = $response['code'] === 201 ? "Thêm mới" : "Cập nhật";
        $_SESSION["status"] = "success";
    } else {
        $_SESSION["message"] = $response['message'];
        $_SESSION["title"] = "Lỗi";
        $_SESSION["status"] = "error";
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
