<?php
session_start();
include '../include/connection.php';
include('../include/header.php');


if (isset($_POST['add'])) {
    $pAdd = $_POST['add'];
}

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
                                <a href="posts.php" target="_blank">
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
                    <button class="btn-custom mt-3">مقال جديد</button>
                    <?php
                    if (isset($pAdd)) {

                        $pTitle = $_POST['title'];
                        $pCat = $_POST['cat'];
                        $pContent = $_POST['content'];
                        $pAuther = "مرتضى لقمان";
                        //image
                        $imageName = $_FILES['postImage']['name'];
                        $imageTmp = $_FILES['postImage']['tmp_name'];
                        $size = $_FILES['postImage']['size'];

                        $img_ext = explode('.', $imageName);
                        $img_correct_ext = strtolower(end($img_ext));
                        $allow = array('jpg', 'png', 'jpeg');
                        // $destination = uniqid() . ".jpg";
                        $path = "../uploads/postimages/" . $imageName;


                        $queryy = "SELECT * FROM posts WHERE postTitle = '$pTitle'";
                        $ress = mysqli_query($conn, $queryy);

                        if (mysqli_fetch_assoc($ress)) {
                    ?> <script>
                                $(function() {
                                    Swal.fire(
                                        'حدث خطا ',
                                        'المقال موجود بالفعل اكتب مقال اخر',
                                        'question'
                                    )
                                })
                            </script>
                        <?php
                        } elseif (empty($pTitle)) {
                        ?> <script>
                                $(function() {
                                    Swal.fire(
                                        'حدث خطا ',
                                        'الرجاء كتابة العنوان',
                                        'question'
                                    )
                                })
                            </script>
                        <?php
                        } elseif (empty($pContent)) {
                        ?> <script>
                                $(function() {
                                    Swal.fire(
                                        'حدث خطا ',
                                        'الرجاء كتابة المحتوى',
                                        'question'
                                    )
                                })
                            </script>
                        <?php
                        } elseif (empty($imageName)) {
                        ?> <script>
                                $(function() {
                                    Swal.fire(
                                        'حدث خطا ',
                                        'الرجاء وضع صورة',
                                        'question'
                                    )
                                })
                            </script>
                            <?php
                        }
                        // elseif ($pContent > 10000) {
                        //     echo "<div class='alert alert-danger'>" . "محتوى المنشور كبير جدا";
                        // }
                        elseif (in_array($img_correct_ext, $allow)) {

                            // $postImage = rand(0, 1000) . "_" . $imageName;
                            // move_uploaded_file($imageTmp, "..\uploads\postimages\\" . $postImage);
                            if ($size < 500000)
                            {
                                $query = "INSERT INTO posts(postTitle , postCat , postImage , postContent , postAuthor) VALUES ('$pTitle' , '$pCat' , '$imageName' , '$pContent' , '$pAuther')";

                                $res = mysqli_query($conn, $query);
                                if ($res) 
                                {
                            ?> <script>
                                        $(function() {
                                            Swal.fire({
                                                position: 'center',
                                                icon: 'success',
                                                title: 'تمت اضافة مقال جديد',
                                                showConfirmButton: false,
                                                timer: 2000
                                            })
                                        })
                                    </script>
                            <?php
                                    move_uploaded_file($imageTmp, $path);
                                }
                            }
                        } 
                        else 
                            {
                                ?> <script>
                                    $(function() {
                                        Swal.fire(
                                            'حدث خطا ',
                                            ' يمكنك وضع صورة من امتداد  jpg , png , jpeg فقط',
                                            'question'
                                        )
                                    })
                                </script>
                        <?php
                            }
                    }
                    ?>
                    <div class="add-category">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title" class="mb-3"> عنوان المقال</label>
                                <input type="text" name="title" class="form-control mb-3">
                            </div>

                            <div class="form-group">
                                <label for="cate" class="mb-3">التصنيف</label>
                                <select name="cat" id="cate" class="form-control mb-3">
                                    <?php
                                    $query = "SELECT * FROM catigories";
                                    $res = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($res)) {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['catigoryName'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image" class="mb-3">صورة المقال</label>
                                <input type="file" id="image" class="form-control" name="postImage">
                            </div>

                            <div class="form-group">
                                <label for="content" class="mb-3">نص المقال</label>
                                <textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <button class="btn-custom mt-3" name="add">نشر المقال</button>

                        </form>
                    </div>
                </div>
                <!-- End Content -->

            <?php
        }
            ?>

            <?php
            include('../include/footer.php');
            ?>