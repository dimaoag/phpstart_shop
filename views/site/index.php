<?php include_once ROOT . '/views/layouts/header.php';?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $category):?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="/category/<?= $category['id']; ?>">
                                            <?= $category['name']; ?>
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <div class="col-sm-9 padding-right">

                <div class="recommended_items"><!--recommended_items-->

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            <div id="wrapper">
                                <div class="slider-wrapper theme-default">
                                    <div id="slider" class="nivoSlider">
                                        <img src="/upload/images/slider/113.png" data-thumb="/upload/images/slider/113.png" alt="" data-transition="slideInLeft" />
                                        <img src="/upload/images/slider/114.jpg" data-thumb="/upload/images/slider/114.jpg" alt="" />
                                    </div>
                                    <div id="htmlcaption" class="nivo-html-caption">
                                        <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div><!--/recommended_items-->


                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>
                    <?php foreach ($latestProducts as $product):?>
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="/product/<?= $product['id']; ?>">
                                            <img src="<?= $product['image']; ?>" alt="image" />
                                        </a>
                                        <h2><?= $product['price']; ?>$</h2>
                                        <p>
                                            <a href="/product/<?= $product['id']; ?>">
                                            <?= $product['name']; ?>
                                            </a>
                                        </p>
                                        <a href="#" data-id="<?php echo $product['id'];?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                    </div>
                                    <?php if ($product['is_new']): ?>
                                        <img src="/template/images/home/new.png" class="new" alt="" />
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div><!--features_items-->


            </div>
        </div>
    </div>
</section>


<?php include_once ROOT . '/views/layouts/footer.php';?>