<?php 
include 'inc/header.php';  
include 'dbConnection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
        extract($_POST);
        $extensions = ['jpg', 'png','jfif'];
      
        $img = $_FILES['image'];
        $imgname = $img['name'];
        $imgsize = $img['size'];
        $imgtemp = $img['tmp_name'];
        $imgex = pathinfo($imgname, PATHINFO_EXTENSION);


        if (!is_string($name)) {
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Enter a valid name
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } elseif (!is_string($description)) {
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Enter a valid description
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } elseif (!is_numeric($price)) {
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Enter a valid price (should be numeric).
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } elseif (!in_array($imgex, $extensions)) {
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Enter a valid extension
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            // Update query
            $edit = "UPDATE `product`
                     SET `name` = '$name',
                         `description` = '$description',
                         `image` = '$imgname',
                         `price` = '$price'
                     WHERE `ID` = '$id'";

            $runedit = mysqli_query($conn, $edit);
           
            if ($runedit) {
                echo '
                <div class="alert alert-success"><b>Product updated successfully!</b></div>
                ';
            } else {
                echo "<p>Error updating product: " . mysqli_error($conn) . "</p>";
            }
        }
    }
} else {
    echo "<p>Invalid request: Product ID not specified.</p>";
}
?>



<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">


            <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                
          
                <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control" id="name" name = "name">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price:</label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>

                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "description"></textarea>
                </div>

                <div class="mb-3">
                <label for="formFile" class="form-label">Image:</label>
                <input class="form-control" type="file" id="formFile" name="image">
                </div>

                <div class="col-lg-3">
                        <img src="images/one.jpg" class="card-img-top">
                        </div>
              
                <center><button on type="submit" class="btn btn-primary" id="<?php echo $product[$id]?>" name="submit">Add</button></center>
            </form>
                    
        </div>
    </div>
</div>



<?php include 'inc/footer.php'; ?>