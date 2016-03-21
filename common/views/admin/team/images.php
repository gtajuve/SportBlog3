<?php
require_once __DIR__.'/../include/header.php';
require_once __DIR__.'/../include/sidebar.php';
?>

<link id="bootstrap-style" href="css/images.css" rel="stylesheet">
<!-- start: Content -->
<div id="content" class="span10" xmlns="http://www.w3.org/1999/html">

    <ul class="breadcrumb">
        <li>
            <i class="icon-home"></i>
            <a href="index.php">Teams</a>
            <i class="icon-angle-right"></i>
        </li>
        <li><a href="#">Team Images</a></li>
    </ul>

    <form action="index.php?c=team&m=images&id=<?php echo $team_id ?>" method="post"  class="form-horizontal" enctype="multipart/form-data">
        <fieldset>
            <div class="control-group">
                <label class="control-label" for="fileInput">File input</label>
                <div class="controls">
                    <input type="text" id="inputSuccess" placeholder="Title" name="title">
                    <input class="input-file uniform_on" id="fileInput" name="image" type="file">
                    <input type="submit" name="addimage" value="Add Image" class="btn btn-primary"/>
                </div>
            </div>

        </fieldset>
    </form>


    <div class="container">
        <div class="row">
            <?php foreach($images as $image): ?>
                <div class="span3 ">
                    <a href="index.php?c=team&m=deleteimage&id=<?php echo $image->getId(); ?>" class="btn btn-mini btn-danger ">Delete</a>
                    <?php if($image->getTitle()!='') { ?><a href="#" class="btn btn-mini btn-success "><?php echo $image->getTitle(); ?></a><?php } ?>
                    <img style="width:320px; height:220px;" class="img-responsive" src="uploads/teams/images/<?php echo  $image->getImageName(); ?>" />
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>

<?php
require_once __DIR__.'/../include/footer.php';

?>
