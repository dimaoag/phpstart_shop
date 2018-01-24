<?php include_once ROOT . '/views/layouts/header.php'; ?>

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if($result): ?>
                    <p>Данные отредактырованы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form"><!--sign up form-->
                        <h2>Вход на сайт</h2>
                        <form action="#" method="post">
                            <p>Имя:</p>
                            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Имя"/>
                            <p>Пароль:</p>
                            <input type="password" name="password" value="<?php echo $password; ?>" placeholder="Пароль"/>
                            <input type="submit" name="submit" class="btn btn-info" value="Сохранить"/>
                        </form>
                    </div><!--/sign up form-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><!--/form-->

<?php include_once ROOT . '/views/layouts/footer.php'; ?>
