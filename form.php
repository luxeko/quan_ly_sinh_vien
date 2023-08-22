<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="icon" href="https://eprojectsem4.blob.core.windows.net/plant-nest/plant-nest.png" type="image/x-icon">
</head>
</head>

<body>
    <?php
    session_start();
    require_once("./controller/SinhVienController.php");
    require_once("./entity/SinhVien.php");
    $errors = [];
    $id = 0;
    if (isset($_REQUEST["id"])) {
        $id = $_REQUEST["id"];
    }
    if (isset($_POST['btn-submit'])) {
        if (empty($_POST['tenSV'])) {
            $errors['tenSV'] = 'Tên sinh viên không được để trống';
        } else {
            $tenSV = htmlspecialchars(trim($_POST['tenSV']));
        }
        if (empty($_POST['ngaySinh'])) {
            $errors['ngaySinh'] = 'Ngày sinh không được để trống';
        } else {
            $ngaySinh = htmlspecialchars(trim($_POST['ngaySinh']));
        }
        if (empty($_POST['diaChi'])) {
            $errors['diaChi'] = 'Địa chỉ không được để trống';
        } else {
            $diaChi = htmlspecialchars(trim($_POST['diaChi']));
        }
        if (isset($_POST['gioiTinh'])) {
            $gioiTinh = $_POST['gioiTinh'];
        } else {
            $errors['gioiTinh'] = 'Vui lòng chọn giới tính';
        }
        if (empty($_POST['lop'])) {
            $errors['lop'] = 'Lớp không được để trống';
        } else {
            $lop = htmlspecialchars(trim($_POST['lop']));
        }
        if (empty($_POST['khoa'])) {
            $errors['khoa'] = 'Khoa không được để trống';
        } else {
            $khoa = htmlspecialchars(trim($_POST['khoa']));
        }
        if (count($errors) === 0) {
            $sinhVien = new SinhVien();
            $sinhVien->set_tenSV($tenSV);
            $sinhVien->set_diaChi($diaChi);
            $sinhVien->set_ngaySinh($ngaySinh);
            $sinhVien->set_gioiTinh($gioiTinh);
            $sinhVien->set_lop($lop);
            $sinhVien->set_khoa($khoa);
        }
    }
    ?>
    <section class="container-sm mt-4 px-5">
        <a href="index.php" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Quản lý sinh viên</a>
    </section>
    <section class="container-sm mt-5 px-5">
        <h1 class="mb-4 text-center">
            <?php
            if ($id !== 0) {
                echo "Cập nhật thông tin sinh viên";
            } else {
                echo "Thêm mới sinh viên";
            }
            ?>
        </h1>
        <form id="form-post" method="POST">
            <input id="studentId" name="studentId" hidden value="<?php echo $id ?>" />
            <div class="mb-3">
                <label for="tenSV" class="form-label fw-medium">Tên sinh viên</label>
                <input type="text" class="form-control" id="tenSV" name="tenSV">
            </div>
            <div class="mb-3">
                <label for="ngaySinh" class="form-label fw-medium">Ngày sinh</label>
                <input type="date" class="form-control" id="ngaySinh" name="ngaySinh">
            </div>
            <div class="mb-3">
                <label for="diaChi" class="form-label fw-medium ">Địa chỉ</label>
                <input type="text" class="form-control" id="diaChi" name="diaChi">
            </div>
            <div class="mb-3 d-flex align-items-center">
                <span class="me-4 fw-medium">Giới tính</span>
                <div class="d-flex align-items-center">
                    <div class="form-check d-flex align-items-center me-4">
                        <input type="radio" class="form-check-input me-2" id="nam" name="gioiTinh" value="Nam">
                        <label for="nam" class="form-check-label">Nam</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input type="radio" class="form-check-input me-2" id="nu" name="gioiTinh" value="Nữ">
                        <label for="nu" class="form-check-label">Nữ</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="lop" class="form-label fw-medium">Lớp</label>
                <input type="text" class="form-control" id="lop" name="lop">
            </div>
            <div class="mb-3">
                <label for="khoa" class="form-label fw-medium">Khoa</label>
                <select class="form-control" id="khoa" name="khoa">
                    <option value="CNTT">CNTT</option>
                    <option value="QTKD">QTKD</option>
                    <option value="Marketing">Marketing</option>
                </select>
            </div>
            <button type='submit' class='btn btn-primary' name='btn-submit'>
                <?php
                if ($id !== 0) {
                    echo "Cập nhật";
                } else {
                    echo "Thêm mới";
                }
                ?>
            </button>
        </form>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

    <script>
        const id = document.getElementById('studentId').value
        const tenSV = document.getElementById('tenSV')
        const ngaySinh = document.getElementById('ngaySinh')
        const diaChi = document.getElementById('diaChi')
        const nam = document.getElementById('nam')
        const nu = document.getElementById('nu')
        const lop = document.getElementById('lop')
        const khoa = document.getElementById('khoa')
        const form = document.getElementById('form-post')

        form.addEventListener('submit', function(e) {
            e.preventDefault()
            const data = {
                id: +id !== 0 ? +id : 0,
                tenSV: tenSV.value,
                ngaySinh: ngaySinh.value,
                diaChi: diaChi.value,
                gioiTinh: nam.checked ? nam.value : nu.value,
                lop: lop.value,
                khoa: khoa.value
            }
            $.ajax({
                url: `./response/luu_sinh_vien.php?action=${+id !== 0 ? 'update' : 'insert'}`,
                data: data,
                method: 'POST',
                success: function(res) {
                    console.log(res);
                    if (res.status) {
                        window.location.href = "index.php"
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }

            })
        })

        const handleGetDetailStudent = () => {
            if (+id !== 0) {
                $.ajax({
                    url: './response/chi_tiet_sinh_vien.php?action=detail',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    success: function(res) {
                        if (res && res.code === 200) {
                            tenSV.value = res.data.ten_sinh_vien
                            ngaySinh.value = res.data.ngay_sinh
                            diaChi.value = res.data.dia_chi
                            lop.value = res.data.lop
                            khoa.value = res.data.khoa
                            if (res.data.gioi_tinh === "Nam") {
                                nam.checked = true
                            } else {
                                nu.checked = true
                            }
                        }
                    }
                })
            }
        }
        handleGetDetailStudent()
    </script>

</body>

</html>