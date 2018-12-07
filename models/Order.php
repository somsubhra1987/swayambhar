<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_info".
 *
 * @property string $orderID
 * @property string $customerID
 * @property string $orderStatusID
 * @property string $orderDate
 * @property string $preferredDeliveryTime
 * @property integer $quantity
 * @property double $price
 * @property double $discount
 * @property double $totalAmount
 * @property string $orderDetails
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerID', 'orderStatusID', 'quantity', 'price', 'discount', 'totalAmount'], 'required'],
            [['customerID', 'orderStatusID', 'quantity'], 'integer'],
            [['orderDate', 'preferredDeliveryTime'], 'safe'],
            [['price', 'discount', 'totalAmount'], 'number'],
            [['orderDetails'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orderID' => 'Order ID',
            'customerID' => 'Customer ID',
            'orderStatusID' => 'Order Status ID',
            'orderDate' => 'Order Date',
            'preferredDeliveryTime' => 'Preferred Delivery Time',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'discount' => 'Discount',
            'totalAmount' => 'Total Amount',
            'orderDetails' => 'Order Details',
        ];
    }
}
