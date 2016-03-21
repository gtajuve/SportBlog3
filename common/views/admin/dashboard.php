<?php require_once __DIR__.'/include/header.php'; ?>
<?php require_once __DIR__.'/include/sidebar.php'; ?>


<noscript>
    <div class="alert alert-block span10">
        <h4 class="alert-heading">Warning!</h4>
        <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
    </div>
</noscript>

<!-- start: Content -->
<div id="content" class="span10">


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Dashboard</a></li>
    </ul>

    <div class="row-fluid">

        <div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
            <div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
            <div class="number"><?php echo $numUsers ?><i class="icon-arrow-up"></i></div>
            <div class="title">Users</div>
            <div class="footer">
                <a href="users.php"> read full report</a>
            </div>
        </div>
        <div class="span3 statbox green" onTablet="span6" onDesktop="span3">
            <div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
            <div class="number"><?php echo $numTeams ?><i class="icon-arrow-up"></i></div>
            <div class="title">Teams</div>
            <div class="footer">
                <a href="teams.php"> read full report</a>
            </div>
        </div>
        <div class="span3 statbox blue noMargin" onTablet="span6" onDesktop="span3">
            <div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
            <div class="number"><?php echo $numPlayers ?><i class="icon-arrow-up"></i></div>
            <div class="title">Players</div>
            <div class="footer">
                <a href="players.php"> read full report</a>
            </div>
        </div>
        <div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
            <div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
            <div class="number"><?php echo $numGames ?><i class="icon-arrow-down"></i></div>
            <div class="title">Games</div>
            <div class="footer">
                <a href="games.php"> read full report</a>
            </div>
        </div>

    </div>

<?php
require_once __DIR__.'/include/footer.php';
?>
