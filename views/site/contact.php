<?php include_once ROOT . '/views/layouts/header.php'; ?>

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <?php if($result): ?>
                    <p>Сообщение отправлено. Мы с вами свяжемя в ближайшее время.</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <div class="signup-form"><!--sign up form-->
                        <h2>Обратная связь</h2>
                        <h2>Есть вопрос? Пишите нам...</h2>
                        <form action="#" method="post">
                            <p>Ваша почта:</p>
                            <input type="email" name="userEmail" value="<?php echo $userEmail; ?>" placeholder="E-mail"/>
                            <p>Сообщение:</p>
                            <input type="text" name="userText" value="<?php echo $userText; ?>" placeholder="Сообщение"/>
                            <input type="submit" name="submit" class="btn btn-info" value="Отправить"/>
                        </form>
                    </div><!--/sign up form-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</section><!--/form-->

<?php include_once ROOT . '/views/layouts/footer.php'; ?>
