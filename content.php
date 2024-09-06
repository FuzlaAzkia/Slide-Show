<?php
include "proses/connect.php";

// Ambil 15 data media terbaru dari database
$query = mysqli_query($conn, "SELECT * FROM tb_image ORDER BY upload_time DESC LIMIT 15");
$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>

<style>
    .carousel-item {
        height: 100vh;
        justify-content: center;
        align-items: center;
    }

    .carousel-item img,
    .carousel-item video {
        object-fit: contain;
        height: 100%;
        width: 100%;
        object-position: center;
    }
</style>

<div class="card bg-dark">
    <div id="carouselExampleAutoplaying" class="carousel carousel-light slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            if (!empty($result)) {
                foreach ($result as $index => $row) {
                    echo '<button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="' . $index . '" ' . ($index == 0 ? 'class="active"' : '') . ' aria-label="Slide ' . ($index + 1) . '"></button>';
                }
            }
            ?>
        </div>
        <div class="carousel-inner">
            <?php
            if (!empty($result)) {
                foreach ($result as $index => $row) {
                    $fileType = strtolower(pathinfo($row['foto_video'], PATHINFO_EXTENSION));
                    echo '<div class="carousel-item ' . ($index == 0 ? 'active' : '') . '">';
                    if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                        echo '<img src="assets/media/' . $row['foto_video'] . '" class="d-block w-100" alt="Image">';
                    } elseif (in_array($fileType, ['mp4', 'mov', 'avi', 'mkv'])) {
                        echo '<video class="d-block w-100">
                                <source src="assets/media/' . $row['foto_video'] . '" type="video/' . $fileType . '">
                                Your browser does not support the video tag.
                              </video>';
                    } else {
                        echo '<p>File type not supported</p>';
                    }
                    echo '<div class="carousel-caption d-none d-md-block" style="color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">';
                    echo '<h5>' . htmlspecialchars($row['caption']) . '</h5>';
                    echo '<p>' . htmlspecialchars($row['upload_time']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var carousel = document.querySelector('#carouselExampleAutoplaying');
        var carouselInstance = new bootstrap.Carousel(carousel, {
            interval: 5000, // interval untuk gambar
            ride: 'carousel'
        });

        carousel.addEventListener('slide.bs.carousel', function (e) {
            var activeItem = e.relatedTarget;
            var video = activeItem.querySelector('video');

            if (video) {
                carouselInstance.pause(); // Pause the carousel
                video.play(); // Play the video

                video.addEventListener('ended', function () {
                    carouselInstance.next(); // Go to the next slide when the video ends
                }, { once: true });
            } else {
                carouselInstance.cycle(); // Resume the carousel for non-video slides
            }
        });

        carousel.addEventListener('slid.bs.carousel', function () {
            var activeItem = carousel.querySelector('.carousel-item.active');
            var video = activeItem.querySelector('video');

            if (!video) {
                carouselInstance.cycle(); // Resume the carousel if there is no video
            }
        });
    });
</script>