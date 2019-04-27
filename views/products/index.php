<?php

use yii\widgets\ActiveForm;
use \app\component\Helper;
use \yii\widgets\ListView;

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs('ProductController.createUpdate();');

?>

<div class="products-index">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'id' => 'product-search-form',
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-3">
            
            <h3>Category List</h3>            
            <?php if(!empty($categoryList)): ?>
                <?php foreach ($categoryList as $item): ?>
                    <div class="col-md-12">
                        <a href="javascript:void(0)" class="category-list">
                            <?= $item['category'] ?>
                        </a>(<?= $item['count']?>)
                    </div>
                <?php endforeach; ?>
            <?php endif ?>
            <!-- hidden field to store the category -->
            <?=  $form->field($searchModel, 'category')->hiddenInput()?>

            <hr>
            <div class="col-md-12">
                <div class="col-md-5">
                    <?= $form->field($searchModel, "min_price")->textInput([
                        'class' => 'min-price, form-control'
                    ])->label('max price') ?>
                </div>
                <div class="col-md-5">
                    <?= $form->field($searchModel, "max_price")->textInput([
                        'class' => 'max-price, form-control'
                    ])->label('max price') ?>
                </div>
                <div class="col-md-2">
                    <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Go'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>

            <hr>


            <label> discount: <span id="discount-span"><?= $searchModel->discount ?></span>%</label>
            <input value="<?= (isset($searchModel->discount) && !empty($searchModel->discount))? $searchModel->discount : 0 ?>" class="discount-range" type="range" name="ProductSearch[discount]" min="0" max="100" step="10">
            <hr>


            <h3>Stores list</h3>
            <?php if(!empty($storeModels)): ?>
                <?php foreach ($storeModels as $storeModel): ?>
                    <div class="col-md-12">

                        <a href="" class="store-list">
                            <?php $storeId =  $storeModel['id'] ?>
                            <?= $form->field($searchModel, "store_id[$storeId]")->checkbox([
                                    'value' => $storeId,
                                    'class' => 'store-chkbox'
                            ])->label(false) ?>
                            <?= $storeModel['store_name'] ?>

                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif ?>
        </div>


        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12" style="float: right; text-align: right">
                    <div class="col-md-6">
                        <?= $form->field($searchModel, "product_name")->textInput([
                            'class' => 'product-search, form-control'
                        ])->label(false) ?>
                    </div>
                    <div class="col-md-2">
                        <?= \yii\helpers\Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>




            <?=
            ListView::widget([
                'dataProvider' => $listDataProvider,
                'options' => [
                 //   'tag' => 'div',
                    'class' => 'list-wrapper',
                    'id' => 'list-wrapper',
                ],
                'itemOptions' => [
                    'tag' => false,
                ],
                'summary' => false,
                //'layout' => "{pager}\n{items}\n{summary}",
                'itemView' => 'partials/_list-item',
            ]);
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
