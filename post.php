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

                $id = $_GET['id'];

                

                $query = "SELECT * FROM posts WHERE id='$id'";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result)

                ?>
                <div class="post text-center">
                    <div class="post-image">
                        <img src="uploads/postimages/<?php echo $row['postImage'] ?>">
                    </div>
                    <div class="post-title mt-4 mb-4">
                        <h4><?php echo $row['postTitle']; ?></h4>
                    </div>
                    <div class="post-details">
                        <p class="post-info">
                            <span><i class="fas fa-user"></i><?php echo $row['postAuthor'] ?></span>
                            <span><i class="far fa-calendar-alt"></i><?php echo $row['postDate'] ?></span>
                            
                        </p>
                        <p class="postContent">
                            <?php echo $row["postContent"]; ?>
                        </p>

                    </div>
                </div>





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
                        $query = "SELECT * FROM posts ORDER BY id DESC LIMIT 3";
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