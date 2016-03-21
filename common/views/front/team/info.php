
<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/menu.php';?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo $teamInfo->getImage() ?>" alt="" class="img-thumbnail">
            </div>
            <div class="col-md-6">
                <h3><?php echo $teamInfo->getTeamName()?></h3>
                <h4>Стадион:<?php echo $teamInfo->getAddress()?></h4>
                <h4>Държава:<?php echo $teamInfo->getCountryName()?></h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="bg-primary text-center">Последни пет мача</p>
            </div>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Домакин</th>
                    <th>Резултат</th>
                    <th>Гост</th>
                </tr>
                </thead>

                <?php
                if(!empty($games)){
                    foreach($games as $game) : ?>
                        <tr>
                            <td><?php echo date('Y-F-d h:i',(int)$game->getDatePlay())?></td>
                            <td><?php echo $game->getHomeTeam()?></td>
                            <td><a href="index.php?c=roster&m=index&id=<?php echo $game->getId() ?>"><?php echo $game->getScore()?></a></td>
                            <td><?php echo $game->getAwayTeam()?></td>

                        </tr>
                    <?php endforeach ; }?>

            </table>
            <div class="col-md-12 left">
                <a href="index.php?c=games&m=index&team_id1=<?php echo $_GET['id'] ?>">Покажи всички мачове</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="bg-info text-center">Състав</p>
            </div>

        </div>

        <div class="row border">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Снимка</th>
                    <th>Име</th>
                    <th><a href="index.php?c=teams&m=single&f=0&id=<?php echo $teamId?>">Позиция</a></th>
                    <th>Държава</th>
                    <th><a href="index.php?c=teams&m=single&f=1&id=<?php echo $teamId?>">Мачове</a> </th>
                    <th><a href="index.php?c=teams&m=single&f=2&id=<?php echo $teamId?>">Голове</a></th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($players)) {
                    foreach($players as $player) : ?>
                        <tr>
                            <td><img src="<?php echo $player->getImage() ?>" height="50px" width="50px" alt=""></td>
                            <td><a href="index.php?c=players&m=single&id=<?php echo $player->getId()?>"><?php echo $player->getFullName()?></a></td>
                            <td><?php echo $player->getPositionPlayer()?></td>
                            <td><?php echo $player->getCountry()?></td>
                            <td><?php echo $player->getGames()?></td>
                            <td><?php echo $player->getGoals()?></td>
                        </tr>
                    <?php endforeach ; }?>
                </tbody>

            </table>

        </div>

    </div>
    <div class="col-md-2"></div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>