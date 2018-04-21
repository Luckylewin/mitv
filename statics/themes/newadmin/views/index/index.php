<div class="container">
    <div class="jumbotron">
        <h2>TV APP</h2>
        <p>

                <?php if($be_deal_num): ?>
        <ul>
            <li>
                    <?= \yii\bootstrap\Html::a("有{$be_deal_num}个帐号需要被激活,现在去激活", \yii\helpers\Url::to(['activate-log/index']),[
                        'class' => 'btn btn-link'
                    ]) ?>
            </li>
        </ul>
                <?php endif; ?>



    </div>

</div>