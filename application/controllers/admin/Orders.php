<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller
{
	public $class_name='';
	function __construct()
	{
		parent::__construct();
		$this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/'; 
		$this->data['class_name']= $this->class_name;
	}
	
    public function index($status=null,$user_id=null)
    {
		$this->load->model('ProductOrder_Model');
		$this->load->model('Address_Model');
		
		$this->data['page_title'] =ucfirst($status).' Orders';
		$this->data['page_status'] =$status;
		$this->data['sub_page_view_url'] = 'viewOrder';
		$this->data['sub_page_delete_url'] = 'deleteOrder';
		$fromDate=$toDate='';
		if($this->input->post()){
			
		    $fromDate=$this->input->post('fromDate');
		    $toDate=$this->input->post('toDate');
		    
		}
		
		$lists=$this->ProductOrder_Model->getOrderList($status,$user_id,$fromDate,$toDate);
		
		$this->load->model('Store_Model');		
		$StoreList=$this->Store_Model->getAllStoreList();
		$this->data['StoreList']=$StoreList;
		#pr($StoreList,1);
		
		$this->data['lists']=$lists;
		$this->data['user_id']=!empty($user_id) ? $user_id:'0';
		$this->data['fromDate']=$fromDate;
		$this->data['toDate']=$toDate;
		$this->data['status']=!empty($status) ? $status:'all';
		//print_r($this->data['lists']);die;
		$this->render($this->class_name.'index');
	
    }
    
    public function personaliseDetail(){
        
    	$this->load->model('ProductOrder_Model');
    	$id=$this->input->post('id');
    	$data=$this->ProductOrder_Model->personaliseDetail($id);
    	echo json_encode($data);

    }
	
    public function changeOrderStatus($id=null,$status=null)
    {	
	    
		$this->load->model('Address_Model');
		$id=$this->input->post('order_id');
		$status=$this->input->post('status');
        $emailMsg=$this->input->post('emailMsg');
		$json=array('status'=>0,'msg'=>'');
        if(!empty($id) && !empty($status)){
			
			    $postData['id']=$id;
				if($status !=4){  
		            $postData['status']=$status;
				}
				$this->load->model('ProductOrder_Model');
				$this->load->model('Store_Model');
				if ($this->ProductOrder_Model->saveProductOrder($postData))
				{   
					$orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
					#pr($orderData,1);
					
					$shipping_state=$this->Address_Model->getStateById($orderData['shipping_state']);
					$orderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);
				    $CountryData=$this->Address_Model->getCountryById($orderData['shipping_country']);
				    $cityData=$this->Address_Model->getCityById($orderData['shipping_city']);
					
					$toEmail=$orderData['email'];
					$name=$orderData['name'];
					$mobile=$orderData['mobile'];
					$order_id=$orderData['order_id'];
					
					$store_id=$orderData['store_id'];
					$StoreData=$this->Store_Model->getStoreDataById($store_id);
					
					$store_url    = $StoreData['url'];
					$store_phone  = $StoreData['phone'];
					$from_name    = $StoreData['name'];
					$from_email   = $StoreData['from_email'];
					$admin_email1 = $StoreData['admin_email1'];
					$admin_email2 = $StoreData['admin_email2'];
					$admin_email3 = $StoreData['admin_email3'];
					
					$langue_id=$StoreData['langue_id'];
				
					if($status==3){
						
						
						if($langue_id==2){
							
							$subject='Votre commande'.$order_id.' traite';
						    $body='<div class="top-info" style="margin-top: 15px;text-align: left;">
							<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
							
							'.$emailMsg.'<br>
							<h1>NOUS VOUS REMERCIONS DE VOTRE COMMANDE!</h1>
						   </span>
					       </div><br></br>';
						   
						}else{
							
							$subject='Your Order '.$order_id.' is processing';
						    $body='<div class="top-info" style="margin-top: 15px;text-align: left;">
							<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
							<br>
							'.$emailMsg.'<br>
						    <h1>THANK YOU FOR YOUR ORDER!</h1>
						   </span>
					       </div><br></br>';
						}
						
						
					
					
					}else if($status==4){
						
						$image=$this->Store_Model->getStoreEmailTemapleImage($store_id,'shipped_order');
						
						$image_template='';
						if($orderData['shipping_method_formate']){
							
							$shipping_method_formate=explode('-',$orderData['shipping_method_formate']);
							
							
							if($shipping_method_formate[0]=="flagship"){
								
								$tracking_number='';
								#FlagShipAPi Code
								$FlagShipConfirmData=FlagShipConfirm($orderData,$orderItemData,$CountryData,$shipping_state,$cityData,$StoreData);
								//pr($FlagShipConfirmData,1);
								if($FlagShipConfirmData['status']==0){
									
									$json['msg']=$FlagShipConfirmData['msg'];
									echo json_encode($json);
									exit();	
								}
								
								$data=$FlagShipConfirmData['data']->shipment;
								$postData['shipment_id']=$data->shipment_id;
								$tracking_number=$postData['tracking_number']=$data->tracking_number;
								
								$postData['labels_regular']=$data->labels->regular;
								$postData['labels_thermal']=$data->labels->thermal;
								$postData['shipment_data']=json_encode($data);
								#FlagShipAPi End;
								
							}
						}
						
						$postData['id']=$id;
		                $postData['status']=$status;
						$this->ProductOrder_Model->saveProductOrder($postData);
						
						if(!empty($image)){
							
							$image_url=$store_url.'uploads/email_templates/'.$image;
							$image_template="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'><a href='".$store_url."/Logins'><img style='width:578px;'  src='".$image_url."'></a></div>";
							
						}
						
						if($langue_id==2){
							
							$subject='Votre commande '.$order_id.' a été expédié.';
							$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
							<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
							 '.$image_template.'
							<br>
							
								'.$emailMsg.'<br>
								<!--<p>Suivre votre commande</p>
							    <p>Numéro de suivi:'.$tracking_number.'</p>-->
								<h1>NOUS VOUS REMERCIONS DE VOTRE COMMANDE!</h1>
								
							</span>
							</div></br></br>';
						}else{
							
							$subject='Your Order '.$order_id.' has been shipped.';
							$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
							<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
							'.$image_template.'
							<br>
							
								'.$emailMsg.'<br>
								<!--<p>Track Your Order</p>
							    <p>Tracking Number:'.$tracking_number.'</p>-->
								
								<h1>THANK YOU FOR YOUR ORDER!</h1>
								
							</span>
							</div></br></br>';
						}
					
					}else if($status==9){
					    if($langue_id==2){
							
							$subject="Votre commande $order_id a été prête pour le ramassage ";
								$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
								<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
								   
									'.$emailMsg.'<br>
									<h1>NOUS VOUS REMERCIONS DE VOTRE COMMANDE!</h1>
								</span>
							</div><br><br>';
							
						}else{
							
							    $subject='Your Order '.$order_id.' has been Ready for pickup.';
								$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
								<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
									'.$emailMsg.'<br>
								   <h1>THANK YOU FOR YOUR ORDER!</h1>
								</span>
							</div><br><br>';
							
						}
						
					}
					else if($status==5){
						
					    if($langue_id==2){
							
							$subject="Votre commande $order_id a été livré";
								$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
								<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
								   
									'.$emailMsg.'<br>
									<h1>NOUS VOUS REMERCIONS DE VOTRE COMMANDE!</h1>
								</span>
							</div><br><br>';
							
						}else{
							
							    $subject='Your Order '.$order_id.' has been delivered.';
								$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
								<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
									'.$emailMsg.'<br>
								   <h1>THANK YOU FOR YOUR ORDER!</h1>
								</span>
							</div><br><br>';
							
						}
						
					}else if($status==6){
						
						if($orderData['shipping_method_formate']){
							
							$shipping_method_formate=explode('-',$orderData['shipping_method_formate']);
							if($shipping_method_formate[0]=="flagship"){
								
							     $data=FlagShipCancal($orderData,$StoreData);
								
							}
						}
						if($langue_id==2){
							
							    $subject="Votre commande ". $order_id." a été annulé.";
								$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
								<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
								<br>
									'.$emailMsg.'<br>
									<h1>NOUS VOUS REMERCIONS DE VOTRE COMMANDE!</h1>
								</span>
							</div><br><br>';
							
						}else{
							
							    $subject='Your Order '.$order_id.' has been cancelled.';
								$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
								<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
								<br>
									'.$emailMsg.'<br>
									<h1>THANK YOU FOR YOUR ORDER!</h1>
								</span>
							</div><br><br>';
						}
					
					}
					
					if($langue_id==2){
						
						$invoice_file=$orderData['order_id'].'-fr-invoice.pdf';
						$invoice_file=strtolower($invoice_file);
						$invoicefilePath=FILE_BASE_PATH.'pdf/'.$invoice_file;
						
						$order_file=$orderData['order_id'].'-fr-order.pdf';
		                $order_file=strtolower($order_file);
						$orderfilePath=FILE_BASE_PATH.'pdf/'.$order_file;
						
					}else{
						
						$invoice_file=$orderData['order_id'].'-invoice.pdf';
						$invoice_file=strtolower($invoice_file);
						$invoicefilePath=FILE_BASE_PATH.'pdf/'.$invoice_file;
						
						$order_file=$orderData['order_id'].'-order.pdf';
		                $order_file=strtolower($order_file);
						$orderfilePath=FILE_BASE_PATH.'pdf/'.$order_file;
						
					}
					
					if(!file_exists ($invoicefilePath)) {
						
						$this->getOrderInvoicePdf($id,$store_id);
					}
					if(!file_exists ($orderfilePath)) {
						
						$this->getOrderPdf($id,$store_id);
					}
					
					$files[$invoice_file]=$invoicefilePath;
					$files[$order_file]=$orderfilePath;
					
					$body=$this->getorderEmail($id,$subject,$body,$store_id);
					
                    sendEmail($toEmail,$subject,$body,$from_email,$from_name,$files);
					if(!empty($admin_email1)){
							
						sendEmail($admin_email1,$subject,$body,$from_email,$from_name,$files);
					}
					if(!empty($admin_email2)){
							
						sendEmail($admin_email2,$subject,$body,$from_email,$from_name, $files);
					}
					if(!empty($admin_email3)){
							
						sendEmail($admin_email3,$subject,$body,$from_email,$from_name, $files);
					}
					
					$json['status']=1;
					$json['msg']='Order status '.strtolower(getOrderSatus($status)).' change successfully.';
					
				}
				
				else
				{
				    
					$json['msg']='Order status '.strtolower(getOrderSatus($status)).' change unsuccessfully.';
				}
		}else{
			
			$json['msg']='Order status '.strtolower(getOrderSatus($status)).' change unsuccessfully.';
	    }
		echo json_encode($json);
		exit();
		
    }
	public function changeOrderPaymentStatus()
    {	
	    
		
		$id=$this->input->post('order_id');
		$payment_status=$this->input->post('payment_status');
        $payment_type=$this->input->post('payment_type');
        $transition_id=$this->input->post('transition_id');
		//pr($_POST,1);
		
		$json=array('status'=>0,'msg'=>'');
		
        if(!empty($id) && !empty($payment_status) && !empty($payment_type) && !empty($transition_id)){
			
			    $postData['id']=$id;
		        $postData['payment_status']=$payment_status;
				$postData['payment_type']=$payment_type;
			    $postData['transition_id']=$transition_id;
				
				$this->load->model('ProductOrder_Model');
				$this->load->model('Store_Model');
				
				if ($this->ProductOrder_Model->saveProductOrder($postData))
				{   
					
					
					
					$json['status']=1;
					$json['msg']='Order Pyment status change successfully.';
					
					$orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
					$order_id=$orderData['order_id'];
					$toEmail=$orderData['email'];
					$name=$orderData['name'];
					
					$store_id=$orderData['store_id'];
					$StoreData=$this->Store_Model->getStoreDataById($store_id);
					
					$store_url    = $StoreData['url'];
					$store_phone  = $StoreData['phone'];
					$from_name    = $StoreData['name'];
					$from_email   = $StoreData['from_email'];
					$admin_email1 = $StoreData['admin_email1'];
					$admin_email2 = $StoreData['admin_email2'];
					$admin_email3 = $StoreData['admin_email3'];
					
					$langue_id=$StoreData['langue_id'];
					
					if($langue_id==2){
						
					$subject="Votre commande ".$order_id." Le paiement a été un succès";
					$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
					<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
						salut '.$name.',
					<br>
						Merci pour le paiement avec'.$from_name.'
					</span>
					</div><br><br>';
					}else{
						
						$subject='Your Order '.$order_id.' Payment has been success.';
						$body='<div class="top-info" style="margin-top: 15px;text-align: left;">
						<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
							Hi '.$name.',
						<br>
							Thanks for Payment with '.$from_name.'
						</span>
						</div><br><br>';
					}
					if($langue_id==2){
						
						$invoice_file=$orderData['order_id'].'-fr-invoice.pdf';
						$invoice_file=strtolower($invoice_file);
						$invoicefilePath=FILE_BASE_PATH.'pdf/'.$invoice_file;
						
						$order_file=$orderData['order_id'].'-fr-order.pdf';
		                $order_file=strtolower($order_file);
						$orderfilePath=FILE_BASE_PATH.'pdf/'.$order_file;
						
					}else{
						
						$invoice_file=$orderData['order_id'].'-invoice.pdf';
						$invoice_file=strtolower($invoice_file);
						$invoicefilePath=FILE_BASE_PATH.'pdf/'.$invoice_file;
						
						$order_file=$orderData['order_id'].'-order.pdf';
		                $order_file=strtolower($order_file);
						$orderfilePath=FILE_BASE_PATH.'pdf/'.$order_file;
						
					}
					
					if(!file_exists ($invoicefilePath)) {
						
						$this->getOrderInvoicePdf($id,$store_id);
					}
					if(!file_exists ($orderfilePath)) {
						
						$this->getOrderPdf($id,$store_id);
					}
					
					$files[$invoice_file]=$invoicefilePath;
					$files[$order_file]=$orderfilePath;
					
					$body=$this->getorderEmail($id,$subject,$body,$store_id);
					
                       sendEmail($toEmail,$subject,$body,$from_email,$from_name,$files);
					if(!empty($admin_email1)){
							
						sendEmail($admin_email1,$subject,$body,$from_email,$from_name,$files);
					}
					if(!empty($admin_email2)){
							
						sendEmail($admin_email2,$subject,$body,$from_email,$from_name, $files);
					}
					
					if(!empty($admin_email3)){
							
						sendEmail($admin_email3,$subject,$body,$from_email,$from_name, $files);
					}
					
				}
				else
				{
					$json['msg']='Order Pyment status change unsuccessfully.';
					
				}
		}else{
			$json['msg']='Order Pyment status change unsuccessfully.';
	    }
		echo json_encode($json);
		
    }
	
	public function deleteOrder($id=null,$page_status)
    {	
	
	    $this->load->model('ProductOrder_Model');
		
        if(!empty($id)){
			    
				$page_title='Order Delete';
				if ($this->ProductOrder_Model->deleteProductOrder($id,2))
				{   
			        
				    $this->session->set_flashdata('message_success',$page_title.' Successfully.');
					
				}
				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{
			
			$this->session->set_flashdata('message_error','Missing information.');
	    }
		
	    redirect('admin/Orders/index/'.$page_status);
		
    }
	
	public function getOrdersByStatus($status=null)
    {
		$status=base64_decode($status);
		$this->load->model('ProductOrder_Model');
		$lists=$this->ProductOrder_Model->getOrdersByStatus($status);
		$data['lists']=$lists;
		$data['BASE_URL']=base_url();
		$data['BASE_URL_ADMIN']=base_url()."admin/";
		
		$this->load->view($this->class_name.'get_orders_status',$data);
	
    }
	
	public function getOrderData($id,$status)
    {       
	        $this->load->model('ProductOrder_Model');
	        $this->load->model('Store_Model');
		    $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
		    $order_id=$orderData['order_id'];
		    $toEmail=$orderData['email'];
		    $name=$orderData['name'];
		
		    $store_id=$orderData['store_id'];
		    $StoreData=$this->Store_Model->getStoreDataById($store_id);
		
			$store_url    = $StoreData['url'];
			$store_phone  = $StoreData['phone'];
			$store_email  = $StoreData['email'];
			$from_name    = $StoreData['name'];
			$from_email   = $StoreData['from_email'];
			$admin_email1 = $StoreData['admin_email1'];
			$admin_email2 = $StoreData['admin_email2'];
			$admin_email3 = $StoreData['admin_email3'];
			$order_id=$orderData['order_id'];
			
		   if($status == 3){
				
				$webMsg="Your order $order_id is being processed. We will let you know when your items are on their way";
				
			}else if($status == 4){
			
				$webMsg="Great news your order $order_id  is on the way! If you have any questions, please contact us or call us at ($store_phone, $from_email) Please do not reply to this email as it does not accommodate replies.For more details contact us on $store_phone";
				
				
			}else if($status == 9){
			
				$webMsg="Great news your order $order_id  is Ready for pickup! If you have any questions, please contact us or call us at ($store_phone, $from_email) Please do not reply to this email as it does not accommodate replies.For more details contact us on $store_phone";
				
				
			}else if($status == 5){
				
				$webMsg="We are pleased to inform you that Your Order $order_id items has been delivered sucessfully. I hope you’re enjoying your shopping with $from_name. We hope you have a lovely day! For today s deal: $store_url";
				
			}else if($status == 6){
				
				$webMsg="Sorry to inform you that we have cancelled your order $order_id The reason Indicated below. Cancellation Reason :  If you have any questions, please contact us or call us at ($store_phone, $store_email) Please do not reply to this email as it does not accommodate replies.";
			}
			
			$html='<div id="MsgError"></div>
			<div class="col-xs-12">
				<div class="form-group">
					<label for="InputMessage" class="col-lg-12 control-label">Email Message</label>
					<div class="col-lg-12">
						<textarea name="emailMsg" id="webMsg" class="form-control" rows="5" required>'.$webMsg.'</textarea>
					</div>
				</div>
			</div>';
			echo $html;
			exit();
			
			
			
    }
	
	public function OrderTracking($id)
    {       
	        $this->load->model('ProductOrder_Model');
		    $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
		    $order_id=$orderData['order_id'];
			$store_id=$orderData['store_id'];
			$StoreData=$this->Store_Model->getStoreDataById($store_id);
			$flagShipTrackingData=FlagShipTracking($orderData,$StoreData);
			if($flagShipTrackingData['status']==1){
			    $data=$flagShipTrackingData['data'];
				$shipment=$data->shipment;
				
				$html='<div id="MsgError"></div>
				<div class="col-xs-12">
					<div class="form-group">
						<div class="col-lg-12">
						<p>Shipment Date:'.$shipment->options->shipping_date.'</p>
						</hr>';
						
						if(!empty($shipment->service->estimated_delivery_date)){
							
						   $html.'<p>Estimated Delivery Date:'.$shipment->options->shipping_date.'</p></hr>';
						}
						$html .='<p>Tracking Status</p>';
						$transit_details=$shipment->transit_details;
						foreach($transit_details as $val){
							
							$html .='<p>'.$val->last_update.' '.FlagShipTrackingStatus($val->status).' '.$val->message.'</p>';
						}
						$html.='</div>
					</div>
				</div>';
			}else{
				
				$html='<div id="MsgError"></div>
				<div class="col-xs-12">
					<div class="form-group">
						<div class="col-lg-12">
						'.$flagShipTrackingData['msg'].'
						</div>
					</div>
				</div>';
			}
			echo $html;
			exit();
			
			
			
    }
	
	public function exportCSV($status=null,$user_id=null,$fromDate=null,$toDate=null){
		
		$this->load->model('ProductOrder_Model');
		// file name
		$filename = 'order-'.date('d').'-'.date('m').'-'.date('Y').'.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv; ");
		
		$lists=$this->ProductOrder_Model->getOrderList($status,$user_id,$fromDate,$toDate);
		// file creation
		$file = fopen('php://output', 'w');
		
		$header = array("Order Id","Customer Name","Order Amount","Total Items","Payment Type","Payment Method","Payment Status"," 	Transition Id","Created On","Updated On","Status");
		fputcsv($file, $header);
		
		foreach ($lists as $key=>$list){
			$data=array();
			$data['order_id']=ucfirst($list['order_id']);
			$data['name']=ucwords($list['name']);
			$data['total_amount']=CURREBCY_SYMBOL.number_format($list['total_amount'],2);
			$data['total_items']=$list['total_items'];
			$data['payment_type']=$list['payment_type'];
			
			if($list['payment_type']=='cod'){
				
				$data['payment_method']='Cash On Delivery';
			}else{
			 
			    $data['payment_method']=getOrderPaymentMethod($list['payment_method']); 
			}
			
			$data['payment_status']=getOrderPaymentStatus($list['payment_status'],'csv');
			
			$data['transition_id']=$list['transition_id'];
			
			$data['created']=dateFormate($list['created']);
			$data['updated']=dateFormate($list['updated']);
			$data['status']=getOrderSatus($list['status']);
		    fputcsv($file,$data);
			
		}

		fclose($file);
		exit;
	}
	
	
	public function viewOrder($id)
    {	
	    
		$this->load->model('Product_Model');
		$this->load->model('ProductOrder_Model');
		$this->load->model('Address_Model');
		$orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
		$OrderItemData=$this->ProductOrder_Model->getProductOrderItemDataById($id);
		
		$stateData=$this->Address_Model->getStateById($orderData['billing_state']);
		$countryData=$this->Address_Model->getCountryById($orderData['billing_country']);
		$cityData=$this->Address_Model->getCityById($orderData['billing_city']);
		$salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($orderData['billing_state']);
		
		$this->load->model('Store_Model');		
		$StoreList=$this->Store_Model->getAllStoreList();
		$this->data['StoreList']=$StoreList;
		
		$this->data['page_title']='Order details';
		$this->data['orderData']=$orderData;
		$this->data['OrderItemData']=$OrderItemData;
		$this->data['cityData']=$cityData;
		$this->data['stateData']=$stateData;
		$this->data['countryData']=$countryData;
		$this->data['salesTaxRatesProvinces_Data']=$salesTaxRatesProvinces_Data;
		
		
		$this->render($this->class_name.'view');
	
    }
	
	
	public function createOrder()
    {	

		$this->load->helper('form');
		$this->data['page_title']='Create Order';
		$this->load->model('Category_Model');
		$this->load->model('Address_Model');
		$this->load->model('Product_Model');
		$this->load->model('ProductOrder_Model');
		$this->load->model('User_Model');
		$this->load->model('Store_Model');
		
		
		$categoryList = $this->Category_Model->getCategoryDropDownList();
        $this->data['categoryList']  = $categoryList;
		
		$PickupStoresList=$this->Store_Model->getPickupStoresList();
		
		$PostData = [];
		$PaymentStatus=getOrderPaymentStatus('','csv');
		$this->data['PaymentStatus']=$PaymentStatus;
		$this->data['PaymentMethod']=PaymentMethod();
		
		if ($this->input->post()){
			//pr($_POST);
			$this->load->library('form_validation');
			$set_rules = $this->ProductOrder_Model->config;

			$this->form_validation->set_rules($set_rules);
			$this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
			
            $PostData['name']    = $this->input->post('name');
            $PostData['email']   = $this->input->post('email');
            $PostData['mobile']  = $this->input->post('mobile');
			
			$PostData['billing_name']    = $PostData['shipping_name']    =  $this->input->post('billing_name');
            $PostData['billing_pin_code']= $PostData['shipping_pin_code']    =  $this->input->post('billing_pin_code');
            $PostData['billing_mobile']  = $PostData['shipping_mobile']    =  $this->input->post('billing_mobile');
            $PostData['billing_address'] = $PostData['shipping_address']    =  $this->input->post('billing_address');
            $PostData['billing_city']    = $PostData['shipping_city']    =  $this->input->post('billing_city');
            $PostData['billing_state']   = $PostData['shipping_state']    =  $this->input->post('billing_state');
			$PostData['billing_country'] = $PostData['shipping_country']    =  $this->input->post('billing_country');
			$PostData['billing_company'] = $PostData['billing_company']    =  $this->input->post('billing_company');
			
			
		    $PostData['preffered_customer_discount']=$this->input->post('preffered_customer_discount');
			$PostData['coupon_discount_amount']=$this->input->post('coupon_discount_amount');
			
		    $PostData['total_sales_tax']=$this->input->post('total_sales_tax');
			$PostData['sub_total_amount']=$this->input->post('sub_total_amount');
			$PostData['total_amount']= $this->input->post('total_amount');
            $PostData['total_items'] = $this->input->post('total_items');
			$PostData['delivery_charge']=$this->input->post('shipping_fee');
			$shipping_method=$this->input->post('shipping_method_formate');
			$PostData['currency_id'] =1;
			
			
			if(!empty($shipping_method)){
				
			    $PostData['shipping_method_formate']=$shipping_method;
				
		    }
			$PostData['payment_status']= $this->input->post('payment_status');
			$PostData['payment_type']  = $PostData['payment_method']= $this->input->post('payment_type');
			$PostData['transition_id'] = $this->input->post('transition_id');
			
			//pr($PostData,1);
			
			if ($this->form_validation->run()===TRUE) {
				
			  $userData=$this->User_Model->getUserDataByEmailId($PostData['email']);	
			  $PostData['user_id'] =$userData['id'];
			  
			  $insert_id=$this->ProductOrder_Model->saveProductOrder($PostData);
				
			  if ($insert_id > 0) {
				  
              $PostDataNew=array();
              $PostDataNew['id']=$insert_id;
              $PostDataNew['order_id']=ORDER_ID_PREFIX.$insert_id;
			  $this->ProductOrder_Model->saveProductOrder($PostDataNew);
			  
	          $product_list= isset($_SESSION['product_list']) ? $_SESSION['product_list']:array();
			  
	          foreach($product_list as $product_id_key=>$product_val){
				  
	            if(!empty($product_val)){
					
					$id=$product_val['id'];
					$ProductData = $this->Product_Model->getProductDataById($id);  
					$ProductOrderItemSaveData=array();
					$ProductOrderItemSaveData['id']='';
					$ProductOrderItemSaveData['product_id']=$ProductData['id'];
					$ProductOrderItemSaveData['order_id']=$insert_id;
					$ProductOrderItemSaveData['name']=$ProductData['name'];
					$ProductOrderItemSaveData['price']=$product_val['price'];
					$ProductOrderItemSaveData['short_description']=$ProductData['short_description'];
					$ProductOrderItemSaveData['full_description']=$ProductData['full_description'];
					$ProductOrderItemSaveData['discount']=$ProductData['discount'];
					$ProductOrderItemSaveData['product_image']=$ProductData['product_image'];
					$ProductOrderItemSaveData['code']=$ProductData['code'];
					$ProductOrderItemSaveData['brand']=$ProductData['brand'];
					$ProductOrderItemSaveData['quantity']=$product_val['qty'];
					$ProductOrderItemSaveData['subtotal']=$product_val['subtotal'];
					$ProductOrderItemSaveData['delivery_charge']=$ProductData['delivery_charge'];
					$ProductOrderItemSaveData['total_stock']=$ProductData['total_stock'];
					
					$ProductOrderItemSaveData['cart_images']=json_encode($product_val['options']['cart_images']);
					
					$ProductOrderItemSaveData['attribute_ids']=json_encode($product_val['options']['attribute_ids']);
					
					$ProductOrderItemSaveData['product_size']=json_encode($product_val['options']['product_size']);
					
					$ProductOrderItemSaveData['product_width_length']=json_encode($product_val['options']['product_width_length']);
					
					
					$this->ProductOrder_Model->saveProductOrderItem($ProductOrderItemSaveData);
					
					
					
					
				}
				
			  }
			  
			 if(isset($_SESSION['product_list'])){
				 
				  unset($_SESSION['product_list']);
			 }
			 
			 if(isset($_SESSION['product_id'])){
				 
				  unset($_SESSION['product_id']);
			 }
			 
			 if(isset($_SESSION['total_item'])){
				 
				  unset($_SESSION['total_item']);
			 }
			 if(isset($_SESSION['sub_total'])){
				 
				  unset($_SESSION['sub_total']);
			 }
			 
			 if(isset($_SESSION['total_amount'])){
				 
				  unset( $_SESSION['total_amount']);
			 }
			 if(isset($_SESSION['shipping_fee'])){
				 
				  unset( $_SESSION['shipping_fee']);
			 }
			if(isset($_SESSION['total_sales_tax'])){
				 
				  unset( $_SESSION['total_sales_tax']);
			}
			if(isset($_SESSION['state_id'])){
				 
				  unset( $_SESSION['state_id']);
			}
			if(isset($_SESSION['total_sales_tax_rate'])){
				 
				  unset( $_SESSION['total_sales_tax_rate']);
			}
			
			    
			    $this->session->set_flashdata('message_success','order created successfully.');
				$ProductOrder=$this->ProductOrder_Model->getProductOrderDataById($insert_id);
				$orderData['status']=2;
			    $orderData['order_id']=$ProductOrder['order_id'];
			    $this->UpdateOrderStatus($orderData);
				
				redirect('admin/Orders/index/new');
			  
			} else{
			  $this->session->set_flashdata('message_error','oder save  Unsuccessfully.');
			}
			}else{
				
			    $this->session->set_flashdata('message_error','Missing information.');
			}	   
		}else{
			
			if(isset($_SESSION['product_list'])){
			 
			  unset($_SESSION['product_list']);
		    }
		 
			if(isset($_SESSION['product_id'])){
				 
				  unset($_SESSION['product_id']);
			}
			 
			if(isset($_SESSION['total_item'])){
				 
				  unset($_SESSION['total_item']);
			}
			if(isset($_SESSION['sub_total'])){
				 
				  unset($_SESSION['sub_total']);
			}
			
			if(isset($_SESSION['total_amount'])){
				 
				  unset( $_SESSION['total_amount']);
			}
			
			if(isset($_SESSION['discount_amount'])){
				 
				  unset( $_SESSION['discount_amount']);
			}
			if(isset($_SESSION['preffered_customer_discount'])){
				 
				  unset( $_SESSION['preffered_customer_discount']);
			}
			
			if(isset($_SESSION['shipping_fee'])){
				 
				  unset( $_SESSION['shipping_fee']);
			}
			
			if(isset($_SESSION['shipping_fee'])){
				 
				  unset( $_SESSION['shipping_fee']);
			}
			if(isset($_SESSION['total_sales_tax'])){
				 
				  unset( $_SESSION['total_sales_tax']);
			}
			if(isset($_SESSION['state_id'])){
				 
				  unset($_SESSION['state_id']);
			}
			if(isset($_SESSION['total_sales_tax_rate'])){
				 
				  unset( $_SESSION['total_sales_tax_rate']);
			}
			
			
			
		}
		
		$this->data['countries'] = $this->Address_Model->getCountries();
		$billing_country=isset($PostData['billing_country']) ? $PostData['billing_country']:'';
		$billing_state=isset($PostData['billing_state']) ? $PostData['billing_state']:'';
		
		$this->data['states'] = $this->Address_Model->getState($billing_country);
		$this->data['citys'] = $this->Address_Model->getCity($billing_state);
		$total_charges_ups=array();
		
		$this->load->library('UpsKit/UpsRating');
		$this->upsrating->addField('ShipTo_City','MONTREAL');
		$this->upsrating->addField('ShipTo_StateProvinceCode','QC');
		$this->upsrating->addField('ShipTo_PostalCode','H2M1S2');
		$this->upsrating->addField('ShipTo_CountryCode', 'CA');
		$CanedaPostShiping=CanedaPostApigetRate('H2M1S2');
		
		$index = 0;
		//$dimensions[$index]['Length'] = 1;
		//$dimensions[$index]['Width'] = 1;
		//$dimensions[$index]['Height'] = 1;
		$dimensions[$index]['Weight'] = 1; #Kg 
		$dimensions[$index]['Qty'] =5;	
		
		$this->upsrating->addField('dimensions', $dimensions);
		$this->upsrating->processRate();
		list($response, $status) = $this->upsrating->processRate();
		$ups_response = json_decode( $response );
		if($status==200){
			
			$total_charges_ups = $ups_response->RateResponse->RatedShipment;
		}
		
		$this->data['total_charges_ups']=$total_charges_ups;
		$this->data['PostData']=$PostData;
		$this->data['CanedaPostShiping']=$CanedaPostShiping;
		$this->data['PickupStoresList']=$PickupStoresList;
        
		$this->render($this->class_name.'create-order');
		
		
		
    }
	
	function AddSingleProduct($product_id){
		
		#unset($_SESSION['product_list']);
		$key=time().'-'.$product_id;
		if(isset($_SESSION['product_list'])){
			
			$_SESSION['product_list'][$key]=array();
			
	    }else {
			
			$_SESSION['product_list']=array();
			$_SESSION['product_list'][$key]=array();	
		}
		
		if(!isset($_SESSION['total_item'])){
			
			$_SESSION['total_item']=0;
		}
		
		if(!isset($_SESSION['sub_total'])){
			
			$_SESSION['sub_total']=0;
		}
		
        $this->getProductList();
		
		
	}
	
	function RemoveSingleProduct($product_id_key){
		$json['success']=0;
		if(isset($_SESSION['product_list'][$product_id_key])){
			
			$qty=$_SESSION['product_list'][$product_id_key]['qty'];
			$subtotal=$_SESSION['product_list'][$product_id_key]['subtotal'];
			$_SESSION['total_item']=$_SESSION['total_item']-$qty;
			$_SESSION['sub_total']=$_SESSION['sub_total']-$subtotal;
		    unset($_SESSION['product_list'][$product_id_key]);
		    $json['success']=1;
            $json['product_html']=$this->getProductList(true);
		    $json['orderinformation']=$this->orderinformation();
		    $json['confirmbtn']=$this->confirmbtn();  			
	    }
       
		echo json_encode($json);
	    exit(0);
		
        		
	}
	
	
	function getProductList($fl=false){
		
		
		$this->load->model('Product_Model');
		$data['BASE_URL']= base_url();
		if($fl){
			return $this->load->view($this->class_name.'get_product_html',$data,true);
		}else{
		echo $this->load->view($this->class_name.'get_product_html',$data,true);
		exit();
		}
	}
	
	function calculatePrice() {
	  	
	   $this->load->model('Product_Model');
	   
	   $response=array();
	   $product_id=$this->input->post('product_id');
	   $price=$this->input->post('price');
	   $quantity=$this->input->post('quantity');
	   
	   $product_size_id=$this->input->post('product_size_id');
	   
	   $add_length_width=$this->input->post('add_length_width');
	   
	   
	   $product_size_quantity=$this->input->post('product_size_quantity');
	   $product_size_ncr_number_parts=$this->input->post('product_size_ncr_number_parts');
	   
	   $product_size_paper_size=$this->input->post('product_size_paper_size');
	   
	   $quantity=!empty($quantity) ? $quantity:1;
	   
	   $ProductAttributes=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);
	   
	   
	    #RECTO_ATTRIBUTE PRICE Extra 35 %
		$attribute_name='attribute_id_'.RECTO_ATTRIBUTE_ID;
		$RECTO_ATTRIBUTE_VALUE=isset($_POST[$attribute_name]) ?$this->input->post($attribute_name):'';
		//pr($_POST);
		
		if($RECTO_ATTRIBUTE_VALUE==RECTO_ATTRIBUTE_ID_VALUE_YES){
			
			$price = $price+(($price*RECTO_ATTRIBUTE_PERCENTAGE)/100);
		}
		
	    foreach($ProductAttributes as $key=>$val){
		   
		   $attribute_name='attribute_id_'.$key;
		   $attribute_item_id=isset($_POST[$attribute_name]) ? $this->input->post($attribute_name):'';
		   $items=$val['items'];
		   
		   if(!empty($attribute_item_id) && array_key_exists($attribute_item_id,$items)){
			    
			    $extra_price=$items[$attribute_item_id]['extra_price'];
			    $price += $extra_price;
		   }
	    }
	   
	  
	    #Product Size Price Cal.
	    if(!empty($product_size_id) && !empty($product_size_quantity)){
		   
		    $ProductSizes=$this->Product_Model->ProductSizeListDropDwon($product_id);
		    $size_data=$ProductSizes[$product_size_id];
			foreach($size_data as $key=>$val){
				
				$product_size_qty_id=$val['id'];
				if($product_size_qty_id == $product_size_quantity){
					$extra_price=$val['price'];
					$price += $extra_price;
					break;
				}
			}
	    }
		
		if(!empty($product_size_id) && !empty($product_size_ncr_number_parts)){
		   
		    $ProductSizes=$this->Product_Model->ProductSizeListDropDwon($product_id);
		    $size_data=$ProductSizes[$product_size_id];
			foreach($size_data as $key=>$val){
				
				$product_size_ncr_id=$val['id'];
				if($product_size_ncr_id == $product_size_ncr_number_parts){
					
					$extra_price=$val['ncr_number_part_price'];
					$price += $extra_price;
					break;
				}
			}
	    }
		
		if(!empty($product_size_id) && !empty($product_size_paper_size)){
		   
		    $ProductSizes=$this->Product_Model->ProductSizeListDropDwon($product_id);
		    $size_data=$ProductSizes[$product_size_id];
			foreach($size_data as $key=>$val){
				
				$product_size_paper_id=$val['id'];
				if($product_size_paper_id == $product_size_paper_size){
					$extra_price=$val['paper_size_price'];
					$price += $extra_price;
					break;
				}
			}
	    }
		if(!empty($add_length_width)){
			
		    $product_length=$this->input->post('product_length');
		    $product_width=$this->input->post('product_width');
			$Product =$this->Product_Model->getProductList($product_id);
			$min_length=$Product['min_length'];
			$max_length=$Product['max_length'];
			$min_width=$Product['min_width'];
			$max_width=$Product['max_width'];
			$min_lenght_min_width_price=$Product['min_lenght_min_width_price'];
			
			$response['product_length']=$product_length;
			$response['product_length_error']='';
			$response['product_width']=$product_width;
			$response['product_width_error']='';
			if(empty($product_length)){
				
				$response['product_length']='';
				$response['product_length_error']='Please enter length';
				
			}else if(!empty($product_length) && $product_length < $min_length){
				
				$response['product_length']=0;
				$response['product_length_error']='Please enter length between '.$min_length.' and '.$max_length;
				
				
			}else if(!empty($product_length) && $product_length > $max_length){
				
				$response['product_length']=0;
				$response['product_length_error']='Please enter length between '.$min_length.' and '.$max_length;
				
			}else if(empty($product_width)){
				
				$response['product_width']='';
				$response['product_width_error']='Please enter width';
				
			}else if(!empty($product_width) && $product_width < $min_width){
				
				$response['product_width']=0;
				$response['product_width_error']='Please enter width between '.$min_width.' and '.$max_width;
				
				
			}else if(!empty($product_width) && $product_width > $max_width){
				
				$response['product_width']=0;
				$response['product_width_error']='Please enter width between '.$min_width.' and '.$max_width;
				
			} else if(!empty($product_length) && !empty($product_width)){
				
				
				$rq_aria=$product_length*$product_width;
				$min_aria=$min_length*$min_width;
				$par_squre_price=($min_lenght_min_width_price/$min_aria);
				$extra_price=$par_squre_price*$rq_aria;
				$price += $extra_price;
				
                $response['product_width']=$product_width;
				$response['product_width_error']='';
				
                $response['product_length']=$product_length;
				$response['product_length_error']='';				
			}
			
		}
	   
	   $response['success'] = 1;
	   $price=$price*$quantity;
	   $response['price']=number_format($price,2);
	   echo json_encode($response);
	   exit(0);
	}
	
	
	function getSizeOptions($product_id_key,$product_id,$product_quantity_id=null,$product_size_id=null,$fl=0){
		
		$this->load->model('Product_Model');
		$ProductSizes=$this->Product_Model->ProductSizeListDropDwon($product_id);
		
		$options_size_first = $options_ncr_number_parts_first =$stock_first =$paper_quality_first =$diameter_first = $shape_paper_first = $color_first =$grommets_first='<option value="">Choose an option...</option>';
		
		$options_size = $options_ncr_number_parts = $stock= $paper_quality = $diameter = $shape_paper = $color=$grommets='';
		
		$options_size_show=$ncr_number_parts_show=$stock_show=$paper_quality_show=$color_show=$diameter_show=$shape_paper_show=$grommets_show=false;
		
		$size_disebal=true;
		
		if(!empty($product_quantity_id) && !empty($product_size_id)){
			
			
			$items=$ProductSizes[$product_quantity_id][$product_size_id];
			   $val=$ProductSizes[$product_quantity_id];
				
			    if(!empty($val)){
					
					$options_size_show=true;
					$size_disebal=false;
					
					foreach($val as $key1=>$val1){
						
						
						$size_extra_price='';
                        $label='';						
						foreach($val1 as $size_data){
							
							//pr($size_data,1);
							$size_extra_price=$size_data['extra_prce'];
							$label=$size_data['size_name'];
							break;
						}
						
						if(!empty($size_extra_price) && $size_extra_price !='0.00'){
							
							//$label = $label." +".$this->product_price_currency_symbol.number_format($size_extra_price,2);
						}
						$selected='';
						if($key1==$product_size_id){
							$selected='selected="selected"';
						}
						$options_size = $options_size."<option value='".$key1."' $selected>".$label."</option>";
					}
			    }	
			foreach($items as $key=>$val){
				
				
				$label=$val['ncr_number_parts'];
				if(!empty($val['ncr_number_part_price']) && $val['ncr_number_part_price'] !='0.00'){
					
					//$label=$val['ncr_number_parts']." +".$this->product_price_currency_symbol.number_format($val['ncr_number_part_price'],2);	
				}
				if(!empty($val['ncr_number_parts'])){
					
				   $options_ncr_number_parts = $options_ncr_number_parts."<option value='".$val['id']."'>".$label."</option>";
				   $ncr_number_parts_show=true;
				}
				
				$label=$val['stock'];
				if(!empty($val['stock_extra_price']) && $val['stock_extra_price'] !='0.00'){
					
					//$label=$val['stock']." +".$this->product_price_currency_symbol.number_format($val['stock_extra_price'],2);
					
					
				}
				
				if(!empty($val['stock'])){
					
				    $stock = $stock."<option value='".$val['id']."'>".$label."</option>";
					$stock_show=true;
				}
				
				$label=$val['paper_quality'];
				if(!empty($val['paper_quality_extra_price']) && $val['paper_quality_extra_price'] !='0.00'){
					
					//$label=$val['paper_quality']." +".$this->product_price_currency_symbol.number_format($val['paper_quality_extra_price'],2);
					
				}
				
				if(!empty($val['paper_quality'])){
					
				    $paper_quality = $paper_quality."<option value='".$val['id']."'>".$label."</option>";
					$paper_quality_show=true;
				}
				
				$label=$val['diameter'];
				if(!empty($val['diameter_extra_price']) && $val['diameter_extra_price'] !='0.00'){
					
					//$label=$val['diameter']." +".$this->product_price_currency_symbol.number_format($val['diameter_extra_price'],2);
					
					
				}
				
				if(!empty($val['diameter'])){
					
				    $diameter = $diameter."<option value='".$val['id']."'>".$label."</option>";
					$diameter_show=true;
				}
				
				$label=$val['shape_paper'];
				if(!empty($val['shape_paper_extra_price']) && $val['shape_paper_extra_price'] !='0.00'){
					
					//$label=$val['shape_paper']." +".$this->product_price_currency_symbol.number_format($val['shape_paper_extra_price'],2);
					
				}
				
				if(!empty($val['shape_paper'])){
					
				    $shape_paper = $shape_paper."<option value='".$val['id']."'>".$label."</option>";
					$shape_paper_show=true;
				}
				
				$label=$val['color'];
				if(!empty($val['color_extra_price']) && $val['color_extra_price'] !='0.00'){
					
				      //$label=$val['color']." +".$this->product_price_currency_symbol.number_format($val['color_extra_price'],2);
					
				}
				
				if(!empty($val['color'])){
					
				   $color = $color."<option value='".$val['id']."'>".$label."</option>";
				   $color_show=true;
				   
				}
				
				$label=$val['grommets'];
				if(!empty($val['grommets_extra_price']) && $val['grommets_extra_price'] !='0.00'){
					
				      //$label=$val['grommets_extra_price']." +".$this->product_price_currency_symbol.number_format($val['grommets_extra_price'],2);
					
				}
				
				if(!empty($val['grommets'])){
					
				   $grommets = $grommets."<option value='".$val['id']."'>".$label."</option>";
				   $grommets_show=true;
				}

			}
			
		}else if(!empty($product_quantity_id) && empty($product_size_id)){
			
			    $val=$ProductSizes[$product_quantity_id];
				
			    if(!empty($val)){
					
					$options_size_show=true;
					$size_disebal=false;
					
					foreach($val as $key1=>$val1){
						
						
						$size_extra_price='';
                        $label='';						
						foreach($val1 as $size_data){
							
							//pr($size_data,1);
							$size_extra_price=$size_data['extra_prce'];
							$label=$size_data['size_name'];
							break;
						}
						
						if(!empty($size_extra_price) && $size_extra_price !='0.00'){
							
							//$label = $label." +".$this->product_price_currency_symbol.number_format($size_extra_price,2);
						}
						
						
						$options_size = $options_size."<option value='".$key1."'>".$label."</option>";
						
						foreach($val1 as $key2=>$val2){
							
							
							if(!empty($val2['ncr_number_parts'])){
								
								$ncr_number_parts_show=true;
							}
							
							if(!empty($val2['stock'])){
								
								$stock_show=true;
							}
							
							if(!empty($val2['paper_quality'])){
								
								$paper_quality_show=true;
							}
							
							if(!empty($val2['color'])){
								
								$color_show=true;
							}
							
							if(!empty($val2['diameter'])){
								
								$diameter_show=true;
							}
							if(!empty($val2['shape_paper'])){
								
								$shape_paper_show=true;
							}
							
							if(!empty($val2['grommets'])){
								
								$grommets_show=true;
							}
							
							
						} 
					}
				}	
			
		}else{
		    //pr($ProductSizes);
			foreach($ProductSizes as $key=>$val){
				
				if(!empty($val)){
					
					$options_size_show=true;
					
					foreach($val as $key1=>$val1){
						 
						foreach($val1 as $key2=>$val2){
							//pr($val2);
							if(!empty($val2['ncr_number_parts'])){
								
								$ncr_number_parts_show=true;
							}
							
							if(!empty($val2['stock'])){
								
								$stock_show=true;
							}
							
							if(!empty($val2['paper_quality'])){
								
								$paper_quality_show=true;
							}
							
							if(!empty($val2['color'])){
								
								$color_show=true;
							}
							
							if(!empty($val2['diameter'])){
								
								$diameter_show=true;
							}
							if(!empty($val2['shape_paper'])){
								
								$shape_paper_show=true;
							}
				            if(!empty($val2['grommets'])){
								
								$grommets_show=true;
							}
							
							
						} 
					}
				}		
			}
		}
		
		$response=array();
		$last=0;
		
		if($options_size_show){
			
			$options_size=$options_size_first.$options_size;
			$last++;
		}
		
		if($ncr_number_parts_show){
			
			$options_ncr_number_parts=$options_ncr_number_parts_first.$options_ncr_number_parts;
			$last++;	
		}
		if($stock_show){
			
			$stock=$stock_first.$stock;
			$last++;
		}
		if($paper_quality_show){
			
			$paper_quality=$paper_quality_first.$paper_quality;
			$last++;
		}
		if($diameter_show){
			
			$diameter=$diameter_first.$diameter;
			$last++;
		}
		if($shape_paper_show){
			
			$shape_paper=$shape_paper_first.$shape_paper;
			$last++;
		}
		
		if($color_show){
			
			$color=$color_first.$color;
			$last++;
		}
		
		if($grommets_show){
			
			$grommets=$grommets_first.$grommets;
			$last++;
		}
		
		if(!empty($product_size_id) && $last > 2){
			
			//$last--;
		}
		
		$response['options_size']=$options_size;
		$response['options_ncr_number_parts']=$options_ncr_number_parts;
		$response['options_paper_size']=$options_paper_size;
		$response['stock']=$stock;
		$response['paper_quality']=$paper_quality;
		$response['shape_paper']=$shape_paper;
		$response['diameter']=$diameter;
		$response['color']=$color;
		$response['grommets']=$grommets;
		
		
		$response['last']=$last;
		$response['size_disebal']=$size_disebal;
		$response['product_size_id']=$product_size_id;
		
		//pr($response);
		
		if($fl){
			
	      return $this->load->view('Products/size_options',$response,true);
		  
		}else{
			echo $this->load->view('Products/size_options',$response,true);
		}
		exit();
		
	}
	
	function GetQuantity()
    {
		
		$this->load->model('Product_Model');
	    $product_id=$this->input->post('product_id');
	    $price=$this->input->post('price');
	    $quantity=$this->input->post('quantity');
		$product_size_id=$this->input->post('product_size_id');
		$add_length_width=$this->input->post('add_length_width');
	    $quantity=!empty($quantity) ? $quantity:1;
		$ProductSizes=$this->Product_Model->ProductSizeListDropDwon($product_id);
		
		$options_qty='<option value="">Choose an option...</option>';
		
		$options_ncr_number_parts='<option value="">Choose an option...</option>';
		
		$options_paper_size='<option value="">Choose an option...</option>';
		
		if(!empty($product_size_id)){
			
			$items=$ProductSizes[$product_size_id];
			//pr($items,1);
			foreach($items as $key=>$val){
				
				
				$label=$val['qty'];
				
				if(!empty($val['price']) && $val['price'] !='0.00'){
					
					$label=$val['qty']." +".CURREBCY_SYMBOL.number_format($val['price'],2);
					
				}
				
				$options_qty = $options_qty.'<option value="'.$val['id'].'" >'.$label.'</option>';
				
				
				$label=$val['ncr_number_parts'];
				if(!empty($val['ncr_number_part_price']) && $val['ncr_number_part_price'] !='0.00'){
					
					$label=$val['ncr_number_parts']." +".CURREBCY_SYMBOL.number_format($val['ncr_number_part_price'],2);
					
				}
				
				$options_ncr_number_parts = $options_ncr_number_parts.'<option value="'.$val['id'].'" >'.$label.'</option>';
				
				
				$label=$val['paper_size'];
				if(!empty($val['paper_size_price']) && $val['paper_size_price'] !='0.00'){
					
					$label=$val['paper_size']." +".CURREBCY_SYMBOL.number_format($val['paper_size_price'],2);
					
				}
				
				$options_paper_size = $options_paper_size.'<option value="'.$val['id'].'" >'.$label.'</option>';
				
				
				
				
			}
		}
		
		
		#RECTO_ATTRIBUTE PRICE Extra 35 %
		$attribute_name='attribute_id_'.RECTO_ATTRIBUTE_ID;
		$RECTO_ATTRIBUTE_VALUE=isset($_POST[$attribute_name]) ?$this->input->post($attribute_name):'';
		
		if($RECTO_ATTRIBUTE_VALUE==RECTO_ATTRIBUTE_ID_VALUE_YES){
			
			$price = $price+(($price*RECTO_ATTRIBUTE_PERCENTAGE)/100);
		}
		
	    $ProductAttributes=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);
	    foreach($ProductAttributes as $key=>$val){
		   
		   $attribute_name='attribute_id_'.$key;
		   $attribute_item_id=isset($_POST[$attribute_name]) ? $this->input->post($attribute_name):'';
		   $items=$val['items'];
		   
		    if(!empty($attribute_item_id) && array_key_exists($attribute_item_id,$items)){
			   
			    $extra_price=$items[$attribute_item_id]['extra_price'];
			    $price += $extra_price;
		    }
	    }
		
		if(!empty($add_length_width)){
			
			$product_length=$this->input->post('product_length');
		    $product_width=$this->input->post('product_width');
			if(!empty($product_length) && !empty($product_width)){
				
				$Product =$this->Product_Model->getProductList($product_id);
			    $min_length=$Product['min_length'];
			    $max_length=$Product['max_length'];
			    $min_width=$Product['min_width'];
			    $max_width=$Product['max_width'];
			    $min_lenght_min_width_price=$Product['min_lenght_min_width_price'];
				$rq_aria=$product_length*$product_width;
				$min_aria=$min_length*$min_width;
				$par_squre_price=($min_lenght_min_width_price/$min_aria);
				$extra_price=$par_squre_price*$rq_aria;
				$price += $extra_price;
				
			}
			
			
			
		}
	    $response=array();
	    $response['success'] = 1;
	    $price=$price*$quantity;
	    $response['price']=number_format($price,2);
		$response['options_qty']=$options_qty;
		$response['options_ncr_number_parts']=$options_ncr_number_parts;
		$response['options_paper_size']=$options_paper_size;
        echo json_encode($response);
	    exit(0);
	   
	}
	
	function addToCard(){
		
		$json=array('status'=>0,'msg'=>'');
		$product_id=$this->input->post('product_id');
        $quantity=$this->input->post('quantity');
		$price=$this->input->post('price');
		
		   $product_size_id=$this->input->post('product_size_id');
	       $add_length_width=$this->input->post('add_length_width');
		   $product_size_quantity=$this->input->post('product_size_quantity');
		   $product_size_ncr_number_parts=$this->input->post('product_size_ncr_number_parts');
		   
		   $product_size_paper_size=$this->input->post('product_size_paper_size');
		   
		
		
		
		
		$product_id_key=$this->input->post('product_id_key');
		$this->load->model('Product_Model');
		
		if(isset($_SESSION['product_list'][$product_id_key])){
			
              $productData=$this->Product_Model->getProductDataById($product_id);
           	  $ProductAttributes=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);
			  
				$attribute_name='attribute_id_'.RECTO_ATTRIBUTE_ID;
				$RECTO_ATTRIBUTE_VALUE=isset($_POST[$attribute_name]) ? $this->input->post($attribute_name):'';
				
				if($RECTO_ATTRIBUTE_VALUE==RECTO_ATTRIBUTE_ID_VALUE_YES){

				    $price = $price+(($price*RECTO_ATTRIBUTE_PERCENTAGE)/100);
				}
	        
                $AttributeIds=array();
			    foreach($ProductAttributes as $key=>$val){
				  
				   $attribute_name='attribute_id_'.$key;
				   $attribute_item_id=isset($_POST[$attribute_name]) ? $this->input->post($attribute_name):'';
				   $items=$val['items'];
				   if(!empty($attribute_item_id) && array_key_exists($attribute_item_id,$items)){
						
						$extra_price=$items[$attribute_item_id]['extra_price'];
						$price += $extra_price;
						$AttributeIds[$key]=$attribute_item_id;
				   }
		        }
				
			    $product_size=array();
			
			    if(!empty($product_size_id) && !empty($product_size_quantity)){
		   
				$ProductSizes=$this->Product_Model->ProductSizeListDropDwon($product_id);
				$size_data=$ProductSizes[$product_size_id];
				foreach($size_data as $key=>$val){
					
					$product_size_qty_id=$val['id'];
					if($product_size_qty_id == $product_size_quantity){
						
						$extra_price=$val['price'];
						$price += $extra_price;
						$product_size['product_size_quantity']=$val;
						break;
					}
				}
	        }
			
			if(!empty($product_size_id) && !empty($product_size_ncr_number_parts)){
			   
				$ProductSizes=$this->Product_Model->ProductSizeListDropDwon($product_id);
				$size_data=$ProductSizes[$product_size_id];
				foreach($size_data as $key=>$val){
					
					$product_size_ncr_id=$val['id'];
					if($product_size_ncr_id == $product_size_ncr_number_parts){
						
						$extra_price=$val['ncr_number_part_price'];
						$price += $extra_price;
						
						$product_size['product_size_ncr_number_parts']=$val;
						break;
					}
				}
			}
		
			if(!empty($product_size_id) && !empty($product_size_paper_size)){
				   
					$ProductSizes=$this->Product_Model->ProductSizeListDropDwon($product_id);
					$size_data=$ProductSizes[$product_size_id];
					foreach($size_data as $key=>$val){
						
						$product_size_paper_id=$val['id'];
						if($product_size_paper_id == $product_size_paper_size){
							
							$extra_price=$val['paper_size_price'];
							$price += $extra_price;
					 $product_size['product_size_paper_size']=$val;
							break;
						}
					}
			}
		
        $AddToCart=true;
        $product_width_length=array();		
		if(!empty($add_length_width)){
			
		    $product_length=$this->input->post('product_length');
		    $product_width=$this->input->post('product_width');
			$Product =$this->Product_Model->getProductList($product_id);
			
			$min_length=$Product['min_length'];
			$max_length=$Product['max_length'];
			$min_width=$Product['min_width'];
			$max_width=$Product['max_width'];
			$min_lenght_min_width_price=$Product['min_lenght_min_width_price'];
			
			$response['product_length']=$product_length;
			$response['product_length_error']='';
			$response['product_width']=$product_width;
			$response['product_width_error']='';
			
			if(empty($product_length)){
				
				$json['msg']='Please enter length';
				$AddToCart=false;	
			}else if(!empty($product_length) && $product_length < $min_length){
				
				
				$json['msg']='Please length enter between '.$min_length.' and '.$max_length;
				$AddToCart=false;
				
			}else if(!empty($product_length) && $product_length > $max_length){
				
				$json['msg']='Please length enter between '.$min_length.' and '.$max_length;
				$AddToCart=false;
				
			}else if(empty($product_width)){
				
				$json['msg']='Please enter width';
				$AddToCart=false;
				
			}else if(!empty($product_width) && $product_width < $min_width){
				
				$json['msg']='Please width enter between '.$min_width.' and '.$min_width;
				$AddToCart=false;
				
			}else if(!empty($product_width) && $product_width > $max_width){
				
				$json['msg']='Please width enter between '.$min_width.' and '.$min_width;
				$AddToCart=false;
				
			} else if(!empty($product_length) && !empty($product_width)){
				
				
				$rq_aria=$product_length*$product_width;
				$min_aria=$min_length*$min_width;
				$par_squre_price=($min_lenght_min_width_price/$min_aria);
				$extra_price=$par_squre_price*$rq_aria;
				$price += $extra_price;
				
                $product_width_length['product_width']=$product_width;
                $product_width_length['product_length']=$product_length;
				$AddToCart=true;
			}
			
		}
		
	        if(!empty($productData) && $AddToCart==true){
				   
					$data=array();
					$data['id']=  $productData['id'];
					$data['qty']= $quantity;
					$data['price']= $price;
					$data['subtotal']= $price*$quantity;
					$name=str_replace('(','',$productData['name']);
					$name=str_replace(')','',$name);
					$name=str_replace("'",'',$name);
					$name=str_replace(",",'',$name);
					$name=preg_replace('/[^A-Za-z0-9\-]/', '', $name);
					$data['name']=$name;
					$cart_images=array();
					if(isset($_SESSION['product_id'][$product_id_key][$product_id])){
						
						$cart_images=$_SESSION['product_id'][$product_id_key][$product_id];
					}
					
					$data['options']=array(
						'product_id'=>$productData['id'],
						'product_image'=>$productData['product_image'],
						'cart_images'=>$cart_images,
						'attribute_ids'=>$AttributeIds,
						'product_size' =>$product_size,
						'product_width_length'=>$product_width_length
					);
					
					$_SESSION['product_list'][$product_id_key]=$data;
					
					$json['status']=1;
					$json['msg']=ucfirst(strtolower($productData['name'].' has been saved successfully'));
					
				}else{
					
					//$json['msg'] ='Product does not exist';
				}
				
	        }else{
				
				$json['msg'] ='Product does not exist';
			}
			
		    if(isset($_SESSION['product_list'])){
				
				$product_list=$_SESSION['product_list'];
				$total_item=$sub_total=0;
				foreach($product_list as $product_id_key=>$product_val){
					
					$total_item += $product_val['qty'];
					$sub_total  += $product_val['subtotal'];
				}
				
				$_SESSION['total_item']   = $total_item;
				$_SESSION['sub_total']    = $sub_total;
                				
			}
		    $json['orderinformation']=$this->orderinformation(); 
            $json['confirmbtn']=$this->confirmbtn();			
		    echo json_encode($json);
			exit();
	}
	
	function applyCode($code){
		
		$json=array('status'=>0,'msg'=>'');
		$this->load->model('Discount_Model');
		$codeData=$this->Discount_Model->getDiscountDataByCode($code);
		$discount_amount=0;
		if(!empty($codeData)){
			
		    $discount_type=$codeData['discount_type'];
			$discount=$codeData['discount'];
			$discount_valid_from=$codeData['discount_valid_from'];
			$discount_valid_to=$codeData['discount_valid_to'];
			$cdate=date('Y-m-d H:i:s');
			$sub_total  = isset($_SESSION['sub_total']) ? $_SESSION['sub_total']:0;
			
			if(strtotime($cdate) < strtotime($discount_valid_from)){
				
				$json['msg']='coupon code date not start';
				
			}else if(strtotime($cdate) > strtotime($discount_valid_to)){
				
				$json['msg']='coupon code expire';
				
				
			}else{
				 
				 if($discount_type=='discount_percent'){
					 
					 $discount_amount=($sub_total*$discount)/100;
					 
				 }else{
					 
					 $discount_amount=$discount;
				 }
				 
				 $json['status']=1;
				 
			}
		}else{
			$json['msg']='invalid coupon code';
		}
		
		$_SESSION['discount_amount']=$discount_amount;
		$_SESSION['code']=$code;
		
		$json['orderinformation']=$this->orderinformation();
		$json['confirmbtn']=$this->confirmbtn();
		
 		echo json_encode($json);
		exit();
	}
	
	function PrefferedCustomerDiscount(){
		
		$email=$this->input->post('email');
		$this->load->model('User_Model');
		$json=array('status'=>0,'msg'=>'');
		$userData=$this->User_Model->getUserDataByEmailId($email);
		$sub_total  = isset($_SESSION['sub_total']) ? $_SESSION['sub_total']:0;
		if(!empty($userData)){
				
			    $user_type=$userData['user_type'];
				$preferred_status=$userData['preferred_status'];
				if($user_type==2 && $preferred_status==1){
					 
					$preffered_customer_discount=(($sub_total*10)/100);
					 
				}
				 
		    
		}
		$json['status']=1;
		$_SESSION['preffered_customer_discount']=$preffered_customer_discount;
		$json['orderinformation']=$this->orderinformation();
		$json['confirmbtn']=$this->confirmbtn();
 		echo json_encode($json);
		exit();
	}
	
	function shippingMethodFormate(){
		
		$shipping_fee='';
		$shipping_method_formate=$this->input->post('shipping_method_formate');
		
		if(!empty($shipping_method_formate)){
			
			$shipping_fee=explode('-',$shipping_method_formate);
			$shipping_fee=$shipping_fee[1];
			  
		}
		$json['status']=1;
		$_SESSION['shipping_fee']=$shipping_fee;
		$json['orderinformation']=$this->orderinformation();
		$json['confirmbtn']=$this->confirmbtn();
 		echo json_encode($json);
		exit();
	}
	
	function orderinformation(){
		
		$this->load->model('Address_Model');
		$data=array();
		$sub_total        = isset($_SESSION['sub_total']) ? $_SESSION['sub_total']:0;
		$shipping_fee     = isset($_SESSION['shipping_fee']) ? $_SESSION['shipping_fee']:0;
		$discount_amount  = isset($_SESSION['discount_amount']) ? $_SESSION['discount_amount']:0;
		$preffered_customer_discount=isset($_SESSION['preffered_customer_discount']) ? $_SESSION['preffered_customer_discount']:0;
		
		if(!empty($preffered_customer_discount)){
			
			$preffered_customer_discount=(($sub_total*10)/100);
			
			$_SESSION['preffered_customer_discount']=$preffered_customer_discount;
			
		}
		
		if(!empty($discount_amount)){
			
			$this->load->model('Discount_Model');
			$code  = isset($_SESSION['code']) ? $_SESSION['code']:'';
			$codeData=$this->Discount_Model->getDiscountDataByCode($code);
		    $discount_amount=0;
		    if(!empty($codeData)){
				
		    $discount_type=$codeData['discount_type'];
			$discount=$codeData['discount'];
			$discount_valid_from=$codeData['discount_valid_from'];
			$discount_valid_to=$codeData['discount_valid_to'];
			$cdate=date('Y-m-d H:i:s');
			$sub_total  = isset($_SESSION['sub_total']) ? $_SESSION['sub_total']:0;
			
			if(strtotime($cdate) < strtotime($discount_valid_from)){
				
				$discount_amount=0;
				
			}else if(strtotime($cdate) > strtotime($discount_valid_to)){
				
				$discount_amount=0;
				
				
			}else{
				 
				    if($discount_type=='discount_percent'){
					 
					    $discount_amount=($sub_total*$discount)/100;
					 
				    }else{
					 
					    $discount_amount=$discount;
				    }
				 
				    
				 
			    }
		    }
			
			$_SESSION['discount_amount']=$discount_amount;
			
		}
		
		$total_sales_tax=0;
		$total_sales_tax_rate=isset($_SESSION['total_sales_tax_rate']) ? $_SESSION['total_sales_tax_rate']:0;
		if(!empty($total_sales_tax_rate)){
			
			$total_sales_tax=($sub_total*$total_sales_tax_rate)/100;
		}
		
		$_SESSION['total_sales_tax']=$total_sales_tax;
		
		$total_amount=($sub_total-($preffered_customer_discount+$discount_amount))+$shipping_fee+$total_sales_tax;
		$_SESSION['total_amount']=$total_amount;
		return $this->load->view($this->class_name.'order-information',$data,true);
	}
	
	
	function getCityDropDownListByAjax($state_id){
		
		
	    $this->load->model('Address_Model');
		$options='<option value="">--Select City--</option>';
		if(!empty($state_id)){
			
		    $stateList=$this->Address_Model->getCity($state_id);
			//pr($stateList);
			
			foreach($stateList as $key=>$val){
												
				$options .='<option value="'.$val['id'].'">'.$val['name'].'</option>';
			}
		}
		
        $salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($state_id);
		
		if(!empty($salesTaxRatesProvinces_Data)){
			
			$_SESSION['state_id']=$state_id;
			$_SESSION['total_sales_tax_rate']=$salesTaxRatesProvinces_Data['total_tax_rate'];
			
			
		}else{
			
			unset($_SESSION['state_id']);
			unset($_SESSION['total_sales_tax_rate']);
		}
		
		$json['status']=1;
		$json['options']=$options;
		$json['orderinformation']=$this->orderinformation();
		$json['confirmbtn']=$this->confirmbtn();
 		echo json_encode($json);
		exit();
		
		
	}
	
	function confirmbtn(){
		
		$data=array();
		return $this->load->view($this->class_name.'confirm_btn',$data,true);
		
	}
	
	function uploadImage(){
	    #pr($_POST);
	    #unset($_SESSION['product_id']); die();
	    $product_id=$_POST['product_id'];
		$product_id_key=$_POST['product_id_key'];
	   /* Getting file name */
		$filename =$_FILES['file']['name'];
		/* Getting File size */
		$filesize = $_FILES['file']['size'];
		/* Location */
		$newfileName="cart-image/".time().'-'.$filename;
		$location =FILE_UPLOAD_BASE_PATH."cart-image/".time().'-'.$filename;
		$return_arr = array();
		$session_data=array();
		/* Upload file */
		$data=array();
		if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
			
			$src = DEFAULT_IMAGE_URL."default.png";
			// checking file is image or not
			if(is_array(getimagesize($location))){
				
				$src=FILE_UPLOAD_BASE_URL.$newfileName;
			}
			
			$range=range(1,5000);
			$key=array_rand($range);
			$return_arr = array("name" => $filename,"size" => $filesize, "src"=> $src,'skey'=>$key,'product_id'=>$product_id,'location'=>$location,'cumment'=>'','product_id_key'=>$product_id_key);
			
			$_SESSION['product_id'][$product_id_key][$product_id][$key]=$return_arr;
			$data['return_arr']=$return_arr;
			
		}
		
		$html=$this->load->view($this->class_name.'file_data',$data,true);
		$return_arr['html']=$html;
		echo json_encode($return_arr);
		
     }
	 
	 function updateCumment(){
		   
		   $product_id=$_POST['product_id'];
		   $product_key_id=$_POST['product_key_id'];
		   $skey=$_POST['skey'];
		   $cumment=$_POST['cumment'];
		   if(isset($_SESSION['product_id'][$product_key_id][$product_id][$skey])){
			   
			  $_SESSION['product_id'][$product_key_id][$product_id][$skey]['cumment']=$cumment;
		   }
		   #pr($_SESSION['product_id'][$product_key_id][$product_id]);
		   exit(0);	   
		  
	  }
	  
	  function deleteImage(){
		  
		   $product_id=$_POST['product_id'];
		   $product_key_id=$_POST['product_key_id'];
		   $skey=$_POST['skey'];
		   $location=$_POST['location'];
		   if(isset($_SESSION['product_id'][$product_key_id][$product_id][$skey])){
			   
			  #$_SESSION['product_list'][$product_id_key]['options']['cart_images'] 
			  unset($_SESSION['product_id'][ $product_key_id][$product_id][$skey]);
			  
		   }
		   #pr($_SESSION['product_id'][$product_key_id]);
		   exit(0);
	  }
	  
	  
	public function download($filePath = NULL,$name=null) {
		
		$this->load->helper('download');
		if ($filePath) {
			
			///$file = FILE_UPLOAD_BASE_URL."cart-image\\" .$fileName;
			$file=urldecode($filePath);
			// check file exists    
			if (file_exists ( $file )) {
				
			 // get file content
			    $data = file_get_contents ($file);
				
			    //force download
			    force_download (urldecode($name), $data);
				exit();
				
			}
		}
    }
	
	public function downloadOrderPdf($filePath = NULL,$name=null,$id) {
		
		$this->load->helper('download');
		if ($filePath) {
			
			///$file = FILE_UPLOAD_BASE_URL."cart-image\\" .$fileName;
			$file=urldecode($filePath);
			// check file exists    
			if (file_exists ( $file )) {
				
			    //get file content
			    $data = file_get_contents ($file);
			    //force download
			    force_download (urldecode($name), $data);
				exit();
				
			}else{
				
				$this->load->model('ProductOrder_Model');
		        $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
				$this->getOrderInvoicePdf($id,$orderData['store_id']);
		        $this->getOrderPdf($id,$orderData['store_id']);
				 //get file content
			    $data = file_get_contents ($file);
			    //force download
			    force_download (urldecode($name), $data);
				exit();
				
			}
		}
    }
	
	function UpdateOrderStatus($orderData=array()){


		$this->load->model('ProductOrder_Model');
	    $this->load->model('Product_Model');
	    $this->load->model('User_Model');
		$this->load->model('Address_Model');

		$id=str_replace(ORDER_ID_PREFIX,'',$orderData['order_id']);
		$orderData['id']=(int)$id;

		$this->ProductOrder_Model->saveProductOrder($orderData);

		$ProductOrderItem=$this->ProductOrder_Model->getProductOrderItemDataById($id);

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
			        $this->getOrderInvoicePdf($id);
		            $this->getOrderPdf($id);
					
			    #send Email and Msg
                     
		            $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
					$toEmail=$orderData['email'];
					$name=$orderData['name'];
					$order_id=$orderData['order_id'];
					$subject='Order '.$order_id.' Confirmation';
					
					$body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="color:#303030; font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block;">
						Hi '.ucfirst($name).',
					<br>
						Thanks for your order.
					</span>
				    </div><br><br>';
					$invoice_file=$orderData['order_id'].'-invoice.pdf';
		            $invoice_file=strtolower($invoice_file);
					
					$order_file=$orderData['order_id'].'-order.pdf';
		            $order_file=strtolower($order_file);
					
					
					$files[$invoice_file]=FILE_BASE_PATH.'pdf/'.$invoice_file;
					$files[$order_file]=FILE_BASE_PATH.'pdf/'.$order_file;
					
                    $body=$this->getorderEmail($id,$subject,$body);
					
					sendEmail($toEmail,$subject,$body,'','',$files);
					sendEmail(ADMIN_EMAIL,$subject,$body,'','',$files);
					
					//Admin Email

		}else if($orderData['status']==7){

			        $orderData=$this->ProductOrder_Model->getProductOrderDataById($id);
					$toEmail=$orderData['email'];
					$name=$orderData['name'];
					

					    $order_id=$orderData['order_id'];
						$subject='Your Order '.$order_id.'Payment Has Been Failed ';
						
						$body='<div class="top-info" style="margin-top: 25px;text-align: left;">
						<span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
							Hi '.$name.',
						<br>
						   your payment has been failed for the '.$order_id.' . There could be numerous reasons for this issue. May you have a poor internet connection or payment gateway failure.

                           Wait a couple of hours and try again.<br>

                            Thanks! '.WEBSITE_NAME.' Team

						</span>
					</div></br>/br>';
					
					$body=$this->getorderEmail($id,$subject,$body);
					sendEmail($toEmail,$subject,$body);
                   					
					

		}

		$this->cart->destroy();
		if($insert_id > 0){
		   return true;
		}else{
			return false;
		}

	}
 
}
