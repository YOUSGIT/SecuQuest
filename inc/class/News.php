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

        $this->list_this = "select * from " . $this->tbname . " order by dates desc";
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
    function get_front()
    {

        $this->list_this = "select * from " . $this->tbname . " where sale='1' order by dates desc limit 5";
        return parent::get_list($this->list_this);
    }

    function get_all_front()
    {

        $this->list_this = "select * from " . $this->tbname . " where sale='1' order by dates desc";
        return parent::get_list($this->list_this);
    }

    function get_detail_front($pk)
    {

        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "select * from " . $this->tbname . " where  sale='1' and " . $this->PK . "=" . $pk;

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

    function crumbs()
    {

        global $_LANG;

        $this->crumbs = array("news_detail.php" => array($_LANG['crumb']['新聞管理'][LANG] => "news_list.php", $_LANG['crumb']['編輯新聞'][LANG] => ""),
            "news_list.php" => array($_LANG['crumb']['新聞管理'][LANG] => "news_list.php", $_LANG['crumb']['新聞列表'][LANG] => "")
        );

        return parent::crumbs($this->this_Page);
    }

    function sale()
    {

        $this->back .= $this->myParent;

        foreach ($this->del_arr as $k => $v)
        {
            $sql = "update " . $this->tbname . " set sale='" . $this->post_arr['sale'] . "' where " . $this->PK . "=" . $k;
            //echo $sql;
            if (!$this->qry($sql))
            {
                $this->alert = "更新失敗";
                break;
            }
        }
    }

}
