<?php

class Support extends Superobj
{

    //var $Crumbs_local;
    var $crumbs = array();
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    protected $limit = 2; //上傳檔案大小
    protected $sort_where;
    protected $tbname = SUPPORT;
    protected $tbname_info = CONTACT_INFO;
    protected $tbname_cat = SUPPORT_CAT;
    protected $tbname_down = SUPPORT_DOWN;
    protected $tbname_bcat = CATALOG;
    protected $tbname_product = PRODUCT;
    var $sdir = FILES_down;
    var $back = './support.php';
    var $s_size = array();
    var $is_image = false;
    var $list_this;
    var $detail_this;
    var $this_Page = this_Page;
    var $detail_id; //編輯細節ID
    var $is_sort = false;
    var $sort_arr = array();

    ####################################################################################
    function __construct($debug = Debug)
    {
        $this->post_arr = (is_array($_POST)) ? $_POST : "";
        $this->file_arr = (is_array($_FILES)) ? $_FILES : "";
        $this->del_arr = (isset($_REQUEST['delid'])) ? $_REQUEST['delid'] : "";
        $this->detail_id = (is_numeric($_GET['id'])) ? $_GET['id'] : "";
        // $this->set_sort_arr();

        parent::__construct($debug);

        if (trim($this->tbname) != '')
            $this->set_field($this->tbname);
    }

    function get_dir()
    {
        return $this->sdir;
    }

    ################################# HTML #######################################
    function get_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="support.php">支援管理</a></li>                    
                    <li><span>支援列表</span></li>
                </ul>';

