<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Loader;
use Bitrix\Sale,
    Bitrix\Sale\Order,
    Bitrix\Sale\PersonType,
    Bitrix\Sale\Shipment,
    Bitrix\Sale\PaySystem,
    Bitrix\Sale\Payment,
    Bitrix\Sale\Delivery;
class SaleOrderCustom extends CBitrixComponent
{
    /**
     * @var \Bitrix\Sale\Order
     */
    protected $order;

    protected $errors = [];

    protected $arResponse = [
        'errors' => [],
        'html' => ''
    ];


    function __construct($component = null)
    {
        parent::__construct($component);

        if (!Loader::includeModule('sale')) {
            $this->errors[] = 'No sale module';
        };

        if (!Loader::includeModule('catalog')) {
            $this->errors[] = 'No catalog module';
        };
    }

    function onPrepareComponentParams($arParams)
    {
        if (isset($arParams['PERSON_TYPE_ID']) && intval($arParams['PERSON_TYPE_ID']) > 0) {
            $arParams['PERSON_TYPE_ID'] = intval($arParams['PERSON_TYPE_ID']);
        } else {
            if (intval($this->request['payer']['person_type_id']) > 0) {
                $arParams['PERSON_TYPE_ID'] = intval($this->request['payer']['person_type_id']);
            } else {
                $arParams['PERSON_TYPE_ID'] = 1;
            }
        }

        if (isset($arParams['IS_AJAX']) && ($arParams['IS_AJAX'] == 'Y' || $arParams['IS_AJAX'] == 'N')) {
            $arParams['IS_AJAX'] = $arParams['IS_AJAX'] == 'Y';
        } else {
            if (isset($this->request['is_ajax']) && ($this->request['is_ajax'] == 'Y' || $this->request['is_ajax'] == 'N')) {
                $arParams['IS_AJAX'] = $this->request['is_ajax'] == 'Y';
            } else {
                $arParams['IS_AJAX'] = false;
            }
        }
        if (isset($arParams['ACTION']) && strlen($arParams['ACTION']) > 0) {
            $arParams['ACTION'] = strval($arParams['ACTION']);
        } else {
            if (isset($this->request['action']) && strlen($this->request['action']) > 0) {
                $arParams['ACTION'] = strval($this->request['action']);
            } else {
                $arParams['ACTION'] = '';
            }
        }
        return $arParams;
    }
    public $propMap = [];
    public function getAvailableDeliveries(){
        $deliver_array = \Bitrix\Sale\Delivery\Services\Manager::getActiveList();
        return $deliver_array;
    }
    public function getAvailablePaySystems(){

    }
    public function getPropByCode($code)
    {
        $result = false;

        $propId = 0;
        if (isset($this->propMap[$code])) {
            $propId = $this->propMap[$code];
        }

        if ($propId > 0) {
            $result = $this->order
                ->getPropertyCollection()
                ->getItemByOrderPropertyId($propId);
        }

        return $result;
    }

    public function getPropDataByCode($code)
    {
        $result = [];

        $propId = 0;
        if (isset($this->propMap[$code])) {
            $propId = $this->propMap[$code];
        }

        if ($propId > 0) {
            $result = $this->order
                ->getPropertyCollection()
                ->getItemByOrderPropertyId($propId)
                ->getFieldValues();
        }

        return $result;
    }

    protected function createVirtualOrder()
    {
        global $USER;

        try {
            $siteId = \Bitrix\Main\Context::getCurrent()->getSite();
            $basketItems = \Bitrix\Sale\Basket::loadItemsForFUser(
                \CSaleBasket::GetBasketUserID(),
                $siteId
            )
                ->getOrderableItems();

            if (count($basketItems) == 0) {
                LocalRedirect(PATH_TO_BASKET);
            }

            $this->order = \Bitrix\Sale\Order::create($siteId, $USER->GetID());
            $this->order->setPersonTypeId($this->arParams['PERSON_TYPE_ID']);
            $this->order->setBasket($basketItems);

//            $this->setOrderProps();

            /* @var $shipmentCollection \Bitrix\Sale\ShipmentCollection */
            $shipmentCollection = $this->order->getShipmentCollection();

            if (intval($this->request['delivery_id']) > 0) {
                $shipment = $shipmentCollection->createItem(
                    Bitrix\Sale\Delivery\Services\Manager::getObjectById(
                        intval($this->request['delivery_id'])
                    )
                );
            } else {
                $shipment = $shipmentCollection->createItem();
            }

            /** @var $shipmentItemCollection \Bitrix\Sale\ShipmentItemCollection */
            $shipmentItemCollection = $shipment->getShipmentItemCollection();
            $shipment->setField('CURRENCY', $this->order->getCurrency());

            foreach ($this->order->getBasket()->getOrderableItems() as $item) {
                /**
                 * @var $item \Bitrix\Sale\BasketItem
                 * @var $shipmentItem \Bitrix\Sale\ShipmentItem
                 * @var $item \Bitrix\Sale\BasketItem
                 */
                $shipmentItem = $shipmentItemCollection->createItem($item);
                $shipmentItem->setQuantity($item->getQuantity());
            }


            if (intval($this->request['payment_id']) > 0) {
                $paymentCollection = $this->order->getPaymentCollection();
                $payment = $paymentCollection->createItem(
                    Bitrix\Sale\PaySystem\Manager::getObjectById(
                        intval($this->request['payment_id'])
                    )
                );
                $payment->setField("SUM", $this->order->getPrice());
                $payment->setField("CURRENCY", $this->order->getCurrency());
            }

        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }
    }

//    protected function setOrderProps()
//    {
//        global $USER;
//        $arUser = $USER->GetByID(intval($USER->GetID()))
//            ->Fetch();
//
//        foreach ($this->order->getPropertyCollection() as $prop) {
//            /** @var \Bitrix\Sale\PropertyValue $prop */
//            $this->propMap[$prop->getField('CODE')] = $prop->getPropertyId();
//            $value = '';
//
//            switch ($prop->getField('CODE')) {
//                case 'NAME':
//                    $value = ' ' . $this->request['NAME'];
//
//                    $value = trim($value);
//                    if (empty($value)) {
//                        $value = $arUser['NAME'];
//                    }
//                    break;
//                case 'LAST_NAME' :
//                    $value = ' ' . $this->request['LAST_NAME'];
//
//                    $value = trim($value);
//                    if (empty($value)) {
//                        $value = $arUser['LAST_NAME'];
//                    }
//                    break;
//                default:
//            }
//
//            if (empty($value)) {
//                foreach ($this->request as $key => $val) {
//                    if (strtolower($key) == strtolower($prop->getField('CODE'))) {
//                        $value = $val;
//                    }
//                }
//            }
//
//            if (empty($value)) {
//                $value = $prop->getProperty()['DEFAULT_VALUE'];
//            }
//
//            if (!empty($value)) {
//                $prop->setValue($value);
//            }
//        }
//    }


