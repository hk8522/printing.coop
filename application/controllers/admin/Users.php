<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller
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
        $this->load->helper('form');
        $this->load->model('User_Model');
        $title=empty($status) ? 'All Users':ucfirst($status).' Users';
        $page_status=!empty($status) ? $status:'';

        $this->load->model('Store_Model');
        $StoreList=$this->Store_Model->getAllStoreList();
        $this->data['StoreList']=$StoreList;

        $this->data['page_title'] = $title;
        $this->data['page_status'] = $page_status;
        $this->data['sub_page_title'] = 'Add New User';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_view_url'] = 'viewUser';
        $this->data['sub_page_delete_url'] = 'deleteUser';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $lists=$this->User_Model->getUserList($status);
        $this->data['lists']=$lists;
        $this->data['status']=$status;
        $this->render($this->class_name.'index');
    }

    public function preferredCustomer($status=null)
    {
        $this->load->model('User_Model');
        $this->load->model('Address_Model');

        $title='Preferred Customer';

        $page_status=!empty($status) ? $status:'';

        $this->load->model('Store_Model');
        $StoreList=$this->Store_Model->getAllStoreList();
        $this->data['StoreList']=$StoreList;

        $this->data['page_title'] = $title;
        $this->data['page_status'] = $page_status;
        $this->data['sub_page_title'] = 'Add New User';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_view_url'] = 'viewUser';
        $this->data['sub_page_delete_url'] = 'deleteUser';
        $this->data['sub_page_url_active_inactive'] = 'activeInactivePreferredCustomer';
        $lists=$this->User_Model->getPreferredCustomerUserList($status);
        $this->data['lists']=$lists;
        $this->render($this->class_name.'preferred_customer');
    }

    public function viewUser($id=null)
    {
        if(empty($id)){
            redirect('admin/Users');
        }
        $this->load->model('User_Model');
        $this->data['page_title'] = 'User Details';
        $this->data['main_page_url'] = '';
        $this->load->model('User_Model');
        $User=$this->User_Model->getUserList($id);
        $this->data['User']=$User;
        $this->render($this->class_name.'view');
    }
    public function changePassword($id,$page_status='',$paage_name=null)
    {
        $this->load->helper('form');
        $this->load->model('User_Model');
        $this->data['page_title'] = $page_title='Change Password';
        if(empty($id)){
            redirect('admin/Users');
        }
        if ($this->input->post()){
            $this->load->library('form_validation');
            $set_rules = $this->User_Model->configChangePassword;

            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
            $password=$this->input->post('password');
            $postData['id']=$this->input->post('id');

            if ($this->form_validation->run()===TRUE) {
                $postData['password'] = md5($password);

                if($this->User_Model->saveUser($postData)){
                   $this->session->set_flashdata('message_success',$page_title.' Successfully.');

                   if(!empty($postData['id']) && !empty($password)){
                        $postData=$this->User_Model->getUserDataById($postData['id']);
                        $this->load->model('Store_Model');
                        $store_id=$postData['store_id'];
                        $Store=$this->Store_Model->getStoreDataById($store_id);

                        $store_url=$Store['url'];
                        $langue_id=$Store['langue_id'];
                        $url = $store_url.'Logins';

                        $toEmail=$postData['email'];
                        $from_name    = $Store['name'];
                        $from_email   = $Store['from_email'];
                        $admin_email1 = $Store['admin_email1'];
                        $admin_email2 = $Store['admin_email2'];
                        $admin_email3 = $Store['admin_email3'];

                        if($langue_id==2){
                            $subject="Réinitialiser le mot de passe par l'administrateur";
                            $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                    salut,'.$postData['name'].',
                                    <br>';
                                    $body .="Votre mot de passe a été mis à jour par l'administrateur, veuillez vous connecter à votre compte<br>";
                                    $body .='URL de connexion :	'.$url.'<br>
                                    Email :	'.$postData['email'].'<br>
                                    nouveau mot de passe:	'.$password.'<br>
                                </span>
                            </div>';
                        }else{
                            $subject="Reset Password By Admin";
                            $toEmail=$postData['email'];
                            $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                    Hi,'.$postData['name'].',
                                    <br>
                                    Your password has been updated by admin.Please login your account<br>
                                    Login Url :	'.$url.'<br>
                                    Email :	'.$postData['email'].'<br>
                                    New Password:	'.$password.'<br>
                                </span>
                           </div>';
                        }

                        $body=$this->emailTemplate($subject,$body,$store_id);
                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);
                    }

                    if($paage_name=='preferred-customer'){
                        redirect('admin/Users/preferredCustomer');
                    }else{
                        redirect('admin/Users/index/'.$page_status);
                    }
                }else{
                   $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                }
            }
        }
        $this->data['id']=$id;
        $this->render($this->class_name.'change_password');
    }
    public function addEdit($id=null,$page_status=null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New User';
        if(!empty($id)){
           $this->data['page_title'] = $page_title = 'Edit User';
        }
        $this->data['main_page_url'] = 'index/'.$page_status;
        $this->load->model('User_Model');

        $postData=array();
        $postData=$this->User_Model->getUserDataById($id);

        if($this->input->post()){
            $this->load->library('form_validation');
            $set_rules=$this->User_Model->config;

            if(!empty($id)){
                $set_rules=$this->User_Model->config_edit;
            }

            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if(!empty($id)){
               $postData['id']=$this->input->post('id');
            }

            $postData['fname']=$this->input->post('fname');
            $postData['lname']=$this->input->post('lname');
            $postData['email']=$this->input->post('email');
            $postData['password']=$this->input->post('password');
            $postData['mobile']=$this->input->post('mobile');
            if(empty($postData['lname'])){
                $postData['name']=$postData['fname'];
            }else{
                $postData['name']=$postData['fname'].' '.$postData['lname'];
            }
            if($this->form_validation->run()===TRUE)
            {
                if(!empty($postData['password'])){
                    $postData['password']=md5($postData['password']);
                }else{
                    unset($postData['password']);
                }
                $insert_id=$this->User_Model->saveUser($postData);
                    if($insert_id > 0)
                    {
                        $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                        redirect('admin/Users/index/'.$page_status);
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
        $this->render($this->class_name.'add_edit');
    }
    public function activeInactive($id=null,$status=null,$page_status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
                $postData['id']=$id;
                $postData['status']=$status;
                $page_title='User Active';
                if($status==0){
                    $page_title='User Inactive';
                }
                $this->load->model('User_Model');
                if ($this->User_Model->saveUser($postData))
                {
                        $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                        $postData=$this->User_Model->getUserDataById($id);

                        $this->load->model('Store_Model');
                        $store_id=$postData['store_id'];
                        $Store=$this->Store_Model->getStoreDataById($store_id);

                        $store_url=$Store['url'];
                        $langue_id=$Store['langue_id'];

                        $toEmail=$postData['email'];
                        $from_name    = $Store['name'];
                        $from_email   = $Store['from_email'];
                        $admin_email1 = $Store['admin_email1'];
                        $admin_email2 = $Store['admin_email2'];
                        $admin_email3 = $Store['admin_email3'];

                        if($langue_id==2){
                            $subject='Compte actif';
                            $msg="Votre compte a été actif par l'administrateur";
                            if($status==0){
                                $subject='Compte inactif';
                                $msg="Votre compte a été inactif par l'administrateur";
                            }
                        }else{
                            $subject='Active Account';
                            $msg="Your account has been active by admin";
                            if($status==0){
                                $subject='Compte inactif';
                                $msg="Your account has been inactive by admin";
                            }
                        }

                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                '.$postData['name'].',
                                <br>
                                '.$msg. '
                            </span>
                        </div>';

                        $body=$this->emailTemplate($subject,$body,$store_id);
                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);
                }
                else
                {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                }
        }else{
            $this->session->set_flashdata('message_error','Missing information.');
        }

        redirect('admin/Users/index/'.$page_status);
    }

    public function activeInactivePreferredCustomer($id=null,$status=null,$page_status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
                $postData['id']=$id;
                $postData['status']=$status;
                $page_title='User Active';
                if($status==0){
                    $page_title='User Inactive';
                }
                $this->load->model('User_Model');

                if ($this->User_Model->saveUser($postData))
                {
                        $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                        $postData=$this->User_Model->getUserDataById($id);
                        $this->load->model('Store_Model');
                        $store_id=$postData['store_id'];
                        $Store=$this->Store_Model->getStoreDataById($store_id);
                        $store_url=$Store['url'];
                        $langue_id=$Store['langue_id'];

                        $toEmail=$postData['email'];
                        $from_name    = $Store['name'];
                        $from_email   = $Store['from_email'];
                        $admin_email1 = $Store['admin_email1'];
                        $admin_email2 = $Store['admin_email2'];
                        $admin_email3 = $Store['admin_email3'];

                        if($langue_id==2){
                            $subject='Compte actif';
                            $msg="Votre compte a été actif par l'administrateur";
                            if($status==0){
                                $subject='Compte inactif';
                                $msg="Votre compte a été inactif par l'administrateur";
                            }
                        }else{
                            $subject='Active Account';
                            $msg="Your account has been active by admin";
                            if($status==0){
                                $subject='Compte inactif';
                                $msg="Your account has been inactive by admin";
                            }
                        }

                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                '.$postData['name'].',
                                <br>
                                '.$msg. '
                            </span>
                        </div>';

                        $body=$this->emailTemplate($subject,$body,$store_id);
                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);
                }
                else
                {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                }
        }else{
            $this->session->set_flashdata('message_error','Missing information.');
        }

        redirect('admin/Users/preferredCustomer/'.$page_status);
    }
    public function activeInactiveUserType($id=null,$status=null,$page_status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
                $postData['id']=$id;
                $postData['preferred_status']=$status;
                $page_title='User Unverified';
                $this->load->model('User_Model');
                if($status==1){
                    $page_title='User Verified';
                }
                if ($this->User_Model->saveUser($postData))
                {
                        $this->session->set_flashdata('message_success',$page_title.' Successfully.');
                        $postData=$this->User_Model->getUserDataById($id);
                        $this->load->model('Store_Model');
                        $store_id=$postData['store_id'];
                        $Store=$this->Store_Model->getStoreDataById($store_id);
                        $store_url=$Store['url'];
                        $store_phone=$Store['phone'];
                        $langue_id=$Store['langue_id'];

                        $toEmail=$postData['email'];
                        $from_name    = $Store['name'];
                        $from_email   = $Store['from_email'];
                        $admin_email1 = $Store['admin_email1'];
                        $admin_email2 = $Store['admin_email2'];
                        $admin_email3 = $Store['admin_email3'];

                        if($langue_id==2){
                            $subject='Compte actif';
                            $msg="Votre compte a été actif par l'administrateur";
                            if($status==1){
                                $subject='Votre compte '.$from_name.' est approuvé';

                                $image=$this->Store_Model->getStoreEmailTemplateImage($store_id,'account_approved');

                                $image_template='';
                                if(!empty($image)){
                                    $image_url=$store_url.'uploads/email_templates/'.$image;
                                    $image_template="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'><a href='".$store_url."/Logins'><img style='width:578px;' src='".$image_url."'></a></div>";
                                }

                                $body="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'>$image_template
                                Votre compte a été activé.<br>
                                Bienvenue sur $from_name ! Connectez-vous à notre tout nouveau portail
                                client pour commencer. À partir de là, vous pourrez télécharger et gérer vos
                                images, configurer et commander des produits et discuter avec notre
                                formidable équipe d'assistance à la clientèle à l'aide du centre de messages.
                                Si vous avez des questions ou des préoccupations, n'hésitez pas à nous
                                contacter au $store_phone<br><br>

                                Nos heures d'ouverture sont: du lundi au vendredi de 9h à 18h). Nous
                                sommes fermés le samedi et le dimanche.<br><br>
                                Merci encore d'avoir choisi $from_name
                                </span>
                                <div><h1>BIENVENUE SUR $from_name !</h1></div>
                                </div>";
                            }else{
                                $subject="Your $from_name Le compte n'est pas approuvé";
                                $body="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'>
                                Votre compte a été désactivé<br>
                                </div>";
                            }
                        }else{
                            if($status==1){
                                $subject='Your '.$from_name.' Account is Approved';

                                $image=$this->Store_Model->getStoreEmailTemplateImage($store_id,'account_approved');
                                $image_template='';
                                if(!empty($image)){
                                    $image_url=$store_url.'uploads/email_templates/'.$image;
                                    $image_template="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'><a href='".$store_url."/Logins'><img style='width:578px;'  src='".$image_url."'></a></div>";
                                }

                                $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">'.$image_template.'
                                Your account has been activated.<br>
                                Welcome to '.$from_name.'! Login to our all new Customer Portal to get
                                started. From there, you will be able to upload and manage your images,
                                configure and order products, and chat with our phenomenal Customer
                                Support team using the Message Center. If you have any questions or
                                concerns, please do not hesitate to contact us at $store_phone<br><br>

                                Our hours of operation are : Monday - Friday 9AM - 6pmdnight). We are
                                closed on Saturday and Sunday.<br><br>
                                Thank you again for choosing '.$from_name.'
                            </span>
                            <div><h1>WELCOME TO '.$from_name.'!</h1></div>
                            </div>';
                            }else{
                                $subject='Your '.$from_name.' Account is Unapproved';
                                $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                Your account has been Inactivated.<br>
                                </div>';
                            }
                        }

                        $body=$this->emailTemplate($subject,$body,$store_id);
                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);
                }
                else
                {
                    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
                }
        }else{
            $this->session->set_flashdata('message_error','Missing information.');
        }

        redirect('admin/Users/preferredCustomer/'.$page_status);
    }

    public function deleteUser($id=null,$page_status=null)
    {
        if(!empty($id)){
                $page_title='User Delete';
                $this->load->model('User_Model');
                if ($this->User_Model->deleteUser($id))
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
        redirect('admin/Users/index/'.$page_status);
    }

    public function wishlists($user_id=null,$page_status=null)
    {
        if(empty($user_id)){
            redirect('admin/Users/index/'.$page_status);
        }

        $this->load->model('User_Model');
        $title='Wishlist';
        $this->data['page_title'] = $title;
        $lists=$this->User_Model->getWishlistList($user_id);
        $this->data['lists']=$lists;
        $this->data['user_id']=$user_id;
        $this->data['page_status']=$page_status;
        $this->render($this->class_name.'wishlists');
    }

     public function subscribeEmail(){
        $this->load->model('Product_Model');
        $this->data['page_title'] = 'subscribe Email';
        $this->data['sub_page_title'] = '';
        $this->data['sub_page_url'] = '';
        $this->data['sub_page_view_url'] = '';
        $this->data['sub_page_delete_url'] = 'deleteSubscribeEmail';
        $this->data['sub_page_url_active_inactive'] = '';
        $lists=$this->Product_Model->getsubscribeEmail();
        $this->data['lists']=$lists;
        $this->load->model('Store_Model');
        $StoreList=$this->Store_Model->getAllStoreList();
        $this->data['StoreList']=$StoreList;
        $this->render($this->class_name.'subscribe_email');
    }
    public function deleteSubscribeEmail($id=null)
    {
        if(!empty($id)){
                $page_title='Subscribe Email Delete';
                $this->load->model('Product_Model');
                if ($this->Product_Model->deleteSubscribeEmail($id))
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

        redirect('admin/Users/subscribeEmail');
    }

    public function exportCSV($status=null){
        $this->load->model('User_Model');
        // file name
        $filename = 'user-list-'.date('d').'-'.date('m').'-'.date('Y').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        $lists=$this->User_Model->getUserList($status);
        // file creation
        $file = fopen('php://output', 'w');
        $header = array("Customer Code","Name","Mobile","Email","Last Login","Last Login IP","Created On","Status");
        fputcsv($file, $header);

        foreach ($lists as $key=>$list){
            $data=array();
            $data['customer_code']=CUSTOMER_ID_PREFIX.$list['id'];
            $data['name']=ucwords($list['name']);
            $data['mobile']=$list['mobile'];
            $data['email']=$list['email'];
            $data['last_login']=dateFormate($list['last_login']);
            $data['last_login_ip']=$list['last_login_ip'];
            $data['created']=dateFormate($list['created']);
            $data['status']=$list['status'] ==1 ? "Active":"Inactive";
            fputcsv($file,$data);
        }
        fclose($file);
        exit;
    }

    public function ImportCSV(){
        $this->load->model('User_Model');
        $page_status=$_POST['page_status'];
        if(!empty($_FILES['csv']['name'])){
            $tmp_name=$_FILES['csv']['tmp_name'];
            $filename=$_FILES['csv']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if($ext=="csv"){
                if (($handle = fopen($tmp_name, "r")) !== FALSE) {
                    $i=0;
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $userSaveData=array();
                        $row=0;
                        if($i > 0){
                            $name=trim($data['0']);
                            $mobile=trim($data['1']);
                            $email=trim($data['2']);
                            $password=trim($data['3']);

                            if(!empty($email) && !$this->User_Model->checkEmailId($email) && !empty($name)){
                                $userSaveData['name']=$name;
                                $userSaveData['email']=$email;
                                $userSaveData['mobile']=$mobile;
                                $userSaveData['password']=!empty($password) ? md5($password):md5('12345678');
                                $userSaveData['email_verification']=1;
                                $id=$this->User_Model->saveUser($userSaveData);
                                #pr($userSaveData);
                                if($id > 0)
                                {
                                    $row++;
                                }
                            }
                        }
                        $i++;
                    }

                    fclose($handle);
                    $this->session->set_flashdata('message_success',$row.' User import  successfully.');
                }else{
                     $this->session->set_flashdata('message_error','Selected only csv file');
                }
            }else{
                 $this->session->set_flashdata('message_error','Selected only csv file');
            }
        }else{
           $this->session->set_flashdata('message_success','Please selected csv file');
        }
        redirect('admin/Users/index/'.$page_status);
    }
}
