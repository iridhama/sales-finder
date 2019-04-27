<div class="col-md-3" style="height: 250px">
    <?php
        $prices = $model->prices;
        $price = $prices[0];
    ?>
    <a href="<?= $model->product_url ?>">
        <img style="width: 200px; height: 100px"  src="<?= $model->product_image ?>" />
        <span style="background: #333; color: #fff">Save upto <?= \app\component\Helper::getDiscountPercent($price->sale_price, $price->normal_price) ?>%</span><br>
        <span style="">$<?= $price->sale_price ?>  $<?= $price->normal_price ?></span><br>
    </a>
    <a href="<?= $model->product_url ?>" style="margin-top: 20px">
        <span><?= $model->product_name ?></span>
    </a>
</div>