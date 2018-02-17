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
                        <h2>Востановление пароля. Введите свой email: </h2>
                        <form action="#" method="post">
                            <input type="email" name="email" value="" placeholder="E-mail"/>
                            <input type="submit" name="submit" class="btn btn-warning" value="Ввостановить"/>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

<?php include_once ROOT . '/views/layouts/footer.php'; ?>