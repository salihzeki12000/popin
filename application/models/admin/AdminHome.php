<?php

class AdminHome extends CI_Model {
	
	function __construct(){
		parent::__construct();
	}
	
	public function top_recent_comments()
	{
		$limit = '5';
		$table = 'blog,blog_comment';
  		$select_fields = 'blog.name,blog.url,blog_comment.id,blog_comment.blog_id,blog_comment.author,blog_comment.email,blog_comment.website_url,blog_comment.message,blog_comment.status,blog_comment.createdDate';
   		$where = "blog.id=blog_comment.blog_id";
		//$order = array('blog_comment.updatedDate' => 'desc'); // default order
		$query = $this->db->select($select_fields)->from($table)->where($where)->order_by('blog_comment.updatedDate','DESC')->limit($limit)->get();
		return $query->result();
	}
	
}
?>
