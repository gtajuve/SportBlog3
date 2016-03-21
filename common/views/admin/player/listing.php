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
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Players</h2>

            </div>
            <div class="box-content">
                <div class="row-fluid">
                    <form action="index.php"  method="get" class="form-inline">
                        <input type="hidden" name="c" value="player" />
                        <input type="hidden" name="m" value="index" />
                        <div class="span3">
                            <div class="control-group">
                                <label class="control-label" for="selectError2"></label>
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
                                            <option value="<?php echo $team->getId() ?>" <?php echo (isset($_GET['team_id'])&&$_GET['team_id']==$team->getId())?'selected': ''?> ><?php echo $team->getTeamName()?></option>

                                        <?php endforeach; ?>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="span3">

                            <label><select size="1" name="pos" aria-controls="DataTables_Table_0" >
                                    <option value=""  ><--Избери позиция--></option>
                                    <option value="G" <?php echo (isset($_GET['pos'])&&$_GET['pos']=="G")?'selected': ''?> >Вратари</option>
                                    <option value="D" <?php echo (isset($_GET['pos'])&&$_GET['pos']=="D")?'selected': ''?> >Защитници</option>
                                    <option value="M" <?php echo (isset($_GET['pos'])&&$_GET['pos']=="M")?'selected': ''?> >Полузащитници</option>
                                    <option value="F" <?php echo (isset($_GET['pos'])&&$_GET['pos']=="F")?'selected': ''?> >Нападатели</option>
                                </select> </label>


                        </div>
                        <div class="span3">
                            <label><select size="1" name="filter" aria-controls="DataTables_Table_0" >
                                    <option value="0"><-- Подреди по --></option>
                                    <option value="last_name ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='last_name ASC')?'selected': ''?> >Име възходящо</option>
                                    <option value="last_name DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='last_name DESC')?'selected': ''?>>Име низходяшо</option>
                                    <option value="games ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='games ASC')?'selected': ''?>>Мачове въз</option>
                                    <option value="games DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='games DESC')?'selected': ''?>>Мачове низ</option>
                                    <option value="goals ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='goals ASC')?'selected': ''?>>Голове въз</option>
                                    <option value="goals DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='goals DESC')?'selected': ''?>>Голове низ</option>
                                    <option value="country ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='country ASC')?'selected': ''?>>Националност виз</option>
                                    <option value="country DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='country DESC')?'selected': ''?>>Националност низ</option>
                                    <option value="position_player ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='position_player ASC')?'selected': ''?>>Позиция</option>
                                </select> </label>
                        </div>

                        <div class="span3">

                            <div class="dataTables_filter" id="DataTables_Table_0_filter">
                                <label>Search: <input type="text" aria-controls="DataTables_Table_0" name="pattern" value="<?php echo $pattern ?>">
                                </label>

                            </div>

                        </div>
                        <div class="span4">
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
                        </div>
                        <button class="btn" type="submit" name="">Покажи</button>
                    </form>
                </div>
                <?php
                if(isset($_SESSION['flashMessage'])){
                    echo $_SESSION['flashMessage'];
                    unset($_SESSION['flashMessage']);
                }
                ?>

                <a href="index.php?c=player&m=create" class="btn btn-large btn-success pull-right">Create new player</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Nationality</th>
                        <th>Team</th>
                        <th>Games</th>
                        <th>Goals</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($players as $player): ?>
                        <tr>
                            <td class="center"><img src="<?php echo $player->getImage() ?>" height="50px" width="50px" alt=""></td>
                            <td><?php echo $player->getFirstName().' '.$player->getLastName() ?></td>
                            <td class="center"><?php echo $player->getPositionPlayer() ?></td>
                            <td class="center"><?php echo $player->getCountry() ?></td>
                            <td class="center"><?php echo $player->getTeamName()?></td>
                            <td class="center"><?php echo $player->getGames() ?></td>
                            <td class="center"><?php echo $player->getGoals() ?></td>
                            <td class="center">

                                <a class="btn btn-info" href="index.php?c=player&m=update&id=<?php echo $player->getId(); ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?c=player&m=delete&id=<?php echo $player->getId(); ?>">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php
                echo $pagination->create();
                ?>
            </div>
        </div><!--/span-->
    </div><!--/row-->





    <?php
require_once __DIR__.'/../include/footer.php';

?>
