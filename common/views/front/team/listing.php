<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/menu.php';?>
<div class="row">
    <form action="index.php"  method="get" class="form-inline">
        <input type="hidden" name="c" value="teams" />
        <input type="hidden" name="m" value="index" />
        <div class="col-sm-3">
            <label>Подредо по <select size="1" name="filter" aria-controls="DataTables_Table_0" >
                    <option value="team_name ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='team_name ASC')?'selected': ''?> >Име възходящо</option>
                    <option value="team_name DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='team_name DESC')?'selected': ''?>>Име низходяшо</option>

                </select>
            </label>
        </div>
        <div class="col-sm-3">
            <label>Избери Страна
                <select size="1" name="country_id" aria-controls="DataTables_Table_0" >
                    <option value="0"  ><--Избери страна--></option>
                    <?php foreach($countrys as $country) : ?>
                        <option value="<?php echo $country->getid() ?> " <?php echo isset($_GET['country_id'])&&(int)$_GET['country_id']==$country->getid()?'selected': ''?> ><?php echo $country->getCountryName()?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <div class="col-sm-3">
            <div class="dataTables_filter" id="DataTables_Table_0_filter">
                <label>Search: <input type="text" aria-controls="DataTables_Table_0" name="pattern" value="<?php echo $pattern ?>">
                </label>
            </div>
        </div>
        <div class="col-sm-3">
            <label>Подредо по <select size="1" name="filter" aria-controls="DataTables_Table_0" >
                    <option value="team_name ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='team_name ASC')?'selected': ''?> >Име възходящо</option>
                    <option value="team_name DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='team_name DESC')?'selected': ''?>>Име низходяшо</option>

                </select>
            </label>
        </div>
        <div class="row-fluid">
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
            <button class="btn align-right" type="submit" name="">Filter</button>
        </div>
    </form>
</div>
<div class="row">
    <?php $countryId=0;
           $openTag=false;
    ?>
    <?php foreach($teams as $team) :?>
        <?php if($team->getCountryId()!=$countryId){
            if($openTag){
                echo '</div>';
            }
            echo '<hr>';
            echo '<h3>'.$team->getCountryName().'</h3>';
            $countryId=$team->getCountryId();
            echo '<div class="row">';
            $openTag=true;
        }?>
        <div class="col-sm-3">
            <div class="thumbnail">
                <img src="<?php echo $team->getImage()?>" alt="...">
                <div class="caption">
                    <a href="index.php?c=teams&m=single&id=<?php echo $team->getId()?>"> <h4><?php echo $team->getTeamName()?></h4></a>
            </div>
        </div>
        </div>

    <?php endforeach;?>

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