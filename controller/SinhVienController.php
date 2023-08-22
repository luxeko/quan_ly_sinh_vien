<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__ . '/config/connect.php');
require_once(__ROOT__ . '/entity/SinhVien.php');

class SinhVienController
{
    public static function index()
    {
        $students = [];
        $connection = Connection::getConnection();
        $sql = "SELECT * from sinh_vien";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sinhVien = new SinhVien();
                $sinhVien->convertRecordToArray($row);
                $students[] = $sinhVien;
            }
        }
        Connection::closeConnection($connection);

        return $students;
    }

    public static function create($sinhVien)
    {
        $response = [];
        if ($sinhVien instanceof SinhVien === false || $sinhVien === null) {
            $response = ['code' => 400, 'message' => 'Dữ liệu đầu vào không hợp lệ', 'status' => false];
        }
        $tenSV = $sinhVien->get_tenSV();
        $ngaySinh = $sinhVien->get_ngaySinh();
        $diaChi = $sinhVien->get_diaChi();
        $gioiTinh = $sinhVien->get_gioiTinh();
        $lop = $sinhVien->get_lop();
        $khoa = $sinhVien->get_khoa();
        $connection = Connection::getConnection();
        $sql = "INSERT INTO sinh_vien(ten_sinh_vien, ngay_sinh, dia_chi, gioi_tinh, lop, khoa) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = $connection->prepare($sql);
        $statement->bind_param('ssssss', $tenSV, $ngaySinh, $diaChi, $gioiTinh, $lop, $khoa);
        if ($statement->execute()) {
            $response = ['code' => 201, 'message' => 'Thêm sinh viên thành công', 'status' => true];
        } else {
            $response = ['code' => 500, 'message' => 'Lỗi khi thêm sinh viên: ' . $statement->error, 'status' => false];
        }
        $statement->close();
        Connection::closeConnection($connection);
        return $response;
    }
    public static function update($sinhVien, $id)
    {
        $response = [];
        if ($sinhVien instanceof SinhVien === false || $sinhVien === null || intval($id) === 0) {
            $response = ['code' => 400, 'message' => 'Dữ liệu đầu vào không hợp lệ', 'status' => false];
        }
    }
    public static function detail($id)
    {
        $response = [];
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM sinh_vien WHERE id = ?";
        $statement = $connection->prepare($sql);
        $statement->bind_param('i', $id);

        if ($statement->execute()) {
            $result = $statement->get_result();
            $row = $result->fetch_assoc();
            $response = ['code' => 200, 'message' => 'Lấy thông tin sinh viên thành công', 'status' => true, 'data' => $row];
        } else {
            $response = ['code' => 404, 'message' => 'Không tìm thấy sinh viên: ' . $statement->error, 'status' => false];
        }
        $statement->close();
        Connection::closeConnection($connection);
        return $response;
    }
    public static function delete($id)
    {
        $response = [];
        $connection = Connection::getConnection();
        $sql = "DELETE FROM sinh_vien WHERE id=?";
        $statement = $connection->prepare($sql);
        // "i": Integer
        // "d": Double (floating-point number)
        // "s": String
        // "b": Blob (binary data)
        $statement->bind_param('i', $id);

        if ($statement->execute()) {
            $response = ['code' => 200, 'message' => 'Xóa sinh viên thành công', 'status' => true];
        } else {
            $response = ['code' => 404, 'message' => 'Không tìm thấy sinh viên: ' . $statement->error, 'status' => false];
        }
        $statement->close();
        Connection::closeConnection($connection);
        return $response;
    }
}
