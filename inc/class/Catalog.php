<?php

class Catalog extends Superobj
{

    //var $Crumbs_local;
    var $crumbs = array();
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    protected $limit = 2; //上傳檔案大小
    protected $sort_where = " 1";
    protected $tbname = CATALOG;
    var $sdir;
    var $back = './product_bcatalog.php';
    var $s_size = array();
    var $is_image = false;
    var $list_this;
    var $detail_this;
    var $this_Page = this_Page;
    var $detail_id; //編輯細節ID
    var $is_sort = true;
    var $sort_arr = array();
    var $status_arr = array(1 => "上架", 0 => "下架");

    ####################################################################################
    function __construct($debug = Debug)
    {
        $this->post_arr = (is_array($_POST)) ? $_POST : "";
        $this->file_arr = (is_array($_FILES)) ? $_FILES : "";
        $this->del_arr = (isset($_REQUEST['delid'])) ? $_REQUEST['delid'] : "";
        $this->detail_id = (is_numeric($_GET['id'])) ? $_GET['id'] : "";
        $this->set_sort_arr();

        parent::__construct($debug);

        if (trim($this->tbname) != '')
            $this->set_field($this->tbname);
    }

    function get_dir()
    {
        return $this->sdir;
    }

    function get_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="product_bcatalog.php">產品管理</a></li>                    
                    <li><span>大分類列表</span></li>
                </ul>';

        return $crumb;
    }

    function get_toolbar_html()
    {
        $toolbar = '<ul class="group">
                        <li><a href="product_bcatalog_detail.php" class="folder-add">新增大分類</a></li>
                    </ul>
                    <ul class="group">
                        <li><a href="#" onclick="return del();" class="folder-delete">批次刪除</a></li>
                        <li><a href="#" onclick="return sale(1);" class="on">批次上架</a></li>
                        <li><a href="#" onclick="return sale(0);" class="off">批次下架</a></li>
                    </ul>  ';

        return $toolbar;
    }

    function get_detail_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="product_bcatalog.php">產品管理</a></li>                    
                    <li><span>新增大分類</span></li>
                </ul>';

        return $crumb;
    }

    function get_cat_toolbar_html()
    {
        $toolbar = '<ul class="group">
                        <li><a href="support_catalog_detail.php" class="folder-add">新增分類</a></li>
                    </ul>
                    <ul class="group">
                        <li><a href="#" onclick="return del();" class="folder-delete">批次刪除</a></li>
                    </ul> ';

        return $toolbar;
    }

    function get_all()
    {
        if (is_numeric($_GET['s']) && $_GET['s'] != '')
            $wheres = " AND `status` = " . $_GET['s'];

        $this->list_this = "SELECT * FROM " . $this->tbname . " WHERE 1 " . $wheres . " ORDER BY `sequ` ASC";
        return parent::get_list($this->list_this);
    }

    function get_cat_all()
    {
        $this->list_this = "SELECT * FROM " . $this->tbname_cat . " ORDER BY `sequ` ASC";
        return parent::get_list($this->list_this);
    }

    function get_cat_detail($pk = '')
    { //列出單筆細節
        $pk = (is_numeric($pk)) ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT * FROM " . $this->tbname_cat . " where " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    function get_detail($pk = '')
    { //列出單筆細節
        $pk = (is_numeric($pk)) ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT * FROM " . $this->tbname . " where " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    function get_catalog($id)
    {
        if (!is_numeric($id))
            return false;

        $this->set_field($this->tbname_cat);
        $ret = self::get_cat_detail($id);
        return $ret['title'];
    }

    #############################################################################
    function get_front()
    {
        $this->list_this = "SELECT * FROM " . $this->tbname . " WHERE sale='1' ORDER BY dates desc limit 5";
        return parent::get_list($this->list_this);
    }

    function get_all_front()
    {
        $this->list_this = "SELECT * FROM " . $this->tbname . " WHERE sale='1' ORDER BY dates desc";
        return parent::get_list($this->list_this);
    }

    function get_detail_front($pk)
    {
        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT * FROM " . $this->tbname . " WHERE  sale='1' and " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    function get_status($v)
    {
        return $this->status_arr[$v];
    }

    ############################################################################
    function renew()
    {
        if ($this->tbname == add_field_quotes($this->tbname_cat))
            self::set_back("support_catalog.php");
        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->s_size);
    }

    function killu()
    {
        if ($this->tbname == add_field_quotes($this->tbname_cat))
            self::set_back("support_catalog.php");
        return parent::killu($this->del_arr, $this->is_image, $this->sdir);
    }

    function sale()
    {
        foreach ($this->del_arr as $v)
        {
            $arr = array();
            $arr['id'] = $v;
            $arr['status'] = $_POST['status'];
            parent::renew($arr);
        }
        return;
    }

    function set_back($page)
    {
        $this->back = $page;
    }

    function is_sort()
    {
        return $this->is_sort;
    }

    function set_sort_arr()
    {
        $this->sort_arr = $_POST['sort_arr'];
    }

    function get_sort_arr()
    {
        return $this->sort_arr;
    }

}