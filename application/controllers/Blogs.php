<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Blogs extends Public_Controller
{
  public $class_name='';
  function __construct()
  {
    parent::__construct();
	$this->class_name=ucfirst(strtolower($this->router->fetch_class())).'/';
  }

  public function index()
  {
    $this->load->model('Blog_Model');
	$this->data['page_title']=$this->language_name=='French' ? 'Blogs':'Blogs';
	$this->data['blogs']=$this->Blog_Model->getBlogsFrontEndList(0,0,0,'blogs.created','desc',0,0,$this->main_store_id);
    $this->render($this->class_name.'index');
	#pr($this->data['blogs'],1);
  }
  public function category($category_id)
  {
    if($category_id){

     $category_id=base64_decode($category_id);

	}
    $this->load->model('Blog_Model');
	$this->data['page_title']=$this->language_name=='French' ? 'Blog de la catégorie':'Category Blog';
	$this->data['blogs']=$this->Blog_Model->getBlogsFrontEndList($category_id,0,0,'blogs.created','desc',0,0,$this->main_store_id);
	$this->sideBarData();
    $this->render($this->class_name.'category');
  }

  public function search()
  {

	$search=$_GET['search'];
    $this->load->model('Blog_Model');
	$this->data['page_title']=$this->language_name=='French' ? 'Rechercher dans le blog':'Search Blog';
	$this->data['blogs']=$this->Blog_Model->getBlogsFrontEndList(null,null,$search,$order_by='blogs.title',$type='asc',0,0,$this->main_store_id);
	$this->sideBarData();
    $this->render($this->class_name.'category');

  }
  public function singleview($id=null)
  { $this->load->model('Blog_Model');
    if($id){

        $id=base64_decode($id);
	}

    $this->data['blog']= $blog=$this->Blog_Model->getBlogsFrontEndById($id);
	if(empty($blog)){
		redirect('/');

	}
	$category_id=$this->data['blog']['category_id'];
	$this->data['releted_blog']= $this->Blog_Model->getBlogsFrontEndList($category_id,null,null,'blogs.created','desc',$start=0,$limit=5,$this->main_store_id);

    $this->data['page_title']=$this->language_name=='French' ? $this->data['blog']['title_french']:$this->data['blog']['title'];
	$this->sideBarData(2);
    $this->render($this->class_name.'single_view');

  }

  public function sideBarData($fl=1)
  {
    $data=array();
    $this->load->model('Blog_Model');
	$this->data['latestblogs']=$this->Blog_Model->getBlogsFrontEndList(null,null,null,'blogs.created','desc',$start=0,$limit=10,$this->main_store_id);

	$this->data['popularblogs']=$this->Blog_Model->getBlogsFrontEndList(null,1,null,'blogs.created','desc',$start=0,$limit=10,$this->main_store_id);
	$this->data['category']= $this->Blog_Model->getBlogsCategoryList(1,$this->main_store_id);
	if($fl==2){

		$this->data['page_title']=$this->language_name=='French' ? $this->data['blog']['title_french']:$this->data['blog']['title'];
	}
  }

  public function month10_2018()
  {
    $this->data['page_title']='Monthy Archive';
    $this->render($this->class_name.'month10-2018');
  }
}
