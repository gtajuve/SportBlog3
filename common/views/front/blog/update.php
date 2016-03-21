<?php require_once __DIR__.'/../include/header.php'; ?>
<?php require_once __DIR__.'/../include/menu.php';?>

<?php if($this->IsLog()): ?>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form action="index.php?c=blog&m=update&id=<?php echo $teamId; ?>&m_id=<?php echo $messageInfo['id'] ?>" method="post">
                <div class="form-group">
                    <?php echo array_key_exists('title',$errors)?"<span class=\"label label-danger\">Title</span>":""?>
                    <label for="">Заглавие</label><input required type="text" name="title" class="form-control" placeholder="Title" value="<?php echo $messageInfo['title'] ?>">
                    <?php echo array_key_exists('message',$errors)?"<span class=\"label label-danger\">Message</span>":""?>
                    <label for="">Съобшение<textarea name="message" id="" cols="100" rows="20" class="form-control" placeholder="Message"> <?php echo $messageInfo['message'] ?></textarea></label>
                    <input type="submit" class='btn-primary' value="Post it" name="post">

                </div>
            </form>

        </div>
        <div class="col-md-2"></div>
    </div>
<?php endif; ?>
<?php require_once __DIR__.'/../include/footer.php';?>