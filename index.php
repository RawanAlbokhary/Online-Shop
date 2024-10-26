<?php 
include 'inc/header.php'; 
include 'dbConnection.php';
?>

<div class="container my-5">
    <div class="row">
        <?php
        $q1 = "SELECT * FROM product";
        $runq1 = mysqli_query($conn, $q1);
        $products = mysqli_fetch_all($runq1, MYSQLI_ASSOC);

        foreach ($products as $p) {
            $id = $p['ID'];
        ?>
            <div class="col-lg-4 mb-3">
                <div class="card">
                    <img src="images/<?php echo htmlspecialchars($p['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($p['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "Product " . htmlspecialchars($p['ID']); ?><br><br><b><?php echo htmlspecialchars($p['name']); ?></b></h5>
                        <p class="text-muted"><?php echo htmlspecialchars($p['price']); ?> EGP</p>
                        <p class="card-text"><?php echo htmlspecialchars($p['description']); ?></p>

                        
                        <a href="show.php?id=<?php echo $id; ?>" class="btn btn-primary">Show</a>
                        <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-info">Edit</a>
                        <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
                        
 
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
