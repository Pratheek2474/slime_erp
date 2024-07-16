<?php include 'headers.php'; ?>

<?php

$new_query = mysqli_query($conn,"SELECT file FROM images WHERE type='news'");
$news_images = mysqli_fetch_all($new_query,MYSQLI_ASSOC);
$notice_query = mysqli_query($conn,"SELECT * FROM notices");
$notices = mysqli_fetch_all($notice_query,MYSQLI_ASSOC);

?>

<div class="container p-5">
            <div class="row m-4 border border-dark border-1 rounded-5 border-opacity-25 object-fit-none col-12">
                <h2 class="text-center text-dark p-3">News & Happenings</h2>
                <div id="news" class="carousel slide carousel-fade" >
                    <div class="carousel-inner">
                        <div class="carousel-item d-flex justify-content-center active my-2 mb-2">
                            <img src="images/artworks-FPLBxL5i3usMIDcl-Zy35oQ-t500x500.jpg" class="" alt="..." width="500" height="400">
                        </div>
                        <?php foreach($news_images as $news_image): ?>
                        <div class="carousel-item d-flex justify-content-center my-2">
                        <img src="images/news/<?php echo $news_image['file']?>" class="" alt="..." width="500" height="400">
                        </div>
                        <?php endforeach ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#news" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: black;"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#news" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: black;"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    </div>
            </div>
            <div class="row m-4 p-5 overflow-y: scroll position: absolute">
                <div class="card scroll">
                    <h2 class="m-2 p-2 text-center card-title">Notices</h2>
                    <div class="card-body m-3 p-3">
                        <?php foreach($notices as $notice): ?>
                            <div class="card m-3 p-3">
                            <h5 class="card-title text-danger mb-3 p-2">
                                <?php echo $notice['heading']; ?>
                            </h5>
                            <div class="card-body">
                            <?php echo $notice['body']; ?>
                            </div>
                        </div>
                        <?php endforeach ?>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    
</body>
</html>