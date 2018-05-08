<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/4/21
 * Time: 14:45
 */?>

<tr>
    <td><?= $model->appname; ?></td>
    <td><?= isset($model->order) ? $model->order->invoice_number : '-'; ?></td>
    <td> <?= $model->is_charge? $model->order->total:"free" ?> </td>
    <td><?= $model->duration . ' days'; ?></td>
    <td><?= date('Y-m-d', $model->expire_time) ?></td>
    <td><?= date('Y-m-d', $model->created_time)?></td>
    <td><?= $model->is_deal? 'Will open it within 24 hours' : '<i class="fa fa-check-circle"><i>' ?></td>
</tr>
