<?php
include('config.php');
include('nav.php');
include('footer.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch existing product details
    $sql = "SELECT * FROM hw06 WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$product) {
        echo "Product not found.";
        exit;
    }
} else {
    echo "No product ID specified.";
    exit;
}

// Update product details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $proname = $_POST['proname'];
    $info = $_POST['info'];
    $cost = $_POST['cost'];
    $selling = $_POST['selling'];
    $img = $_POST['img']; // For simplicity, assuming image URL input

    $sql = "UPDATE hw06 SET proname = :proname, info = :info, cost = :cost, Selling = :selling, Img = :img WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'proname' => $proname,
        'info' => $info,
        'cost' => $cost,
        'selling' => $selling,
        'img' => $img,
        'id' => $id
    ]);

    header('Location: previewlogin.php'); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Edit Product</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="proname" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="proname" name="proname" value="<?php echo htmlspecialchars($product['proname']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="info" class="form-label">Info</label>
                <input type="text" class="form-control" id="info" name="info" value="<?php echo htmlspecialchars($product['info']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="cost" class="form-label">Cost</label>
                <input type="number" class="form-control" id="cost" name="cost" value="<?php echo htmlspecialchars($product['cost']); ?>" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="selling" class="form-label">Selling Price</label>
                <input type="number" class="form-control" id="selling" name="selling" value="<?php echo htmlspecialchars($product['Selling']); ?>" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Image URL</label>
                <input type="file" class="form-control" id="img" name="img" value="<?php echo htmlspecialchars($product['Img']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            <a href="previewlogin.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>