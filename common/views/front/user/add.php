<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/menu.php';?>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">

        <form action="index.php?c=user&m=add" method="post">
            <div class="form-group">
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
                <input type="submit" class='btn-primary' value="Добави любим отбор" name="add">

            </div>
        </form>

    </div>
    <div class="col-md-4"></div>
</div>
<?php require_once __DIR__.'/../include/footer.php'; ?>