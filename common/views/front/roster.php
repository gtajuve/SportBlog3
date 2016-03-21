<?php require_once __DIR__.'/include/header.php'; ?>
<?php require_once __DIR__.'/include/menu.php';?>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-3">


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
            <div class="col-md-3">
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

        <div class="col-md-4"></div>
    </div>



<?php require_once __DIR__.'/include/footer.php'; ?>