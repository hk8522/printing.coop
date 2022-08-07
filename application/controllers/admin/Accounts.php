<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends Admin_Controller
{
    public $class_name='';
    function __construct()
    {
        parent::__construct();
        $this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
        $this->data['class_name']= $this->class_name;
    }

    public function index($status=null)
    {
        $this->load->model('Admin_Model');
        $this->load->model('Store_Model');
        $title=empty($status) ? 'All Sub Admin':ucfirst($status).' Sub Admin';
        $page_status=!empty($status) ? $status:'';
        $this->data['page_title'] = $title;
        $this->data['page_status'] = $page_status;
        $this->data['sub_page_title'] = 'Add New  Sub Admin';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_view_url'] = '';
        $this->data['sub_page_delete_url'] = 'delete';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $lists=$this->Admin_Model->getAdminList($status);
        $this->data['lists']=$lists;
        $this->data['stores']=$this->Store_Model->getStoreList();

        $this->render($this->class_name.'index');
    }

    public function addEdit($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Sub Admin';

        if ($id) {
            $this->data['page_title'] = $page_title = 'Edit Sub Admin';
        }

        $this->data['main_page_url'] = '';
        $this->load->model('Admin_Model');
        $this->load->model('Module_Model');
        $this->load->model('Store_Model');

        $postData = [];

        $postData = $this->Admin_Model->getAdminDataById($id);

        $AttributesList=$this->Module_Model->getModuleList();
        $this->data['AttributesList']=$AttributesList;

        $ProductAttributes=$this->Module_Model->getAdminModuleByAdminId($id);
        $this->data['ProductAttributes']=$ProductAttributes;

        $this->data['StoreList']=$this->Store_Model->getStoreDropDownList();

        if ($this->input->post()){
            //pr($_POST);
            $this->load->library('form_validation');
            $set_rules = $this->Admin_Model->config;
            if ($id){
                    $postData['id']=$this->input->post('id');
                    $set_rules = $this->Admin_Model->editconfig;
            }

            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
            $postData['name'] = $this->input->post('name');
            $postData['email'] = $this->input->post('email');
            $postData['mobile'] = $this->input->post('mobile');
            $postData['username'] = $this->input->post('username');
            $postData['role'] = 'subadmin';

            $postData['password'] = $this->input->post('password');
            $postData['address'] = $this->input->post('address');

            $postData['store_ids']='';
            $store_ids=$this->input->post('store_ids');
            if(!empty($store_ids)){
                $postData['store_ids'] = implode(',',$store_ids);
            }
            #pr($_POST);
            #pr($postData,1);
            $uploadData = array();
            $attributes_data = array();

            foreach($AttributesList as $key => $val){
                $attribute_name='attribute_id_'.$key;
                $attribute_id=isset($_POST[$attribute_name]) ? $this->input->post($attribute_name):'';

                if(!empty($attribute_id)){
                    $attributes_sdata=array();
                    $attributes_sdata['attribute_id']=$attribute_id;
                    $attributes_data[$attribute_id]['data']=$attributes_sdata;

                    $product_attribute_item_ids =!empty($this->input->post('attribute_item_id_'.$attribute_id)) ? $this->input->post('attribute_item_id_'.$attribute_id):array();

                    foreach($product_attribute_item_ids as $subkey => $subval){
                        $attributes_item_sdata=array();
                        if(!empty($subval)){
                            $attributes_item_sdata['attribute_id']=$attribute_id;
                            $attributes_item_sdata['attribute_item_id']=$subval;
                            $attributes_data[$attribute_id]['items'][$subval]= $attributes_item_sdata;
                        }
                    }
                }
            }
            $ProductAttributes=$attributes_data;

            if ($this->form_validation->run()===TRUE) {
                $saveData = true;

                if ($saveData) {
                    if(!empty($postData['id']) && !empty($id)){
                        if(empty($postData['password'])){
                            unset($postData['password']);
                        }else{
                            $postData['password']=md5($postData['password']);
                        }
                    }else{
                        $postData['password']=md5($postData['password']);
                    }

                    $insert_id=$this->Admin_Model->saveAdmin($postData);

                    if ($insert_id > 0) {
                        $attributes_data = array();
                        $attributes_item_data = array();

                        foreach($AttributesList as $key => $val){
                            $attributes_sdata=array();
                            $attribute_name='attribute_id_'.$key;
                            $attribute_id=isset($_POST[$attribute_name]) ? $this->input->post($attribute_name):'';

                            if(!empty($attribute_id)){
                                $attributes_sdata['module_id']=$attribute_id;

                                $attributes_sdata['admin_id']=$insert_id;

                                $product_attribute_item_ids =!empty($this->input->post('attribute_item_id_'.$attribute_id)) ? $this->input->post('attribute_item_id_'.$attribute_id):array();

                                foreach($product_attribute_item_ids as $subkey => $subval){
                                    $attributes_item_sdata=array();
                                    if(!empty($subval)){
                                        $attributes_item_sdata['module_id']=$attribute_id;
                                        $attributes_item_sdata['sub_module_id']=$subval;
                                        $attributes_item_sdata['admin_id']=$insert_id;

                                        $attributes_item_data[]=$attributes_item_sdata;
                                    }
                                }
                                //pr($attributes_sdata); die();
                                $attributes_data[]=$attributes_sdata;
                            }

                            $this->Admin_Model->saveAdminAttributesData($attributes_data,$attributes_item_data,$insert_id);
                        }

                        $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                        $url = FILE_BASE_URL.'pcoopadmin';
                        $password=$this->input->post('password');
                        if(empty($postData['id'])){
                            $subject="Welcome !";
                            $toEmail=$postData['email'];
                            $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                    Hi,'.$postData['name'].',
                                    <br>
                                    Your sub admin account has been created by admin.Please login your account<br>
                                    Login Url :	'.$url.'<br>
                                    User Name :	'.$postData['username'].'<br>
                                    Password:	'.$password.'<br>
                                </span>
                            </div>';

                            $body=emailTemplate($subject,$body);
                            sendEmail($toEmail,$subject,$body);
                        }
                        if(!empty($postData['id']) && !empty($password)){
                            $subject="Reset Password By Admin";
                            $toEmail=$postData['email'];
                            $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                    Hi,'.$postData['name'].',
                                    <br>
                                    Your password has been updated by admin.Please login your account<br>
                                    Login Url :	'.$url.'<br>
                                    User Name :	'.$postData['username'].'<br>
                                    New Password:	'.$password.'<br>
                                </span>
                            </div>';

                            $body=emailTemplate($subject,$body);
                            sendEmail($toEmail,$subject,$body);
                        }
                        redirect('admin/Accounts');
                    } else {
                        $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                    }
                }
            } else {
                $this->session->set_flashdata('message_error','Missing information.');
            }
         }

         $this->data['postData'] = $postData;
         $this->data['ProductAttributes']=$ProductAttributes;
         $this->render($this->class_name.'add_edit');
    }

    public function delete($id=null,$page_status=null)
    {
        if(!empty($id)){
                $page_title='Sub Admin Delete';
                $this->load->model('Admin_Model');
                if ($this->Admin_Model->deleteAdmin($id))
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
        redirect('admin/Accounts/index/'.$page_status);
    }

    public function activeInactive($id=null,$status=null,$page_status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
                $postData['id']=$id;
                $postData['status']=$status;
                $page_title='Sub Admin Active';
                $this->load->model('Admin_Model');
                $subject='Active Account';
                $msg="Your account has been active by admin";
                if($status==0){
                    $page_title='Sub Admin Inactive';
                    $subject='Inactive Account';
                    $msg="Your account has been inactive by admin";
                }
                if ($this->Admin_Model->saveAdmin($postData))
                {
                    $this->session->set_flashdata('message_success',$page_title.' Successfully.');

                    $postData = $this->Admin_Model->getAdminDataById($id);

                    $toEmail=$postData['email'];

                    $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                        '.$postData['name'].',
                                        <br>
                                        '.$msg.'
                                    </span>
                                </div>';

                            $body=emailTemplate($subject,$body);
                            sendEmail($toEmail,$subject,$body);
                }
                else
                {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                }
        }else{
            $this->session->set_flashdata('message_error','Missing information.');
        }

        redirect('admin/Accounts/index/'.$page_status);
    }
    public function changePassword(){
        $this->load->helper('form');
        $this->load->model('Admin_Model');
        $this->data['page_title'] = 'Change Password';
        $loginUserData=$this->session->get_userdata();
        $adminLoginId=$loginUserData['adminLoginId'];
        $postData=$this->Admin_Model->getAdminDataById($adminLoginId);
        $this->data['success'] =false;

        if($this->input->post()){
            $this->load->library('form_validation');
            $set_rules=$this->Admin_Model->config_chnage_password;
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if(!empty($id)){
               $postData['id']=$id;
            }

            $postData['email']=$this->input->post('email');
            if($this->form_validation->run()===TRUE)
            {
                $url=base_url().'pcoopadmin/reset-password/'.base64_encode($postData['id']);

                $toEmail=$postData['email'];
                $subject='Reset Password';
                $name=$postData['name'];
                $body='<div class="top-info" style="margin-top: 25px;text-align: left;">
                    <span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                        Dear '.$name.',
                    <br>
                        You have successfully forgot password  your '.WEBSITE_NAME.' admin account. Please click on the link bellow to for reset password.
                    </span>
                </div>
                <div style="margin: 25px 0px;"><a style="font-size: 14px;text-transform: uppercase;color: #000;font-weight: 600;padding: 10px 30px;border-radius: 3px;border: none;background: #00a9d0;cursor: pointer;text-decoration: none;" href="'.$url.'">Visit Website</a>
                </div>';

                $body=emailTemplate($subject,$body);

                sendEmail($toEmail,$subject,$body);

                $this->session->set_flashdata('message_success','Please check your mail reset password link send your email id.');
                $this->data['success'] =true;
                //$this->logout();
            }else{
                  $this->session->set_flashdata('message_error','Missing information.');
            }
        }

        $this->data['postData']=$postData;
        $this->render($this->class_name.'change_password');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('pcoopadmin');
    }
}
