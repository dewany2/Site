<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Procurar</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Pesquise .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Procurar</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Publicação Recente</h4>
        <?php
        include "config.php";

        $limit = 3;

        $sql = "SELECT post.post_id, post.title,  post.post_img, post.category, post.post_date,
                    category.category_name,user.username,post.author FROM post LEFT JOIN 
                    category ON post.category = category.category_id
                    LEFT JOIN user ON post.author = user.user_id
                    ORDER BY post.post_id DESC LIMIT {$limit}";

        $result = mysqli_query($conn, $sql) or die("query failed");
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div class="recent-post">
                    <a class="post-img" href="single.php?id=<?php echo $row['post_id'] ?>">
                        <img src="admin/upload/<?php echo $row['post_img']; ?>" alt="" />
                    </a>
                    <div class="post-content">
                        <h5><a href="single.php?id=<?php echo $row['post_id'] ?>"><?php echo $row['title']; ?></a></h5>
                        <span>
                            <i class="fa fa-tags" aria-hidden="true"></i>
                            <a href='category.php?cid=<?php echo $row['category'] ?>'><?php echo $row['category_name']; ?></a>
                        </span>
                        <span>
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <?php echo $row['post_date']; ?>
                        </span>
                        <a class="read-more" href="single.php?id=<?php echo $row['post_id'] ?>">Ler Mais</a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <!-- /recent posts box -->
</div>