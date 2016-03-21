
<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/menu.php';?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $player->getImage() ?>" alt="" class="img-thumbnail">
            </div>
            <div class="col-md-6">
                <h3><?php echo $player->getFullName()?></h3>
                <h4>Националност:<?php echo $player->getCountry()?></h4>
                <h4>Позиция:<?php echo $player->getPositionPlayer()?></h4>
            </div>
        </div>

        <div class="row border">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Отбор</th>
                    <th><a href="index.php?c=teams&m=single&f=1&id=<?php echo $teamId?>">Мачове</a> </th>
                    <th><a href="index.php?c=teams&m=single&f=2&id=<?php echo $teamId?>">Голове</a></th>
                </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><?php echo $player->getTeamName()?></td>
                            <td><?php echo $player->getGames()?></td>
                            <td><?php echo $player->getGoals()?></td>
                        </tr>

                </tbody>

            </table>

        </div>

    </div>
    <div class="col-md-2"></div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>