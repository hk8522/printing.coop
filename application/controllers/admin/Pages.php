<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends Admin_Controller
{
	public $class_name='';
	function __construct()
	{
		parent::__construct();
		$this->class_name='admin/'.ucfirst(strtolower($this->router->fetch_class())).'/';
		$this->data['class_name']= $this->class_name;
	}

    public function index()
    {
		$this->load->model('Page_Model');
		$this->load->model('Store_Model');
	    $this->data['page_title'] = 'Pages';
	    $this->data['sub_page_title'] = 'Add New Page';
	    $this->data['sub_page_url'] = 'addEdit';
	    $this->data['sub_page_url_active_inactive'] = 'activeInactive';
	    $this->data['sub_page_delete_url'] = 'deletePage';
	    $lists=$this->Page_Model->getPageList();
		$MainStoreList=$this->Store_Model->MainStoreList();
	    $this->data['lists']=$lists;
		$this->data['MainStoreList']=$MainStoreList;
        $this->render($this->class_name.'index');
    }

	public function addEdit($id=null)
    {
        $this->load->helper('form');
		$this->data['page_title'] = $page_title = 'Add New Page';
		if(!empty($id)){
	       $this->data['page_title'] = $page_title = 'Edit Page';
		}
		$this->data['main_page_url'] = '';
		$this->load->model('Page_Model');
		$this->load->model('Page_Category_Model');
		$this->load->model('Store_Model');
		$catgoryList=$this->Page_Category_Model->getCategoryDropDownList();

		$MainStoreList=$this->Store_Model->MainStoreList();
		$this->data['MainStoreList']=$MainStoreList;

		$postData=array();
		$this->data['catgoryList']=$catgoryList;
		$postData=$this->Page_Model->getPageDataById($id);
		#pr($postData,1);
		if($this->input->post()){
			$this->load->library('form_validation');
			$set_rules=$this->Page_Model->config;
			$this->form_validation->set_rules($set_rules);
			$this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
			$postData['title']=$this->input->post('title');
			$postData['title_france']=$this->input->post('title_france');
			$postData['category_id']=$this->input->post('category_id');
			$postData['description']=$this->input->post('description');
			$postData['description_france']=$this->input->post('description_france');
			$postData['shortOrder']=$this->input->post('shortOrder');
			$postData['description']=$this->input->post('description');
			$postData['page_title']=$this->input->post('page_title');
			$postData['page_title_france']=$this->input->post('page_title_france');
			$postData['meta_description_content']=$this->input->post('meta_description_content');
			$postData['meta_description_content_france']=$this->input->post('meta_description_content_france');
			$postData['meta_keywords_content']=$this->input->post('meta_keywords_content');
			$postData['meta_keywords_content_france']=$this->input->post('meta_keywords_content_france');

			$postData['display_on_footer'] = !empty($this->input->post('display_on_footer')) ?
			$this->input->post('display_on_footer'):0;

			$postData['display_on_top_menu'] = !empty($this->input->post('display_on_top_menu')) ?
			$this->input->post('display_on_top_menu'):0;

			$postData['display_on_footer_last_menu'] = !empty($this->input->post('display_on_footer_last_menu')) ?
			$this->input->post('display_on_footer_last_menu'):0;

			$postData['main_store_id']=$this->input->post('main_store_id');

			if($this->form_validation->run()===TRUE)
			{
				if(!empty($id)){
				   $postData['id']=$this->input->post('id');
				}else{
					$postData['slug']=$this->Page_Model->getSlug($postData['title'],$postData['main_store_id']);
				}

				if ($this->Page_Model->savePage($postData))
				{
					$this->session->set_flashdata('message_success',$page_title.' Successfully.');
					redirect('admin/Pages');
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

	public function activeInactive($id=null,$status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
			    $postData['id']=$id;
		        $postData['status']=$status;
				$page_title='Page Active';
				$this->load->model('Page_Model');
				if($status==0){
					$page_title='Page Inactive';
				}
				if ($this->Page_Model->savePage($postData))
				{
					$this->session->set_flashdata('message_success',$page_title.' Successfully.');
					redirect('admin/Pages');
				}

				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{
			$this->session->set_flashdata('message_error','Missing information.');
	    }
    }

	public function deletePage($id=null)
    {
        if(!empty($id)){
				$page_title='Page Delete';
				$this->load->model('Page_Model');
				if ($this->Page_Model->deletePage($id))
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

		redirect('admin/Pages');
    }

    public function pageCategoryList()
    {
		$this->load->model('Page_Category_Model');
	    $this->data['page_title'] = 'Pages Category';
	    $this->data['sub_page_title'] = 'Add New Page Category';
	    $this->data['sub_page_url'] = 'addEditPageCategory';
	    $this->data['sub_page_url_active_inactive'] = 'activeInactivePageCategory';
		$this->data['sub_page_delete_url'] = 'deletePageCategory';
	    $lists=$this->Page_Category_Model->getCategoryList();
	    $this->data['lists']=$lists;
        $this->render($this->class_name.'page_category_list');
    }

	public function addEditPageCategory($id=null)
    {
        $this->load->helper('form');
		$this->data['page_title'] = $page_title = 'Add New Page Category';
		if(!empty($id)){
	       $this->data['page_title'] = $page_title = 'Edit Page Category';
		}
		$this->data['main_page_url'] = 'pageCategoryList';
		$this->load->model('Page_Category_Model');
		$postData=array();
		$postData=$this->Page_Category_Model->getCategoryDataById($id);

		if($this->input->post()){
			$this->load->library('form_validation');
			$set_rules=$this->Page_Category_Model->config;
			$this->form_validation->set_rules($set_rules);
			$this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

			if(!empty($id)){
			   $postData['id']=$this->input->post('id');
			}
			$postData['name']=$this->input->post('name');
			$postData['category_order']=$this->input->post('category_order');

			if($this->form_validation->run()===TRUE)
			{
				if ($this->Page_Category_Model->saveCategory($postData))
				{
					$this->session->set_flashdata('message_success',$page_title.' Successfully.');
					redirect('admin/Pages/pageCategoryList');
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
	    $this->render($this->class_name.'add_edit_page_category');
    }

    public function activeInactivePageCategory($id=null,$status=null)
    {
        if(!empty($id) && ($status==1 || $status==0)){
			    $postData['id']=$id;
		        $postData['status']=$status;
				$page_title='Page Category Active';
				$this->load->model('Page_Category_Model');
				if($status==0){
					$page_title='Page Category Inactive';
				}
				if ($this->Page_Category_Model->saveCategory($postData))
				{
					$this->session->set_flashdata('message_success',$page_title.' Successfully.');
					redirect('admin/Pages/pageCategoryList');
				}

				else
				{
				    $this->session->set_flashdata('message_error',$page_title.' Unsuccessfully.');
				}
		}else{
			$this->session->set_flashdata('message_error','Missing information.');
	    }
    }

	public function deletePageCategory($id=null)
    {
        if(!empty($id)){
				$page_title='Page Category Delete';
				$this->load->model('Product_Model');
				$this->load->model('Page_Category_Model');
				if ($this->Page_Category_Model->deletePageCategory($id))
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
		redirect('admin/Pages/pageCategoryList');
    }
}
