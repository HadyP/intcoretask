<?php
session_start();
?>
<?php require('partial/head.php'); ?>

<?php
error_reporting(0);
if($_SESSION['out']=="yes"){
    echo (
        "<div class='alert alert-dark alert-dismissible fade show' role='alert'>
        <strong>You have been logged out successfuly!</strong>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>"
    );
    session_start();
    session_destroy();
}
?>

<div class="card formdidv" >

    <div class="row">

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <?php
                    error_reporting(0);
                    if($_SESSION['error']!= ""){

                        echo ('
                            <div class="alert alert-danger" role="alert">'
                            .$_SESSION['error'].'
                            </div>'
                        );
                        session_start();
                        session_destroy();


                    }
                    ?>
                    <form action="/store_user" method="POST" enctype="multipart/form-data" claas="formmove">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="name" placeholder="Name" value=<?= $_SESSION['name'] ?> >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?=  $_SESSION['email'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_photo" class="col-sm-2 col-form-label">Choose a profile photo</label>
                            <div class="col-sm-6">
                                <input type="file" class="form-control" name="user_photo">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 offset-sm-2">
                                <input type="submit" name="submit" class="btn btn-primary" value="Sign Up" />

                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                <?php
                    error_reporting(0);
                    if($_SESSION['login_error']!= ""){

                        echo ('
                            <div class="alert alert-danger" role="alert">'
                            .$_SESSION['login_error'].'
                            </div>'
                        );
                        session_start();
                        session_destroy();
                    }
                ?>
                     <form action="/login" method="POST" claas="formmove">

                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];} else {$_SESSION['logemail'];} ?>" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['pass'])){echo $_COOKIE['pass'];}?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <label class="form-check-label"><input name="remember" type="checkbox" <?php if(isset($_COOKIE['email'])){ ?> checked <?php } ?> > Remember me</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 offset-sm-2">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>

                 </div>
            </div>
        </div>
    </div>
</div>


<?php require('partial/footer.php'); ?>

