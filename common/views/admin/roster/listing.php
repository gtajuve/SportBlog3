<?php
require_once __DIR__.'/../include/header.php';
require_once __DIR__.'/../include/sidebar.php';
?>

<div id="content" class="span10">
    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.php">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Dashboard</a></li>
    </ul>


    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header">
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Game Roster</h2>
                <div class="box-icon">

                </div>
            </div>
            <div class="box-content">



                <div class="row-fluid">
                    <div class="span6">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><?php echo $game->getHomeTeam(); ?></th>
                                <th><?php echo $game->getScore() ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($gameInfo as $player): ?>
                                <tr>
                                    <?php
                                    if($player->getTeamId()==$game->getHomeTeamId()){
                                        echo '<td>'.$player->getFullName().'</td><td>';
                                        if($player->getGoalsOngame()>0){
                                            echo $player->getGoalsOngame().' goal';
                                            echo $player->getGoalsOngame()>1?'s':'';
                                        }
                                        echo '</td>';
                                    }
                                    ?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="span6">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><?php echo $game->getAwayTeam() ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($gameInfo as $player): ?>
                                <tr>
                                    <?php
                                    if($player->getTeamId()==$game->getAwayTeamId()){
                                        echo '<td>'.$player->getFullName().'</td><td>';
                                        if($player->getGoalsOngame()>0){
                                            echo $player->getGoalsOngame().' goal';
                                            echo $player->getGoalsOngame()>1?'s':'';
                                        }
                                        echo '</td>';
                                    }
                                    ?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <a href="index.php?c=roster&m=update&id=<?php echo $gameId?>" class="btn btn-large btn-success pull-right">Change roster</a>
                </div>
            </div>
        </div><!--/span-->
    </div><!--/row-->









    <?php require_once __DIR__.'/../include/footer.php'; ?>

