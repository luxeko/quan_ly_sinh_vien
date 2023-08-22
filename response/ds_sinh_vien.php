<?php
require_once '../controller/SinhVienController.php';
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
    if ($action === "list" && $_SERVER['REQUEST_METHOD'] === 'GET') {
        $keyword = $_GET["keyword"];
        $students = SinhVienController::index($keyword);
        $stt = 0;
        foreach ($students as $sinhVien) {
            $stt++;
            $phpdate = strtotime($sinhVien->get_ngaySinh());
            echo "<tr>";
            echo "<td>$stt</td>";
            echo "<td>" . $sinhVien->get_tenSV() . "</td>";
            echo "<td>" . date("d-m-Y", $phpdate)  . "</td>";
            echo "<td>" . $sinhVien->get_diaChi() . "</td>";
            echo "<td>" . $sinhVien->get_gioiTinh() . "</td>";
            echo "<td>" . $sinhVien->get_lop() . "</td>";
            echo "<td>" . $sinhVien->get_khoa() . "</td>";
            echo "<td>";
            echo "<div class='d-flex align-items-center'>";
            echo "<a href='form.php?id=" . $sinhVien->get_maSV() . "' style='cursor: pointer' class='text-primary fs-5 pe-auto'>
                <i class='bi bi-pencil-fill'></i>
            </a>";
            echo "  <span class='mx-3 fs-5'>|</span>";
            echo "<a href='#'" . "onclick='handleShowModal(" . $sinhVien->get_maSV() . ", " . "\"" . $sinhVien->get_tenSV() . "\"" . ")'" . " style='cursor: pointer' class='text-danger fs-5'>
                <i class='bi bi-trash3'></i>
            </a>";
            echo "</div>";
            echo "</td>";
            echo "</tr>";
        }
    }
}
