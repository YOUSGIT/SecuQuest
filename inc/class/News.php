<?php

class News extends Superobj
{

    //var $Crumbs_local;
    var $crumbs = array();
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    protected $limit = 2; //上傳檔案大小
    protected $sort_where = null;
    protected $tbname = NEWS;
    var $sdir = NEWS_Image;
    var $back = './news.php';
    var $s_size = array("m" => array("w" => 600, "h" => 600), "s" => array("w" => 150, "h" => 2000), "ss" => array("w" => 98, "h" => 98));
    var $is_image = true;
    var $list_this;
    var $detail_this;
    var $this_Page = this_Page;
    var $detail_id; //編輯細節ID

    ####################################################################################
    function __construct($debug = Debug)
    {

        $this->post_arr = (is_array($_POST)) ? $_POST : "";
        $this->file_arr = (is_array($_FILES)) ? $_FILES : "";
        $this->del_arr = (isset($_REQUEST['delid'])) ? $_REQUEST['delid'] : "";
        $this->detail_id = (is_numeric($_GET['id'])) ? $_GET['id'] : "";

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
                    <li><a href="news.php">新聞管理</a></li>                    
                    <li><span>新聞管理</span></li>
                  </ul>';

        return $crumb;
    }

    function get_toolbar_html()
    {
        $toolbar = '<ul class="group">
                        <li><a href="news_detail.php" class="file-add">新增新聞</a></li>
                        <li><a href="#" onclick="return del();" class="file-delete">批次刪除</a></li>
                    </ul>';

        return $toolbar;
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

    function get_all()
    {
        $this->list_this = "SELECT `id`, `title`, `path` FROM " . $this->tbname . " ORDER BY `dates` DESC";
        return parent::get_list($this->list_this);
    }

    function get_detail($pk = '')
    {
        $pk = (is_numeric($pk)) ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "select * from " . $this->tbname . " where " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    #############################################################################
    function get_front($l = '')
    {
        if (is_numeric($l) && $l > 0)
            $limit = " LIMIT 0, " . $l;

        $this->list_this = "SELECT * FROM " . $this->tbname . " ORDER BY `dates` DESC";
        return parent::get_list($this->list_this . $limit);
    }

    function get_all_front($l = '')
    {
        if (is_numeric($l) && $l > 0)
            $limit = " LIMIT 0, " . $l;

        $this->list_this = "SELECT `title`, `id`, `dates`, `path` FROM " . $this->tbname . " ORDER BY `dates` DESC";
        return parent::get_list($this->list_this . $limit);
    }

    function get_detail_front($pk = '')
    {
        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "SELECT * FROM " . $this->tbname . " WHERE  1 AND " . $this->PK . " = " . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    ############################################################################
    function renew()
    {

        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->s_size);
    }

    function killu()
    {

        return parent::killu($this->del_arr, $this->is_image, $this->sdir);
    }

    function is_sort()
    {
        return $this->is_sort;
    }

    function get_s_size()
    {
        return $this->s_size;
    }

}