<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Checkouts extends Public_Controller
{
    public $class_name='';
    function __construct()
    {
      parent::__construct();
      $this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
          $this->load->library('paypal_lib');
    }

    public function index($stap=1,$order_id=0,$product_id=0,$coupon_code=null)
    {
      $this->load->model('ProductOrder_Model');
      $this->load->model('Address_Model');
      $this->load->model('Product_Model');
      $this->load->model('User_Model');
      $this->load->model('Discount_Model');
      $this->load->model('Store_Model');

      $this->load->helper('form');
      $this->data['page_title']='Checkout';
      $main_store_data=$this->main_store_data;

      if(empty($this->loginId)){
        redirect('/Logins');
      }
      if($this->language_name=='French'){
         $this->data['page_title']='Check-out';
      }
      if ($stap == 1){
         $stap = base64_encode($stap);
      }

      $stap = base64_decode($stap);

      if ($order_id != '0') {
         $order_id=base64_decode($order_id);
      }

      if ($stap == 1 && !empty($this->loginId)){
         $stap=2;
      }

      if (!in_array($stap,array('1','2','3','4'))) {
          redirect('/');
      }

    if(isset($_GET['coupon_code']) && $_GET['coupon_code'] !='' && isset($_GET['apply_code']) && $_GET['apply_code'] !=''){
        $coupon_code=$_GET['coupon_code'];
        $couponData=$this->Discount_Model->getDiscountDataByCode($coupon_code);

        if(!empty($couponData)){
            $discount=$couponData['discount'];
            $discount_type=$couponData['discount_type'];
            $discount_valid_from=$couponData['discount_valid_from'];
            $discount_valid_to=$couponData['discount_valid_to'];
            $cdate=date('Y-m-d H:i:s');
            if(strtotime($discount_valid_from) > strtotime($cdate)){
               $this->session->set_flashdata('code_error','This coupon code that time not apply');
               $coupon_code='';
            }else if(strtotime($discount_valid_to) < strtotime($cdate)){
                $this->session->set_flashdata('code_error','coupon code expired');
                $coupon_code='';
            }else{
                $coupon_discount_amount='0';
                if(!empty($coupon_code) && !empty($order_id)){
                $ProductOrder=$this->ProductOrder_Model->getProductOrderDataById($order_id);
                $couponData=$this->Discount_Model->getDiscountDataByCode($coupon_code);
                //pr($couponData);
                if(!empty($couponData)){
                    $discount=$couponData['discount'];
                    $discount_type=$couponData['discount_type'];
                    $discount_valid_from=$couponData['discount_valid_from'];
                    $discount_valid_to=$couponData['discount_valid_to'];
                    $cdate=date('Y-m-d H:i:s');
                    if(strtotime($discount_valid_from) <= strtotime($cdate) && strtotime($discount_valid_to) >= strtotime($cdate)){
                       if($discount_type=='discount_percent'){
                           $coupon_discount_amount=($ProductOrder['sub_total_amount']*$discount)/100;
                       }else{
                           $coupon_discount_amount=$discount;
                       }
                    }else{
                        $coupon_code='';
                    }
                }else{
                    $coupon_code='';
                }
                if($coupon_code==$ProductOrder['coupon_code']){
                    $this->session->set_flashdata('code_success','coupon code already applied');
                }else if(!empty($ProductOrder['coupon_code']) && $coupon_code !=$ProductOrder['coupon_code']){
                    $ProductOrderNewData['coupon_discount_amount']=$coupon_discount_amount;
                    $ProductOrderNewData['coupon_code']=$coupon_code;
                    $ProductOrderNewData['total_amount']=($ProductOrder['total_amount']+$ProductOrder['coupon_discount_amount'])-$coupon_discount_amount;
                    $ProductOrderNewData['id']=$order_id;
                    $this->ProductOrder_Model->saveProductOrder($ProductOrderNewData);
                    $this->session->set_flashdata('code_success','coupon code applied successfully');
                }else{
                    $ProductOrderNewData['coupon_discount_amount']=$coupon_discount_amount;
                    $ProductOrderNewData['coupon_code']=$coupon_code;

                    $ProductOrderNewData['total_amount']=$ProductOrder['total_amount']-$coupon_discount_amount;
                    $ProductOrderNewData['id']=$order_id;
                    $this->ProductOrder_Model->saveProductOrder($ProductOrderNewData);
                    $this->session->set_flashdata('code_success','coupon code applied successfully');
                }
            }
            }
        }else{
            $this->session->set_flashdata('code_error','invalid coupon code');
        }

        redirect('Checkouts/index/'.base64_encode($stap).'/'.base64_encode($order_id)."/".base64_encode($product_id)."/".$coupon_code);
    }

      $address = $this->Address_Model->getAddressListByUserId($this->loginId);
      $this->data['address'] = $address;
      $this->data['states'] =array();
      $this->data['citys'] =array();

      //$this->Address_Model->getState();
      $this->data['countries'] = $this->Address_Model->getCountries();

      $ProductOrder = array();
      $ProductOrderItem = array();
      $userData=array();
      $total_charges_ups=array();
      $CanedaPostShiping=$FlagShiping=array();
      $salesTaxRatesProvinces_Data=array();
      $our_company_shiping_cost=0;
      if(!empty($this->loginId)){
          $userData=$this->User_Model->getUserDataById($this->loginId);
      }

      if(!empty($order_id)) {
        $ProductOrder=$this->ProductOrder_Model->getProductOrderDataById($order_id);
        $ProductOrderItem=$this->ProductOrder_Model->getProductOrderItemDataById($order_id);
         //pr($ProductOrder);
         if (empty($ProductOrder)){
            redirect('/');
         }

                $stateData=$this->Address_Model->getStateById($ProductOrder['shipping_state']);

                $CountryData=$this->Address_Model->getCountryById($ProductOrder['shipping_country']);
                $cityData=$this->Address_Model->getCityById($ProductOrder['shipping_city']);
                /*pr($stateData);
                pr($CountryData);
                pr($cityData);
                pr($ProductOrder);*/

                $shipping_pin_code=strtoupper(str_replace(" ","",$ProductOrder['shipping_pin_code']));

                $this->load->library('UpsKit/UpsRating');
                $this->upsrating->addField('ShipTo_Name', $ProductOrder['shipping_name']);
                $this->upsrating->addField('ShipTo_AddressLine', array(
                    $ProductOrder['shipping_address'], $ProductOrder['shipping_address']
                ));

                $this->upsrating->addField('ShipTo_City', $cityData['name']);
                $this->upsrating->addField('ShipTo_StateProvinceCode',$stateData['iso2']);
                $this->upsrating->addField('ShipTo_PostalCode', $shipping_pin_code);
                $this->upsrating->addField('ShipTo_CountryCode', $CountryData['iso2']);

                /* Package Dimension and Weight */
                /*$cart = $this->cart->contents();
                $dimensions = array();
                $index = 0;
                foreach( $cart as $rowid => $cart_data ) {
                    $dimensions[$index]['Length'] = $cart_data['options']['Length'];
                    $dimensions[$index]['Width'] = $cart_data['options']['Width'];
                    $dimensions[$index]['Height'] = $cart_data['options']['Height'];
                    $dimensions[$index]['Weight'] = $cart_data['options']['Weight'];
                    $dimensions[$index]['Qty'] = $cart_data['qty'];
                    $index++;
                }
                */
                $index = 0;
                //$dimensions[$index]['Length'] = 1;
                //$dimensions[$index]['Width'] = 1;
                //$dimensions[$index]['Height'] = 1;
            $dimensions[$index]['Weight'] = 1; #Kg
            $dimensions[$index]['Qty'] = $ProductOrder['total_items'];
            $this->upsrating->addField('dimensions', $dimensions);
            $this->upsrating->processRate();
            list($response, $status) = $this->upsrating->processRate();
            $ups_response = json_decode($response);
            //pr($ups_response);
            //pr($CanedaPostShiping);
            if($status==200){
                $total_charges_ups = $ups_response->RateResponse->RatedShipment;
            }

            $CanedaPostShiping=CanedaPostApigetRate($shipping_pin_code);

            $salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($ProductOrder['billing_state']);

            //pr($CanedaPostShiping,1);
           $storeData=$this->Store_Model->getDataById($ProductOrder['store_id']);

           $our_company_shiping_cost = calculateShippingCost($ProductOrder['total_amount']);
           $flag_ship= $storeData['flag_ship'];
           if($flag_ship=='yes'){
               $FlagShiping =getRatesFlagShip($ProductOrder,$ProductOrderItem,$CountryData,$stateData,$cityData,$storeData);
               //pr($FlagShiping,1);
           }
        } else {
            $ProductOrder['sub_total_amount'] = $this->cart->total();
            $ProductOrder['total_amount'] = $this->cart->total();
            $ProductOrder['preffered_customer_discount'] =0;

            $ProductOrder['currency_id'] = !empty($default_currency_id) ? $default_currency_id :1;

            $ProductOrder['store_id']=$main_store_data['id'];
            $ProductOrder['payment_mode']=$main_store_data['paypal_payment_mode'];

            if(!empty($userData)){
                 $user_type=$userData['user_type'];
                 $preferred_status=$userData['preferred_status'];
                 if($user_type==2 && $preferred_status==1){
                     $pramount=(($ProductOrder['sub_total_amount']*10)/100);
                     $ProductOrder['preffered_customer_discount'] =$pramount;
                     $ProductOrder['total_amount']=$ProductOrder['total_amount']-$pramount;
                 }
            }

            $ProductOrder['total_items'] = $this->cart->total_items();
            $items = $this->cart->contents();

        foreach($items as $key=>$item) {
          $ProductData=$this->Product_Model->getProductDataById($item['id']);
          #pr($ProductData);
          $ProductOrderItem[$key]['id']='';
          $ProductOrderItem[$key]['order_id']='';
          $ProductOrderItem[$key]['product_id']=$ProductData['id'];
          $ProductOrderItem[$key]['name']=$ProductData['name'];
           $ProductOrderItem[$key]['name_french']=$ProductData['name_french'];
          $ProductOrderItem[$key]['price']=$item['price'];
          $ProductOrderItem[$key]['short_description']=$ProductData['short_description'];
          $ProductOrderItem[$key]['full_description']=$ProductData['full_description'];
          $ProductOrderItem[$key]['discount']=$ProductData['discount'];

          $ProductOrderItem[$key]['product_image']=$ProductData['product_image'];
          $ProductOrderItem[$key]['cart_images']=json_encode($item['options']['cart_images']);
          $ProductOrderItem[$key]['attribute_ids']=json_encode($item['options']['attribute_ids']);

          $ProductOrderItem[$key]['product_size']=json_encode($item['options']['product_size']);

          $ProductOrderItem[$key]['product_width_length']=json_encode($item['options']['product_width_length']);

          $ProductOrderItem[$key]['page_product_width_length']=json_encode($item['options']['page_product_width_length']);

          $ProductOrderItem[$key]['product_depth_length_width']=json_encode($item['options']['product_depth_length_width']);

          $ProductOrderItem[$key]['votre_text']=$item['options']['votre_text'];

          $ProductOrderItem[$key]['recto_verso']=$item['options']['recto_verso'];

          $ProductOrderItem[$key]['code']=$ProductData['code'];
          $ProductOrderItem[$key]['brand']=$ProductData['brand'];
          $ProductOrderItem[$key]['quantity']=$item['qty'];
          $ProductOrderItem[$key]['subtotal']=$item['subtotal'];
          $ProductOrderItem[$key]['delivery_charge']=$ProductData['delivery_charge'];
          $ProductOrderItem[$key]['total_stock']=$ProductData['total_stock'];

          $ProductOrderItem[$key]['shipping_box_length']=$ProductData['shipping_box_length'];
          $ProductOrderItem[$key]['shipping_box_width']=$ProductData['shipping_box_width'];
          $ProductOrderItem[$key]['shipping_box_height']=$ProductData['shipping_box_height'];
          $ProductOrderItem[$key]['shipping_box_weight']=$ProductData['shipping_box_weight'];
        }

            $coupon_discount_amount='0';
            if(!empty($coupon_code)){
                $couponData=$this->Discount_Model->getDiscountDataByCode($coupon_code);
                //pr($couponData);
                if(!empty($couponData)){
                    $discount=$couponData['discount'];
                    $discount_type=$couponData['discount_type'];
                    $discount_valid_from=$couponData['discount_valid_from'];
                    $discount_valid_to=$couponData['discount_valid_to'];
                    $cdate=date('Y-m-d H:i:s');
                    if(strtotime($discount_valid_from) <= strtotime($cdate) && strtotime($discount_valid_to) >= strtotime($cdate)){
                       if($discount_type=='discount_percent'){
                           $coupon_discount_amount=($ProductOrder['sub_total_amount']*$discount)/100;
                       }else{
                           $coupon_discount_amount=$discount;
                       }
                    }else{
                        $coupon_code='';
                    }
                }else{
                    $coupon_code='';
                }
            }

            $ProductOrder['coupon_discount_amount']=$coupon_discount_amount;
            $ProductOrder['coupon_code']=$coupon_code;

            $ProductOrder['total_amount']=$ProductOrder['total_amount']-$coupon_discount_amount;

            $ProductOrder['total_sales_tax']='';

            //pr($ProductOrder,1);
      }

      //pr($ProductOrderItem); die();
      if (empty($this->cart->total_items()) && empty($order_id) && empty($product_id)) {
          redirect('/');
      }
      $postData=array();
      if ($this->input->post()) {
        $userData=$this->User_Model->getUserDataById($this->loginId);
        $PostData['delivery_address_id'] = $this->input->post('delivery_address_id') ?? $this->ProductOrder_Model->getProductOrderDataById($order_id)['delivery_address_id'];

        $address=$this->Address_Model->getAddressDataById($PostData['delivery_address_id']);
        if (!empty($order_id)){
          $PostData['id']=$order_id;
        }

        $PostData['user_id']=$this->loginId;
        $PostData['name']=$this->loginName;
        $PostData['email']=$userData['email'];
        $PostData['mobile']=$userData['mobile'];

        $PostData['billing_name']=$address['name'];
        $PostData['billing_company']=$address['company_name'];

        $PostData['billing_pin_code']=$address['pin_code'];
        $PostData['billing_mobile']=$address['mobile'];
        $PostData['billing_address']=$address['address'];
        $PostData['billing_city']=$address['city'];
        $PostData['billing_state']=$address['state'];
        $PostData['billing_country']=$address['country'];
        $PostData['billing_landmark']=$address['landmark'];
        $PostData['billing_alternate_phone']=$address['alternate_phone'];
        $PostData['billing_address_type']=$address['address_type'];

        $PostData['shipping_name']=$address['name'];
        $PostData['shipping_company']=$address['company_name'];
        $PostData['shipping_pin_code']=$address['pin_code'];
        $PostData['shipping_mobile']=$address['mobile'];
        $PostData['shipping_address']=$address['address'];
        $PostData['shipping_city']=$address['city'];
        $PostData['shipping_state']=$address['state'];
        $PostData['shipping_country']=$address['country'];
        $PostData['shipping_landmark']=$address['landmark'];
        $PostData['shipping_alternate_phone']=$address['alternate_phone'];
        $PostData['shipping_address_type']=$address['address_type'];

        $salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($PostData['billing_state']);

        $total_tax_rate=$salesTaxRatesProvinces_Data['total_tax_rate'];
        $total_sales_tax=(($ProductOrder['sub_total_amount']*$total_tax_rate)/100);
        $ProductOrder['total_amount']+$total_sales_tax;

        $PostData['total_amount']=$ProductOrder['total_amount']+$total_sales_tax;
        $PostData['total_sales_tax']=$total_sales_tax;

        $PostData['total_items']=$ProductOrder['total_items'];
        $PostData['preffered_customer_discount']=$ProductOrder['preffered_customer_discount'];
        $PostData['sub_total_amount']=$ProductOrder['sub_total_amount'];
        $PostData['currency_id'] =$ProductOrder['currency_id'];
        $PostData['store_id']=$ProductOrder['store_id'];
        $PostData['payment_mode']=$ProductOrder['payment_mode'];
        $PostData['coupon_code']= $ProductOrder['coupon_code'];
        $PostData['coupon_discount_amount']= $ProductOrder['coupon_discount_amount'];

        //pr($PostData,1);

        $insert_id=$this->ProductOrder_Model->saveProductOrder($PostData);

        if ($insert_id > 0) {
          $PostDataNew=array();
          $PostDataNew['id']=$insert_id;
          $PostDataNew['order_id']=$main_store_data['order_id_prefix'].$insert_id;

          //$shipping_method=$this->input->post('shipping_method_formate') ?? $this->ProductOrder_Model->getProductOrderDataById($order_id)['shipping_method_formate'];
          $shipping_method=$this->input->post('shipping_method_formate') ?? '';
          if(!empty($shipping_method)){
              $shipping_method_old=$this->ProductOrder_Model->getProductOrderDataById($order_id)['shipping_method_formate'];
              if(!empty($shipping_method_old)){
                   $delivery_charge_old=explode('-',$shipping_method_old);
                   $ProductOrder['total_amount']=$ProductOrder['total_amount']-$delivery_charge_old[1];
              }
              $PostDataNew['shipping_method_formate']=$shipping_method;
              $delivery_charge=explode('-',$shipping_method);
              $PostDataNew['delivery_charge']=$delivery_charge[1];
              $PostDataNew['total_amount']=$ProductOrder['total_amount']+$delivery_charge[1];

              if($delivery_charge[0]=='flagship'){
                  $PostDataNew['flag_shiping_cost']=!empty($delivery_charge[3]) ? $delivery_charge[3]:0;
              }else{
                  $PostDataNew['flag_shiping_cost']=0;
              }
          }

          $this->ProductOrder_Model->saveProductOrder($PostDataNew);

          foreach($ProductOrderItem as $ProductData) {
            $ProductOrderItemSaveData=array();
            $ProductOrderItemSaveData['id']=$ProductData['id'];
            $ProductOrderItemSaveData['product_id']=$ProductData['product_id'];
            $ProductOrderItemSaveData['order_id']=$insert_id;
            $ProductOrderItemSaveData['name']=$ProductData['name'];
            $ProductOrderItemSaveData['name_french']=$ProductData['name_french'];
            $ProductOrderItemSaveData['price']=$ProductData['price'];
            $ProductOrderItemSaveData['short_description']=$ProductData['short_description'];
            $ProductOrderItemSaveData['short_description_french']=$ProductData['short_description_french'];
            $ProductOrderItemSaveData['full_description']=$ProductData['full_description'];
            $ProductOrderItemSaveData['full_description_french']=$ProductData['full_description_french'];
            $ProductOrderItemSaveData['discount']=$ProductData['discount'];
            $ProductOrderItemSaveData['product_image']=$ProductData['product_image'];
            $ProductOrderItemSaveData['code']=$ProductData['code'];
            $ProductOrderItemSaveData['brand']=$ProductData['brand'];
            $ProductOrderItemSaveData['quantity']=$ProductData['quantity'];
            $ProductOrderItemSaveData['subtotal']=$ProductData['subtotal'];
            $ProductOrderItemSaveData['delivery_charge']=$ProductData['delivery_charge'];
            $ProductOrderItemSaveData['total_stock']=$ProductData['total_stock'];
            $ProductOrderItemSaveData['cart_images']=$ProductData['cart_images'];
            $ProductOrderItemSaveData['attribute_ids']=$ProductData['attribute_ids'];

            $ProductOrderItemSaveData['product_size']=$ProductData['product_size'];

            $ProductOrderItemSaveData['product_width_length']=$ProductData['product_width_length'];

            $ProductOrderItemSaveData['page_product_width_length']=$ProductData['page_product_width_length'];

            $ProductOrderItemSaveData['product_depth_length_width']=$ProductData['product_depth_length_width'];

            $ProductOrderItemSaveData['votre_text']=$ProductData['votre_text'];

            $ProductOrderItemSaveData['recto_verso']=$ProductData['recto_verso'];

            $ProductOrderItemSaveData['shipping_box_length']=$ProductData['shipping_box_length'];
            $ProductOrderItemSaveData['shipping_box_width']=$ProductData['shipping_box_width'];
            $ProductOrderItemSaveData['shipping_box_height']=$ProductData['shipping_box_height'];
            $ProductOrderItemSaveData['shipping_box_weight']=$ProductData['shipping_box_weight'];

            $this->ProductOrder_Model->saveProductOrderItem($ProductOrderItemSaveData);
          }

          $stap = $stap+1;
          redirect('Checkouts/index/'.base64_encode($stap).'/'.base64_encode($insert_id)."/".base64_encode($product_id)."/".$coupon_code);
        } else{
          $this->session->set_flashdata('message_error','oder save  Unsuccessfully.');
        }
      }

      $PickupStoresList=$this->Store_Model->getPickupStoresList();

      $this->data['order_id']=base64_encode($order_id);
      $this->data['stap']=base64_encode($stap);
      $this->data['product_id']=base64_encode($product_id);
      $this->data['ProductOrder']=$ProductOrder;
      $this->data['ProductOrderItem']=$ProductOrderItem;
      $this->data['total_charges_ups']=$total_charges_ups;
      $this->data['CanedaPostShiping']=$CanedaPostShiping;
      $this->data['FlagShiping']=$FlagShiping;
      $this->data['PickupStoresList']=$PickupStoresList;

      $this->data['salesTaxRatesProvinces_Data']=$salesTaxRatesProvinces_Data;
      $this->data['our_company_shiping_cost']=$our_company_shiping_cost;

      $this->data['coupon_code']=$coupon_code;
      $this->render($this->class_name.'index');
    }

    public function SubmitOrder() {
        $this->data['page_title']='Submit Order Details';
        $this->load->model('ProductOrder_Model');
        $this->load->model('Product_Model');
        $this->load->model('User_Model');
        $ProductOrder=array();
        $ProductOrderItem=array();
        $checkSum = "";
        $paramList = array();
        $payment_type='';

        if($this->input->post()){
            $postData=array();
            $userData=$this->User_Model->getUserDataById($this->loginId);
            $order_id=$this->input->post('order_id');
            $payment_type=$this->input->post('payment_type');
            $ProductOrder=$this->ProductOrder_Model->getProductOrderDataById(
            $order_id);

            if(!empty($order_id)){
                $postData['payment_type']=$payment_type;
                $postData['id']=$order_id;
                $this->ProductOrder_Model->saveProductOrder($postData);

                if($payment_type=='cod')
                {
                    $orderData['status']=2;
                    $orderData['order_id']=$ProductOrder['order_id'];
                    if($this->UpdateOrderStatus($orderData)){
                        $this->session->set_flashdata('message_success','your order has been placed successfully');
                    }else{
                        $this->session->set_flashdata('message_error','your order has been placed unsuccessfully');
                    }

                   $this->data['payment_type']=$payment_type;
                   $this->data['ProductOrder']=$ProductOrder;
                   $this->render($this->class_name.'cod_response');
                }else if($payment_type=='paypal')
                {
                    /*$returnURL = base_url().'Checkouts/success'; //payment success url
                    $cancelURL = base_url().'Checkouts/cancel'; //payment cancel url
                    $notifyURL = base_url().'Checkouts/ipn'; //ipn url
                    $this->paypal_lib->add_field('return', $returnURL);
                    $this->paypal_lib->add_field('cancel_return', $cancelURL);
                    $this->paypal_lib->add_field('notify_url', $notifyURL);
                    $this->paypal_lib->add_field('name',$ProductOrder['name']);
                    $this->paypal_lib->add_field('email',$ProductOrder['email']);
                    $this->paypal_lib->add_field('mobile',$ProductOrder['mobile']);
                    //$this->paypal_lib->add_field('userid', $ProductOrder['order_id']);
                    $this->paypal_lib->add_field('item_number',$ProductOrder['id']);
                    $this->paypal_lib->add_field('amount', $ProductOrder['total_amount']);
                    // Load paypal form/
                    $this->paypal_lib->paypal_auto_form();*/
                    $data['ProductOrder']=$ProductOrder;
                    $data['BASE_URL']=base_url();
                    $data['language_name']=$this->language_name;
                    $data['MainStoreData']=$this->main_store_data;
                    $this->load->view('elements/PaypalRedirect',$data);
                }
                else if($payment_type=='pos')
                {
                    $req = $_POST;
                    if(!empty(@$req['card-num']) && !empty(@$req['ExpMonth']) && !empty(@$req['ExpYear']) && !empty(@$req['cvv']))
                    {
                        $data = [
                            'card'=>[
                                'number'=>str_replace(" ","",$req['card-num']),
                                'exp_month'=>$req['ExpMonth'],
                                'exp_year'=>$req['ExpYear'],
                                'cvv'=>$req['cvv'],
                            ]
                        ];
                        $card = $this->cardPaymentRequest($data,$this->data['MainStoreData']);
                        if($card['token'])
                        {
                            $this->load->model('Store_Model');
                            $currency = $this->Store_Model->getCurrency($ProductOrder['currency_id']);
                            $currency_code = count($currency) > 0 ? $currency['code'] : 'cad';
                            $requestData = [
                                'amount'=>(round($ProductOrder['total_amount'])*100),
                                'currency'=>strtolower($currency_code),
                                'capture'=>'true',
                                'description'=>'Products Order Payment',
                                'external_reference_id'=>$ProductOrder['id'],
                                'receipt_email'=>$ProductOrder['email'],
                                'source'=>$card['token'],
                                'ecomind'=>'ecom'
                            ];
                            $response = $this->paymentRequest($requestData,$this->data['MainStoreData']);
                            $orderData['id']=$ProductOrder['id'];
                            if($response['status'])
                            {
                                    $this->session->set_flashdata('message_success',$response['msg']);
                                /* payment response */
                                    $paymentRes =  json_decode($response['paymentData']);
                                    $this->load->model('ProductOrder_Model');
                                    $this->data['page_title']='Order Details';
                                    $orderData['status']=2;
                                    $orderData['payment_status']=2;
                                    $orderData['transition_remark']='payment success';
                                    $orderData['payment_method']='POS';
                                    $orderData['transition_id']=$paymentRes->id;
                                    $orderData['paypal_responce']=$response['paymentData'];
                                    $this->UpdateOrderStatus($orderData);
                                    $this->data['orderData']=$this->ProductOrder_Model->getProductOrderDataById($orderData['id']);
                                    $this->session->set_flashdata('message_success',$response['msg']);
                                    redirect('MyOrders/view/'.base64_encode($orderData['id']));
                                /* payment response */
                            }else
                            {
                                $orderData['payment_status']=3;
                                $orderData['transition_remark']='payment Failed';
                                $this->ProductOrder_Model->saveProductOrder($orderData);
                                $this->session->set_flashdata('message_error',$response['msg']);
                            }
                        }else
                        {
                            $this->session->set_flashdata('message_error',$card['msg']);
                            $orderData['payment_status']=2;
                            $orderData['transition_remark']='Pending';
                            $this->ProductOrder_Model->saveProductOrder($orderData);
                            $referer = $_SERVER['HTTP_REFERER'];
                            $this->load->library('user_agent');
                            if ($this->agent->is_referral())
                            {
                                $referer= $this->agent->referrer();
                            }
                            return redirect($referer);
                        }
                    }else
                    {
                        $this->session->set_flashdata('message_error','Missing Information.');
                    }
                    redirect('MyOrders/view/'.base64_encode($postData['id']));
                }else{
                    $this->session->set_flashdata('message_error','Your Order has been placed Unsuccessfully');
                    redirect('Homes');
                }
            }else{
                redirect('Homes');
            }
        }else{
               redirect('Homes');
        }
    }

        public function cardPaymentRequest($data,$mainStoreData)
        {
            $url = $mainStoreData['clover_mode'] == 1 ? 'https://token.clover.com/v1/' : 'https://token-sandbox.dev.clover.com/v1/';
            $apiKey = $mainStoreData['clover_mode'] == 1 ? $mainStoreData['clover_api_key'] : $mainStoreData['clover_sandbox_api_key'];
            $res = ['token'=>false,'msg'=>'Invalid Card Credentials'];
            $curl = curl_init();
            curl_setopt_array($curl,[
                CURLOPT_URL => $url."tokens",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    "Accept: application/json",
                    "Content-Type: application/json",
                    "apikey: ".$apiKey
                ],
            ]);
            $response = json_decode(curl_exec($curl));
            $err = curl_error($curl);
            curl_close($curl);
            if ($err) {
                $res['msg'] = $err;
            }
            else {
                if(isset($response->id))
                {
                    $res['token'] = $response->id;
                    $res['msg'] = "";
                }elseif(isset($response->error->message))
                {
                    $res['msg'] = $response->error->message;
                }else
                {
                    $res['msg'] = $response->message;
                }
            }
            return $res;
        }

        public function paymentRequest($data,$mainStoreData)
      {
            $res = ['status'=>false,'paymentData'=>false,'msg'=>"Your Order's Payment Failed"];
            $curl = curl_init();
            $url = $mainStoreData['clover_mode'] == 1 ? "https://scl.clover.com/v1/" : "https://scl-sandbox.dev.clover.com/v1/";
            $token = $mainStoreData['clover_mode'] == 1 ? $mainStoreData['clover_secret'] : $mainStoreData['clover_sandbox_secret'];
            curl_setopt_array($curl, [
                CURLOPT_URL => $url."charges",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => [
                    "Accept: application/json",
                    "Authorization: Bearer ".$token,
                    "Content-Type: application/json"
                ],
            ]);
            $response = json_decode(curl_exec($curl));
            $err = curl_error($curl);
            curl_close($curl);
            if($err)
            {
                $res['msg']=$err;
            }else {
                if(isset($response->id) && $response->status=="succeeded")
                {
                    $res['msg']='Your order has been placed Successfully';
                    $res['paymentData']=json_encode($response);
                    $res['status']=true;
                }else{
                    $res['msg']='Your order has been placed Unsuccessfully';
                    if(isset($response->message))
                    {
                        $res['msg'] = $response->message;
                    }
                    $res['paymentData']=json_encode($response);
                }
            }
            return $res;
        }
    function PayPalSuccessResponse($order_id=null){
        $this->load->model('ProductOrder_Model');
        $orderData=array();
        $this->data['page_title']='Order Details';
        $payment_status=$_REQUEST['payment_status'];
        $txn_id=$_REQUEST['txn_id'];
        $PayerID=$_REQUEST['PayerID'];

        if(!empty($order_id)){
            $orderData['id']=$order_id;
            $orderData['status']=2;
            $orderData['payment_method']='paypal';
            $orderData['transition_id']=$txn_id;

            if(!empty($_REQUEST)){
               $myPost=$_REQUEST;
               $orderData['paypal_responce']=json_encode($myPost);
            }

            if($payment_status=='Completed' || $payment_status=='completed'){
                $orderData['payment_status']=2;
                $orderData['transition_remark']='payment success';
                $this->UpdateOrderStatus($orderData);
            }else if($payment_status=='Pending' || $payment_status=='pending'){
                $orderData['payment_status']=1;
                $orderData['transition_remark']='payment Pending';
                $this->ProductOrder_Model->saveProductOrder($orderData);
            }else{
                $orderData['payment_status']=3;
                $orderData['transition_remark']='payment Failed';
                if(!empty($PayerID)){
                    $orderData['payment_status']=2;
                    $orderData['transition_remark']='payment success';
                    if(empty($txn_id)){
                        $orderData['transition_id']=$PayerID;
                    }
                }

                $this->ProductOrder_Model->saveProductOrder($orderData);
            }

            //$this->UpdateOrderStatus($orderData);
            $this->data['orderData']=$orderData;
          $this->session->set_flashdata('message_success','Your order payment has been successfully processed');
            #pr($_REQUEST,1);
            redirect('MyOrders/view/'.base64_encode($order_id));
        }else{
             redirect('Homes');
        }
    }
    function defaultPayPalIPNResponse(){
        exit();
    }
    function PayPalIPNResponse($order_id=null){
        $this->load->model('Store_Model');
        $this->load->model('ProductOrder_Model');
        $PostOrderData=$this->ProductOrder_Model->getProductOrderDataById($order_id);
        $store_id=$PostOrderData['store_id'];
        $postStoreData=$this->Store_Model->getStoreDataById($store_id);
        $paypal_payment_mode=$postStoreData['paypal_payment_mode'];
        $url='https://www.paypal.com/cgi-bin/webscr';
        if($paypal_payment_mode=='sandbox'){
            $url='https://www.sandbox.paypal.com/cgi-bin/webscr';
        }
        $txn_id=$payment_status='';
        #STEP 1: read POST data
        // Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
        //Instead, read raw POST data from the input stream.
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
          $keyval = explode ('=', $keyval);
          if (count($keyval) == 2)
             $myPost[$keyval[0]] = urldecode($keyval[1]);
        }

        // read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
           $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
           if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
           } else {
                $value = urlencode($value);
           }
           $req .= "&$key=$value";
        }

        //STEP 2: POST IPN data back to PayPal to validate
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        // In wamp-like environments that do not come bundled with root authority certificates,
        // please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set
        // the directory path of the certificate as shown below:
        // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        if( !($res = curl_exec($ch)) ){
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
        // STEP 3: Inspect IPN validation result and act accordingly
        if (strcmp ($res, "VERIFIED") == 0) {
            // The IPN is verified, process it:
            // check whether the payment_status is Completed
            // check that txn_id has not been previously processed
            // check that receiver_email is your Primary PayPal email
            // check that payment_amount/payment_currency are correct
            // process the notification
            // assign posted variables to local variables
            /*$item_name = $_POST['item_name'];
            $item_number = $_POST['item_number'];
            $payment_status = $_POST['payment_status'];
            $payment_amount = $_POST['mc_gross'];
            $payment_currency = $_POST['mc_currency'];*/
            $txn_id = $_POST['txn_id'];
            $payment_status = $_POST['payment_status'];
            /*$receiver_email = $_POST['receiver_email'];
            $payer_email = $_POST['payer_email'];*/
            // IPN message values depend upon the type of notification sent.
            // To loop through the &_POST array and print the NV pairs to the screen:
            foreach($_POST as $key => $value) {
              echo $key." = ". $value."<br>";
            }
        } else if (strcmp ($res, "INVALID") == 0) {
            // IPN invalid, log for manual investigation
            $dateTime=date('Y-m-d H:i:s');
            $log="DateTime:$dateTime Responce-Data:$raw_post_data The \n response from IPN was:" .$res ."\n url:$url\n order_id:$order_id\n store_id:$store_id\n ";
            //file_put_contents(FILE_BASE_PATH.'payment-ipn-log',$log);
            $file = fopen("payment-ipn-log","a");
            fwrite($file, $log);
            fclose($file);
            exit();
        }
        $dateTime=date('Y-m-d H:i:s');
        //file_put_contents(FILE_BASE_PATH.'payment-ipn-log',$log);
        $log="DateTime:$dateTime Responce-Data:$raw_post_data The \n response from IPN was:" .$res ."\n url:$url\n order_id:$order_id\n store_id:$store_id\n ";
        $file = fopen("payment-ipn-log","a");
        fwrite($file, $log);
        fclose($file);

        $orderData=array();
        $orderData['id']=$order_id;
        $orderData['payment_method']='paypal';
        $orderData['payment_status']=2;

        if(!empty($raw_post_data)){
            $orderData['paypal_responce']=$raw_post_data;
        }

        if(!empty($order_id)){
            $orderData['id']=$order_id;
            $orderData['status']=2;
            $orderData['payment_method']='paypal';
            if($payment_status=='Completed' || $payment_status=='completed'){
                $orderData['payment_status']=2;
                $orderData['transition_remark']='payment success';
            }else if($payment_status=='Pending' || $payment_status=='pending'){
                $orderData['payment_status']=1;
                $orderData['transition_remark']='payment Pending';
            }else{
                $orderData['payment_status']=3;
                $orderData['transition_remark']='payment Failed';
            }
            $orderData['transition_id']=$txn_id;
            $this->UpdateOrderStatus($orderData);
            exit();
        }
        exit();
    }

    function PayPalCancelResponse($order_id=null){
        $orderData=array();
        $this->data['page_title']='Order Details';
        if(!empty($order_id)){
             $orderData['id']=$order_id;
             $orderData['status']=7;
             $orderData['payment_status']=3;
             $this->UpdateOrderStatus($orderData);
             $this->session->set_flashdata('message_error','Your order payment has been failed');
             $this->data['orderData']=$orderData;
             redirect('MyOrders/view/'.base64_encode($order_id));
        }else{
            redirect('Homes');
        }
    }

    function UpdateOrderStatus($orderData=array()){
        $this->load->model('ProductOrder_Model');
        $this->load->model('Product_Model');
        $this->load->model('User_Model');
        $this->load->model('Address_Model');
        $this->load->model('Store_Model');

        $id=$orderData['id'];
        $insert_id=$this->ProductOrder_Model->saveProductOrder($orderData);
        $ProductOrderItem=$this->ProductOrder_Model->getProductOrderItemDataById($id);
        $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
        //$StoreData=$this->main_store_data;
        $store_id=$orderData['store_id'];
        $StoreData=$this->Store_Model->getStoreDataById($store_id);

        $store_url    = $StoreData['url'];
        $store_phone  = $StoreData['phone'];
        $from_name    = $StoreData['name'];
        $from_email   = $StoreData['from_email'];
        $admin_email1 = $StoreData['admin_email1'];
        $admin_email2 = $StoreData['admin_email2'];
        $admin_email3 = $StoreData['admin_email3'];

        if($orderData['status']==2) {
                foreach($ProductOrderItem as $order){
                    $ProductDataSave=array();
                    $product_id=$order['product_id'];
                    $quantityOrderItem=$order['quantity'];
                    $ProductData=$this->Product_Model->getProductDataById($product_id);
                    $total_stock=$ProductData['total_stock'];
                    $total_stock= $total_stock-$quantityOrderItem;

                    if($total_stock < 0){
                        $total_stock=0;
                    }
                    $ProductDataSave['id']=$ProductData['id'];
                    $ProductDataSave['total_stock']=$total_stock;
                    $this->Product_Model->saveProduct($ProductDataSave);
                }

                    #Oreder Invoice And Order  Pdf  Created
                    $this->getOrderInvoicePdf($id,$this->main_store_id);
                    $this->getOrderPdf($id,$this->main_store_id);

                    #send Email and Msg
                    $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
                    $order_url=$store_url.'MyOrders/view/'.base64_encode($id);
                    $toEmail=$orderData['email'];
                    $name=$orderData['name'];
                    $order_id=$orderData['order_id'];

                    if($this->language_name=='French'){
                        $order_id=$orderData['order_id'];
                        //$subject='Order '.$order_id.' Confirmation';
                        $subject='Reçu de la commande n ° '.$order_id;

                        $image=$this->Store_Model->getStoreEmailTemapleImage($this->main_store_id,'receipt_for_order');
                        $image_template='';
                        if(!empty($image)){
                            $image_url=$store_url.'uploads/email_templates/'.$image;
                            $image_template="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'><a href='".$order_url."'><img style='width:578px;' src='".$image_url."'></a></div>";
                        }

                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="color:#303030; font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block;">
                        '.$image_template.'
                        <br>
                        DÉTAILS DE LA COMMANDE
                        </span>
                        </div><br><br>';

                        /*$body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="color:#303030; font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block;">
                        salut '.ucfirst($name).',
                        <br>
                            Merci pour votre commande.
                        </span>
                        </div><br><br>';*/

                        $invoice_file=$orderData['order_id'].'-fr-invoice.pdf';
                        $invoice_file=strtolower($invoice_file);
                        $order_file=$orderData['order_id'].'-fr-order.pdf';
                        $order_file=strtolower($order_file);
                        $files[$invoice_file]=FILE_BASE_PATH.'pdf/'.$invoice_file;
                        $files[$order_file]=FILE_BASE_PATH.'pdf/'.$order_file;
                        $body=$this->getorderEmail($id,$subject,$body,$this->main_store_id);
                    }else{
                        $subject='Receipt for order '.$order_id;
                        //$subject='Order '.$order_id.' Confirmation';
                        $image=$this->Store_Model->getStoreEmailTemapleImage($this->main_store_id,'receipt_for_order');
                        $image_template='';
                        if(!empty($image)){
                            $image_url=$store_url.'uploads/email_templates/'.$image;
                            $image_template="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'><a href='".$order_url."'><img style='width:578px;' src='".$image_url."'></a></div>";
                        }
                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="color:#303030; font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block;">
                        '.$image_template.'
                        <br>
                         ORDER DETAILS
                        </span>
                        </div><br><br>';

                        /*$body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="color:#303030; font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block;">
                        Hi '.ucfirst($name).',
                        <br>
                            Thanks for your order.
                        </span>
                        </div><br><br>';*/

                        $invoice_file=$orderData['order_id'].'-invoice.pdf';
                        $invoice_file=strtolower($invoice_file);
                        $order_file=$orderData['order_id'].'-order.pdf';
                        $order_file=strtolower($order_file);
                        $files[$invoice_file]=FILE_BASE_PATH.'pdf/'.$invoice_file;
                        $files[$order_file]=FILE_BASE_PATH.'pdf/'.$order_file;

                        $body=$this->getorderEmail($id,$subject,$body,$this->main_store_id);
                    }

                    sendEmail($toEmail,$subject,$body,$from_email,$from_name,$files);

                    if(!empty($admin_email1)){
                        sendEmail($admin_email1,$subject,$body,$from_email,$from_name,$files);
                    }
                    if(!empty($admin_email2)){
                        sendEmail($admin_email2,$subject,$body,$from_email,$from_name,$files);
                    }
                    if(!empty($admin_email3)){
                        sendEmail($admin_email3,$subject,$body,$from_email,$from_name,$files);
                    }
        }else if($orderData['status']==7){
                    $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
                    $toEmail=$orderData['email'];
                    $name=$orderData['name'];
                    $order_id=$orderData['order_id'];

                    if($this->language_name=='French'){
                        $order_id=$orderData['order_id'];

                        $subject='Votre commande '.$order_id.'Le paiement a échoué ';
                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;">
                            <span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                salut '.$name.',
                            <br>
                               votre paiement a échoué pour le '.$order_id.' . T Il peut y avoir de nombreuses raisons à ce problème. Peut-être avez-vous une mauvaise connexion Internet ou une défaillance de la passerelle de paiement.

                               Attendez quelques heures et réessayez<br>

                                Merci! '.$from_name.' Équipe

                            </span>
                        </div><br><br>';

                        $body=$this->getorderEmailFrance($id,$subject,$body,$this->main_store_id);
                    }else{
                        $subject='Your Order '.$order_id.'Payment Has Been Failed ';
                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;">
                            <span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                Hi '.$name.',
                            <br>
                               your payment has been failed for the '.$order_id.' . There could be numerous reasons for this issue. May you have a poor internet connection or payment gateway failure.

                               Wait a couple of hours and try again.<br>

                                Thanks! '.$from_name.' Team

                            </span>
                        </div><br><br>';
                        $body=$this->getorderEmail($id,$subject,$body,$this->main_store_id);
                    }

                    sendEmail($toEmail,$subject,$body,$from_email,$from_name);

                    if(!empty($admin_email1)){
                        sendEmail($admin_email1,$subject,$body,$from_email,$from_name);
                    }

                    if(!empty($admin_email2)){
                        sendEmail($admin_email2,$subject,$body,$from_email,$from_name);
                    }

                    if(!empty($admin_email3)){
                        sendEmail($admin_email3,$subject,$body,$from_email,$from_name);
                    }
        }

        $this->cart->destroy();
        if($insert_id > 0){
           return true;
        }else{
            return false;
        }
    }

    function removeOrderItem(){
            $json=array('status'=>0,'msg'=>'');
            $rowId=$this->input->post('rowId');
            $data=array();
            if($this->cart->remove($rowId)){
            $json['status']=1;
            $json['total_item']=$this->cart->total_items();
            $json['sub_total']=CURREBCY_SYMBOL.number_format($this->cart->total(),2);
            }else{
                $json['msg']='shopping cart item remove has been field';
            }
        echo json_encode($json);
    }

    function updateOrderItem(){
            $json=array('status'=>0,'msg'=>'');
            $rowId=$this->input->post('rowId');
            $quantity=$this->input->post('quantity');
            $data = array(
               'rowid' => $rowId,
                'qty'   => $quantity
            );

            if($this->cart->update($data)){
            $row=$this->cart->get_item($rowId);
            $json['status']=1;
            $json['total_item']=$this->cart->total_items();
            $json['sub_total']=CURREBCY_SYMBOL.number_format($this->cart->total(),2);
            $json['row_sub_total']=CURREBCY_SYMBOL.number_format($row['subtotal'],2);
            }else{
                $json['msg']='shopping cart item update has been field';
            }
        echo json_encode($json);
    }
}
