<?php require_once __DIR__.'/include/header.php'; ?>
<?php require_once __DIR__.'/include/menu.php';?>
    <div class="row">
        <?php foreach ($games as $game) : ?>
            <div class="col-md-3"></div>
            <div class="col-md-2"><img src="<?php echo $game->getHomeImage()?>" alt="" height="75px"></div>
            <div class="col-md-3"><h5><a href="index.php?c=roster&id=<?php echo $game->getId()?>"><?php echo $game->getHomeTeam().'   '.$game->getScore().'   '.$game->getAwayTeam()?></a></h5></div>
            <div class="col-md-2"><img src="<?php echo $game->getAwayImage()?>" alt="" height="75px"></div>
            <div class="col-md-2"></div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <?php foreach ($messages as $message) : ?>
                <h3><span>
                    <?php echo $message->getTeamName(); ?>
                    </span>
                </h3>
                <h3>
                    <?php echo $message->getTitle(); ?>
                </h3>
                <h5>
                    <?php echo 'Post by '.$message->getUsername().' on '.date('Y-F-d h:i',(int)$message->getRegTime()); ?>
                </h5>
                <p>
                    <?php echo $message->getMessage() ?>
                </p>
            <?php endforeach; ?>
        </div>
        <div class="col-md-2"></div>
    </div>
<?php require_once __DIR__.'/include/footer.php'; ?>