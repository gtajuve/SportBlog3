
<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/menu.php';?>

<link href="/admin/css/images.css" rel="stylesheet">
<!-- start: Content -->
<div id="content" class="span10" xmlns="http://www.w3.org/1999/html">


    <div class="container">
        <div class="row">
            <?php foreach($images as $image): ?>
                <div class="span3 ">

                    <?php if($image->getTitle()!='') { ?><a href="#" class="btn btn-mini btn-success "><?php echo $image->getTitle(); ?></a><?php } ?>
                    <img style="width:320px; height:220px;" class="img-responsive" src="admin/uploads/teams/images/<?php echo  $image->getImageName(); ?>" />
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<?php require_once __DIR__.'/../include/footer.php';?>