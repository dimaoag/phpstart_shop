<?php include_once ROOT . '/views/layouts/header.php'; ?>

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
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
                        <input type="email" name="email" value="<?php echo $email; ?>" placeholder="E-mail"/>
                        <input type="password" name="password" value="<?php echo $password; ?>" placeholder="Пароль"/>
                        <input type="submit" name="submit" class="btn btn-info" value="Вход"/>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

<?php include_once ROOT . '/views/layouts/footer.php'; ?>
