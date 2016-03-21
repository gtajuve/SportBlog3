<?php
require_once __DIR__.'/../include/header.php';
require_once __DIR__.'/../include/sidebar.php';
?>
<div id="content" class="span10" style="min-height: 912px;">


    <ul class="breadcrumb">
        <li>

            <a href="players.php">Players</a>
            <i class="icon-angle-right"></i>
        </li>
        <li>
            <i class="icon-edit"></i>
            <a href="addplayer.php">add Player</a>
        </li>
    </ul>



    <div class="row-fluid sortable ui-sortable">
        <div class="box span12">
            <div class="box-header" data-original-title="">
                <h2><i class="halflings-icon white edit"></i><span class="break"></span>Add Player</h2>

            </div>
            <div class="box-content">
                <form class="form-horizontal" method="post" action="index.php?c=player&m=create">
                    <fieldset>

                        <div class="control-group <?php  echo key_exists('first_name',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Име</label>
                            <div class="controls">
                                <input type="text" id="inputError"name="fname" value=" <?php echo $playerInfo['first_name'] ?>">
                                <span class="help-inline"><?php  echo key_exists('first_name',$errors)?$errors['first_name']:''?></span>
                            </div>
                        </div>

                        <div class="control-group <?php  echo key_exists('last_name',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Фамилия</label>
                            <div class="controls">
                                <input type="text" id="inputError" name="lname" value=" <?php echo $playerInfo['last_name'] ?>">
                                <span class="help-inline"><?php  echo key_exists('last_name',$errors)?$errors['last_name']:''?></span>
                            </div>
                        </div>

                        <div class="control-group <?php  echo key_exists('image',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Снимка</label>
                            <div class="controls">
                                <input type="text" id="inputError" name="imagePlayer" value=" <?php echo $playerInfo['image'] ?>">
                                <span class="help-inline"><?php  echo key_exists('image',$errors)?$errors['image']:''?></span>
                            </div>
                        </div>
                        <div class="control-group <?php  echo key_exists('country',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Националност</label>
                            <div class="controls">
                                <input type="text" id="inputError" name="countryPlayer" value=" <?php echo $playerInfo['country'] ?>">
                                <span class="help-inline"><?php  echo key_exists('country',$errors)?$errors['country']:''?></span>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="selectError3">Отбор:</label>
                            <div class="controls">
                                <select data-placeholder="Избери Отбор" name="team_id" id="selectError2" data-rel="chosen">
                                    <option value=""></option>
                                    <?php foreach($teams as $team) : ?>
                                        <?php if($team->getCountryId()!=$country) {
                                            $country=$team->getCountryId();
                                            if(!$openTag){
                                                echo '<optgroup label="'.$team->getCountryName().'">';
                                                $openTag=true;
                                            }else{
                                                echo '<//optgroup>';
                                                echo '<optgroup label="'.$team->getCountryName().'">';
                                                $openTag=true;
                                            }

                                        }
                                        ?>
                                        <option value="<?php echo $team->getId() ?>" <?php echo ($playerInfo['team_id']==$team->getId())?'selected': ''?> ><?php echo $team->getTeamName()?></option>

                                    <?php endforeach; ?>

                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="selectError3">Позиция</label>
                            <div class="controls">
                                <select name="position" id=selectError3" name="country">
                                    <option value="">-- Избери Позиция--</option>
                                    <option value="G" <?php echo ("G"==$playerInfo['position_player']?'selected':'') ?> >Вратар</option>
                                    <option value="D" <?php echo ("D"==$playerInfo['position_player']?'selected':'') ?> >Защитник</option>
                                    <option value="M" <?php echo ("M"==$playerInfo['position_player']?'selected':'') ?> >Полузащитник</option>
                                    <option value="F" <?php echo ("F"==$playerInfo['position_player']?'selected':'') ?> >Нападател</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group <?php  echo key_exists('games',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Мачове</label>
                            <div class="controls">
                                <input type="number" id="inputError" name="games" value="<?php echo $playerInfo['games'] ?>">
                                <span class="help-inline"><?php  echo key_exists('games',$errors)?$errors['games']:''?></span>
                            </div>
                        </div>
                        <div class="control-group <?php  echo key_exists('goals',$errors)?'error':''?>">
                            <label class="control-label" for="inputError">Голове</label>
                            <div class="controls">
                                <input type="number" id="inputError" name="goals" value="<?php echo $playerInfo['goals'] ?>">
                                <span class="help-inline"><?php  echo key_exists('goals',$errors)?$errors['goals']:''?></span>
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

<?php
require_once __DIR__.'/../include/footer.php';

?>
