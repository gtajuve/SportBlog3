
<div class="row">
    <div class="col-md-12">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <a class="navbar-brand" href="index.php?c=user">Football</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo ($title=='index')?'active':''?>"><a href="index.php?c=user">Home <span class="sr-only">(current)</span></a></li>
                        <?php if($this->isLog()): ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Your Favorite Teams <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <?php foreach($userteams as $team) : ?>
                                <li><a href="index.php?c=teams&m=single&id=<?php echo $team->getTeamId() ?>"><?php echo $team->getTeamName();?></a></li>
                                <?php endforeach; ?>
                             </ul>
                        </li>
                            <li class=""><a href="index.php?c=user&m=add">Add Favorite Team <span class="sr-only">(current)</span></a></li>
                            <?php if(isset($_GET['id'])): ?>
                                <li class=""><a href="index.php?c=blog&m=index&id=<?php echo $_GET['id'] ?>">Message Board <span class="sr-only">(current)</span></a></li>
                                <li class=""><a href="index.php?c=image&m=index&id=<?php echo $_GET['id'] ?>">Gallery <span class="sr-only">(current)</span></a></li>
                            <?php endif ;?>
                        <?php endif ;?>

                        <?php if(!$this->isLog()): ?>


                        <li class=""><a href="index.php?c=teams">Teams <span class="sr-only">(current)</span></a></li>

                        <li class=""><a href="index.php?c=players">Players <span class="sr-only">(current)</span></a></li>
                        <li class=""><a href="index.php?c=games">Games <span class="sr-only">(current)</span></a></li>
                        <?php endif ;?>


                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <?php echo  $this->isLog() ?  '<li class=""><a href="profile.php">Здравей '.$_SESSION['user']->getUsername().' <li class=""><a href="index.php?c=login&m=logout">Logout</a></li><span class="sr-only">(current)</span></a></li>': '<li class=""><a href="index.php?c=login&m=login">Login <span class="sr-only">(current)</span></a></li>'?>



                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>
