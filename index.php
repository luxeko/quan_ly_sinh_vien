<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quản lý sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/toast.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="icon" href="https://eprojectsem4.blob.core.windows.net/plant-nest/plant-nest.png" type="image/x-icon">
</head>

<body>
    <section class="main_container pt-5">
        <div class="container-sm px-5">
            <h1 class="mb-4 text-center">Quản lý sinh viên</h1>
            <div class="d-flex align-items-center justify-content-between">
                <a href="form.php" class="btn btn-success mb-4 d-inline-flex align-items-center">
                    <span class="fs-5 me-2">
                        <i class="bi bi-plus"></i>
                    </span>
                    Thêm mới sinh viên
                </a>
                <div>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" placeholder="Tên sinh viên..." class="form-control" name="search" id="search" />
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Đia chỉ</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">Lớp</th>
                        <th scope="col">Khoa</th>
                        <th scope="col">Quản lý</th>
                    </tr>
                </thead>
                <tbody id="tbody-data">

                </tbody>
            </table>
        </div>
        <div id="modal-delete" class="modal-delete"></div>
        <div id="overlay" class="overlay"></div>
        <div id="toast"></div>
    </section>
    <script src="./assets/js/toast.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <?php
    session_start();
    if (isset($_SESSION["message"]) && isset($_SESSION["title"]) && isset($_SESSION["status"])) {
        echo "<script>";
        echo "toast({";
        echo "title: " . "'" . $_SESSION["title"] . "',";
        echo "message: " . "'" . $_SESSION["message"] . "',";
        echo "type:" . "'" . $_SESSION["status"] . "',";
        echo "duration: 3000";
        echo "})";
        echo "</script>";
    }
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    ?>
    <script>
        const modal = document.getElementById('modal-delete')
        const overlay = document.getElementById('overlay')
        const tbodyData = document.getElementById('tbody-data');
        const search = document.getElementById("search")
        const modalLayout = document.createElement("div")
        overlay.addEventListener('click', function() {
            this.style.display = 'none'
            modal.removeChild(modalLayout);
        })
        search.addEventListener("change", function(e) {
            console.log(e.target.value);
        })
        const main = () => {
            handleGetListStudent()
        }
        const handleGetListStudent = () => {
            $.ajax({
                url: './response/ds_sinh_vien.php?action=list',
                method: 'GET',
                success: function(response) {
                    tbodyData.innerHTML = response
                }
            })
        }
        const handleShowModal = (id, tenSinhVien) => {
            overlay.style.display = 'block'
            modalLayout.classList.add("modal-dialog", "modal-confirm")
            modalLayout.innerHTML = `
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <div class="icon">
                            <i class="bi bi-x-lg mt-0"></i>
                        </div>
                    </div>						
                    <h4 class="modal-title">Bạn có chắc không?</h4>	
                </div>
                <div class="modal-body">
                    <p>Bạn có thực sự muốn xóa sinh viên ${tenSinhVien}? Nếu chọn xoá thì không thể hoàn tác lại dữ liệu.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" onclick="handleCancel()" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" onclick="handleDelete(${id})" class="btn btn-danger">Xóa</button>
                </div>
            </div>
            `
            modal.appendChild(modalLayout);
        }

        const handleCancel = () => {
            overlay.style.display = 'none'
            modal.removeChild(modalLayout);
        }
        const handleDelete = (id) => {
            $.ajax({
                url: './response/xoa_sinh_vien.php?action=delete',
                data: {
                    id: id
                },
                method: 'POST',
                success: function(response) {
                    if (response && response.code === 200) {
                        toast({
                            title: 'Thành công',
                            message: response.message,
                            type: 'success',
                            duration: 3000
                        });
                    } else {
                        toast({
                            title: 'Lỗi',
                            message: response.message,
                            type: 'error',
                            duration: 3000
                        });
                    }
                    handleCancel()
                    handleGetListStudent()
                }
            })
        }
        main()
    </script>
</body>

</html>