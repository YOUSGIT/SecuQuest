<?php

class Banner extends Superobj
{

    protected $post_arr = array(); //新增修改資料
    protected $file_arr = array(); //上傳陣列
    protected $sort_arr = array();
    protected $del_arr; //刪除者
    protected $limit = 2; //上傳檔案大小
    protected $sort_where; //排序
    protected $tbname = ADV;
    protected $tbname_about = ABOUT;
    public $crumbs = array();
    public $is_sort = false; //是否排序
    public $sdir = ADM_Image;
    public $back = './website_banner.php';
    public $s_size = array("m" => array("w" => 1000, "h" => 1000), "s" => array("w" => 150, "h" => 2400), "ss" => array("w" => 2400, "h" => 50));
    public $detail_id; //編輯細節ID
    public $is_image = true;
    public $list_this;
    public $detail_this;
    public $this_Page = this_Page;
    public $type_arr = array(0 => "圖片", 1 => "影片");

    function __construct($debug = Debug)
    {

        $this->post_arr = (is_array($_POST)) ? $_POST : "";
        $this->file_arr = (is_array($_FILES)) ? $_FILES : "";
        $this->sort_arr = (isset($_POST['sort'])) ? $_POST['sort'] : "";
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

    function get_all()
    { //列出全部資料
        $this->list_this = "select * from " . $this->tbname . " order by sequ asc, dates desc";
        return parent::get_list($this->list_this);
    }

    function get_type($idx)
    {
        return $this->type_arr[$idx];
    }

    function get_pre_img($type, $path = "")
    {
        if ($type == 0)
        {
            if (is_file($this->get_dir() . $path))
                return $this->get_dir() . "s_" . $path;
            else
                return "images/logo.png";
        }else
            return "images/youtube.jpg";
    }

    function get_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="website_banner.php">網站管理</a></li>                    
                    <li><span>首頁廣告設定</span></li>
                    </ul>';

        return $crumb;
    }

    function get_toolbar_html()
    {
        $toolbar = '<ul class="group">
                    <li><a href="website_banner_detail.php" class="file-add">新增廣告</a></li>
                    <li><a href="#" onclick="return del();" class="file-delete">批次刪除</a></li>
                    </ul>   ';

        return $toolbar;
    }

    function get_detail($pk = '')
    { //列出單筆細節
        $pk = (is_numeric($pk)) ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "select * from " . $this->tbname . " where " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    function get_detail_about()
    { //列出單筆細節
        $this->set_field($this->tbname_about);
        $this->detail_this = "select * from " . $this->tbname . " where " . $this->PK . "=1";

        return parent::get_list($this->detail_this, 1);
    }

    /* 20120704 update by xmimicx */
    function get_detail_purchase()
    { //列出單筆細節
        $this->set_field($this->tbname_about);
        $this->detail_this = "select * from " . $this->tbname . " where " . $this->PK . "=2";

        return parent::get_list($this->detail_this, 1);
    }

    ##############################################################
    function get_all_front()
    { //列出全部資料
        $this->list_this = "select * from " . $this->tbname . " where sale='1' order by sequ asc, dates desc";
        return parent::get_list($this->list_this);
    }

    function get_detail_front($pk)
    { //列出單筆細節
        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "select * from " . $this->tbname . " where sale='1'  and " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    #################################################################
    function renew()
    {
        if ($_POST['about'] == 'about')
        { //公司簡介更新
            $this->set_field($this->tbname_about);
            $this->back = "website_about_detail.php";
            $this->is_sort = false;
        }
        if ($_POST['purchase'] == 'purchase')
        { //如何購買更新
            $this->set_field($this->tbname_about);
            $this->back = "website_purchase_detail.php";
            $this->is_sort = false;
        }

        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->s_size);
    }

    function killu()
    {
        return parent::killu($this->del_arr, $this->is_image, $this->sdir);
    }

    function crumbs()
    {
        global $_LANG;

        $this->crumbs = array("website_banner_list.php" => array($_LANG['crumb']['網站管理'][LANG] => "website_banner_list.php", $_LANG['crumb']['首頁廣告設定'][LANG] => ""),
            "website_about_detail.php" => array($_LANG['crumb']['網站管理'][LANG] => "website_banner_list.php", $_LANG['crumb']['公司簡介'][LANG] => ""),
            "website_purchase_detail.php" => array($_LANG['crumb']['網站管理'][LANG] => "website_banner_list.php", $_LANG['crumb']['如何購買'][LANG] => ""),
            "website_banner_detail.php" => array($_LANG['crumb']['網站管理'][LANG] => "website_banner_list.php", $_LANG['crumb']['首頁廣告設定'][LANG] => "website_banner_list.php", $_LANG['crumb']['編輯廣告'][LANG] => "")
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

    function is_sort()
    {
        return $this->is_sort;
    }

}