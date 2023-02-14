<?php
session_start();
include('../include/connection.php');
include('../include/header.php');


if (isset($_POST['category'])) {
    $cName = $_POST['category'];
}
if (isset($_POST['add'])) {
    $cAdd = $_POST['add'];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    header('location:catefories.php');
}

if (!isset($_SESSION['id'])) {
    echo "<div class =' alert alert-success'>" . "غير مسموح لك بفتح هذه الصفحة" . "</div>";
    header('REFRESH:2;URL=index.php');
} else {



?>

    <!-- Start Content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2" id="side-area">
                    <h4>لوحة التحكم</h4>
                    <ul class="">
                        <li>
                            <a href="">
                                <span><i class="fas fa-tags"></i></span>
                                <span>التصنيفات</span>
                            </a>
                        </li>

                        <!-- Articls -->
                        <li data-bs-toggle="collapse" data-bs-target="#menu">
                            <a href="#">
                                <span><i class="fas fa-newspaper"></i></span>
                                <span>المقالات</span>
                            </a>
                        </li>
                        <ul class="collapse" id="menu">
                            <li>
                                <a href="new-post.php">
                                    <span><i class="far fa-edit"></i></span>
                                    <span>مقال جديد</span>
                                </a>
                            </li>
                            <li>
                                <a href="posts.php">
                                    <span><i class="far fa-edit"></i></span>
                                    <span>كل المقالات</span>
                                </a>
                            </li>

                        </ul>


                        <li>
                            <a href="../index.php" target="_blank">
                                <span><i class="fas fa-window-restore"></i></span>
                                <span>عرض الموقع</span>
                            </a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <span><i class="fas fa-sign-out-alt"></i></span>
                                <span>تسجيل الخروج</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-10" id="main-area">
                    <div class="add-category">

                        <?php

                        if (isset($cAdd)) {

                            $query = "SELECT * FROM catigories WHERE catigoryName = '$cName'";
                            $res = mysqli_query($conn, $query);
                            // $row = ;


                            if (mysqli_fetch_assoc($res)) {
                        ?>
                                <script>
                                    $(function() {
                                        Swal.fire(
                                            'حدث خطا',
                                            'الاسم موجود بالفعل',
                                            'question'
                                        )
                                    })
                                </script>
                            <?php

                            } elseif (empty($cName)) {
                            ?> <script>
                                    $(function() {
                                        Swal.fire(
                                            'حدث خطا ',
                                            'حقل التصنيف فارغ',
                                            'question'
                                        )
                                    })
                                </script>
                            <?php

                            } elseif (strlen($cName) > 100) {
                            ?>
                                <script>
                                    $(function() {
                                        Swal.fire(
                                            'حدث خطا ',
                                            'اسم التصنيف كبير جدا',
                                            'question'
                                        )
                                    })
                                </script>
                            <?php
                            } else {
                                $query = "INSERT INTO catigories(catigoryName) VALUES('$cName')";
                                mysqli_query($conn, $query);

                            ?>
                                <script>
                                    $(function() {
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'success',
                                            title: 'تمت اضافة تصنيف جديد',
                                            showConfirmButton: false,
                                            timer: 2000
                                        })
                                    })
                                </script>
                        <?php
                            }
                        }
                        ?>

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-group">
                                <label for="category" class="mb-3">تصنيف جديد</label>
                                <input type="text" name="category" class="form-control mb-3">
                            </div>
                            <button class="btn-custom " name="add" id="add">اضافة</button>
                        </form>
                    </div>

                    <!-- display categories -->
                    <div class="display-cat mt-5">
                    <?php

                    if (isset($id)) {

                        $queryy = "SELECT * FROM posts WHERE postCat = '$id'";
                        $res = mysqli_query($conn, $queryy);

                        if (mysqli_fetch_assoc($res)) {
                            echo "<div class='alert alert-danger'>" . " عفوا التصنيف يحتوي على مقال" . "</div>";
                        } else {
                            $query = "DELETE FROM catigories WHERE id = '$id' ";
                            $delete = mysqli_query($conn, $query);
                        }
                    }
                

                    ?>
                    <table class="table  table-hover">
                        <tr>
                            <th>رقم الفئة</th>
                            <th>اسم الفئة</th>
                            <th>تاريخ الاضافة</th>
                            <th>حذف التصنيف</th>
                        </tr>
                        <?php
                        $query = "SELECT * FROM catigories ORDER BY id DESC";
                        $res = mysqli_query($conn, $query);
                        $no = 0;
                        while ($row = mysqli_fetch_assoc($res)) {
                            $no++;
                        ?>

                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $row['catigoryName'] ?></td>
                                <td><?php echo $row['catigoryDate'] ?></td>
                                <td><a href="catefories.php?id=<?php echo $row['id']; ?>" visibility="hidden"><button class="btn-custom ">حذف التصنيف</button></a></td>
                            </tr>

                        <?php
                        }
                    }
                        ?>

                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <?php

    ?>

    <?php
    include('../include/footer.php');
    ?>