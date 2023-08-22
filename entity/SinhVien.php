<?php
class SinhVien
{
    private $maSV;
    private $tenSV;
    private $ngaySinh;
    private $diaChi;
    private $gioiTinh;
    private $lop;
    private $khoa;

    public function __construct()
    {
    }

    public function get_maSV()
    {
        return $this->maSV;
    }
    public function set_maSV($maSV)
    {
        $this->maSV = $maSV;
    }
    public function get_tenSV()
    {
        return $this->tenSV;
    }
    public function set_tenSV($tenSV)
    {
        $this->tenSV = $tenSV;
    }
    public function get_ngaySinh()
    {
        return $this->ngaySinh;
    }
    public function set_ngaySinh($ngaySinh)
    {
        $this->ngaySinh = $ngaySinh;
    }
    public function get_diaChi()
    {
        return $this->diaChi;
    }
    public function set_diaChi($diaChi)
    {
        $this->diaChi = $diaChi;
    }
    public function get_gioiTinh()
    {
        return $this->gioiTinh;
    }
    public function set_gioiTinh($gioiTinh)
    {
        $this->gioiTinh = $gioiTinh;
    }
    public function get_lop()
    {
        return $this->lop;
    }
    public function set_lop($lop)
    {
        $this->lop = $lop;
    }
    public function get_khoa()
    {
        return $this->khoa;
    }
    public function set_khoa($khoa)
    {
        $this->khoa = $khoa;
    }
    public function convertRecordToArray($record)
    {
        if ($record !== null || is_array($record) === true) {
            if (isset($record["id"])) {
                $this->maSV = $record["id"];
            }
            if (isset($record["ten_sinh_vien"])) {
                $this->tenSV = $record["ten_sinh_vien"];
            }
            if (isset($record["ngay_sinh"])) {
                $this->ngaySinh = $record["ngay_sinh"];
            }
            if (isset($record["dia_chi"])) {
                $this->diaChi = $record["dia_chi"];
            }
            if (isset($record["gioi_tinh"])) {
                $this->gioiTinh = $record["gioi_tinh"];
            }
            if (isset($record["lop"])) {
                $this->lop = $record["lop"];
            }
            if (isset($record["khoa"])) {
                $this->khoa = $record["khoa"];
            }
        }
    }
}
