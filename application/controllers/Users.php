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
		$this->load->model('User_Model');
		$title=empty($status) ? 'All Users':ucfirst($status).' Users';

		$page_status=!empty($status) ? $status:'';

		$this->data['page_title'] = $title;
		$this->data['page_status'] = $page_status;
		$this->data['sub_page_title'] = 'Add New User';
		$this->data['sub_page_url'] = 'addEdit';
		$this->data['sub_page_view_url'] = 'viewUser';
		$this->data['sub_page_delete_url'] = 'deleteUser';
		$this->data['sub_page_url_active_inactive'] = 'activeInactive';
		$lists=$this->User_Model->getUserList($status);
		$this->data['lists']=$lists;
		$this->render($this->class_name.'index');
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
     public function changePassword()
    {
		 $this->load->helper('form');
		$this->load->model('User_Model');
		$this->data['page_title'] = 'Change Password';
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
				$this->load->model('User_Model');
				if($status==0){
					$page_title='User Inactive';
				}
				if ($this->User_Model->saveUser($postData))
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
}
