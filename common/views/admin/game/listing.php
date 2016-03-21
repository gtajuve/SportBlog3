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
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Games</h2>
                <div class="box-icon">

                </div>
            </div>
            <div class="box-content">
                <div class="row-fluid">
                    <form action="index.php"  method="get" class="form-inline">
                        <input type="hidden" name="c" value="game" />
                        <input type="hidden" name="m" value="index" />

                        <div class="span4">

                            <label>Избери Отбор:
                                <select data-placeholder="Избери Отбор" name="team_id1" id="selectError2" data-rel="chosen">
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
                                        <option value="<?php echo $team->getId() ?>" <?php echo (isset($_GET['team_id1'])&&$_GET['team_id1']==$team->getId())?'selected': ''?> ><?php echo $team->getTeamName()?></option>

                                    <?php endforeach; ?>

                                </select> </label>
                            <label>Избери Отбор:
                                <select size="1" name="team_id2" aria-controls="DataTables_Table_0" >
                                    <option value="" ><--Избери отбор--></option>
                                    <?php foreach($teams as $team):?>

                                        <option value="<?php echo $team->getId()?>" <?php echo (isset($_GET['team_id2'])&&$_GET['team_id2']==$team->getId())?'selected': ''?> "><?php echo $team->getTeamName()?></option>

                                    <?php endforeach; ?>
                                </select> </label>



                        </div>

                        <div class="span4">


                            <label>Подредо по <select size="1" name="filter" aria-controls="DataTables_Table_0" >
                                    <option value="date_play ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='date_play ASC')?'selected': ''?> >Дата възходящо</option>
                                    <option value="date_play DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='date_play DESC')?'selected': ''?>>Дата низходяшо</option>

                                </select></label>
                            <button type="submit" class="btn btn-default" name="sort">Покажи</button>


                        </div>
                        <div class="control-group">

                            <input type="hidden" name="page" value="<?php echo $page; ?>" />
                            <div class="controls">
                                <select id="selectError3" name="perPage">
                                    <option value="0" <?php echo ($perPageSelect == 0)? "selected" : " " ?>>-- Select Order --</option>
                                    <option value="1" <?php echo ($perPageSelect == 1)? "selected" : " " ?>>5 per page</option>
                                    <option value="2" <?php echo ($perPageSelect == 2)? "selected" : " " ?>>10 per page</option>
                                    <option value="3" <?php echo ($perPageSelect == 3)? "selected" : " " ?>>20 per page</option>
                                    <option value="4" <?php echo ($perPageSelect == 4)? "selected" : " " ?>>50 per page</option>
                                </select>
                            </div>
                        </div>
                    </form>

                    <div class="span10">

                        <a href="index.php?c=game&m=create" class="btn btn-large btn-success pull-right">Create new game</a>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12">

                    </div>
                </div>
                <?php
                if (isset($_SESSION['flashMessage'])) {
                    echo $_SESSION['flashMessage'];
                    unset($_SESSION['flashMessage']);
                }
                ?>


                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Home Team</th>
                        <th>Result</th>
                        <th>Away Team</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($games as $game): ?>
                        <tr>

                            <td class="center"><?php echo date('Y-F-d',(int)$game->getDatePlay())?></td>
                            <td class="center"><?php echo $game->getHomeTeam()?></td>
                            <td class="center"><a href="index.php?c=roster&m=index&id=<?php echo $game->getId() ?>"><?php echo $game->getScore() ?></a></td>
                            <td class="center"><?php echo $game->getAwayTeam() ?></td>
                            <td class="center">

                                <a class="btn btn-info" href="index.php?c=game&m=update&id=<?php echo $game->getId(); ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-info" href="index.php?c=roster&m=create&id=<?php echo $game->getId(); ?>">
                                    <i class="halflings-icon file"></i>
                                </a>
                                <a class="btn btn-danger" href=index.php?c=game&m=delete&id=<?php echo $game->getId(); ?>">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?c=roster&m=update&id=<?php echo $game->getId(); ?>">
                                    <i class="halflings-icon user"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?c=roster&m=delete&id=<?php echo $game->getId(); ?>">
                                    <i class="halflings-icon off"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
            <?php
            echo $pagination->create();
            ?>
        </div><!--/span-->
    </div><!--/row-->
    <?php require_once __DIR__.'/../include/footer.php';

?>
