<?php
require_once __DIR__.'/../include/header.php';
require_once __DIR__.'/../include/sidebar.php';
?>
<div id="content" class="span10" style="min-height: 912px;">


    <ul class="breadcrumb">
        <li>

            <a href="games.php">Games</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="#">Edit Game</a>
        </li>
    </ul>



    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon white edit"></i><span class="break"></span>Edit Game</h2>

            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" action="index.php?c=game&m=create">
                    <fieldset>
                        <div class="control-group  <?php  echo key_exists('teams',$errors)?'error':''?>">
                            <label class="control-label" for="selectError3">Домакин</label>
                            <div class="controls">
                                <select name="home_team_id" id=selectError3" >
                                    <option value="">-- Избери Отбор--</option>
                                    <?php foreach($teams as $team):?>

                                        <option value="<?php echo $team->getId() ?>" <?php echo ($team->getId()==$inputData['home_team_id']?'selected':'') ?> ><?php echo $team->getTeamName() ?></option>

                                    <?php endforeach; ?>
                                </select>
                                <span class="help-inline"><?php  echo key_exists('teams',$errors)?$errors['teams']:''?></span>
                            </div>
                        </div>
                        <div class="control-group  <?php  echo key_exists('teams',$errors)?'error':''?>">
                            <label class="control-label" for="selectError3">Гост</label>
                            <div class="controls">
                                <select name="away_team_id" id=selectError3" >
                                    <option value="">-- Избери Отбор--</option>
                                    <?php foreach($teams as $team):?>

                                        <option value="<?php echo $team->getId() ?>" <?php echo ($team->getId()==$inputData['away_team_id']?'selected':'') ?> ><?php echo $team->getTeamName() ?></option>

                                    <?php endforeach; ?>
                                </select>
                                <span class="help-inline"><?php  echo key_exists('teams',$errors)?$errors['teams']:''?></span>
                            </div>
                        </div>

                        <div class="control-group <?php  echo key_exists('home_score',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Home Score</label>
                            <div class="controls">
                                <input type="number" id="inputError" name="home_score" value="<?php echo $inputData['home_score'] ?>">
                                <span class="help-inline"><?php  echo key_exists('home_score',$errors)?$errors['home_score']:''?></span>
                            </div>
                        </div>

                        <div class="control-group <?php  echo key_exists('away_score',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Guest Score</label>
                            <div class="controls">
                                <input type="number" id="inputError" name="away_score" value="<?php echo $inputData['away_score'] ?>">
                                <span class="help-inline"><?php  echo key_exists('away_score',$errors)?$errors['away_score']:''?></span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary" name="change">Save changes</button>
                            <button class="btn">Cancel</button>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->

</div>

<?php require_once __DIR__.'/../include/footer.php';

?>

