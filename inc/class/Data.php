<?php

class Data extends Superobj{
	
	//var $Crumbs_local;
	var $crumbs = array();
	protected 	$post_arr = array();
	protected 	$file_arr = array();
	protected 	$del_arr;
	protected 	$limit = 200; //上傳檔案大小
	protected	$sort_where = null;
	protected	$tbname = DATA;
	var $sdir=DATA_file;
	var	$back='./data.php';
	//var	$s_size=array("m"=>array("w"=>400,"h"=>400),"s"=>array("w"=>150,"h"=>2000));
	var	$is_image=false;
	var $list_this;
	var $detail_this;
	var $this_Page= this_Page;
	var $detail_id ; //編輯細節ID

	####################################################################################
	
	function __construct($debug=false){
				
		$this->post_arr	= (is_array($_POST))	?	$_POST	:	"";
		$this->file_arr	= (is_array($_FILES))	?	$_FILES	:	"";
		$this->del_arr	= (isset($_REQUEST['delid']))	?	$_REQUEST['delid']	:	"";
		$this->detail_id=	(is_numeric($_GET['id']))	?	$_GET['id']	:	"";
		
		parent::__construct($debug);

		if(trim($this->tbname)!='')
			$this->set_field($this->tbname);
		
	}
	
	function get_all(){
		
		$this->list_this="select id,title from ".$this->tbname." order by ctime desc";
		return parent::get_list($this->list_this);
	
	}
	
	function get_type(){

		$this->list_this="select distinct(`type`) from ".$this->tbname." where TRIM(`type`)!=''  order by `type` asc";
		#echo $this->list_this;
		return parent::get_list($this->list_this);
		
	}
	
	function get_detail($pk){
	
		$pk	=	(trim($pk)!='')	?	$pk:	$this->detail_id;
		
		if(trim($pk)!='')
			$this->detail_this="select * from ".$this->tbname." where ".$this->PK."=".$pk;
		
		return parent::get_list($this->detail_this,1);
	
	}
	#############################################################################
	
	function get_front(){
		
		$this->list_this="select * from ".$this->tbname." where sale='1' order by dates desc limit 5";
		return parent::get_list($this->list_this);
	
	}
	
	function get_all_front(){
		
		$this->list_this="select * from ".$this->tbname." where sale='1' order by dates desc";
		return parent::get_list($this->list_this);
	
	}
	
	function get_detail_front($pk){
	
		$pk	=	(trim($pk)!='')	?	$pk:	$this->detail_id;
		
		if(trim($pk)!='')
			$this->detail_this="select * from ".$this->tbname." where  sale='1' and ".$this->PK."=".$pk;
		
		return parent::get_list($this->detail_this,1);
	
	}
		
	############################################################################
	
	function renew(){
	
		parent::renew($this->post_arr,	$this->file_arr	,$this->sdir,$this->s_size,'',$this->limit);
	
	}
	
	function killu(){
	
		return parent::killu($this->del_arr, $this->is_image,	$this->sdir);
		
	}
	
	function crumbs(){
		
		global $_LANG;
		
		$this->crumbs = array(	"news_detail.php"=>array($_LANG['crumb']['新聞管理'		][LANG]=>"news_list.php",$_LANG['crumb']['編輯新聞'		][LANG]=>""),
								"news_list.php"=>array($_LANG['crumb']['新聞管理'		][LANG]=>"news_list.php",$_LANG['crumb']['新聞列表'		][LANG]=>"")
					);
	
		return parent::crumbs($this->this_Page);
	}
	
	function sale(){
	
		$this->back	.=	$this->myParent;	
		
		foreach($this->del_arr as $k	=>	$v){
			$sql="update ".$this->tbname." set sale='".$this->post_arr['sale']."' where ".$this->PK."=".$k;
			//echo $sql;
			if(!$this->qry($sql)){
				$this->alert="更新失敗";
				break;
			}
			
		}
		
	}
}

