<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/menu.php';?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php foreach ($messages as $message) : ?>
            <h3>
                <?php echo $message->getTitle(); ?>
            </h3>
            <h5>
                <?php echo 'Post by '.$message->getUsername().' on '.date('Y-F-d h:i',(int)$message->getRegTime()); ?>
            </h5>
            <p>
                <?php echo $message->getMessage() ?>
            </p>
            <?php if($message->getUserId()==$_SESSION['user']->getId()):?>
            <a class="btn btn-default" href="index.php?c=blog&m=update&m_id=<?php echo $message->getId(); ?>&id=<?php echo $teamId; ?>" role="button">Edit</a>
            <a class="btn btn-default" href="index.php?c=blog&m=delete&m_id=<?php echo $message->getId(); ?>&id=<?php echo $teamId; ?>" role="button">Delete</a>
            <?php endif;?>

        <?php endforeach; ?>
    </div>
    <div class="col-md-2"></div>
</div>
<?php if($this->IsLog()): ?>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="index.php?c=blog&id=<?php echo $teamId; ?>" method="post">
                <div class="form-group">
                    <?php echo array_key_exists('title',$errors)?"<span class=\"label label-danger\">Title</span>":""?>
                    <label for="">Заглавие</label><input required type="text" name="title" class="form-control" placeholder="Title">
                    <?php echo array_key_exists('message',$errors)?"<span class=\"label label-danger\">Message</span>":""?>
                    <label for="">Съобшение<textarea name="message" id="" cols="100" rows="20" class="form-control" placeholder="Message"></textarea></label>
                    <input type="submit" class='btn-primary' value="Post it" name="post">

                </div>
            </form>

        </div>
        <div class="col-md-2"></div>
    </div>
    <?php endif; ?>
<?php require_once __DIR__.'/../include/footer.php';?>