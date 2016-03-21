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
                <form class="form-horizontal" method="post" action="index.php?c=roster&m=create&id=<?php echo $gameId?>">
                    <fieldset>
                        <div class="form-group">
                            <div class="span6">
                                <p><?php echo $game->getHomeTeam() ?></p>
                                <?php foreach($playersHT as $playerHT) : ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="playersHT[]" value="<?php echo $playerHT->getId() ?>" > <?php echo $playerHT->getFullName() ?>
                                        </label>
                                    </div>
                                    <label for="">Goals</label>
                                    <input type="number" class="form-control" name="goalsHT<?php  echo $playerHT->getId() ?>" value=0 >
                                <?php endforeach ; ?>
                            </div>
                            <div class="span6">
                                <p><?php echo $game->getAwayTeam() ?></p>
                                <?php foreach($playersAT as $playerAT) : ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="playersAT[]" value="<?php echo $playerAT->getId() ?>" > <?php echo $playerAT->getFullName() ?>
                                        </label>
                                    </div>
                                    <label for="">Goals</label>
                                    <input type="number" class="form-control" name="goalsAT<?php  echo $playerAT->getId() ?>" value=0 >
                                <?php endforeach ; ?>
                            </div>


                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" name="submitPlayers">Save</button>
                                <button class="btn">Cancel</button>
                            </div>
                    </fieldset>
                </form>

            </div>
        </div><!--/span-->

    </div><!--/row-->




</div>

<?php require_once __DIR__.'/../include/footer.php'; ?>
