<?php

return [
    'admintype' => env('ADMINTYPE',4),
    'suppliertype' => env('SUPPLIERTYPE',3),
    'resellertype' => env('RESELLERTYPE',2),
    'sellertype' => env('SELLERTYPE',1),
    'appname' => env('APPNAME','Dragon Dropship'),
    'msg_add_complete' => env('MSGADDCOMPLETE','เพิ่มข้อมูลสำเร็จ'),
    'logtype' => [
    		'product_activity' => 1,
    		'ticket' => 2,
    		'personal' => 3,
        'orderstatus' => 4,
        'orderpayment' => 5,
    ],
  'message' =>[
    'success_update' => 'แก้ไขข้อมูลสำเร็จ',
    'success_delete' => 'ลบข้อมูลสำเร็จ',
    'not_authorize' => 'ไม่มีสิทธิใช้งานในส่วนนี้'
  ],
  'action' => [
    'add_product' => 'ADD_PRODUCT',
    'update_product' => 'UPDATE_PRODUCT',
    'change_order_status' => 'CHANGE_ORDER_STATUS',
    'order_created' => 'ORDER_CREATED',
    'order_process' => 'ORDER_PROCESS',
  ],
  'orderstatus' => [
    'waiting' => 0,
    'processing' => 1,
    'waitshipping' => 2,
    'shipping' => 3,
    'complete' => 4,
    'cancel' => 5,
    'waitproduct' => 6,
  ],
   'orderstatus_message' => [
     'waiting' => 'รอดำเนินการ',
     'processing' => 'กำลังจัดสินค้า',
     'waitshipping' => 'รอจัดส่ง',
     'shipping' => 'จัดส่งแล้ว',
     'complete' => 'ผู้รับได้รับสินค้าแล้ว',
     'cancel' => 'ยกเลิกใบสั่งซื้อ',
     'waitproduct' => 'รอสินค้า',
   ]
  ,
  'trantype' => [
    'deposit' => 'ฝากเงิน',
    'withdraw' => 'ถอนเงิน',
    'buyproduct' => 'ซื้อสินค้า',
    'shippingcost' => 'ค่าจัดส่ง'
  ],
  'doc_code' =>[
     'order' => 'OR',
     'receipt' => 'RC',
     'shipment' => 'SH',
  ]

];
