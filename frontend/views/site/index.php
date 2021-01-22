<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php
    if($dataCount != null) { ?>
    <div class="" style="margin-bottom: 20px;">
        <h3>Result; <?= $dataCount ?></h3>
        <h5>category id: <?= $_GET['category'] ?></h5>
    </div>
    <?php }?>
    <form action="" method="get" class="form-inline" style="margin-bottom: 20px;">
        <div class="form-group">
            <label for="">Category</label>
            <select name="category" id="" class="form-control">
                <?php foreach ($category as $categoryitem) { ?>
                    <option value="<?= $categoryitem['id'] ?>"><?= $categoryitem['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" value="Filter" class="btn btn-success">
    </form>
        
    <div class="row" style="display: flex; flex-wrap: wrap; justify-content: center;">
        <?php foreach ($data as $item) { ?>
            <div class="col-md-4" style="margin-bottom: 20px;">
                <div class="card" style="border: 1px solid #6c757d; padding: 10px;">
                    <img src="<?= '../../../../yii/myMart/backend/web/'.$item->image ?>" alt="<?= $item->name ?>" class="card-img-top img-reponsive img-rounded" height="250px" width="100%">
                    <hr style="border: 1px solid #6c757d;">
                    <div class="card-body">
                        <h2 class="text-capitalize"><?= $item['name'] ?></h2>
                        <span>Rp. <?= $item['price'] ?>.00</span>
                    </div>
                    <?php if(Yii::$app->user->id) {?>
                    <!-- jika user sudah login maka akan muncul button -->
                    <div class="card-footer" style="margin-top: 10px;">
                        <hr style="border: 1px solid #6c757d;">
                        <div class="" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center;">
                            <a href="#" class="btn btn-primary">Buy</a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="row" style="display: flex; justify-content: center; align-items: center;">
        <div class="col-md-5" style="align-self: center; text-align: center;">
            <?= \yii\widgets\LinkPager::widget([
                'pagination' => $pages,
            ]) ?>
        </div>
    </div>
</div>
