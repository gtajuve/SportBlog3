
<?php
$title=  basename($_SERVER['PHP_SELF'],'.php');

?><!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li class="<?php echo ($title=='index')?'active':''?>"><a href="index.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
            <li class="<?php echo ($title=='users')?'active':''?>"><a href="index.php?c=user&m=index"><i class="icon-align-justify"></i><span class="hidden-tablet"> Users</span></a></li>
            <li class="<?php echo ($title=='teams')?'active':''?>"><a href="index.php?c=team&m=index"><i class="icon-align-justify"></i><span class="hidden-tablet"> Teams</span></a></li>
            <li class="<?php echo ($title=='players')?'active':''?>"><a href="index.php?c=player&m=index"><i class="icon-align-justify"></i><span class="hidden-tablet"> Players</span></a></li>
            <li class="<?php echo ($title=='games')?'active':''?>"><a href="index.php?c=game&m=index"><i class="icon-align-justify"></i><span class="hidden-tablet"> Games</span></a></li>
            <li class="<?php echo ($title=='messages')?'active':''?>"><a href="index.php?c=message&m=index"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Add Infornmation</span><span class="label label-important"> 4 </span></a>
                <ul>
                    <li class="<?php echo ($title=='addteam')?'active':''?>"><a class="submenu" href="index.php?c=team&m=create"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Teams</span></a></li>
                    <li class="<?php echo ($title=='addplayer')?'active':''?>"><a class="submenu" href="index.php?c=player&m=create"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Players</span></a></li>
                    <li class="<?php echo ($title=='addgame')?'active':''?>"><a class="submenu" href="index.php?c=game&m=create"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Games</span></a></li>
                    <li class="<?php echo ($title=='addcountry')?'active':''?>"><a class="submenu" href="index.php?c=country&m=index"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Country</span></a></li>
                </ul>
            </li>

        </ul>
    </div>
</div>
<!-- end: Main Menu -->