        return $crumb;
    }

    function get_toolbar_html()
    {
        $toolbar = '<ul class="group">
                        <li><a href="support_detail.php" class="file-add">新增問題</a></li>
                    </ul>
                    <ul class="group">
                        <li><a href="#" onclick="return del();" class="file-delete">批次刪除</a></li>
                    </ul>';

        return $toolbar;
    }

    function get_cat_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="support_catalog.php">支援管理</a></li>                    
                    <li><span>支援分類</span></li>
                </ul>';

        return $crumb;
    }

    function get_down_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="product_bcatalog.php">支援管理</a></li>                    
                    <li><span>檔案下載列表</span></li>
                </ul>';

        return $crumb;
    }

    function get_down_detail_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="product_bcatalog.php">支援管理</a></li>                    
                    <li><span>支援列表</span></li>
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

    function get_down_toolbar_html()
    {
        $toolbar = '<ul class="group">
                    <li><a href="support_download_detail.php" class="file-add">新增檔案</a></li>
                </ul>
                <ul class="group">
                    <li><a href="#" onclick="return del();" class="file-delete">批次刪除</a></li>
                </ul>';

        return $toolbar;
    }

    ########################## GET DATA ############################################################################
    function get_all()
    {
        if (is_numeric($_GET['c']) && $_GET['c'] != '0')
            $wheres = " AND a.`catalog` = " . $_GET['c'];

        $this->list_this = "SELECT a.`id`, a.`title`, a.`catalog`, a.`dates`, a.`sequ` FROM " . $this->tbname . " a WHERE 1 " . $wheres . " ORDER BY a.`sequ` ASC";
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
            $this->detail_this = "SELECT * FROM " . $this->tbname_cat . " WHERE " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    function get_detail($pk = '')
    { //列出單筆細節
        $pk = (is_numeric($pk)) ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT * FROM " . $this->tbname . " WHERE " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    function get_down_all()
    { //列出檔案全部
        if (is_numeric($_GET['c']) && $_GET['c'] > 0)
            $wheres = " AND ( c.`parent` = " . $_GET['c'] . " || c.`id` = " . $_GET['c'] . ")";

        $this->detail_this = "SELECT a.*,
                                       b.`title` `p_title`,
                                       IF(c.`parent` > 0, d.`title`, c.`title`) `c_title`
                                       /* d.`title` `c_title` */
                                FROM " . $this->tbname_down . " a
                                        LEFT JOIN " . $this->tbname_product . " b ON a.`pid` = b.`id`
                                        LEFT JOIN " . $this->tbname_bcat . " c ON c.`id` = b.`parent`
                                        LEFT JOIN " . $this->tbname_bcat . " d ON c.`parent` = d.`id`
                                        WHERE 1" . $wheres;
        // exit($this->detail_this);
        return parent::get_list($this->detail_this);
    }

    function get_down_detail($pk = '')
    { //列出檔案單筆細節
        $pk = (is_numeric($pk)) ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT a.*, IF(c.`parent` > 0, c.`parent`, c.`id`) `parent` 
                                    FROM " . $this->tbname_down . " a
                                    LEFT JOIN " . $this->tbname_product . " b ON a.`pid` = b.`id`
                                    LEFT JOIN " . $this->tbname_bcat . " c ON c.`id` = b.`parent`
                                    WHERE a." . $this->PK . "=" . $pk;
        // exit($this->detail_this);
        return parent::get_list($this->detail_this, 1);
    }

    function get_down_catalog($pid)
    { //找出檔案產品父分類
        $pid = (is_numeric($pid)) ? $pid : '';
        if (trim($pid) != '')
            $this->detail_this = "SELECT IF(c.`parent` > 0, c.`parent`, c.`id`) `parent` 
                                FROM " . $this->tbname_product . " b 
                                LEFT JOIN " . $this->tbname_bcat . " c ON c.`id` = b.`parent`
                                WHERE b.`id` = " . (int) $pid;
        // exit($this->detail_this);
        $ret = parent::get_list($this->detail_this, 1);
        return $ret['parent'];
    }

    function get_catalog($id)
    {
        if (!is_numeric($id))
            return false;

        $this->set_field($this->tbname_cat);
        $ret = self::get_cat_detail($id);
        return $ret['title'];
    }

    ######################### FRONT ####################################################
    function get_cat_all_front()
    {
        $this->list_this = "SELECT * FROM " . $this->tbname_cat . " ORDER BY `sequ` ASC";
        return parent::get_list($this->list_this);
    }

    function get_front()
    {
        $this->list_this = "SELECT * FROM " . $this->tbname . " WHERE sale='1' ORDER BY dates desc limit 5";
        return parent::get_list($this->list_this);
    }

    function get_all_front($c)
    {
        if (is_numeric($c) && $c != '0')
            $wheres = " AND `catalog` = " . $c;

        $this->list_this = "SELECT * FROM " . $this->tbname . " WHERE 1 " . $wheres . " ORDER BY `sequ` ASC";
        return parent::get_list($this->list_this);
    }

    function get_detail_front($pk)
    {
        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT * FROM " . $this->tbname . " WHERE  sale='1' and " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    function get_down_all_front($c)
    { //列出檔案全部
        if (is_numeric($c))
            $wheres = " AND ( c.`parent` = " . $c . " || c.`id` = " . $c . ")";

        $this->detail_this = "SELECT a.*,
                                    b.`title` `p_title`,
                                    IF(c.`parent` > 0, d.`title`, c.`title`) `c_title`
                                    /* d.`title` `c_title` */
                                FROM " . $this->tbname_down . " a
                                LEFT JOIN " . $this->tbname_product . " b ON a.`pid` = b.`id`
                                LEFT JOIN " . $this->tbname_bcat . " c ON c.`id` = b.`parent`
                                LEFT JOIN " . $this->tbname_bcat . " d ON c.`parent` = d.`id`
                                WHERE 1" . $wheres;
        // exit($this->detail_this);
        return parent::get_list($this->detail_this);
    }

    function get_down_product_front($p)
    {
        if (!is_numeric($p))
            return false;

        $this->detail_this = "SELECT a.*
                                FROM " . $this->tbname_down . " a
                                WHERE a.`pid` = " . $p;

        // exit($this->detail_this);
        return parent::get_list($this->detail_this);
    }

    ############################################################################
    function renew()
    {
        /* 新增分類 */
        if ($this->tbname == add_field_quotes($this->tbname_cat))
            self::set_back("support_catalog.php");

        /* 檔案列表 */
        if ($this->tbname == add_field_quotes($this->tbname_down))
        {
            $catalog = self::get_down_catalog($this->post_arr['pid']);
            self::set_back("support_download.php?c=" . (int) $catalog);
        }
        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->s_size);
    }

    function killu()
    {
        if ($this->tbname == add_field_quotes($this->tbname_cat))
            self::set_back("support_catalog.php");

        /* 檔案下載 */
        if ($this->tbname == add_field_quotes($this->tbname_down))
            self::set_back("support_download.php?c=" . (int) $_POST['parent']);

        return parent::killu($this->del_arr, $this->is_image, $this->sdir);
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

    function get_s_size()
    {
        return $this->s_size;
    }

}