<?php
/**
 * @var PaymentController $this
 * @var array $payments
 * @var array $plan
 */

$this->pageHeader=tt('Оплата за общежитие');
$this->breadcrumbs=array(
    tt('Оплата'),
);

$this->renderPartial('_bottom', array(
    'plans' => $plans,
    'payments' => $payments,
));


