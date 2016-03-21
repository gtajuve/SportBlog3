<?php require_once __DIR__.'/include/header.php'; ?>
<?php require_once __DIR__.'/include/menu.php';?>



    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?php if(isset($_POST['login'])&&!empty($errors)){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php foreach($errors as $error){
                        echo $error;
                    }?>
                </div>
            <?php }; ?>
            <form action="index.php?c=login&m=login" method="post">
                <div class="form-group">
                    Login:<input required type="text" name="login" class="form-control" placeholder="Login">
                    Pass:<input  required type="password" name="pass" class="form-control" placeholder="Password">
                    <input type="submit" class='btn-primary' value="Login">
                    or
                    <a href="index.php?c=login&m=registration">Registration</a>
                </div>
            </form>

        </div>
        <div class="col-md-4"></div>
    </div>
<?php require_once __DIR__.'/include/footer.php'; ?>