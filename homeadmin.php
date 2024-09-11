<?php
include('config.php');
include('navlogin.php');
include('tomrun.php');
echo "<br>";
include('footer.php');

?>
<!DOCTYPE html>
<html>
<style>
    #image-slider {
        margin-left: 40px;
        width: 600px;
        /* ขนาดของภาพ */
        height: 400px;
        /* ขนาดของภาพ */
        overflow: hidden;
        position: relative;
    }

    #image-slider img {
        width: 100%;
        height: auto;
        position: absolute;
        transition: opacity 1s ease-in-out;
    }

    .fade-out {
        opacity: 0;

        hr {
            border: 2px;
            /* ลบเส้นขอบเริ่มต้น */
            height: 5px;
            /* กำหนดความหนาของเส้น */
            background-color: rgb(0, 0, 0);
            /* กำหนดสี */
            width: 80%;
            /* กำหนดความกว้าง */
        }
    }
</style>

<head>
    <meta charset="utf-8">
    <title>Stylish Button</title>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>

<body>
    <section  class="container">
    <div id="image-slider" style="display: flex; justify-content: center; align-items: center; width: 100%; height: 400px; overflow: hidden; position: relative;">
    <img src="img/1.jpg" alt="Image 1" style=" object-fit: cover; display: block;">
    <img src="img/2.jpg" alt="Image 2" class="fade-out" style=" object-fit: cover; display: block;">
    <img src="img/3.jpg" alt="Image 3" class="fade-out" style=" object-fit: cover; display: block;">
</div>

</section>
</body>
<script>
      const images = document.querySelectorAll('#image-slider img');
      let currentIndex = 0;
      const intervalTime = 3000; // เวลาสำหรับการเปลี่ยนภาพ (3 วินาที)

      function showNextImage() {
          images[currentIndex].classList.add('fade-out');
          currentIndex = (currentIndex + 1) % images.length;
          images[currentIndex].classList.remove('fade-out');
      }

      setInterval(showNextImage, intervalTime);
  </script>
</html>