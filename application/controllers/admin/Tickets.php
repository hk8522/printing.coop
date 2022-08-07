<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tickets extends Admin_Controller
{
    public $class_name = '';
    public function __construct()
    {
        parent::__construct();
        $this->class_name = 'admin/' . ucfirst(strtolower($this->router->fetch_class())) . '/';
        $this->data['class_name'] = $this->class_name;
    }

    public function index($status = 0)
    {
        if (!empty($status)) {
            $status = base64_decode($status);
        }

        if (!in_array($status, array(0, 1))) {
            redirect('Dashboards');
        }

        $this->data['page_title'] = 'Tickets';
        $this->data['status_ticket'] = $status;
        $this->render($this->class_name . 'index');
    }

    public function getTickets($status = 0)
    {
        if (!empty($status)) {
            $status = base64_decode($status);
        }
        if (!in_array($status, array(0, 1))) {
            redirect('Dashboards');
        }
        $this->load->model('Ticket_Model');
        $lists = $this->Ticket_Model->getListAdmin($status);
        $data['BASE_URL'] = base_url();
        $data['lists'] = $lists;
        $this->load->view($this->class_name . 'get_ticket', $data);
    }

    public function getChat($ticket_id = null)
    {
        $this->load->helper('form');
        $this->load->model('Ticket_Model');
        if (!empty($ticket_id)) {
            $data['BASE_URL'] = base_url() . 'admin/';
            $data['loginName'] = 'Support';

            if ($this->input->post()) {
                $this->load->library('form_validation');
                $set_rules = $this->Ticket_Model->config_send_message;
                $this->form_validation->set_rules($set_rules);
                $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
                $postData['message'] = $this->input->post('message');
                $postData['id'] = $this->input->post('ticket_id');

                if ($this->form_validation->run() === true) {
                    $insert_id = $this->Ticket_Model->save($postData);
                    if ($insert_id > 0) {
                        $saveComment = array();
                        $saveComment['message'] = $this->input->post('message');
                        $saveComment['comment_author'] = 0; //0 is admin
                        $saveComment['ticket_id'] = $insert_id;
                        $insert_cumment_id = $this->Ticket_Model->saveComment($saveComment);

                        $list = $this->Ticket_Model->getChatById($insert_cumment_id);
                        $data['list'] = $list;

                        $this->load->view($this->class_name . 'get_single_chat', $data);
                    }
                }
            } else {
                $ticket_id = base64_decode($ticket_id);
                $this->load->model('Ticket_Model');
                $lists = $this->Ticket_Model->getChat($ticket_id);
                $this->Ticket_Model->UpdateCommentAdmin($ticket_id);

                $data['ticket_id'] = $ticket_id;
                $data['lists'] = $lists;
                $this->load->view($this->class_name . 'get_chat', $data);
            }
        } else {
            redirect('Dashboards');
        }
    }

    public function getLetestChat($ticket_id = null)
    {
        if (!empty($ticket_id)) {
            $data['BASE_URL'] = base_url() . 'admin/';
            $data['loginName'] = 'Support';
            $ticket_id = base64_decode($ticket_id);
            $this->load->model('Ticket_Model');
            $lists = $this->Ticket_Model->getLetestChatAdmin($ticket_id);
            $this->Ticket_Model->UpdateCommentAdmin($ticket_id);
            $data['ticket_id'] = $ticket_id;
            $data['lists'] = $lists;
            $this->load->view($this->class_name . 'get_letest_chat', $data);
        } else {
            redirect('Dashboards');
        }
    }

    public function createTicket()
    {
        $this->load->helper('form');
        $this->load->model('Ticket_Model');
        $this->data['page_title'] = 'Create Ticket';
        $userData = $this->User_Model->getUserDataById($this->loginId);
        $postData = array();
        $postData['name'] = $this->input->post('name');
        $postData['email'] = $this->input->post('email');
        $postData['subject'] = $this->input->post('subject');
        $postData['contact_no'] = $this->input->post('contact_no');
        $postData['message'] = $this->input->post('message');
        $postData['user_id'] = $this->loginId;
        $save_success = false;

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $set_rules = $this->Ticket_Model->config;
            $this->form_validation->set_rules($set_rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if ($this->form_validation->run() === true) {
                $insert_id = $this->Ticket_Model->save($postData);
                if ($insert_id > 0) {
                    $this->session->set_flashdata('message_success', 'Your ticket created successfully.');

                    $saveComment = array();
                    $saveComment['message'] = $this->input->post('message');
                    $saveComment['comment_author'] = $this->loginId;
                    $saveComment['ticket_id'] = $insert_id;

                    $this->Ticket_Model->saveComment($saveComment);

                    $save_success = true;
                } else {
                    $this->session->set_flashdata('message_error', 'Your ticket created unsuccessfully');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }
        $data['postData'] = $postData;
        $data['save_success'] = $save_success;
        $this->load->view($this->class_name . 'create_ticket', $data);
    }
    public function deleteTicket($id = null)
    {
        if (!empty($id)) {
            $id = base64_decode($id);
            $this->load->model('Ticket_Model');
            if ($this->Ticket_Model->deleteTicket($id)) {
                $this->session->set_flashdata('message_success', 'Ticket deleted successfully');
            } else {
                $this->session->set_flashdata('message_error', 'Ticket deleted unsuccessfully');
            }
        }

        redirect('Tickets');
    }
}
