
<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/menu.php';?>
<div class="row">
    <div class="col-md-12">
    <form action="index.php"  method="get" class="form-inline">
        <input type="hidden" name="c" value="games" />
        <input type="hidden" name="m" value="index" />

        <div class="col-md-4">

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

        <div class="col-md-4">


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
    </div>
</div>
<hr>
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
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <?php
        echo $pagination->create();
        ?>
    </div>
    <div class="col-md-4"></div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>