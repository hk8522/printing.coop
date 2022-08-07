<?php

Class Blog_Model extends MY_Model {
        public $table = 'blogs';

        public $rules = [
                [
                        'field' => 'title',
                        'label' => 'title',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Enter Blog Title',
                        ],
                ],
                [
                        'field' => 'content',
                        'label' => 'Content',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Enter Blog Content',
                        ],
                ],
        ];
        public $categoryrules = [
                [
                        'field' => 'category_name',
                        'label' => 'category_name',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Enter Category Name',
                        ],
                ],

        ];

        public function getBlogsList($id=null,$status=null)
        {
                $this->db->select('blogs.*,blog_category.category_name');
                $this->db->from($this->table);
                $this->db->join('blog_category as blog_category', 'blog_category.id=blogs.category_id', 'left');
                if (!empty($status)){
                    $this->db->where(array('blogs.status' => 1));
                }

                if (!empty($id)){
                    $this->db->where(array('blogs.id' => $id));
                }
                $this->db->order_by('blogs.created','desc');
                $query = $this->db->get();

                if (!empty($id)) {
                    $data=(array)$query->row();
                } else {
                        $data=$query->result_array();
                }

                return $data;
        }

        public function getBlogsFrontEndList($category_id=null,$populer=null,$search=null,$order_by='blogs.created',$type='desc',$start=0,$limit=0,$store_id=null)
        {
                $this->db->select('blogs.*,blog_category.category_name,blog_category.category_name_french');
                $this->db->from($this->table);

                $this->db->where(array('blogs.status' => 1));
                if (!empty($category_id)){
                $this->db->join('blog_category as blog_category', 'blog_category.id=blogs.category_id', 'left');
                $this->db->where(array('blogs.category_id' => $category_id));
                }else{
                    $this->db->join('blog_category as blog_category', 'blog_category.id=blogs.category_id', 'left');
                }

                if (!empty($populer)){
                   $this->db->where(array('blogs.populer' => 1));
                }

                if (!empty($search)){
                   $this->db->like('blogs.title',$search);
                }

                if (!empty($store_id)){
                    $this->db->where("find_in_set($store_id, blogs.store_id)");
                    $this->db->where("find_in_set($store_id, blog_category.store_id)");
                }

                $this->db->order_by($order_by,$type);

                if(!empty($limit)){
                    $this->db->limit($limit,$start);
                }

                $query = $this->db->get();
                $data=$query->result_array();
                return $data;
        }

        public function getBlogsFrontEndById($id=null,$store_id=null)
        {
                $this->db->select('blogs.*,blog_category.category_name,blog_category.category_name_french');
                $this->db->from($this->table);
                $this->db->join('blog_category as blog_category', 'blog_category.id=blogs.category_id', 'left');
                $this->db->where(array('blogs.id' => $id));
                $this->db->order_by('blogs.created','desc');
                $query = $this->db->get();
                if (!empty($store_id)){
                    $this->db->where("find_in_set($store_id, blogs.store_id)");
                    $this->db->where("find_in_set($store_id, blog_category.store_id)");
                }
                $data=(array)$query->row();
                return $data;
        }

        public function getActiveBlogs()
        {
                $this->db->select('*');
                $this->db->from($this->table);
                $this->db->where(array('status' => 1));
                $this->db->order_by('created','desc');
                $query = $this->db->get();

                if (!empty($id)) {
                    $data=(array)$query->row();
                } else {
                        $data=$query->result_array();
                }

                return $data;
        }

        public function saveBlog($data)
        {
                $id = isset($data['id']) ? $data['id']:'';

                if (!empty($id)) {
                    $data['updated']=date('Y-m-d H:i:s');
                    $this->db->where('id', $id);
                    $query = $this->db->update('blogs', $data);

                    if ($query) {
                        return $id;
                    }
                        return 0;
                } else {
                    $data['created']=date('Y-m-d H:i:s');
                    $data['updated']=date('Y-m-d H:i:s');
                    $query = $this->db->insert('blogs', $data);
                    if ($query) {
                        return $insert_id = $this->db->insert_id();
                    }
                    return 0;
                }
        }

        public function getBlogDataById($id)
        {
                $this->db->select('*');
                $this->db->from($this->table);
                $this->db->where(array('id' => $id));
                return $this->db->get()->row_array();
        }

        public function getLatestBlogs($limit = null)
        {
                $this->db->select('*');
                $this->db->from($this->table);
                $this->db->where(array('status' => 1));

                $this->db->order_by('created','desc');

                if ($limit) {
                        $this->db->limit($limit);
                }

                $query = $this->db->get();

                if (!empty($id)) {
                    $data=(array)$query->row();
                } else {
                        $data=$query->result_array();
                }

                return $data;
        }

        public function deleteBlog($id)
        {
                $this->db->where('id',$id);
                $query = $this->db->delete('blogs');

                if ($query) {
                     return 1;
                }

                return 0;
        }

      public function getBlogsCategoryList($status=0,$store_id=null)
        {
                $this->db->select('blog_category.*');
                $this->db->from('blog_category');
                if($status==1){
                    $this->db->where(array('blog_category.status' => 1));
                }
                if (!empty($store_id)){
                    $this->db->where("find_in_set($store_id, blog_category.store_id)");
                }

                $this->db->order_by('category_name','asc');
                $query = $this->db->get();
                $data=$query->result_array();
                return $data;
        }
        public function getBlogCategoryDataById($id)
        {
                $this->db->select('*');
                $this->db->from('blog_category');
                $this->db->where(array('id' => $id));
                return $this->db->get()->row_array();
        }
        public function getActiveBlogCategory()
        {
                $this->db->select('*');
                $this->db->from('blog_category');
                $this->db->where(array('status' => 1));
                $this->db->order_by('created','desc');
                $query = $this->db->get();

                if (!empty($id)) {
                    $data=(array)$query->row();
                } else {
                        $data=$query->result_array();
                }

                return $data;
        }

        public function saveBlogCategory($data)
        {
                $id = isset($data['id']) ? $data['id']:'';

                if (!empty($id)) {
                    $data['updated']=date('Y-m-d H:i:s');
                    $this->db->where('id', $id);
                    $query = $this->db->update('blog_category', $data);

                    if ($query) {
                        return $id;
                    }
                        return 0;
                } else {
                    $data['created']=date('Y-m-d H:i:s');
                    $data['updated']=date('Y-m-d H:i:s');
                    $query = $this->db->insert('blog_category', $data);
                    if ($query) {
                        return $insert_id = $this->db->insert_id();
                    }
                    return 0;
                }
        }
        public function deleteBlogCategory($id)
        {
                $this->db->where('id',$id);
                $query = $this->db->delete('blog_category');

                if ($query) {
                     return 1;
                }

                return 0;
        }
}
