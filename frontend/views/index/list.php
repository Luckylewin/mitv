<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/3/29
 * Time: 15:52
 */
?>


<div class="container">

    <?php if(!empty($data)): ?>
    <h2>The Support Channels</h2>
    <p>Our channel is dynamic, but at the same time, it is stable and reliable</p>
    <div id="accordion">

        <?php foreach ($data as $key => $value): ?>
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>">
                    <?= $value['name'] ?>
                </a>
            </div>
            <div id="collapse<?= $key ?>" class="collapse <?= !$key?'show':'' ?>">
                <div class="card-block">

                        <ul class="list-group">
                        <?php foreach ($value['child'] as $val): ?>
                            <li class="list-group-item">&nbsp;&nbsp;
                                <?= $val['name'] ?>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
            <div class="jumbotron">
                <h1>Note</h1>
                <p>The Support Channels is being arranged, please look forward to it</p>
            </div>
        <?php endif; ?>

</div>
