<?php

Class Blog_Comment_Model extends MY_Model {
        public $table = 'blog_comments';

        public $rules = [
                [
                        'field' => 'comment',
                        'label' => 'comment',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Pleae Enter Comment',
                        ],
                ],
        ];

        public function saveComment($data)
        {
            $data['created']=date('Y-m-d H:i:s');
            $data['updated']=date('Y-m-d H:i:s');
            $query = $this->db->insert('blog_comments', $data);

            if ($query) {
                   return $insert_id = $this->db->insert_id();
            }

            return 0;
        }

    public function getCommentsByBlogId($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where(array('blog_id'=>$id));
        return $this->db->get()->result_array();
    }
}
?>
