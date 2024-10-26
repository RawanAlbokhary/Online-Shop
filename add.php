<?php include 'inc\header.php';
include 'dbConnection.php';?>


<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
<?php

if(isset($_POST['submit'])){

extract($_POST);

if($name==""||$description==""||$price==""){

    echo'
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    All inputs are required
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close" ></button>
    </div>';
}
if(!is_string($name)){
    echo'
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    enter a valid name
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close" ></button>
    </div>';

}
if(!is_string($description)){
    echo'
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    enter a valid description
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close" ></button>
    </div>';

}
if(!is_numeric($price)){
    echo'
    <div class="alert alert-warning alert-disissible fade show" role="alert">
    enter a valid price(should be numeric).
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close" ></button>

    </div>';
}
$extensions=['jpg','png','jfif'];
$img=$_FILES['image'];
$imgname=$img['name'];
$imgtemp=$img['tmp_name'];
$imgex=pathinfo($imgname,PATHINFO_EXTENSION);

if(!in_array($imgex,$extensions)){
   echo '
    <div class="alert alert-warning alert-disissible fade show" role="alert">
    Enter a valid extension
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close" ></button>

    </div>';
}
else{

$addproduct="INSERT INTO product(`name`,`description`,`price`,`image`)VALUES('$name','$description','$price','$imgname')";
$runaddinsert=mysqli_query($conn,$addproduct);

if (!$runaddinsert) {
    echo "Error: " . mysqli_error($conn);
}

}

}

?>

            <form action="add.php" method="post" enctype="multipart/form-data">
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

                <center><button on type="submit" class="btn btn-primary" name="submit">Add</button></center>
            </form>
        </div>
    </div>
</div>


<?php include 'inc/footer.php'; ?>