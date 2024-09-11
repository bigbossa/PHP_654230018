<?php
include('config.php');
include('navlogin.php');
include('footer.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Homepage</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="container">
        <h3 class="mt-4">แสดงข้อมูลสินค้า</h3><br>
        <a href="uplondlogin.php" class="btn btn-info">Add</a>
        <hr>
        <table id="productTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Info</th>
                    <th>Cost</th>
                    <th>Selling Price</th>
                    <th>Image</th>
                    <th>Edit/delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
           $sql = "SELECT * FROM hw06";
            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                if ($result) {
                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['proname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['info']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['cost']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Selling']) . "</td>";
            
                        if (isset($row['Img']) && !empty($row['Img'])) {
                        echo "<td><img src='" . htmlspecialchars($row['Img']) . "' width='100' height='100'></td>";
                        } else {
                            echo "<td>ไม่มีภาพ</td>";
                        }
            
                        echo "<td>";
                        echo "<button class='btn btn-primary edit-btn' data-id='" . htmlspecialchars($row['id']) . "'>Edit</button> ";
                        echo "<button class='btn btn-danger delete-btn' data-id='" . htmlspecialchars($row['id']) . "'>Delete</button>";
                        echo "</td>";
            
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>ไม่มีข้อมูลสินค้า</td></tr>";
                }
            } catch (PDOException $e) {
                echo "<tr><td colspan='7'>Error: " . $e->getMessage() . "</td></tr>";
            }
            ?>
            
            </tbody>
        </table>
        <p class="text-end"><br>
            <a href="index.php" class="btn btn-info">กลับหน้าหลัก</a>
        </p>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productTable').DataTable();
        });
    </script>
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#productTable').DataTable();

        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            window.location.href = 'edit.php?id=' + id;
        });

        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delete.php', 
                        type: 'POST',
                        data: { id: id },
                        success: function(response) {
                        
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(() => {
                            
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

</body>

</html>
