<?php use yii\helpers\Url; ?>

<link href="/statics/themes/default/views/css/price.css?v=20180403" rel="stylesheet">
<style>
    .content{background: linear-gradient(to right, #f3d08e , #afeb86);padding: 47px 40px; }
</style>



<div class="row">

    <div class="col-md-12 free-item">
        <div class="pricingTable yellow">
            <div class="pricingTable-header">
                <i class="fa fa-adjust"></i>
                <div class="price-value"> $0.00
                    <!--                                <span class="month">per month</span>-->
                </div>
            </div>
            <h3 class="heading">Free use for <?= $app->free_day ?> days now!</h3>
            <!--<div class="pricing-content">
                <ul>
                    <li><b>50GB</b> Disk Space</li>
                    <li><b>50</b> Email Accounts</li>
                    <li><b>50GB</b> Monthly Bandwidth</li>
                    <li><b>10</b> subdomains</li>
                    <li><b>15</b> Domains</li>
                </ul>
            </div>-->
            <div class="pricingTable-signup">
                <?php if($free_chance): ?>
                <a href="<?= Url::to(['index/first-activate','type'=>'1','app'=>$app->id])?>">Activate now</a>
                <?php else: ?>
                <a href="javascript:void(0);">Had use</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="pricingTable">
            <div class="pricingTable-header">
                <i class="fa fa-adjust"></i>
                <div class="price-value"> $<?= $app->month_price ?>
                    <!--                                <span class="month">per month</span>-->
                </div>
            </div>
            <h3 class="heading">1 month</h3>
            <!--<div class="pricing-content">
                <ul>
                    <li><b>50GB</b> Disk Space</li>
                    <li><b>50</b> Email Accounts</li>
                    <li><b>50GB</b> Monthly Bandwidth</li>
                    <li><b>10</b> subdomains</li>
                    <li><b>15</b> Domains</li>
                </ul>
            </div>-->
            <div class="pricingTable-signup">
                <a href="<?= Url::to(['index/activate','type'=>'1','app'=>$app->id])?>">Activate now</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="pricingTable green">
            <div class="pricingTable-header">
                <i class="fa fa-briefcase"></i>
                <div class="price-value"> $<?= $app->season_price ?>
                    <!--                                <span class="month">per month</span> -->
                </div>
            </div>
            <h3 class="heading">3 Month</h3>
            <!-- <div class="pricing-content">
                 <ul>
                     <li><b>60GB</b> Disk Space</li>
                     <li><b>60</b> Email Accounts</li>
                     <li><b>60GB</b> Monthly Bandwidth</li>
                     <li><b>15</b> subdomains</li>
                     <li><b>20</b> Domains</li>
                 </ul>
             </div>-->
            <div class="pricingTable-signup">
                <a href="<?= Url::to(['index/activate','type'=>'3','app'=>$app->id])?>">Activate now</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="pricingTable blue">
            <div class="pricingTable-header">
                <i class="fa fa-diamond"></i>
                <div class="price-value"> $<?= $app->half_price ?>
                    <!--                                <span class="month">per month</span>-->
                </div>
            </div>
            <h3 class="heading">6 month</h3>
            <!-- <div class="pricing-content">
                 <ul>
                     <li><b>70GB</b> Disk Space</li>
                     <li><b>70</b> Email Accounts</li>
                     <li><b>70GB</b> Monthly Bandwidth</li>
                     <li><b>20</b> subdomains</li>
                     <li><b>25</b> Domains</li>
                 </ul>
             </div>-->
            <div class="pricingTable-signup">
                <a href="<?= Url::to(['index/activate','type'=>'6','app'=>$app->id])?>">Activate now</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="pricingTable red">
            <div class="pricingTable-header">
                <i class="fa fa-cube"></i>
                <div class="price-value"> $<?= $app->year_price ?>
                    <!--                                <span class="month">per month</span> -->
                </div>
            </div>
            <h3 class="heading">1 Year</h3>
            <!-- <div class="pricing-content">
                 <ul>
                     <li><b>80GB</b> Disk Space</li>
                     <li><b>80</b> Email Accounts</li>
                     <li><b>80GB</b> Monthly Bandwidth</li>
                     <li><b>25</b> subdomains</li>
                     <li><b>30</b> Domains</li>
                 </ul>
             </div>-->
            <div class="pricingTable-signup">
                <a href="<?= Url::to(['index/activate','type'=>'12','app'=>$app->id])?>">Activate now</a>
            </div>
        </div>
    </div>
</div>

