<?php
require_once __DIR__.'/../include/header.php';
require_once __DIR__.'/../include/sidebar.php';
?>
<div id="content" class="span10" style="min-height: 912px;">


    <ul class="breadcrumb">
        <li>

            <a href="teams.php">Team</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Add Team</a>
        </li>
    </ul>



    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon white edit"></i><span class="break"></span>Add Team</h2>

            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" action="index.php?c=team&m=create">
                    <fieldset>

                        <div class="control-group <?php  echo key_exists('name',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Име</label>
                            <div class="controls">
                                <input type="text" id="inputError"name="name" value="<?php echo $inputData['team_name']?>">
                                <span class="help-inline"><?php  echo key_exists('name',$errors)?$errors['name']:''?></span>
                            </div>
                        </div>

                        <div class="control-group <?php  echo key_exists('image',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Снимка</label>
                            <div class="controls">
                                <input type="text" id="inputError" name="image" value="<?php echo $inputData['image']?>">
                                <span class="help-inline"><?php  echo key_exists('image',$errors)?$errors['image']:''?></span>
                            </div>
                        </div>

                        <div class="control-group <?php  echo key_exists('address',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Стадион</label>
                            <div class="controls">
                                <input type="text" id="inputError" name="address" value="<?php echo ($inputData['address'])?>">
                                <span class="help-inline"><?php  echo key_exists('address',$errors)?$errors['address']:''?></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError3">Страна</label>
                            <div class="controls">
                                <select name="country_id" id=selectError3" name="country">
                                    <option value="">-- Избери Страна--</option>
                                    <?php foreach($countrys as $country):?>

                                        <option value="<?php echo $country->getId() ?>" <?php echo ($country->getId()==$inputData['country_id']?'selected':'') ?> ><?php echo $country->getCountryName() ?></option>

                                    <?php endforeach; ?>
                                </select>
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


