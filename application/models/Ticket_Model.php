<?php

Class Ticket_Model extends MY_Model {
	public $table='tickets';

	public $config = array(
        array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|max_length[50]',
                'errors' => array(

                        'required' => 'Enter your name',
                ),
        ),
		array(
                'field' => 'subject',
                'label' => 'Subject',
                'rules' => 'required|max_length[200]',
                'errors' => array(
				     'required' => 'Enter Subject',
                ),
        ),

		array(
                'field' => 'contact_no',
                'label' => 'contact number',
                'rules' => 'required|integer|max_length[10]|min_length[10]',
                'errors' => array(
                        'required' => 'Enter contact number',
                ),
        ),
		array(
                'field' => 'email',
                'label' => 'email id',
                'rules' => 'required|valid_email|max_length[100]',
                'errors' => array(
                        'required' => 'Enter email id',
                ),
        ),
		array(
                'field' => 'message',
                'label' => 'message',
                'rules' => 'required|max_length[1000]',
                'errors' => array(
                        'required' => 'Enter Message',
                ),
        )
    );

	public $config_send_message = array(

		array(
                'field' => 'ticket_id',
                'label' => 'ticket_id',
                'rules' => 'required',
                'errors' => array(

                ),
        ),
		array(
                'field' => 'message',
                'label' => 'message',
                'rules' => 'required|max_length[250]',
                'errors' => array(
                        'required' => 'Enter Message',
                ),
        )
    );

	public function getChat($ticket_id) {
        $this->db->select(array('TicketComments.*','User.name as name'));
		$condition=array();
		$condition['TicketComments.ticket_id']=$ticket_id;
		$this->db->where($condition);
		$this->db->from('ticket_comments as TicketComments');
		$this->db->join('users as User', 'User.id=TicketComments.comment_author', 'left');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getLetestChat($ticket_id) {
        $this->db->select(array('TicketComments.*','User.name as name'));
		$condition=array();
		$condition['TicketComments.ticket_id']=$ticket_id;
		$condition['TicketComments.comment_author']=0;
		$condition['TicketComments.receiver_read']=1;
		$this->db->where($condition);
		$this->db->from('ticket_comments as TicketComments');
		$this->db->join('users as User', 'User.id=TicketComments.comment_author', 'left');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getLetestChatAdmin($ticket_id) {
        $this->db->select(array('TicketComments.*','User.name as name'));
		$condition=array();
		$condition['TicketComments.ticket_id']=$ticket_id;
		$condition['TicketComments.receiver_read']=1;
		$this->db->where($condition);
		$this->db->where('comment_author !=0');

		$this->db->from('ticket_comments as TicketComments');
		$this->db->join('users as User', 'User.id=TicketComments.comment_author', 'left');
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getChatById($id) {
		$this->db->select(array('TicketComments.*','User.name as name'));
		$condition=array();
		$condition['TicketComments.id']=$id;
		$this->db->where($condition);
		$this->db->from('ticket_comments as TicketComments');
		$this->db->join('users as User', 'User.id=TicketComments.comment_author', 'left');
        $query = $this->db->get();
		$data=(array)$query->row();
		return $data;
    }

	public function getList($user_id,$status) {
        $this->db->select('*');
		$condition=array();
		$condition['user_id']=$user_id;
		$condition['status']=$status;
		$this->db->where($condition);
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }
	public function getListAdmin($status) {
        $this->db->select('*');
		$condition=array();
		$condition['status']=$status;
		$this->db->where($condition);
		$this->db->from($this->table);
        $query = $this->db->get();
		$data=$query->result_array();
		return $data;
    }

	public function getMessageCount($ticket_id=null){
        $this->db->select('*');
		$condition=array();
        $condition['ticket_id']=$ticket_id;
		$condition['receiver_read']=1;
		$condition['comment_author']=0;
		$this->db->where($condition);
		//pr($condition);

        $this->db->from('ticket_comments');
        $query = $this->db->get();
		return $query->num_rows();
    }

	public function getMessageCountAdmin($ticket_id=null){
        $this->db->select('*');
		$condition=array();
        $condition['ticket_id']=$ticket_id;
		$condition['receiver_read']=1;
		$this->db->where($condition);
		$this->db->where('comment_author !=0');
		//pr($condition);

        $this->db->from('ticket_comments');
        $query = $this->db->get();
		return $query->num_rows();
    }

	public function save($data) {
		$id=isset($data['id']) ? $data['id']:'';

		if(!empty($id)){
			$data['updated']=date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			$query = $this->db->update($this->table, $data);
			if ($query) {
               return $id;
			} else {
				return 0;
			}
		}else{
			$data['created']=date('Y-m-d H:i:s');
			$data['updated']=date('Y-m-d H:i:s');
			$query = $this->db->insert($this->table, $data);
			if ($query) {
               return $insert_id = $this->db->insert_id();
			} else {
				return 0;
			}
		}
    }

	public function UpdateCommentAdmin($ticket_id) {
		if(!empty($ticket_id)){
			$this->db->where('ticket_id', $ticket_id);
			$this->db->where('comment_author !=0');
			$data=array('receiver_read'=>2);
			$query = $this->db->update('ticket_comments', $data);
			if ($query) {
               return $ticket_id;
			} else {
				return 0;
			}
		}
    }
	public function UpdateComment($ticket_id) {
		if(!empty($ticket_id)){
			$this->db->where('ticket_id', $ticket_id);
			$this->db->where('comment_author=0');
			$data=array('receiver_read'=>2);
			$query = $this->db->update('ticket_comments', $data);
			if ($query) {
               return $ticket_id;
			} else {
				return 0;
			}
		}
    }
	public function saveComment($data) {
		$data['created']=date('Y-m-d H:i:s');
		$data['updated']=date('Y-m-d H:i:s');
		$query = $this->db->insert('ticket_comments', $data);
        if ($query) {
           return $insert_id = $this->db->insert_id();
        } else {
            return false;
        }
    }

	public function deleteTicket($id) {
		$this->db->where('id',$id);
        $query = $this->db->delete($this->table);
		if ($query) {
			$this->db->where('ticket_id',$id);
            $query = $this->db->delete('ticket_comments');
            return 1;
		} else {
			return 0;
		}
    }

	public function getCountTicket($status=null) {
        $this->db->select('id');
		$condition=array();
		if(in_array($status,array(0,1))){
			$condition['status']=$status;
			$this->db->where($condition);
		}
		$this->db->from($this->table);
        $query = $this->db->get();
		return $query->num_rows();
    }

	public function getSupportQuery($id=null) {
        $this->db->select('*');
		$condition=array();

		if(!empty($id)){
			$condition['id']=$id;
			$this->db->where($condition);
		}
		$this->db->from('contact_us');
		$this->db->order_by('created','desc');

        $query = $this->db->get();
		$data=$query->result_array();
		if(!empty($id)){
			$data=(array)$query->row();
		}
		return $data;
    }

	public function deleteQuery($id) {
		$this->db->where('id',$id);
        $query = $this->db->delete('contact_us');
		if ($query) {
            return 1;
		} else {
			return 0;
		}
    }
}

?>