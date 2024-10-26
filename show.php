<?php 
include 'inc/header.php'; 
include 'dbConnection.php';
?>

<div class="container my-5">
    <div class="row">
        <?php
        
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

           
            $q1 = "SELECT * FROM product WHERE ID = $id LIMIT 1";
            $runq1 = mysqli_query($conn, $q1);
            $product = mysqli_fetch_assoc($runq1);

           
            if ($product) {
        ?>
                <div class="col-lg-6">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="col-lg-6">
                    <h5><?php echo htmlspecialchars($product['name']); ?></h5>
                    <p class="text-muted">Price: <?php echo htmlspecialchars($product['price']); ?> EGP</p>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <a href="index.php" class="btn btn-primary">Back</a>
                    <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-info">Edit</a>
                    <form action="delete.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <button type="submit" name="Delete" class="btn btn-danger">Delete</button>
                    </form>
                </div>
        <?php
            } else {
                echo "<p>Product not found.</p>";
            }
        } else {
            echo "<p>No product specified.</p>";
        }
        ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
