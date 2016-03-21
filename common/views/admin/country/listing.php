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
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Countries</h2>

            </div>
            <?php if(isset($_GET['id'])) {?>
            <div class="box-content">
                <div class="row-fluid">
                    <div class="span12">
                        <form action="index.php?c=country&m=index&id=<?php echo $_GET['id'] ?>" method="post"  class="form-horizontal">
                            <fieldset>
                                <div class="control-group <?php  echo key_exists('name',$errors)?'error':''?>">
                                    <label class="control-label" for="inputError">Name</label>
                                    <div class="controls">
                                        <input type="text" id="inputError" name="name" value="<?php echo isset($inputData['country_name'])?$inputData['country_name']:'' ?>" placeholder="Name" >
                                        <span class="help-inline"><?php  echo key_exists('name',$errors)?$errors['name']:''?></span>
                                        <input type="submit" name="change" value="Change Name" class="btn btn-primary"/>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>
                <?php }else { ?>
                <div class="box-content">
                    <div class="row-fluid">
                        <div class="span12">
                            <form action="index.php?c=country&m=index" method="post"  class="form-horizontal">
                                <fieldset>
                                    <div class="control-group <?php  echo key_exists('name',$errors)?'error':''?>">
                                        <label class="control-label" for="inputError">Name</label>
                                        <div class="controls">
                                            <input type="text" id="inputError" name="name" value="<?php echo isset($inputData['country_name'])?$inputData['country_name']:'' ?>" placeholder="Name" >
                                            <span class="help-inline"><?php  echo key_exists('name',$errors)?$errors['name']:''?></span>
                                            <input type="submit" name="addcountry" value="Add Country" class="btn btn-primary"/>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>

                    </div>
                    <?php } ?>
                    <div class="row-fluid">
                        <form action="index.php" method="get"  class="form-horizontal">
                            <input type="hidden" name="c" value="country" />
                            <input type="hidden" name="m" value="index" />
                            <fieldset>
                                <div class="span4">
                                    <select size="1" name="filter" aria-controls="DataTables_Table_0" >
                                        <option value="0" >-->Подреди по<---</option>
                                        <option value="country_name ASC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='country_name ASC')?'selected': ''?> >Име възходящо</option>
                                        <option value="country_name DESC" <?php echo (isset($_GET['filter'])&&$_GET['filter']=='country_name DESC')?'selected': ''?>>Име низходяшо</option>

                                    </select>

                                </div>
                                <div class="span4">

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
                                <div class="span4">

                                    <input type="text" aria-controls="DataTables_Table_0" placeholder="Търси по име" name="pattern" value="<?php echo $pattern ?>">

                                </div>
                                <button class="btn align-right" type="submit" name="">Filter</button>
                            </fieldset>
                        </form>

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
                            <th>Countries</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($countries as $country): ?>
                            <tr>

                                <td class="center"><?php echo $country->getCountryName()?></td>

                                <td class="center">

                                    <a class="btn btn-info" href="index.php?c=country&m=index&id=<?php echo $country->getId(); ?>">
                                        <i class="halflings-icon white edit"></i>
                                    </a>

                                    <a class="btn btn-danger" href="index.php?c=country&m=delete&id=<?php echo $country->getId(); ?>">
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




        <?php require_once __DIR__.'/../include/footer.php'; ?>

