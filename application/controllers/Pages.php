<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class Pages extends Public_Controller
	{
		
		public $class_name='';
		function __construct()
		{
			parent::__construct();
			$this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
			
		}
		public function index($slug=null)
		{
		    $this->load->model('Page_Model');
			$website_store_id=$this->website_store_id;
            $pageData=$this->Page_Model->getPageDataBySlug($slug,$website_store_id);
            if(!empty($pageData)){
				
				$this->data['page_title']=$pageData['title'];
				$this->data['meta_page_title'] = $pageData['page_title'];
				$this->data['meta_description_content'] = $pageData['meta_description_content'];
				$this->data['meta_keywords_content'] = $pageData['meta_keywords_content'];
				if($this->language_name=='French'){
					
					$this->data['page_title']=$pageData['title_france'];
					$this->data['meta_page_title'] = $pageData['page_title_france'];
					$this->data['meta_description_content'] = $pageData['meta_description_content_france'];
				    $this->data['meta_keywords_content'] = $pageData['meta_keywords_content_france'];
				}
				
				$this->data['slug']=$pageData['slug'];
				$this->data['pageData']=$pageData;
			    $this->render($this->class_name.'index');
				
			}else{

				redirect(base_url());
			}
			
		}
		
		public function contactUs()
		{       
		
		        $website_store_id=$this->website_store_id;
				$this->load->model('Page_Model');
				$pageData=$this->Page_Model->getPageDataBySlug('contact-us',$website_store_id);
				$this->data['page_title']=$pageData['title'];
				$this->data['meta_page_title'] = $pageData['page_title'];
				$this->data['meta_description_content'] = $pageData['meta_description_content'];
				$this->data['meta_keywords_content'] = $pageData['meta_keywords_content'];
				if($this->language_name=='French'){
					
					$this->data['page_title']=$pageData['title_france'];
					$this->data['meta_page_title'] = $pageData['page_title_france'];
					$this->data['meta_description_content'] = $pageData['meta_description_content_france'];
				    $this->data['meta_keywords_content'] = $pageData['meta_keywords_content_france'];
				}
				$this->data['slug'] = $pageData['slug'];
				$this->data['pageData'] = $pageData;
				$this->render($this->class_name.'contact_us');
			
		}
		
		public function prefferedCustomer()
		{       if ($this->loginId) {
			
			      redirect('MyOrders');
		        }
				$website_store_id=$this->website_store_id;
				$this->load->model('Page_Model');
				$pageData=$this->Page_Model->getPageDataBySlug('preffered-customer',$website_store_id);
				
				$this->load->model('Address_Model');
				$this->data['countries'] = $this->Address_Model->getCountries();
				//pr($this->data['countries'],1);
				
				$this->data['page_title']=$pageData['title'];
				$this->data['meta_page_title'] = $pageData['page_title'];
				$this->data['meta_description_content'] = $pageData['meta_description_content'];
				$this->data['meta_keywords_content'] = $pageData['meta_keywords_content'];
				if($this->language_name=='French'){
					
					$this->data['page_title']=$pageData['title_france'];
					$this->data['meta_page_title'] = $pageData['page_title_france'];
					$this->data['meta_description_content'] = $pageData['meta_description_content_france'];
				    $this->data['meta_keywords_content'] = $pageData['meta_keywords_content_france'];
				}
				
				$this->data['slug'] = $pageData['slug'];
				$this->data['pageData'] = $pageData;
				//$this->data['page_title'] = 'PREFFERED CUSTOMER';

				$this->render($this->class_name.'preffered_customer');
		}

		public function estimate()
		{       
		       
		        $website_store_id=$this->website_store_id;
				$this->load->model('Page_Model');
				$this->load->model('Address_Model');
				$this->data['countries'] = $this->Address_Model->getCountries();
				$this->data['states']=array();
				$pageData=$this->Page_Model->getPageDataBySlug('estimate',$website_store_id);
				$this->data['page_title']=$pageData['title'];
				$this->data['meta_page_title'] = $pageData['page_title'];
				$this->data['meta_description_content'] = $pageData['meta_description_content'];
				$this->data['meta_keywords_content'] = $pageData['meta_keywords_content'];
				if($this->language_name=='French'){
					
					$this->data['page_title']=$pageData['title_france'];
					$this->data['meta_page_title'] = $pageData['page_title_france'];
					$this->data['meta_description_content'] = $pageData['meta_description_content_france'];
				    $this->data['meta_keywords_content'] = $pageData['meta_keywords_content_france'];
				}
				$this->data['slug'] = $pageData['slug'];
				$this->data['pageData'] = $pageData;
				$this->render($this->class_name.'estimate');
		}

		public function faq()
		{     
		        $website_store_id=$this->website_store_id;
				$this->load->model('Page_Model');
				$pageData=$this->Page_Model->getPageDataBySlug('faq',$website_store_id);
				$this->data['page_title']=$pageData['title'];
				$this->data['meta_page_title'] = $pageData['page_title'];
				$this->data['meta_description_content'] = $pageData['meta_description_content'];
				$this->data['meta_keywords_content'] = $pageData['meta_keywords_content'];
				if($this->language_name=='French'){
					
					$this->data['page_title']=$pageData['title_france'];
					$this->data['meta_page_title'] = $pageData['page_title_france'];
					$this->data['meta_description_content'] = $pageData['meta_description_content_france'];
				    $this->data['meta_keywords_content'] = $pageData['meta_keywords_content_france'];
				}
				$this->data['slug'] = $pageData['slug'];
				$this->data['pageData'] = $pageData;
				$this->render($this->class_name.'faq');
		}

		public function saveContactUs()
		{ 
		
			
		    if($this->input->post()) { 
					$response = [
							'status' => 'success',
							'msg'    => '',
							'errors' => [],
					];
                
				$recaptchaResponse = $this->input->post('g-recaptcha-response');
				 
				    $this->load->model('Contact_Us_Model');
					$this->load->library('form_validation');
					$rules = $this->Contact_Us_Model->rules;
					$this->form_validation->set_rules($rules);

					if ($this->form_validation->run() == FALSE) {  
							
						    $response['status'] = 'error';
							$response['errors'] = $this->form_validation->error_array();
					
					}else if( $recaptchaResponse=='' ){ 
				
						$response['status'] = 'error';
						$response['msg'] = 'failed';
						$response['errors'] = array('captcha'=>'Captcha unsuccessfull'); 
					
					} else { 
							$data['name']  = $this->input->post('name');
							$data['email'] = $this->input->post('email');
							$data['phone'] = $this->input->post('phone');
							$data['comment'] = $this->input->post('comment');
							$data['store_id'] = $this->main_store_id;
							$StoreData=$this->main_store_data;
							$from_name    = $StoreData['name'];
							if ($this->Contact_Us_Model->save($data)) {
								
									$response['msg'] = "Thank you for contacting $from_name we have received your query our representative will get back to you within 24 hours";
								
									$subject = 'Contact Us';
									$body = '<p>Recieved contact us request from: <br><br> Name:' .ucfirst($data['name']).'<br><br>
									         Email: '.$data['email'].'<br><br> Phone: '.$data['phone'].'<br><br>Message: '.$data['comment'].' </p>';
                                    $body = emailTemplate($subject,$body,1);
                                  
									sendEmail( ADMIN_EMAIL,$subject,$body,FROM_EMAIL,'ADMIN',array() );
									
									if($this->language_name=='French'){
									 $response['msg'] = "Merci d'avoir contacté $from_name nous avons reçu votre demande notre représentant vous répondra dans les 24 heures"; 
									}
							}
					}
					echo json_encode($response);
		}else{
			
			redirect(base_url());
		}
	}
}
?>
