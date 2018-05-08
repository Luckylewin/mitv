<?php
/**
 * Created by PhpStorm.
 * User: lychee
 * Date: 2018/3/27
 * Time: 16:17
 */

namespace frontend\controllers;


use common\models\ActivateLog;
use common\models\Order;
use frontend\components\paypal;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use Yii;

class PayController extends Controller
{
    public function actionCreate($order)
    {
        $order = Order::findOne(['invoice_number' => $order]);
        if (!$order) {
            throw new NotFoundHttpException("Sorry, an error occur", 404);
        }
        $product = $order->app_name;
        $price = $order->total;
        $shipping = 0.00; //运费
        $invoice_number = $order->invoice_number; //订单号
        $successCallback = Yii::$app->urlManager->createAbsoluteUrl(['pay/callback','success'=>'true']);   //成功支付回调
        $cancelCallback = Yii::$app->urlManager->createAbsoluteUrl(['pay/callback','success'=>'false']);  //取消回调
        $total = $price; //总金额
        $quantity = 1; //数量
        $currency = 'USD'; //货币
        $description = "Activate APP : ". $order->app_name;  //订单描述信息

        //创建paypal对象
        $apiContext = paypal::init();

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)
            ->setCurrency($currency)
            ->setQuantity($quantity)
            ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping)
            ->setSubtotal($price);

        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($description)
            ->setInvoiceNumber($invoice_number);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($successCallback)   //设置支付成功回调地址
                     ->setCancelUrl($cancelCallback); //设置支付失败回调地址

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($apiContext);
        } catch (PayPalConnectionException $e) {
           throw new NotFoundHttpException($e->getData,"404");
        }

        $approvalUrl = $payment->getApprovalLink();
        return \Yii::$app->response->redirect($approvalUrl);
        //header("Location:{$approvalUrl}");
    }

    public function actionCallback()
    {
        if (Yii::$app->request->get('success') == 'false') {
            die('<script>alert("transaction cancel")</script>');
        }

        if (!Yii::$app->request->get('success') ||
            !Yii::$app->request->get('paymentId') ||
            !Yii::$app->request->get('PayerID')
        ) {
            die('<script>alert("error params")</script>');
        }

        $paymentID = Yii::$app->request->get('paymentId');
        $payerId = Yii::$app->request->get('PayerID');

        $apiContext = paypal::init();
        $payment = Payment::get($paymentID, $apiContext);

        $execute = new PaymentExecution();
        $execute->setPayerId($payerId);

        try{
            $result = $payment->execute($execute, $apiContext);
            Yii::$app->session->setFlash('success', "pay success");

            $result = $this->object_array($result);
            $result = current(array_values($result));
            $result = current($result['transactions']);
            $result = array_values($result)[0];
            $invoice_number = $result['invoice_number'];

            if (!empty($invoice_number)) {
                $order = Order::findOne(['invoice_number' => $invoice_number]);
                $order->is_pay = '1';

                //生成一条激活记录
                $activateLog = new ActivateLog();

                $activateLog->order_id = $order->id;
                $activateLog->uid = $order->user->id;
                $activateLog->appname = $order->app_name;
                $activateLog->expire_time = strtotime('+ '. $order->type . 'month');
                $activateLog->duration = floor((strtotime('+ '. $order->type . 'month') - time()) / 86400);
                $activateLog->is_charge = Order::CHARGE;
                $activateLog->save(false);

                $order->save(false);

                return Yii::$app->response->redirect(Url::to(['index/success', 'order' =>  $invoice_number]));
            }
        }catch(\Exception $e){
           throw new ForbiddenHttpException("The order has been paid successfully, do not repeat the refresh");
        }
    }


    private  function object_array($array)
    {
        if(is_object($array)) {
            $array = (array)$array;
        } if(is_array($array)) {
            foreach($array as $key=>$value) {
                $array[$key] = $this->object_array($value);
            }
        }
        return $array;
    }
}