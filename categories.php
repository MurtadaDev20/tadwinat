<?php

include 'public/header.php';
include 'include/connection.php';
?>

<!-- Start Content -->
<div class="content mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php

                if (isset($_GET['id'])) {
                    $cat = $_GET['id'];

                    $query = "SELECT * FROM catigories where id = '$cat'";
                    $res = mysqli_query($conn, $query);


                    $query = "SELECT * FROM posts  WHERE postCat='$cat'";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {

                ?>
                        <div class="post text-center">
                            <div class="post-image">
                                <a href="post.php?id=<?php echo $row['id'] ?>"><img src="uploads/postimages/<?php echo $row['postImage'] ?>"></a>
                            </div>
                            <div class="post-title mt-4 mb-4">
                                <h4><a href="post.php?id=<?php echo $row['id'] ?>"><?php echo $row['postTitle']; ?></a></h4>
                            </div>
                            <div class="post-details">
                                <p class="post-info">
                                    <span><i class="fas fa-user"></i><?php echo $row['postAuthor'] ?></span>
                                    <span><i class="far fa-calendar-alt"></i><?php echo $row['postDate'] ?></span>
                                    <?php
                                    $roww = mysqli_fetch_assoc($res)
                                    ?>
                                    <span><i class="fas fa-tags"></i><?php echo $roww['catigoryName'] ?></span>
                                </p>
                                <p class="postContent">
                                    <?php
                                    if (strlen($row['postContent']) > 150) {
                                        $row['postContent'] = substr($row['postContent'], 0, 300) . ".....";
                                    }
                                    echo $row['postContent']
                                    ?>
                                </p>
                                <a href="post.php?id=<?php echo $row['id'] ?>"><button class="btn btn-custom">اقرا المزيد</button></a>
                            </div>
                        </div>
                <?php

                    }
                }
                ?>


            </div>
            <div class="col-md-3">
                <!-- Catagories -->
                <div class="catagories mb-5">
                    <h4>التصنيفات</h4>
                    <ul>
                        <?php
                        $query = "SELECT * FROM catigories ORDER BY id DESC";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>

                            <li>
                                <a href="categories.php?id=<?php echo $row['id'] ?>">

                                    <span><i class="fas fa-tags"></i></span>
                                    <span><?php echo $row['catigoryName']; ?></span>
                                </a>
                            </li>

                        <?php

                        }
                        ?>

                    </ul>

                </div>
                <!-- End catagories -->

                <!-- Start Latest Post -->
                <div class="last-posts">
                    <h4>احدث المنشورات</h4>
                    <ul>
                        <?php
                        $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 5";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                            <li>
                                <a href="post.php?id=<?php echo $row['id'] ?>">
                                    <span class="spn-img"><img src="uploads/postimages/<?php echo $row['postImage'] ?>" alt="image1"></span>
                                    <span><?php echo $row['postTitle'] ?></span>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <!-- End Latest Post -->
            </div>
        </div>
    </div>
</div>
<!-- End Content -->
<?php

include 'public/footer.php'

?>