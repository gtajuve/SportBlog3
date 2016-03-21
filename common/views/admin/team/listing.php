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
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Teams</h2>

            </div>

            <div class="box-content">
                <div class="row-fluid">
                    <form action="index.php"  method="get" class="form-inline">
                        <input type="hidden" name="c" value="team" />
                        <input type="hidden" name="m" value="index" />
                        <div class="span3">
                            <label>Подредо по <select size="1" name="filter" aria-controls="DataTables_Table_0" >
                                    <option value="team_name ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='team_name ASC')?'selected': ''?> >Име възходящо</option>
                                    <option value="team_name DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='team_name DESC')?'selected': ''?>>Име низходяшо</option>

                                </select>
                            </label>
                        </div>
                        <div class="span3">
                            <label>Избери Страна
                                <select size="1" name="country_id" aria-controls="DataTables_Table_0" >
                                    <option value="0"  ><--Избери страна--></option>
                                    <?php foreach($countrys as $country) : ?>
                                        <option value="<?php echo $country->getid() ?> " <?php echo isset($_GET['country_id'])&&(int)$_GET['country_id']==$country->getid()?'selected': ''?> ><?php echo $country->getCountryName()?></option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                        </div>
                        <div class="span3">
                            <div class="dataTables_filter" id="DataTables_Table_0_filter">
                                <label>Search: <input type="text" aria-controls="DataTables_Table_0" name="pattern" value="<?php echo $pattern ?>">
                                </label>
                            </div>
                        </div>
                        <div class="span3">
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
                <?php
                if (isset($_SESSION['flashMessage'])) {
                    echo $_SESSION['flashMessage'];
                    unset($_SESSION['flashMessage']);
                }
                ?>

                <a href="index.php?c=team&m=create" class="btn btn-large btn-success pull-right">Create new team</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Stadium</th>
                        <th>Country</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($teams as $team): ?>
                        <tr>
                            <td class="center"><img src="<?php echo $team->getImage(); ?>" alt="" height="50px" width="50px"></td>
                            <td class="center"><?php echo $team->getTeamName()?></td>
                            <td class="center"><?php echo $team->getAddress(); ?></td>
                            <td class="center"><?php echo $team->getCountryName(); ?></td>
                            <td class="center">

                                <a class="btn btn-info" href="index.php?c=team&m=update&id=<?php echo  $team->getId(); ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-warning" href="index.php?c=player&m=index&team_id=<?php echo $team->getId(); ?>">
                                    <i class="halflings-icon list"></i>
                                </a>
                                <a class="btn btn-success" href="index.php?c=team&m=images&id=<?php echo $team->getId(); ?>">
                                    <i class="halflings-icon camera"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?c=team&m=delete&id=<?php echo $team->getId(); ?>">
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
