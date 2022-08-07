<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stores extends Admin_Controller
{
    public $class_name = '';

    public function __construct()
    {
        parent::__construct();
        $this->class_name = 'admin/' . ucfirst(strtolower($this->router->fetch_class())) . '/';
        $this->data['class_name'] = $this->class_name;
    }

    public function index()
    {
        $this->load->model('Blog_Model');
        $this->load->helper('form');
        $this->data['page_title'] = 'Blogs';
        $this->data['sub_page_title'] = 'Add New Blog';
        $this->data['sub_page_view_url'] = 'viewBlog';
        $this->data['sub_page_url'] = 'addEdit';
        $this->data['sub_page_url_active_inactive'] = 'activeInactive';
        $this->data['sub_page_delete_url'] = 'deleteBlog';
        $this->data['blogs'] = $this->Blog_Model->getBlogsList();
        $this->render($this->class_name . 'index');
    }

    public function addEdit($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Blog';

        if (!empty($id)) {
            $this->data['page_title'] = $page_title = 'Edit Blog';
        }

        $this->data['main_page_url'] = 'blogs';
        $this->load->model('Blog_Model');
        $categoryData = $this->Blog_Model->getBlogsCategoryList();
        $this->data['categoryData'] = $categoryData;
        $postData = array();
        if ($id) {
            $postData = $this->Blog_Model->getBlogDataById($id);
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $rules = $this->Blog_Model->rules;
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');
            if (!empty($id)) {
                $postData['id'] = $this->input->post('id');
            }
            $postData['title'] = $this->input->post('title');
            $postData['content'] = $this->input->post('content');
            $postData['populer'] = $this->input->post('populer');
            $postData['category_id'] = $this->input->post('category_id');

            if ($this->form_validation->run() === true) {
                $saveData = true;
                $Filename = $_FILES['files']['name'];
                $uploadData = array();

                if (!empty($Filename)) {
                    $_FILES['file']['name'] = $_FILES['files']['name'];
                    $_FILES['file']['type'] = $_FILES['files']['type'];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'];
                    $_FILES['file']['error'] = $_FILES['files']['error'];
                    $_FILES['file']['size'] = $_FILES['files']['size'];

                    $config['upload_path'] = BLOG_IMAGE_BASE_PATH;
                    $config['allowed_types'] = FILE_ALLOWED_TYPES;
                    $config['max_size'] = FILE_MAX_SIZE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('file')) {
                        $uploadData = $this->upload->data();
                        $this->resizeImage($uploadData['file_name'], 'small', '', '', 'blogs');
                        $this->resizeImage($uploadData['file_name'], 'medium', '', '', 'blogs');
                        $this->resizeImage($uploadData['file_name'], 'large', 2000, 1333, 'blogs');
                    } else {
                        $this->session->set_flashdata('file_message_error', 'maximum product image size allowed on only 1Mb');
                        $saveData = false;
                    }
                } else {
                    if (empty($id)) {
                        $this->session->set_flashdata('file_message_error', 'Select  images of banner');
                        $saveData = false;
                    }
                }

                if ($saveData) {
                    $old_image = !empty($this->input->post('old_image')) ? $this->input->post('old_image') : '';
                    if (!empty($Filename)) {
                        $postData['image'] = $uploadData['file_name'];
                    }

                    $insert_id = $this->Blog_Model->saveBlog($postData);

                    if ($insert_id > 0) {
                        $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                        if (!empty($Filename) && !empty($old_image)) {
                            $imageName = $old_image;

                            if (file_exists(BLOG_IMAGE_SMALL_BASE_PATH . $imageName)) {
                                unlink(BLOG_IMAGE_SMALL_BASE_PATH . $imageName);
                            }

                            if (file_exists(BLOG_IMAGE_MEDIUM_BASE_PATH . $imageName)) {
                                unlink(BLOG_IMAGE_MEDIUM_BASE_PATH . $imageName);
                            }

                            if (file_exists(BLOG_IMAGE_LARGE_BASE_PATH . $imageName)) {
                                unlink(BLOG_IMAGE_LARGE_BASE_PATH . $imageName);
                            }

                            if (file_exists(BLOG_IMAGE_BASE_PATH . $imageName)) {
                                unlink(BLOG_IMAGE_BASE_PATH . $imageName);
                            }

                        }
                        redirect('admin/Blogs');
                    } else {
                        $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
                    }
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }
        $this->data['postData'] = $postData;
        $this->render($this->class_name . 'add_edit');
    }

    public function activeInactive($id = null, $status = null)
    {
        if (!empty($id) && ($status == 1 || $status == 0)) {
            $postData['id'] = $id;
            $postData['status'] = $status;
            $page_title = 'Blog Active';
            $this->load->model('Blog_Model');

            if (!$status) {
                $page_title = 'Blog Inactive';
            }

            if ($this->Blog_Model->saveBlog($postData)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                redirect('admin/Blogs');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
    }

    public function resizeImage($filename, $type = 'small', $widthlarge = 800, $heightlarge = 800, $section = 'product')
    {
        $source_path = BLOG_IMAGE_BASE_PATH . $filename;
        $target_path = BLOG_IMAGE_BASE_PATH . $type . '/' . $filename;

        if ($type == 'medium') {
            $width = 400;
            $height = 390;
        } else if ($type == 'large') {
            $width = $widthlarge;
            $height = $heightlarge;
        } else {
            $width = 200;
            $height = 200;
        }
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => false,
            'create_thumb' => true,
            'thumb_marker' => false,
            'width' => $width,
            'height' => $height,
        );
        //pr($config_manip);
        $this->load->library('image_lib');
        $this->image_lib->initialize($config_manip);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
    }

    public function deleteBlog($id = null, $imageName = null)
    {
        if (!empty($id)) {
            $page_title = 'Blog Delete';
            $this->load->model('Blog_Model');
            $data = $this->Blog_Model->getBlogDataById($id);
            $imageName = $data['image'];
            if ($this->Blog_Model->deleteBlog($id)) {
                if (file_exists(BLOG_IMAGE_SMALL_BASE_PATH . $imageName)) {
                    unlink(BLOG_IMAGE_SMALL_BASE_PATH . $imageName);
                }

                if (file_exists(BLOG_IMAGE_MEDIUM_BASE_PATH . $imageName)) {
                    unlink(BLOG_IMAGE_MEDIUM_BASE_PATH . $imageName);
                }

                if (file_exists(BLOG_IMAGE_LARGE_BASE_PATH . $imageName)) {
                    unlink(BLOG_IMAGE_LARGE_BASE_PATH . $imageName);
                }

                if (file_exists(BLOG_IMAGE_BASE_PATH . $imageName)) {
                    unlink(BLOG_IMAGE_BASE_PATH . $imageName);
                }

                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }

        redirect('admin/Blogs');
    }

    public function viewBlog($id = null)
    {
        if (empty($id)) {
            redirect('admin/Blogs');
        }
        $this->load->model('Blog_Model');
        $this->load->model('Blog_Comment_Model');
        $this->data['page_title'] = 'Blog Details';
        $this->data['main_page_url'] = '';
        $this->load->model('ProductImage_Model');

        $blog = $this->Blog_Model->getBlogDataById($id);
        $blogComments = $this->Blog_Comment_Model->getCommentsByBlogId($id);
        $this->data['blog'] = $blog;
        $this->data['blogComments'] = $blogComments;
        $this->render($this->class_name . 'view');
    }

    public function Category()
    {
        $this->load->model('Blog_Model');
        $this->load->helper('form');
        $this->data['page_title'] = 'Blogs';
        $this->data['sub_page_title'] = 'Add New Category';
        $this->data['sub_page_view_url'] = '';
        $this->data['sub_page_url'] = 'addEditCategory';
        $this->data['sub_page_url_active_inactive'] = 'activeInactiveCategory';
        $this->data['sub_page_delete_url'] = 'deleteCategory';
        $this->data['blogs'] = $this->Blog_Model->getBlogsCategoryList();
        $this->render($this->class_name . 'category');
    }

    public function addEditCategory($id = null)
    {
        $this->load->helper('form');
        $this->data['page_title'] = $page_title = 'Add New Category';

        if (!empty($id)) {
            $this->data['page_title'] = $page_title = 'Edit Category';
        }

        $this->data['main_page_url'] = 'Category';
        $this->load->model('Blog_Model');

        $postData = array();
        if ($id) {
            $postData = $this->Blog_Model->getBlogCategoryDataById($id);
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $rules = $this->Blog_Model->categoryrules;
            $this->form_validation->set_rules($rules);
            $this->form_validation->set_error_delimiters('<div class="form_vl_error">', '</div>');

            if (!empty($id)) {
                $postData['id'] = $this->input->post('id');
            }

            $postData['category_name'] = $this->input->post('category_name');

            if ($this->form_validation->run() === true) {
                $insert_id = $this->Blog_Model->saveBlogCategory($postData);

                if ($insert_id > 0) {
                    $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                    redirect('admin/Blogs/Category');
                } else {
                    $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
                }
            } else {
                $this->session->set_flashdata('message_error', 'Missing information.');
            }
        }
        $this->data['postData'] = $postData;
        $this->render($this->class_name . 'add_edit_category');
    }

    public function deleteCategory($id = null, $imageName = null)
    {
        if (!empty($id)) {
            $page_title = 'Blog Delete';
            $this->load->model('Blog_Model');
            if ($this->Blog_Model->deleteBlogCategory($id)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }

        redirect('admin/Blogs/Category');
    }

    public function activeInactiveCategory($id = null, $status = null)
    {
        if (!empty($id) && ($status == 1 || $status == 0)) {
            $postData['id'] = $id;
            $postData['status'] = $status;
            $page_title = 'Category Active';
            $this->load->model('Blog_Model');

            if (!$status) {
                $page_title = 'Category Inactive';
            }

            if ($this->Blog_Model->saveBlogCategory($postData)) {
                $this->session->set_flashdata('message_success', $page_title . ' Successfully.');
                redirect('admin/Blogs/Category');
            } else {
                $this->session->set_flashdata('message_error', $page_title . ' Unsuccessfully.');
            }
        } else {
            $this->session->set_flashdata('message_error', 'Missing information.');
        }
    }
}