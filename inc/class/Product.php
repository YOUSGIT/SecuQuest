<?php

class Product extends Superobj
{

    //var $Crumbs_local;
    var $crumbs = array();
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    // protected $limit = 2; //上傳檔案大小
    protected $sort_where;
    protected $tbname = PRODUCT;
    protected $tbname_img = PRODUCT_IMG;
    var $sdir = PD_Image;
    var $back = './product.php?p=';
    public $s_size = array("m" => array("w" => 600, "h" => 600), "s" => array("w" => 2400, "h" => 150), "ss" => array("w" => 2400, "h" => 50));
    var $is_image = false;
    var $list_this;
    var $detail_this;
    var $this_Page = this_Page;
    var $detail_id; //編輯細節ID
    var $is_sort = false;
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
                    <li><span>產品列表</span></li>
                </ul>';

        return $crumb;
    }

    function get_toolbar_html()
    {
        $toolbar = '<ul class="group">
                        <li><a href="product_detail.php" class="file-add">新增商品</a></li>
                    </ul>
                    <ul class="group">
                        <li><a href="#" onclick="return del();" class="file-delete">批次刪除</a></li>
                        <li><a href="#" onclick="return sale(1);" class="on">批次上架</a></li>
                        <li><a href="#" onclick="return sale(0);" class="off">批次下架</a></li>
                    </ul>';

        return $toolbar;
    }

    function get_catalog()
    {
        $p = $_POST['p'];
        $obj = new Catalog;
        $ret = $obj->get_all_for_product($p);
        $output = '<option value="' . $p . '">請選子分類（可不選）</option>';
        foreach ($ret as $v)
            $output.='<option value="' . $v['id'] . '">' . $v['title'] . '</option>';

        echo $output;
        exit;
    }

    function get_detail_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="product_bcatalog.php">產品管理</a></li>                    
                    <li><span>產品列表</span></li>
                </ul>';

        return $crumb;
    }

    function get_all()
    {
        if (is_numeric($_GET['s']) && $_GET['s'] != '')
            $wheres = " AND `status` = " . $_GET['s'];

        if ($_GET['p'] != 0)
            $parent = " AND `parent` = " . (int) $_GET['p'];

        $this->list_this = "SELECT * FROM " . $this->tbname . " WHERE  1 " . $parent . " " . $wheres . " ORDER BY `sequ` ASC";
        // exit($this->list_this);
        return parent::get_list($this->list_this);
    }

    function get_detail($pk = '')
    { //列出單筆細節
        $pk = (is_numeric($pk)) ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT * FROM " . $this->tbname . " where " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
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

    function get_pre_img($path = "")
    {
        if (is_file($this->get_dir() . $path))
            return $this->get_dir() . "s_" . $path;
        else
            return "images/logo.png";
    }

    function get_img_detail($p = "")
    {
        $p = (is_numeric($_GET['p'])) ? $_GET['p'] : $p;

        $sql = "SELECT * FROM " . $this->tbname_img . " WHERE `parent` = " . (int) $p . " ORDER BY `master` DESC, `id` ASC";
        return parent::get_list($sql);
    }

    function get_img_master($p)
    {
        if (!is_numeric($p))
            return false;

        $sql = "SELECT `id` FROM " . $this->tbname_img . " WHERE `parent` = " . (int) $p . " AND `master` = 1";
        return parent::get_list($sql, 1);
    }

    ############################################################################
    function renew()
    {
        /* for images */
        if ($this->tbname == add_field_quotes($this->tbname_img))
        {
            /* 手動設定封面 */
            if (is_numeric($_POST['master']))
            {
                $ret = self::get_img_master($_POST['parent']);
                $arr = array('id' => $ret['id'], 'master' => 0);
                parent::renew($arr);
                $arr = array('id' => $_POST['master'], 'master' => 1);
                parent::renew($arr);
                return;
            }

            self::set_back("product_detail_photo.php?p=" . $_POST['parent']);
            foreach ($_POST['path'] as $v)
            {
                $arr = array('path' => $v, 'parent' => $_POST['parent']);
                parent::renew($arr);
            }

            self::set_master();
            
            return;
        }

        self::set_back("product.php?p=" . $_POST['parent']);
        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->s_size);
    }

    function killu()
    {
        /* for images */
        if ($this->tbname == add_field_quotes($this->tbname_img))
        {
            parent::killu();
            
            self::set_master();
            ob_clean();

            echo 'ok';
            exit;
        }

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
            self::set_back("product.php?p=" . $_POST['parent'] . "&s=" . $_POST['status']);
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

    function set_master(){
        /* 自動設定封面 */
        if (!$ret = self::get_img_master($_POST['parent']))
        {
            if ($ret = self::get_img_detail($_POST['parent']))
            {
                $arr = array('id' => $ret[0]['id'], 'master' => 1);
                parent::renew($arr);
            }
        }
        return;
    }
}