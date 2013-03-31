<?php

class Catalog extends Superobj
{

    //var $Crumbs_local;
    var $crumbs = array();
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    protected $limit = 2; //上傳檔案大小
    protected $sort_where = " AND `parent` = 0";
    protected $tbname = CATALOG;
    var $sdir = BC_Image;
    var $back = './product_bcatalog.php';
    public $s_size = array("m" => array("w" => 400, "h" => 400), "s" => array("w" => 2400, "h" => 150), "ss" => array("w" => 2400, "h" => 50));
    var $is_image = true;
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

    function get_pre_img($path)
    {
        if (true)
        {
            if (is_file($this->get_dir() . $path))
                return $this->get_dir() . "s_" . $path;
            else
                return "images/logo.png";
        }
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

    function get_cat_detail_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="product_bcatalog.php">產品管理</a></li>                    
                    <li><span>編輯子分類</span></li>
                </ul>';

        return $crumb;
    }

    function get_cat_crumb_html()
    {
        $crumb = '<ul class="crumb">
                        <li><a href="index.php" class="home">&nbsp;</a></li>
                        <li><a href="product_bcatalog.php">產品管理</a></li>                    
                        <li><span>子分類列表</span></li>
                    </ul>';

        return $crumb;
    }

    function get_cat_toolbar_html()
    {
        $toolbar = '<ul class="group">
                        <li><a href="product_catalog_detail.php" class="folder-add">新增子分類</a></li>
                    </ul>
                    <ul class="group">
                        <li><a href="#" onclick="return del();" class="folder-delete">批次刪除</a></li>
                        <li><a href="#" onclick="return sale(1);" class="on">批次上架</a></li>
                        <li><a href="#" onclick="return sale(0);" class="off">批次下架</a></li>
                    </ul>';

        return $toolbar;
    }

    #################################################################################################
    function get_all()
    {
        if (is_numeric($_GET['s']) && $_GET['s'] != '')
            $wheres = " AND `status` = " . $_GET['s'];

        $this->list_this = "SELECT * FROM " . $this->tbname . " WHERE `parent` = 0 " . $wheres . " ORDER BY `sequ` ASC";
        return parent::get_list($this->list_this);
    }

    function get_parent_title_arr_for_product()
    {
        $this->list_this = "SELECT * FROM " . $this->tbname;
        $ret = parent::get_list($this->list_this);
        $arr = array();
        foreach ($ret as $v)
            $arr[$v['id']] = $v['title'];

        return $arr;
    }

    function get_all_for_product($p)
    {
        if (!is_numeric($p))
            return false;

        $this->list_this = "SELECT a.* FROM " . $this->tbname . " a WHERE 1 AND a.`parent` = " . $p . " " . $wheres . " ORDER BY a.`sequ` ASC";
        // exit($this->list_this);
        return parent::get_list($this->list_this);
    }

    function get_parent_for_product($p)
    {
        if (!is_numeric($p))
            return false;

        $this->list_this = "SELECT `parent` FROM " . $this->tbname . " WHERE `id` = " . $p;
        $ret = parent::get_list($this->list_this, 1);
        return $ret['parent'];
    }

    function get_cat_all()
    {
        if (is_numeric($_GET['cs']) && $_GET['cs'] != '')
            $wheres = " AND a.`status` = " . $_GET['cs'];


        if ((int) $_GET['bc'] > 0)
        {
            $parent = "a.`parent` = " . (int) $_GET['bc'];
        }else
            $parent = "a.`parent` != 0 ";

        $this->list_this = "SELECT a.*, b.`title` `bc` FROM " . $this->tbname . " a, " . $this->tbname . " b WHERE (a.`parent` = b.`id`) AND " . $parent . $wheres . " ORDER BY a.`sequ` ASC";
        // exit($this->list_this);
        return parent::get_list($this->list_this);
    }

    function get_cat_detail($pk = '')
    { //列出單筆細節
        $pk = (is_numeric($pk)) ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT * FROM " . $this->tbname . " where " . $this->PK . "=" . $pk;

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
        $this->list_this = "SELECT * FROM " . $this->tbname . " WHERE `parent` = 0 AND `status` = 1 " . $wheres . " ORDER BY `sequ` ASC";
        return parent::get_list($this->list_this);
    }

    function get_cat_all_front($c)
    {
        if (!is_numeric($c))
            return array();

        if (true)
            $wheres = " AND a.`status` = 1 ";


        if ((int) $c > 0)
        {
            $parent = "a.`parent` = " . (int) $c;
        }else
            $parent = "a.`parent` != 0 ";

        $this->list_this = "SELECT a.*, b.`title` `bc` FROM " . $this->tbname . " a, " . $this->tbname . " b WHERE (a.`parent` = b.`id`) AND " . $parent . $wheres . " ORDER BY a.`sequ` ASC";
        // exit($this->list_this);
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

    function get_first_catalog_for_bcatalog_front($p)
    {
        if (!is_numeric($p))
            return false;

        $this->list_this = "SELECT a.`id` FROM " . $this->tbname . " a WHERE a.`status` = 1 AND a.`parent` = " . $p . " " . $wheres . " ORDER BY a.`sequ` ASC";
        // exit($this->list_this);
        $ret = parent::get_list($this->list_this);
        return $ret[0]['id'];
    }

    ############################################################################
    function renew()
    {
        /* 子分類 */
        if ($this->post_arr['parent'] > 0)
        {
            self::set_back("product_catalog.php?bc=" . $_POST['parent']);
            self::set_sort_where($this->post_arr['parent']);
        }
        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->s_size);
    }

    function killu()
    {
        if ($this->post_arr['parent'])
        {
            self::set_back("product_catalog.php?bc=" . $_POST['parent']);
        }
        return parent::killu($this->del_arr, $this->is_image, $this->sdir);
    }

    function sale()
    {
        if ($this->post_arr['parent'])
        {
            self::set_back("product_catalog.php?bc=" . $_POST['parent']);
        }

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
        if ($this->post_arr['parent'] > 0)
        {
            self::set_back("product_catalog.php?bc=" . $_POST['parent']);
        }
        return $this->sort_arr;
    }

    function set_sort_where($parent)
    {
        $this->sort_where = " AND `parent` = " . (int) $parent;
    }

    function get_s_size()
    {
        return $this->s_size;
    }

}