    protected function calcAction()
    {
        $this->setTemplateName('');

        //Собираем ID доставок
        $deliveryIDs = [];
        if (isset($this->request['delivery_id'])) {
            if (is_array($this->request['delivery_id'])) {
                foreach ($this->request['delivery_id'] as $val) {
                    if (intval($val) > 0) {
                        $deliveryIDs[intval($val)] = intval($val);
                    }
                }
            } elseif (intval($this->request['delivery_id']) > 0) {
                $deliveryIDs = [intval($this->request['delivery_id'])];
            } else {
                $deliveryIDs = [];
            }

        }
        //На выходе в любом случае будет массив
        sort($deliveryIDs);

        if (empty($deliveryIDs)) {
            throw new \Exception('Нет доставок для расчета');
        }

        $shipment = false;
        /** @var \Bitrix\Sale\Shipment $shipmentItem */
        foreach ($this->order->getShipmentCollection() as $shipmentItem) {
            if (!$shipmentItem->isSystem()) {
                $shipment = $shipmentItem;
                break;
            }
        }

        if (!$shipment) {
            throw new \Exception('Отгрузка не найдена');
        }

        //Массив с доставками,
        $availableDeliveries = \Bitrix\Sale\Delivery\Services\Manager::getRestrictedObjectsList(
            $shipment
        );

        foreach ($deliveryIDs as $deliveryId) {
            $obDelivery = false;
            if (isset($availableDeliveries[$deliveryId])) {
                //Если переданный из запроса ID доставки доступен покупателю
                $obDelivery = $availableDeliveries[$deliveryId];
            }

            if ($obDelivery) {
                $arDelivery = [
                    'id'                => $obDelivery->getId(),
                    'name'              => $obDelivery->getName(),
                    'logo_path'         => $obDelivery->getLogotipPath(),
                    'show'              => false,
                    'calculated'        => false,
                    'period'            => '',
                    'price'             => 0,
                    'price_formated'    => '',
                ];

                $shipment->setField('DELIVERY_ID', $obDelivery->getId());
                $calcResult = $obDelivery->calculate($shipment);

                if ($calcResult->isSuccess()) {
                    $arDelivery['calculated'] = true;
                    $arDelivery["price"] = $calcResult->getPrice();
                    $arDelivery["price_formated"] = \SaleFormatCurrency(
                        $calcResult->getPrice(),
                        $this->order->getCurrency()
                    );

                    if (strlen($calcResult->getPeriodDescription()) > 0) {
                        $arDelivery["period_text"] = $calcResult->getPeriodDescription();
                    }
                }

                if (floatval($arDelivery['price']) > 0) {
                    $arDelivery['show'] = true;
                }

                if (empty($arDelivery["period_text"])) {
                    $arDelivery["period_text"] = '...';
                }

                $this->arResponse['deliveries'][$arDelivery['ID']] = $arDelivery;
            } else {
                //В аякс ответе, даже недоступную доставку возвращаем
                $this->arResponse['deliveries'][$deliveryId] = [
                    'id'   => $deliveryId,
                    'show' => false
                ];
            }
        }
    }

    protected function deliveriesAction()
    {
        $this->setTemplateName('delivery');
        //Нифига не делаем, просто подключаем шаблон доставки
    }

    protected function saveAction()
    {
        $this->setTemplateName('done');
        //Проверяем что все корректно, все свойства есть, доставка/отгрузка выбрана, платежная система определена
        //И сохраняем заказ в базу если все нормально
        $this->order->save();

    }

    function executeComponent()
    {

//        var_dump($this->arParams);
        global $APPLICATION;
        if ($this->arParams['IS_AJAX']) {
            $APPLICATION->RestartBuffer();
        }

        $this->createVirtualOrder();

        if(!empty($this->arParams['ACTION'])) {
            if (is_callable([$this, $this->arParams['ACTION'] . "Action"])) {
                try {
                    call_user_func([$this, $this->arParams['ACTION'] . "Action"]);
                } catch (\Exception $e) {
                    $this->errors[] = $e->getMessage();
                }
            }
        }

        if ($this->arParams['IS_AJAX']) {
            if ($this->getTemplateName() != '') {
                ob_start();
                $this->includeComponentTemplate();
                $this->arResponse['html'] = ob_get_contents();
                ob_end_clean();
            }

            $this->arResponse['errors'] = $this->errors;

            header('Content-Type: application/json');
            echo json_encode($this->arResponse);
            $APPLICATION->FinalActions();
            die();
        } else {
            $this->includeComponentTemplate();
        }
    }
}