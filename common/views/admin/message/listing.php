<?php
require_once __DIR__.'/../include/header.php';
require_once __DIR__.'/../include/sidebar.php';
?>
<div id="content" class="span10" style="min-height: 912px;">


    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.html">Home</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Messages</a></li>
    </ul>

    <div class="row-fluid">

        <div class="span12">
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header">
                        <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Teams</h2>

                    </div>

                    <div class="box-content">
                        <div class="row-fluid">
                            <form action="index.php"  method="get" class="form-inline">
                                <input type="hidden" name="c" value="message" />
                                <input type="hidden" name="m" value="index" />
                                <div class="span3">
                                    <select size="1" name="filter" aria-controls="DataTables_Table_0" >
                                        <option value="0">Подреди</option>
                                        <option value="reg_time ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='reg_time ASC')?'selected': ''?> >Време на публикуване Въз</option>
                                        <option value="reg_time DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='reg_time DESC')?'selected': ''?>>Време на публикуване Низ</option>

                                    </select>

                                </div>
                                <div class="span3">

                                    <select size="1" name="user_id" aria-controls="DataTables_Table_0" >
                                        <option value="0"  ><--Избери потребител--></option>
                                        <?php foreach($users as $user) : ?>
                                            <option value="<?php echo $user->getid() ?> " <?php echo isset($_GET['user_id'])&&(int)$_GET['user_id']==$user->getid()?'selected': ''?> ><?php echo $user->getUsername()?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <div class="span3">

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
                                <div class="span3">
                                    <div class="dataTables_filter" id="DataTables_Table_0_filter">
                                        <label>Search: <input type="text" aria-controls="DataTables_Table_0" name="pattern" value="<?php echo $pattern ?>">
                                        </label>
                                    </div>
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
                        <h1>Messages</h1>


                        <ul class="messagesList">
                            <?php foreach($messages as $message): ?>
                                <li>
                                    <span class="from"> <?php echo $message->getUsername()?> </span><span class="title"> <?php echo $message->getTeamName()?> </span><span class="title"> <?php echo substr($message->getTitle(),0,40); ?></span><span class="date"><b></b><?php echo date('Y-F-d',(int)$message->getRegTime())?></b></span>
                                </li>

                            <?php endforeach ;?>


                        </ul>
                        <?php
                        echo $pagination->create();
                        ?>
                    </div>


                </div>



            </div>

<?php require_once __DIR__.'/../include/footer.php';

?>
