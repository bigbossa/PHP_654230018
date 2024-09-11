<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proname = $_POST['proname'];
    $info = $_POST['info'];
    $cost = $_POST['cost'];
    $Selling = $_POST['Selling'];
    $Img = '';

    $uploadDir = 'uploads/';

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            die("Failed to create upload directory.");
        }
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $Img = $uploadFile;
        } else {
            echo "File upload failed.";
        }
    }

    $sql = "INSERT INTO hw06 (proname, info, cost, Selling, Img) 
            VALUES (:proname, :info, :cost, :Selling, :Img)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':proname', $proname);
        $stmt->bindParam(':info', $info);
        $stmt->bindParam(':cost', $cost);
        $stmt->bindParam(':Selling', $Selling);
        $stmt->bindParam(':Img', $Img);

        if ($stmt->execute()) {
            echo "<div id='swingAlert' class='swing-alert'>";
            echo "<h4 class='mb-0'>บันทึกข้อมูลเรียบร้อยแล้ว</h4><hr>";
            echo "</div>";
            echo "<script>setTimeout(function() { document.getElementById('swingAlert').style.display = 'none'; }, 3000);</script>";
        } else {
            echo "<div class='container'>";
            echo "<h3 class='mt-4'>เกิดข้อผิดพลาดในการบันทึกข้อมูล</h3>";
            echo "<hr>";
            echo "<a href='index.php' class='btn btn-info'>กลับหน้าหลัก</a>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<div class="container">
    <h3 class="mt-4">ฟอร์มกรอกข้อมูลสินค้า</h3>
    <hr>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="proname" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="proname" name="proname" aria-describedby="proname">
        </div>
        <div class="mb-3">
            <label for="info" class="form-label">Info</label>
            <input type="text" class="form-control" id="info" name="info" aria-describedby="info">
        </div>
        <div class="mb-3">
            <label for="cost" class="form-label">Cost</label>
            <input type="number" class="form-control" id="cost" name="cost" aria-describedby="cost">
        </div>
        <div class="mb-3">
            <label for="Selling" class="form-label">Net Selling Price</label>
            <input type="number" class="form-control" id="Selling" name="Selling" aria-describedby="Selling">
        </div>
        <div>
            <input class="form-control" type="file" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary mt-3">บันทึกข้อมูล</button>
    </form>
    <hr>
    <p class="text-end">
        <a href="home.php" class="btn btn-info">กลับหน้าหลัก</a>
    </p>
</div>