<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logins extends Public_Controller
{
    public $class_name='';
    function __construct()
    {
        parent::__construct();
        $this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
        $this->load->helper('form');
        if ($this->loginId) {
            redirect('MyOrders');
        }
    }

    public function index()
    {
            $this->data['page_title']='Login/Register';

            if($this->language_name=='French'){
            $this->data['page_title']="S'identifier S'enregistrer";
            }
            $this->render($this->class_name.'index');
    }

    public function checkLoginByAjax()
    {       if(!$this->input->post()) {
                redirect(base_url());
            }
            $this->load->model('User_Model');
            $this->load->library('form_validation');
            $rules = $this->User_Model->loginRules;
            $this->form_validation->set_rules($rules);

            $response = [
                    'status' => 'success',
                    'msg'    => '',
                    'errors' => [],
            ];

            if ($this->form_validation->run() == FALSE) {
                    $response['status'] = 'error';
                    $response['errors'] = $this->form_validation->error_array();
            } else {
                    $data['email'] 		= $this->input->post('loginemail');
                    $data['password'] = $this->input->post('loginpassword');
                    $loginUser = $this->User_Model->checkUserLogin($data);

                    if (count($loginUser) > 0) {
                        $status = $loginUser['status'];
                        $email_verification = $loginUser['email_verification'];

                        if (!$email_verification) {
                                $response['status'] = 'error';
                                $response['msg'] = $this->language_name=='French' ? 'Votre e-mail de vérification est en attente. veuillez vérifier votre adresse e-mail après ce compte de connexion.':'Your email verification is pending. please verify your email after that login account.';
                        } else if (!$status) {
                                $response['status'] = 'error';
                                $response['msg'] = $this->language_name=='French' ? "Votre compte a été inactif par l'administrateur pour plus d'informations, veuillez contacter le support":'Your account has been inactive by the admin for more enquiry please contact the support';
                        } else {
                            $this->session->set_userdata([
                                    "loginId" 				=> $loginUser['id'],
                                    "loginName" 			=> $loginUser['name'],
                                    "loginFirstName" 	    => $loginUser['fname'],
                                    "loginLastName" 	    => $loginUser['lname'],
                                    "loginPic" 				=> $loginUser['profile_pic'],
                                    "loginMobile" 		    => $loginUser['mobile'],
                                    "loginEmail" 			=> $loginUser['email']
                            ]);

                            $sdata = [];
                            $sdata['id'] = $loginUser['id'];
                            $sdata['last_login'] = date('Y-m-d H:i:s');
                            $sdata['last_login_ip'] = $_SERVER['REMOTE_ADDR'];
                            $this->User_Model->saveUser($sdata);
                            $total_items=$this->cart->total_items();
                            $url=base_url()."MyOrders/";
                            if($total_items > 0){
                                $url=base_url()."Checkouts/";
                            }
                            $response['url']=$url;
                        }
                    } else {
                            $response['status'] = 'error';
                            $response['msg'] = $this->language_name=='French' ? "E-mail ou mot de passe incorrect":'Email or password is incorrect';
                    }
            }

            echo json_encode($response);
    }

    public function checkMobileByAjax()
    {
        $this->load->model('User_Model');
        $json=array('status'=>0,'msg'=>'');
        if($this->input->post()){
            $email=$this->input->post('ck_moblie_number');
            if ($this->User_Model->checkEmailId($email))
            {
                $json['status']=1;
                $json['login']=1;
            }else{
                $json['status']=1;
                $json['login']=2;
                $otp=getOtp();
                $json['otp']=$otp;
                $StoreData=$this->main_store_data;
                $store_url    = $StoreData['url'];
                $store_phone  = $StoreData['phone'];
                $from_name    = $StoreData['name'];
                $from_email   = $StoreData['from_email'];
                $admin_email1 = $StoreData['admin_email1'];
                $admin_email2 = $StoreData['admin_email2'];
                $admin_email3 = $StoreData['admin_email3'];

                if($this->language_name == 'French'){
                    $massage=$otp." Le code de vérification de l'e-mail pour signup.code est confidentiel, veuillez ne pas partager ce code avec qui que ce soit pour assurer la sécurité des comptes";
                    $subject="Code de vérification de l'e-mail";

                    $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                    '.$massage.'
                                </span>
                            </div>';

                    $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                    sendEmail($email,$subject,$body,$from_email,$from_name);
                    $json['msg']='Veuillez vérifier que le code de vérification de votre e-mail a été envoyé à votre identifiant de messagerie';
                }else{
                    $massage=$otp.' is email verification code for signup.code is confidential, Please do not share this code with anyone to ensure accounts security';
                    $subject='Email Verification Code';

                    $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                    '.$massage.'
                                </span>
                            </div>';
                    $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                    sendEmail($email,$subject,$body,$from_email,$from_name);
                    $json['msg']='Please check your mail email verification code has been sent to your email id';
                }
            }
        }

        echo json_encode($json);
    }

    public function signup()
    {
            if(!$this->input->post()) {
                redirect(base_url());
            }
            $this->load->model('User_Model');
            $this->load->library('form_validation');
            $set_rules = $this->language_name=='French' ? $this->User_Model->configFranch:$this->User_Model->config;
            $this->form_validation->set_rules($set_rules);

            $response = [
                    'status' => 'success',
                    'msg'    => '',
                    'errors' => [],
            ];

            if ($this->form_validation->run() == FALSE) {
                    $response['status'] = 'error';
                    $response['errors'] = $this->form_validation->error_array();
             } else {
                  $fname = $this->input->post('fname');
                  $lname = $this->input->post('lname');
                  $email = $this->input->post('email');
                  $password = $this->input->post('password');
                  $email_verification= $this->input->post('email_verification');

                    if ($this->User_Model->checkEmailId($email)) {
                            $response['msg'] = $this->language_name=='French' ? "Identifiant de messagerie déjà enregistré":'Email id already registered1';
                    } else {
                            $postData = array();
                            $postData['fname'] = $fname;
                            $postData['lname'] = $lname;
                            $postData['email'] = $email;
                            $postData['password'] = md5($password);
                            $postData['email_verification'] = $email_verification ?? 0;
                            $postData['store_id'] = $this->main_store_id;
                            if (empty($postData['lname'])){
                                $postData['name'] = $postData['fname'];
                            } else {
                                $postData['name'] = $postData['fname'].' '.$postData['lname'];
                            }

                            $insert_id = $this->User_Model->saveUser($postData);

                            if ($insert_id) {
                                $response['msg'] = $this->language_name=='French' ? "Votre compte a été créé avec succès. Veuillez vérifier votre messagerie et vérifier votre identifiant de messagerie.":'Your account has been created successfully. Please check your mail and verify email id.';

                                $toEmail = $email;

                                $StoreData=$this->main_store_data;
                                $store_url    = $StoreData['url'];
                                $store_phone  = $StoreData['phone'];
                                $from_name    = $StoreData['name'];
                                $from_email   = $StoreData['from_email'];
                                $admin_email1 = $StoreData['admin_email1'];
                                $admin_email2 = $StoreData['admin_email2'];
                                $admin_email3 = $StoreData['admin_email3'];

                                $url = $store_url.'Logins/emailVerification/'.base64_encode($insert_id);

                                if($this->language_name == 'French'){
                                    $subject = "vérification de l'E-mail";
                                    $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                                '.$postData['name'].',
                                                <br>
                                                Vous avez créé avec succès votre '.$from_name .' Compte. Veuillez cliquer sur le lien ci-dessous pour vérifier votre adresse e-mail et terminer votre inscription.
                                            </span>
                                        </div>
                                        <div style="margin: 25px 0px;"><a style="font-size: 14px;text-transform: uppercase;color: #000;font-weight: 600;padding: 10px 30px;border-radius: 3px;border: none;background: #00a9d0;cursor: pointer;text-decoration: none;" href="'.$url.'">Visit Website</a>
                                        </div><div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">'."si vous n'avez pas créé de ".$from_name ." compte, veuillez ignorer ce message <br> et assurez-vous que votre compte de messagerie est sécurisé. </span></div>";

                                        $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);

                                        $subject='Bienvenue !';
                                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                                    '.$postData['name'].',
                                                    <br>
                                                    Merci de vous être inscrit avec '.$from_name .' Nous espérons que vous apprécierez votre temps avec nous.
                                                </span>
                                            </div>';

                                        $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);
                                }else{
                                        $subject = 'Email Verification';
                                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                            '.$postData['name'].',
                                            <br>
                                            You have Successfully created your '.$from_name .' account. Please click on the link bellow to verify your email address and complete your registration.
                                        </span>
                                        </div>
                                        <div style="margin: 25px 0px;"><a style="font-size: 14px;text-transform: uppercase;color: #000;font-weight: 600;padding: 10px 30px;border-radius: 3px;border: none;background: #00a9d0;cursor: pointer;text-decoration: none;" href="'.$url.'">Visit Website</a>
                                        </div><div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">if you havent created a  '.$from_name .' account, Please ignore this<br> message and make sure that your email account is secure. </span></div>';

                                        $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);
                                        $subject='Welcome !';
                                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                                    '.$postData['name'].',
                                                    <br>
                                                    Thank you for signing up with '.$from_name.' We hope you enjoy your time with us.
                                                </span>
                                            </div>';
                                        $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);
                                }
                            } else {
                                    $response['status'] = 'error';
                                    $response['msg'] = $this->language_name=='French' ? "Problème technique, veuillez essayer après un certain temps":'Technical problem please try after some time';
                            }
                    }
         }

         echo json_encode($response);
    }

    public function preferred_customer_signup()
    {
            $this->load->model('User_Model');
            $this->load->model('Store_Model');
            $this->load->library('form_validation');
            $set_rules =

            $set_rules = $this->language_name=='French' ? $this->User_Model->prefconfigFranch:$this->User_Model->prefconfig;
            $this->form_validation->set_rules($set_rules);
            $response = [
                    'status' => 'success',
                    'msg'    => '',
                    'errors' => [],
            ];

            if ($this->form_validation->run() == FALSE) {
                    $response['status'] = 'error';
                    $response['errors'] = $this->form_validation->error_array();
             } else {
                  $fname = $this->input->post('fname');
                  $lname = $this->input->post('lname');
                  $email = $this->input->post('email');
                  $password = $this->input->post('password');
                  $email_verification= $this->input->post('email_verification');

                    if ($this->User_Model->checkEmailId($email)) {
                            $response['status'] = 'error';
                            $response['msg'] = $this->language_name=='French' ? 'Identifiant de messagerie déjà enregistré':'Email id already registered';
                    } else {
                            $postData = array();
                            $postData['fname'] = $fname;
                            $postData['lname'] = $lname;
                            $postData['email'] = $email;

                            $postData['password'] = md5($password);
                            $postData['email_verification'] = $email_verification ?? 0;
                            $postData['mobile'] =  $this->input->post('mobile');
                            $postData['company_name'] = $this->input->post('company_name');
                            $postData['responsible_name'] = $this->input->post('responsible_name');
                            $postData['cp'] = $this->input->post('cp');
                            $postData['active_area'] = $this->input->post('active_area');
                            $postData['address'] = $this->input->post('address');
                            $postData['country'] = $this->input->post('country');
                            $postData['region'] = $this->input->post('region');
                            $postData['city'] = $this->input->post('city');
                            $postData['zip_code'] = $this->input->post('zip_code');
                            $postData['request'] = $this->input->post('request');
                            $postData['user_type']=2;
                            $postData['store_id'] = $this->main_store_id;

                            if (empty($postData['lname'])){
                                $postData['name'] = $postData['fname'];
                            } else {
                                $postData['name'] = $postData['fname'].' '.$postData['lname'];
                            }

                            $insert_id = $this->User_Model->saveUser($postData);

                             if ($insert_id) {
                                $response['msg'] =$this->language_name == 'French' ? 'Le client préféré de votre compte a été créé avec succès. Veuillez vérifier votre messagerie et vérifier votre identifiant de messagerie.':'Your account preferred customer has been created successfully. Please check your mail and verify email id.';

                                $toEmail = $email;

                                $StoreData=$this->main_store_data;
                                $store_url    = $StoreData['url'];
                                $store_phone  = $StoreData['phone'];
                                $from_name    = $StoreData['name'];
                                $from_email   = $StoreData['from_email'];
                                $admin_email1 = $StoreData['admin_email1'];
                                $admin_email2 = $StoreData['admin_email2'];
                                $admin_email3 = $StoreData['admin_email3'];
                                $url = $store_url.'Logins/emailVerification/'.base64_encode($insert_id);
                                if($this->language_name == 'French'){
                                    $subject = "vérification de l'E-mail";
                                    $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                                '.$postData['name'].',
                                                <br>
                                                Vous avez créé avec succès votre '.$from_name.' Compte. Veuillez cliquer sur le lien ci-dessous pour vérifier votre adresse e-mail et terminer votre inscription.
                                            </span>
                                        </div>
                                        <div style="margin: 25px 0px;"><a style="font-size: 14px;text-transform: uppercase;color: #000;font-weight: 600;padding: 10px 30px;border-radius: 3px;border: none;background: #00a9d0;cursor: pointer;text-decoration: none;" href="'.$url.'">Visit Website</a>
                                        </div><div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">'."si vous n'avez pas créé de ".$from_name." compte, veuillez ignorer ce message <br> et assurez-vous que votre compte de messagerie est sécurisé. </span></div>";

                                        $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);

                                        $subject='Bienvenue !';
                                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                                    '.$postData['name'].',
                                                    <br>
                                                    Merci de vous être inscrit avec '.$from_name.' Nous espérons que vous apprécierez votre temps avec nous.
                                                </span>
                                            </div>';

                                        $body = $this->emailTemplate($subject,$body,$this->main_store_id);

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

                                $image=$this->Store_Model->getStoreEmailTemapleImage($this->main_store_id,'account_awaiting_approval');
                                $image_template='';
                                if(!empty($image)){
                                    $image_url=$store_url.'uploads/email_templates/'.$image;
                                    $image_template="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'><img style='width:578px;' src='".$image_url."'></div>";
                                }

                                $subject="Votre compte $from_name est en attente d'approbation";

                                $body="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'>$image_template
                                Votre compte $from_name est en attente d'approbation<br>
                                à Mehdi</br>

                                $from_name est une imprimerie coopérative et sociale. Toutes les nouvelles inscriptions
                                doivent subir un processus d'examen standard pour approbation. Vous recevrez un autre email
                                une fois que nous aurons terminé notre examen, et une fois que vous serez approuvé,
                                des instructions supplémentaires pour accéder à votre compte. Si vous avez des questions
                                ou des préoccupations, n'hésitez pas à nous contacter au $store_phone<br><br>

                                Nos heures d'ouverture sont: du lundi au vendredi de 9h à 18h). Nous sommes fermés le
                                samedi et le dimanche.<br><br>
                                Merci de l'intérêt que vous portez à $from_name
                                </span>
                                <div><h1>MERCI!</h1></div>
                                </div>";

                                $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                                sendEmail($toEmail,$subject,$body,$from_email,$from_name);
                                }else{
                                        $subject = 'Email Verification';
                                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                            '.$postData['name'].',
                                            <br>
                                            You have Successfully created your '.$from_name.' account. Please click on the link bellow to verify your email address and complete your registration.
                                        </span>
                                        </div>
                                        <div style="margin: 25px 0px;"><a style="font-size: 14px;text-transform: uppercase;color: #000;font-weight: 600;padding: 10px 30px;border-radius: 3px;border: none;background: #00a9d0;cursor: pointer;text-decoration: none;" href="'.$url.'">Visit Website</a>
                                        </div><div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">if you havent created a  '.$from_name.' account, Please ignore this<br> message and make sure that your email account is secure. </span></div>';

                                        $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                                        sendEmail($toEmail,$subject,$body,$from_email,$from_name);

                                        $subject='Welcome !';
                                        $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                                                    '.$postData['name'].',
                                                    <br>
                                                    Thank you for signing up with '.$from_name.' We hope you enjoy your time with us.
                                                </span>
                                            </div>';

                                        $body = $this->emailTemplate($subject,$body,$this->main_store_id);

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

                                    $image=$this->Store_Model->getStoreEmailTemapleImage($this->main_store_id,'account_awaiting_approval');

                                    $image_template='';
                                    if(!empty($image)){
                                        $image_url=$store_url.'uploads/email_templates/'.$image;
                                        $image_template="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'><img style='width:578px;' src='".$image_url."'></div>";
                                    }

                                    $subject="Your $from_name Account is Awaiting Approval";

                                    $body="<div class='top-info' style='margin-top: 25px;text-align: left;'><span style='font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;'>$image_template
                                    Your $ from_name account is pending approval<br>
                                    <br>

                                    to Mehdi</br>

                                    $from_name is a cooperative and social printing. All new sign ups must undergo a standard review process for approval. You will receive another
email once we have completed our review, and once you're approved, further
instructions for accessing your account. If you have any questions or
concerns, please do not hesitate to contact us at $store_phone<br><br>

                                    Our hours of operation are : Monday - Friday 9AM - 6pmdnight). We are
closed on Saturday and Sunday.<br><br>
                                    Thank you for your interest in $ from_name
                                    </span>
                                    <div><h1>THANK YOU!</h1></div>
                                    </div>";

                                    $body = $this->emailTemplate($subject,$body,$this->main_store_id);
                                    sendEmail($toEmail,$subject,$body,$from_email,$from_name);
                                }
                            } else {
                                    $response['status'] = 'error';
                                    $response['msg'] = $this->language_name=='French' ? 'Problème technique, veuillez essayer après un certain temps':'Technical problem please try after some time';
                            }
                    }
         }

         echo json_encode($response,true);
    }

    function emailVerification($id){
        $id=base64_decode($id);
        $this->load->model('User_Model');
        $userData=$this->User_Model->getUserDataById($id);

            if(!empty($userData)){
                $email_verification= $userData['email_verification'];
                //$email_verification= 0;
                if($email_verification==0){
                    $postData['id']=$id;
                    $postData['email_verification']=1;
                    if($this->User_Model->saveUser($postData))
                    {
                       if($this->language_name == 'French'){
                           $this->session->set_flashdata('message_success', 'Votre compte a été vérifié avec succès');
                       }else{
                           $this->session->set_flashdata('message_success', 'Your Account is verified Successfully');
                       }

                       redirect('Logins');

                        /*$data['email']=$userData['email'];
                        $data['password']=$userData['password'];

                        $LoginUser=$this->User_Model->checkUserLogin($data,false);
                        //pr($LoginUser);

                        if (count($LoginUser) > 0)
                        {
                            $status=$LoginUser['status'];
                            if($status==1){
                                if(empty($this->loginId)){
                                    $this->session->set_userdata(array(
                                        "loginId" => $LoginUser['id'],
                                        "loginName" => $LoginUser['name'],
                                        "loginFirstName" => $LoginUser['fname'],
                                        "loginLastName" => $LoginUser['lname'],
                                        "loginPic" => $LoginUser['profile_pic'],
                                        "loginEmail" => $LoginUser['email'],
                                        "loginMobile" => $LoginUser['mobile']
                                    ));
                                    $sdata=array();
                                    $sdata['id']=$LoginUser['id'];
                                    $sdata['last_login']=date('Y-m-d H:i:s');
                                    $sdata['last_login_ip']=$_SERVER['REMOTE_ADDR'];
                                    $this->User_Model->saveUser($sdata);
                                }
                                redirect('MyAccounts');
                            }else{
                                echo 'Your account is inactive. please contact admin';
                                exit();
                            }
                        }*/
                    }
                    else
                    {
                        echo $this->language_name == 'French' ? "<h2>Le processus de vérification des e-mails a échoué</h1>":"<h2>Email verification process has been failed</h1>";
                    }
                }else{
                     echo $this->language_name == 'French' ? "<h2>votre jeton de vérification de courrier électronique a expiré</h1>":"<h2>Your email verification token has been expired</h1>";
                }
            }else{
                echo $this->language_name == 'French' ? "<h2>Votre jeton de vérification d'e-mail n'est pas valide</h1>":"<h2>Your email verification token is not valid </h1>";
            }
    }

    public function forgotPassword()
    {
            $this->data['page_title']='Forgot Password';
            $this->render('MyAccounts/change_password');
    }

    public function sendOtp(){
        $email=$this->input->post('mobile');
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
                $massage=$otp.' est le code de réinitialisation du mot de passe.code est confidentiel, veuillez ne pas partager ce code avec qui que ce soit pour assurer la sécurité des comptes';
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

        /*if($this->User_Model->checkEmailId($email)){
            $otp=getOtp();
            $massage=$otp.' is reset password code.code is confidential, Please do not share this code with anyone to ensure accounts security';
            $subject='Reset Password';

            $body='<div class="top-info" style="margin-top: 25px;text-align: left;"><span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                            '.$massage.'
                        </span>
                    </div>';

            $body=emailTemplate($subject,$body);
            sendEmail($email,$subject,$body);

            $json['status']=1;
            $json['msg']='Please check your mail reset password code has been sent to your email id: '.$email;
            $json['otp']=$otp;
        }else{
           $json['msg']='Email id does not exist';
        }*/

        echo json_encode($json);
    }

    public function sendOtpSingup(){
        $email=$this->input->post('mobile');
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
                $massage=$otp.' est le code de réinitialisation du mot de passe.code est confidentiel, veuillez ne pas partager ce code avec qui que ce soit pour assurer la sécurité des comptes';
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
}
