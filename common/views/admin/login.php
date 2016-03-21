<?php require_once 'include/header.php'; ?>

<div class="row-fluid">
    <div class="login-box">
        <div class="icons">
            <a href="index.html"><i class="halflings-icon home"></i></a>
            <a href="#"><i class="halflings-icon cog"></i></a>
        </div>
        <h2>Login to your account</h2>
        <?php

        if(array_key_exists('login', $errors)) { ?>
            <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong><?php  echo $errors['login']; ?></strong>
            </div>
        <?php }
        ?>
        <form class="form-horizontal" action="index.php?c=login&m=login" method="post">
            <fieldset>

                <div class="input-prepend" title="Username">
                    <span class="add-on"><i class="halflings-icon user"></i></span>
                    <input class="input-large span10" name="login" id="username" type="text" placeholder="type username"/>
                </div>
                <div class="clearfix"></div>

                <div class="input-prepend " title="Password">
                    <span class="add-on"><i class="halflings-icon lock"></i></span>
                    <input class="input-large span10" name="pass" id="password" type="password" placeholder="type password"/>
                </div>
                <div class="clearfix"></div>

                <label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>

                <div class="button-login">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="clearfix"></div>
        </form>
        <hr>
        <h3>Forgot Password?</h3>
        <p>
            No problem, <a href="#">click here</a> to get a new password.
        </p>
    </div><!--/span-->
</div><!--/row-->
<?php require_once 'include/footer.php'; ?>
