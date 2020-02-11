<?php
require_once './app/views/admin/master/master.php';
?>

<body>
    <div class="wrapper">
        <?php
        require_once './app/views/admin/master/header.php';
        ?>

        <!-- Sidebar -->
        <?php
        require_once './app/views/admin/master/sidebar.php';
        ?>
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">Loại Xe</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="<?= ADMIN_URL . '/category' ?>">Loại Xe</a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">

                                        <a href="<?= ADMIN_URL . '/category' ?>" class="btn btn-primary btn-round ml-auto">
                                            Danh sách
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-md-center">
                                        <div class="col-md-8">
                                            <form action="<?= ADMIN_URL . '/category/save-edit' ?>" method="post">
                                                <input type="hidden" name="id" value="<?= $cate->id ?>">
                                                <div class="form-group">
                                                    <label>Tên loại xe:</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Tên Loại Xe" value="<?= $cate->name ?>">
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_name'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_name'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comment">Mô tả loại xe:</label>
                                                    <textarea name="description" class="form-control" id="comment" rows="5"><?= $cate->description ?></textarea>
                                                    <small id="emailHelp2" class="form-text text-muted">
                                                        <?php if (isset($_GET['err_description'])) : ?>
                                                            <span style="color: red"><?= $_GET['err_description'] ?></span>
                                                        <?php endif ?>
                                                    </small>
                                                </div>
                                                <div class="form-check">
                                                    <label>Hiển thị ra menu:</label><br>
                                                    <label class="form-radio-label">
                                                        <input class="form-radio-input" type="radio" name="show_menu" value="2" 
                                                        <?php 
                                                        if($cate->show_menu ==2){
                                                            echo 'checked';
                                                        } ?>
                                                        >
                                                        <span class="form-radio-sign">Không</span>
                                                    </label>
                                                    <label class="form-radio-label ml-3">
                                                        <input class="form-radio-input" type="radio" name="show_menu" value="1"
                                                        <?php 
                                                        if($cate->show_menu ==1){
                                                            echo 'checked';
                                                        } ?>>
                                                        <span class="form-radio-sign">Có</span>
                                                    </label>
                                                </div>

                                                <div class="card-action">
                                                    <button class="btn btn-success">Cập nhật</button>
                                                    <button class="btn btn-danger">Trở lại</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="./public/assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="./public/assets/js/core/popper.min.js"></script>
    <script src="./public/assets/js/core/bootstrap.min.js"></script>
    <!-- jQuery UI -->
    <script src="./public/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
    <script src="./public/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="./public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="./public/assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Atlantis JS -->
    <script src="./public/assets/js/atlantis.min.js"></script>
    <!-- Atlantis DEMO methods, don't include it in your project! -->
    <script src="./public/assets/js/setting-demo2.js"></script>
    <script>
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});

            $('#multi-filter-select').DataTable({
                "pageLength": 5,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $('<select class="form-control"><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }
            });

            // Add Row
            $('#add-row').DataTable({
                "pageLength": 5,
            });

            var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Sửa"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Xóa"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                ]);
                $('#addRowModal').modal('hide');

            });
        });
    </script>
</body>

</html>