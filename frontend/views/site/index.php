<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
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
</div>
