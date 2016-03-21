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
                <h2><i class="halflings-icon white align-justify"></i><span class="break"></span>Users</h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
                </div>
            </div>


            <div class="box-content">
                <div class="row-fluid">
                    <form action="index.php"  method="get" class="form-inline">
                        <input type="hidden" name="c" value="user" />
                        <input type="hidden" name="m" value="index" />

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
                <?php
                if (isset($_SESSION['flashMessage'])) {
                    echo $_SESSION['flashMessage'];
                    unset($_SESSION['flashMessage']);
                }
                ?>

                <a href="index.php?c=user&m=create" class="btn btn-large btn-success pull-right">Create new user</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>gender</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?php echo $user->getUsername(); ?></td>
                            <td class="center"><?php echo $user->getEmail(); ?></td>
                            <td class="center"><?php echo $user->getGender(); ?></td>
                            <td class="center">

                                <a class="btn btn-info" href="index.php?c=user&m=update&id=<?php echo $user->getId(); ?>">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href=index.php?c=user&m=delete&id=<?php echo $user->getId(); ?>">
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
