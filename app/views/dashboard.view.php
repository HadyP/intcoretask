<?php
session_start();
?>
<?php require('partial/head.php'); ?>

<?php
    error_reporting(0);
    if($_SESSION['in']=="yes"){
        echo('
        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <strong>Thank you for your regestration!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>'
        );

    }
?>

<div class="card formdidv" >

    <div class="row">
        <div class="col-sm-4">
            <img src="public/images/<?= $_SESSION["user_photo"] ?>" class="Image_user" alt="Profile_Picture">

            <form action="/update_photo" method="POST" enctype="multipart/form-data">
                <div class="col-sm-10" style="margin-top: 10px ;">
                    <div class="form-group row">
                        <label for="user_photo" style="margin-right: 40px ;" class="col-sm-6 col-form-label">profile photo</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="user_photo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="submit" name="submit" class="btn btn-primary" value="Edit"  />
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form action="/update_name" method="POST">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name" value="<?= $_SESSION["name"] ?>">
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-primary" value="Edit" />
                    </div>
                </div>
            </form>

            <form action="/update_email" method="POST">
                <div class="form-group row">
                    <label for="name" class="col-sm-4 col-form-label">email:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="email" value="<?= $_SESSION["email"] ?>">
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-primary" value="Edit" />
                    </div>
                </div>
            </form>

            <form action="/update_password" method="POST">
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">password:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="password" placeholder="Cahnge your password">
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" name="submit" class="btn btn-primary" value="Edit" />
                    </div>
                </div>
            </form>

        </div>

        <div class="col-sm-2">
            <a href="/logout" class="btn btn-primary" style="color:white; text-decoration: none;">Log Out</a>
        </div>
    </div>


</div>

<?php require('partial/footer.php'); ?>