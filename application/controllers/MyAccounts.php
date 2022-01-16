<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MyAccounts extends Public_Controller
{
    public $class_name='';
    function __construct()
    {
		parent::__construct();
		$this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
		$this->class_name='MyAccounts/';

		if (empty($this->loginId) && !$this->input->is_ajax_request()) {
			   redirect('/');
		  }
    }

    public function index()
    {
		$this->load->helper('form');
		$this->data['page_title']='My Account';
		if($this->language_name=='French'){
	        $this->data['page_title']="Mon compte";
	    }
		$page_title="My Account Information";
		$postData=array();
		$this->load->model('User_Model');

		$id=$this->loginId;
		$postData=$this->User_Model->getUserDataById($id);

		$this->data['postData']=$postData;
		$this->render($this->class_name.'index');
  }

   public function EditAccount()
    {
	$this->load->helper('form');
	$this->data['page_title']='Edit My  Account';
	if($this->language_name=='French'){
	        $this->data['page_title']="Modifier mon compte";
	}
	$page_title="My Account Information";
	$postData=array();
	$this->load->model('User_Model');
	$id=$this->loginId;
	$postData=$this->User_Model->getUserDataById($id);

	if($this->input->post()){
			$this->load->library('form_validation');
			$set_rules=$this->User_Model->config_edit;
			$this->form_validation->set_rules($set_rules);
			$this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

			if(!empty($id)){
			   $postData['id']=$id;
			}

			$postData['fname']=$this->input->post('fname');
			$postData['lname']=$this->input->post('lname');
           //$postData['email']=$this->input->post('email');
			$postData['mobile']=$this->input->post('mobile');
			if(empty($postData['lname'])){
				$postData['name']=$postData['fname'];
			}else{
				$postData['name']=$postData['fname'].' '.$postData['lname'];
			}
			if($this->form_validation->run()===TRUE)
			{
				$insert_id=$this->User_Model->saveUser($postData);
					if($insert_id > 0)
					{
						$this->session->set_flashdata('message_success', 'My account information updated successfully');

						$LoginUser=$this->User_Model->getUserDataById($id);
						$this->session->set_userdata(array(
						"loginId" =>   $LoginUser['id'],
						"loginName" => $LoginUser['name'],
						"loginPic" => $LoginUser['profile_pic']
					    ));

						redirect('MyAccounts');
					}
					else
					{
						$this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
					}
				}else{
				  $this->session->set_flashdata('message_error','Missing information.');
			    }
	}
	$this->data['postData']=$postData;
    $this->render($this->class_name.'edit_account');
  }
	public function changePassword()
	{
		$this->data['page_title']='Change Password';
		if($this->language_name=='French'){
	        $this->data['page_title']="Changer le mot de passe";
	    }

		$this->render($this->class_name.'change_password');
	}
    public function saveChangePassword()
	{
		$forgot_mobile=$this->input->post('account_email');
		$forgot_password=$this->input->post('new_password');
		$inputOtp=$this->input->post('input_otp');
		$forgotOtp=$this->input->post('send_otp');
		$json=array('status'=>0,'msg'=>'');
		$this->load->model('User_Model');

	    if($this->User_Model->checkEmailId($forgot_mobile)){
			$data['email']=$forgot_mobile;
			$data['password']=md5($forgot_password);
            if($this->User_Model->saveUserPassword($data)){
				$json['status']=1;
				$json['msg']='Your password has been updated successfully.';
				if($this->language_name=='French'){
	              $json['msg']='Votre mot de passe a été mis à jour avec succès.';
	            }
			}else{
				$json['msg']='Technical problem please try after some time';
				if($this->language_name=='French'){
	              $json['msg']='Problème technique, veuillez essayer après un certain temps.';
	            }
			}
		}else{
		    $json['msg']='Email id does not exist';
		    if($this->language_name=='French'){
	             $json['msg']="L'identifiant de messagerie n'existe pas.";
	        }
		}
		echo json_encode($json);
	}

  public function  manageAddress()
  {
	$this->load->model('Address_Model');
	$this->data['page_title']='Manage Address';
	if($this->language_name=='French'){
	    $this->data['page_title']="Gérer l'adresse";
	}
	$address=$this->Address_Model->getAddressListByUserId($this->loginId);
	//pr($address,1);
	$this->data['address']   =$address;
	$this->data['countries'] = $this->Address_Model->getCountries();
    $this->render($this->class_name.'manage_address');
  }

  public function addEditAddress($id = null)
  {
      $this->load->helper('form');
      $this->load->model('Address_Model');

      if (!empty($id)) {
          $id=base64_decode($id);
          if (!empty($id)) {
			         $this->data['page_title']=$page_title='Edit Address';
					 if($this->language_name=='French'){
	                    $this->data['page_title']="Modifier l'adresse";
	                }
		      } else {
			         $id = null;
		      }
      }

      if(!empty($id)) {
            $this->data['page_title']='Edit Address';
		    if($this->language_name=='French'){
	          $this->data['page_title']="Modifier l'adresse";
	        }
          $page_title='Address updated successfully';
         } else {
          $this->data['page_title']=$page_title='Add New Address';
		  $page_title='New address added successfully';
	    }

	    $postData = array();
	    $postData = $this->Address_Model->getAddressDataById($id);
		$this->data['countries'] = $this->Address_Model->getCountries();
		$country_id=isset($postData['country']) ? $postData['country']:'';
		$state_id=isset($postData['state']) ? $postData['state']:'';
		$this->data['states'] = $this->Address_Model->getState($country_id);
		$this->data['citys'] = $this->Address_Model->getCity($state_id);
		//pr($this->data['states']);

      if ($this->input->post()) {
         $this->load->library('form_validation');
         $set_rules=$this->Address_Model->config;
         $this->form_validation->set_rules($set_rules);
         $this->form_validation->set_error_delimiters('<label style="color:red">', '</label>');

         /*if (!empty($id)){
            $postData['id']=$id;
         }*/

		 $postData['id']      = $this->input->post('id');
         $postData['user_id'] = $this->loginId;
         $postData['first_name'] = $this->input->post('first_name');
         $postData['last_name'] = $this->input->post('last_name');
         $postData['company_name'] = $this->input->post('company_name');
         $postData['name'] = $postData['first_name'].' '. $postData['last_name'];
         $postData['pin_code'] = $this->input->post('pin_code');
         $postData['mobile'] = $this->input->post('mobile');
         $postData['address'] = $this->input->post('address');
         $postData['country'] = $this->input->post('country');
         $postData['city'] = $this->input->post('city');
         $postData['state'] = $this->input->post('state');
         $postData['landmark'] = $this->input->post('landmark');
         $postData['alternate_phone'] = $this->input->post('alternate_phone');$postData['address_type']=$this->input->post('address_type');
         $postData['default_delivery_address'] = $this->input->post('default_delivery_address');

         if ($this->input->is_ajax_request()) {
               return $this->addAddressByAjax($postData);
         }

         if ($this->form_validation->run() === TRUE)
         {
              $insert_id = $this->Address_Model->saveAddress($postData);
              if ($insert_id > 0) {
                $this->Address_Model->CheckDeliveryAddress($insert_id,$postData);
                $this->session->set_flashdata('message_success',$page_title);
				redirect('MyAccounts/manageAddress');
             } else {
                $this->session->set_flashdata('message_error',' save address unsuccessfully.');
             }
         } else {
              $this->session->set_flashdata('message_error','Missing information.');
         }
     }

     $this->data['postData'] = $postData;
     $address = $this->Address_Model->getAddressListByUserId($this->loginId);
     $this->render($this->class_name.'add_edit_address');
  }

    public function deleteAddress($id=null)
    {
        if(!empty($id)){
				$page_title='Address delete';
				if($this->language_name=='French'){
	                   $page_title="Suppression d'adresse";
	            }
				$this->load->model('Address_Model');
				$postData=$this->Address_Model->getAddressDataById(base64_decode($id));

				if(empty($postData['default_delivery_address'])){
					if ($this->Address_Model->deleteAddress(base64_decode($id)))
					{
						$this->session->set_flashdata('message_success',$page_title.' Successfully.');
					}
					else
					{
						$this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
					}
				}else{
					$this->session->set_flashdata('message_error','this address is default delivery address so this address you can not deleted');
				}
		}else{
			$this->session->set_flashdata('message_error','Missing information.');
	    }

		redirect('MyAccounts/manageAddress');
    }

  public function  notification()
    {
	$this->data['page_title']='Notification';
	if($this->language_name=='French'){
	    $page_title="Notification";
	}
    $this->render($this->class_name.'notification');
    }

    public function  logout()
    {
      $this->session->sess_destroy();
      redirect('/');
	}

	public function sendOtp(){
		$email=$this->input->post('account_email');
		$type=$this->input->post('type');

		$json=array('status'=>0,'msg'=>'');
		$this->load->model('User_Model');

	    if($this->User_Model->checkEmailId($email)){
		    $otp=getOtp();

			$StoreData=$this->main_store_data;
			$store_url    = $StoreData['url'];
			$store_phone  = $StoreData['phone'];
			$from_name    = $StoreData['name'];
			$from_email   = $StoreData['from_email'];
			$admin_email1 = $StoreData['admin_email1'];
			$admin_email2 = $StoreData['admin_email2'];
			$admin_email3 = $StoreData['admin_email3'];

			if($this->language_name == 'French'){
				$massage=$otp." est le code de réinitialisation du mot de passe.code est confidentiel, veuillez ne pas partager ce code avec qui que ce soit pour assurer la sécurité des comptes";
				$subject='réinitialiser le mot de passe';
				$body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
								'.$massage.'
							</span>
						</div>';

				   $body = $this->emailTemplate($subject,$body,$this->main_store_id);
				   sendEmail($email,$subject,$body,$from_email,$from_name);
			}else{
				    $massage=$otp.' is reset password code.code is confidential, Please do not share this code with anyone to ensure accounts security';
				    $subject='Reset Password';
				    $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
								'.$massage.'
							</span>
						</div>';

				    $body = $this->emailTemplate($subject,$body,$this->main_store_id);
				    sendEmail($email,$subject,$body,$from_email,$from_name);
			}

			$json['status']=1;

			$json['msg']='Please check your mail reset password code has been sent to your email id: '.$email;
			if($this->language_name == 'French'){
				$json['msg']='Veuillez vérifier que votre code de mot de passe de réinitialisation de messagerie a été envoyé à votre identifiant de messagerie:'.$email;
			}

			$json['otp']=$otp;
		}else{
		    $json['msg']='Email id does not exist';
		    if($this->language_name == 'French'){
				$json['msg']="L'identifiant de messagerie n'existe pas";
			}
		}

		echo json_encode($json);
	}

  public function addAddressByAjax($postData)
  {
     $response = [
        'status' => 'error',
        'msg'    => '',
        'errors' => [],
        'data'   => '',
     ];

     $this->load->model('Address_Model');
     $this->load->library('form_validation');
     $set_rules=$this->Address_Model->config;
     $this->form_validation->set_rules($set_rules);

     if ($this->form_validation->run() === FALSE) {
         $response['errors'] = $this->form_validation->error_array();
     } else {
		    //pr($postData,1);
            $insert_id = $this->Address_Model->saveAddress($postData);

        if ($insert_id > 0) {
            $this->Address_Model->CheckDeliveryAddress($insert_id,$postData);
            $this->data['address'] = $this->Address_Model->getAddressDataById($insert_id);
			if(!empty($postData['id'])){
				$response['msg']    = 'Address Updated Successfully';
				$response['updated']    = 1;
			}else{
                $response['msg']    = 'New Address Added Successfully';
				$response['updated']    = 0;
			}
            $response['status'] = 'success';
            $response['data'] = $this->load->view('elements/addresses-list', $this->data, TRUE);
        }
     }

     echo json_encode($response);
  }

   function getStateDropDownListByAjax($country_id){
	    $this->load->model('Address_Model');
		$options='<option value="">--Select State--</option>';
		if(!empty($country_id)){
		    $stateList=$this->Address_Model->getState($country_id);
			//pr($stateList);

			foreach($stateList as $key=>$val){
				$options .='<option value="'.$val['id'].'">'.$val['name'].'</option>';
			}
		}
		echo $options;
		exit();
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
		echo $options;
		exit();
	}
}
