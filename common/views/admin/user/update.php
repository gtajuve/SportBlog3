<?php
require_once __DIR__.'/../include/header.php';
require_once __DIR__.'/../include/sidebar.php';
?>
<div id="content" class="span10" style="min-height: 912px;">


    <ul class="breadcrumb">
        <li>

            <a href="teams.php">User</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Add User</a>
        </li>
    </ul>



    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon white edit"></i><span class="break"></span>Add User</h2>

            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" action="index.php?c=user&m=update&id=<?php echo $_GET['id']?>">
                    <fieldset>

                        <div class="control-group <?php  echo key_exists('username',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Username</label>
                            <div class="controls">
                                <input type="text" id="inputError"name="login" value="<?php echo $inputData['username']!=''?$inputData['username']:''?>">
                                <span class="help-inline"><?php  echo key_exists('username',$errors)?$errors['username']:''?></span>
                            </div>
                        </div>


                        <div class="control-group <?php  echo key_exists('mail',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Email</label>
                            <div class="controls">
                                <input type="email" id="inputError" name="mail" value="<?php echo ($inputData['email']!=''?$inputData['email']:'')?>">
                                <span class="help-inline"><?php  echo key_exists('mail',$errors)?$errors['email']:''?></span>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Gender</label>
                            <div class="controls">
                                <label class="radio">Male
                                    <div class="radio" id="uniform-optionsRadios1"><input type="radio" name="gender" id="optionsRadios1" value="male" checked=""></div>

                                </label>
                                <div style="clear:both"></div>
                                <label class="radio">Female
                                    <div class="radio" id="uniform-optionsRadios2"><input type="radio" name="gender" id="optionsRadios2" value="female"></div>

                                </label>
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="change">Save</button>
                            <button class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->




</div>


<?php
require_once __DIR__.'/../include/footer.php';

?>

