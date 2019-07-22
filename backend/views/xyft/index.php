<?php

use yii\helpers\Html;

$this->registerCssFile('/css/chance.css');

?>
    <div class="site-index" style="margin-top: 75px;">

        <div class="row">
            <div class="col-md-12" style="margin-bottom: 10px;">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="exampleInputEmail1">日期</label>
                        <input style="width: 50%;" type="text" class="form-control" id="date"
                               placeholder="<?= $date ?>">
                    </div>
                    <a id="indexSearch" class="btn btn-default">查询</a>
                </form>
            </div>
        </div>
        <?php
         if($tenNumberStage !== ''){
             ?>
             <div class="row">
                 <div class="col-md-12">
                     <p>10个号码出齐期数：<?= $tenNumberStage ?></p>
                     <p>热门号码总数：<?= $hotNumberCount ?></p>
                     <p>冷门号码总数：<?= $coolNumberCount ?></p>
                 </div>
             </div>
             <?php
         }
        ?>

        <div class="row">
            <div class="col-md-12 rank-btn-div">
                <?php
                if (isset(Yii::$app->params['xyftRank']) && Yii::$app->params['xyftRank']) {
                    foreach (Yii::$app->params['xyftRank'] as $key => $val) {
                        ?>
                        <a class="btn <?= ($key == $rank) ? 'btn-danger' : 'btn-success' ?>"
                           href="/xyft?rank=<?= $key ?>" role="button"><?= $val['rankDesc'] ?></a>
                        <?php
                    }
                }
                ?>
                <!--            <a class="btn -->
                <? //= ($rank == 'all') ? 'btn-danger' : 'btn-success' ?><!--" href="/xyft/overview" role="button">总览</a>-->
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <?php
                    $data = array_reverse($data);
                    if (isset($data) && $data) {
                        foreach ($data as $key => $val) {
                            ?>
                            <tr>
                                <td colspan="3" style="line-height: 28px;">第<?= $val['stage'] ?>期</td>
                                <td>
                                    <span class="number num_<?= $val['kjRes'] ?> "> <?= $val['kjRes'] ?> </span>
                                </td>
                            </tr>
                            <tr>
                                <?php
                                if (isset($val['chance']) && $val['chance']) {
                                    foreach ($val['chance'] as $k => $c) {

                                        ?>

                                        <td>
                                            <div>
                                                <span class="number num_<?= $k ?>"><?= $k ?></span>
                                            </div>
                                            <div>
                                                <small><?= (number_format($c / $val['stageCount'], 2) * 100) . '%' ?></small>
                                            </div>
                                        </td>

                                        <?php
                                    }
                                }
                                ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
<?php
$this->registerJsFile('js/chance.js', ['depends' => ['frontend\assets\AppAsset'], 'position' => $this::POS_HEAD]);