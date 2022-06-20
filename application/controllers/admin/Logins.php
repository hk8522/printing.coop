<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logins extends Adminlogin_Controller
{
    public $class_name = '';
    public function __construct()
    {
        parent::__construct();
        $this->class_name = 'admin/' . ucfirst(strtolower($this->router->fetch_class())) . '/';
        $this->load->helper('form');
    }

    public function index()
    {
        $this->data['page_title'] = 'Login';
        $this->load->model('Admin_Model');
        if ($this->input->post()) {
            $currentUserIp = $this->input->ip_address();
            $ip_info = $this->db->where('created >=', 'date_sub(now(),interval ' . BLOCKED_IPS_ACCESS_TIME_IN_MINUTES . ' minute)')->where('ip', $currentUserIp)->get('blocked_ips')->row_array();
            if (count($ip_info) > 0) {
                $start_date = new DateTime($ip_info['created']);
                $since_start = $start_date->diff(new DateTime(date()));
                //$minutes = (time() - strtotime($ip_info['created'])) / 60;
                if ($since_start->i > BLOCKED_IPS_ACCESS_TIME_IN_MINUTES) {
                    $this->session->unset_userdata('hits_count');
                    $this->db->where('ip', $currentUserIp)->delete('blocked_ips');
                } else {
                    $this->session->set_flashdata('message_error', 'Your ip address has been blocked by Security Reasons. Please try again after Sometime.');
                }
            } else {
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<p class="form_vl_error">', '</p>');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                if ($this->form_validation->run() === true) {
                    $data['username'] = $this->input->post('username');
                    $data['password'] = $this->input->post('password');
                    $LoginUser = $this->Admin_Model->checkAdminLogin($data);
                    if (count($LoginUser) > 0 && verify_admin_password(['id' => $LoginUser['id'], 'password' => $this->input->post('password')])) {
                        if (empty($LoginUser['status'])) {
                            $this->session->set_flashdata('message_error', 'Your account has been inactive by the admin for more enquiry please contact the support');
                        } else {
                            $this->session->set_userdata(array(
                                "adminLoginId" => $LoginUser['id'],
                                "name" => $LoginUser['name'],
                                "adminLoginRole" => $LoginUser['role'],
                            ));
                            redirect('/admin/Dashboards');
                        }
                    } else {
                        $count = 1;
                        $d = $this->session->get_userdata();
                        if (isset($d['hits_count']) && !empty($d['hits_count'])) {
                            $count = $d['hits_count'] + 1;
                        }
                        $this->session->set_userdata(['hits_count' => $count]);
                        if ($count >= 3) {
                            $this->db->insert("blocked_ips", ['ip' => $currentUserIp, 'created' => date('Y-M-Y H:i:s'), 'updated' => date('Y-M-Y H:i:s')]);
                            $this->session->set_flashdata('message_error', 'Your ip address has been blocked by Security Reasons. Please try again after Sometime.');
                        } else {
                            $this->session->set_flashdata('message_error', 'Username or password is incorrect');
                        }
                    }
                }
            }
        }
        $this->render($this->class_name . 'index');
    }

    public function forgotPassword()
    {
        $this->data['page_title'] = 'Forgot Password';
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->load->model('Admin_Model');

            $set_rules = $this->Admin_Model->config_chnage_password;
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
            $postData['email'] = $this->input->post('email');

            if ($this->form_validation->run() === true) {
                $adminData = $this->Admin_Model->getDataByEmailId($postData['email']);
                if (!empty($adminData)) {
                    $url = base_url() . 'pcoopadmin/reset-password/' . base64_encode($adminData['id']);

                    $toEmail = $postData['email'];
                    $subject = 'Reset Password';
                    $name = $adminData['name'];
                    $body = '<div class="top-info" style="margin-top: 25px;text-align: left;">
                    <span style="font-size: 17px; letter-spacing: 0.5px; line-height: 28px; word-spacing: 0.5px;">
                        Dear ' . $name . ',
                    <br>
                        You have successfully forgot password  your ' . WEBSITE_NAME . ' admin account. Please click on the link bellow to for reset password.
                    </span>
                </div>
                <div style="margin: 25px 0px;"><a style="font-size: 14px;text-transform: uppercase;color: #000;font-weight: 600;padding: 10px 30px;border-radius: 3px;border: none;background: #00a9d0;cursor: pointer;text-decoration: none;" href="' . $url . '">Visit Website</a>
                </div>';

                    $body = emailTemplate($subject, $body);

                    sendEmail($toEmail, $subject, $body);

                    $this->session->set_flashdata('message_success', 'Please check your mail reset password link send your email id.');
                    $this->data['success'] = true;
                } else {
                    $this->session->set_flashdata('message_error', 'This email address does not exist in any account');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }

        $this->render($this->class_name . 'forgot_password');
    }

    public function ResetPassword($id = null)
    {
        $this->data['page_title'] = 'Reset Password';
        $this->load->model('Admin_Model');
        $id = base64_decode($id);
        $userData = $this->Admin_Model->getAdminDataById($id);
        if (empty($userData)) {
            $this->session->set_flashdata('message_error', 'invalid reset password token');
            redirect('pcoopadmin');
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->load->model('Admin_Model');
            $set_rules = $this->Admin_Model->config_reset_password;
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
            $postData['password'] = md5($this->input->post('password'));
            $postData['id'] = $id;
            if ($this->form_validation->run() === true) {
                if ($this->Admin_Model->saveAdmin($postData)) {
                    admin_security(['id' => $id, 'password' => $this->input->post('password')]);
                    $this->session->set_flashdata('message_success', 'Your Password change has been successfully login new password.');
                    redirect('pcoopadmin');
                } else {
                    $this->session->set_flashdata('message_error', 'Your Password change has been unsuccessfully.');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }

        $this->render($this->class_name . 'reset_password');
    }
}
