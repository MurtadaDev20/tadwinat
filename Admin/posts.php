<?php
session_start();
include '../include/connection.php';
include '../include/header.php';
@$id = $_GET['id'];

if (!isset($_SESSION['id'])) {
    echo "<div class =' alert alert-danger'>" . "غير مسموح لك بفتح هذه الصفحة" . "</div>";
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
                            <a href="catefories.php">
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
                                <a href="logout.php">
                                    <span><i class="far fa-edit"></i></span>
                                    <span>كل المقالات</span>
                                </a>
                            </li>

                        </ul>


                        <li>
                            <a href="../index.php">
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
                    <button class="custom-btn">كل المقالات</button>
                    <?php
                    if (isset($id)) {
                        $query = "DELETE FROM posts WHERE id = '$id' ";
                        $delete = mysqli_query($conn, $query);

                    
                        if (isset($delete)) {
                            echo "<div class='alert alert-success'>" . " تم حذف المقال بنجاح" . "</div>";
                        } else {
                            echo "<div class='alert alert-danger'>" . " عفوا حدث خطا ما" . "</div>";
                        }
                        header('location:posts.php');
                    }

                    ?>
                    <!-- Display All Posts-->
                    <div class="display-posts mt-4">
                        <table class="table table-ordered">
                            <tr style="background-color:#5b4834; color:#eee;">
                                <th>رقم المقال</th>
                                <th>عنوان المقال</th>
                                <th>كاتب المقال</th>
                                <th>صورة المقال</th>
                                <th>تاريخ المقال</th>
                                <th>حذف المقال</th>
                            </tr>
                            <?php
                            $query = "SELECT * FROM posts ORDER BY id DESC";
                            $res = mysqli_query($conn, $query);
                            $no = 0;
                            while ($row = mysqli_fetch_assoc($res)) {
                                $no++
                            ?>

                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $row['postTitle']; ?></td>
                                    <td><?php echo $row['postAuthor']; ?></td>
                                    <td><img src="../uploads/postimages/<?php echo $row['postImage']; ?>" width="70px"></td>
                                    <td><?php echo $row['postDate']; ?></td>
                                    <td><a href="posts.php?id=<?php echo $row['id']; ?>"><button class="btn-custom">حذف المقال</button></a></td>
                                </tr>


                            <?php
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
}
?>

<?php

include '../include/footer.php'


?>