<?php require_once __DIR__.'/include/header.php'; ?>
<?php require_once __DIR__.'/include/menu.php';?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="index.php?c=login&m=registration" method="post">
            <div class="form-group">
                <div class="form-group <?php echo isset($errors['username'])?'has-error':''?>">
                    <label class="control-label" for="login">Username<?php echo isset($errors['username'])?' - '.$errors['username']:'' ?></label>
                    <input type="text" class="form-control" name="login" id="login" placeholder="Username" value="<?php echo isset($inputData['login'])?$inputData['login']:'';?>">
                </div>
                <div class="form-group <?php echo isset($errors['pass'])?'has-error':''?>">
                    <label class="control-label" for="pass">Password<?php echo isset($errors['pass'])?' - '.$errors['pass']:'' ?></label>
                    <input type="password" class="form-control" name="pass" id="password" placeholder="Password">
                </div>
                <div class="form-group <?php echo isset($errors['mail'])?'has-error':''?>">
                    <label class="control-label" for="mail">Email<?php echo isset($errors['mail'])?' - '.$errors['mail']:'' ?></label>
                    <input type="text" class="form-control" name="mail" id="mail" placeholder="Email" value="<?php echo isset($inputData['mail'])?$inputData['mail']:'';?>">
                </div>

                <?php echo (isset($errors['gender'])?'<div class="alert alert-danger" role="alert">'.$errors['gender'].'</div>':'' )?>
                <div class="checkbox">
                    <label for="">Gender:
                        <label for="male">Male</label>
                        <input type="radio" checked name="gender" id="male" value="male">
                        <label for="female">Female</label>
                        <input type="radio" id="female" name="gender" value="female">
                    </label>
                </div>
                <?php echo (isset($errors['team'])?'<div class="alert alert-danger" role="alert">'.$errors['team'].'</div>':'' )?>
                <label for="" >Team</label>
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

                <input type="submit" class='btn-primary' value="Registration" name="register" >


            </div>
        </form>

    </div>
    <div class="col-md-4"></div>
</div>

<?php require_once __DIR__.'/include/footer.php'; ?>