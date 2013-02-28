<?php

class Contact extends Superobj
{

    //var $Crumbs_local;
    var $crumbs = array();
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    protected $limit = 2; //上傳檔案大小
    protected $sort_where = " 1";
    protected $tbname = CONTACT;
    protected $tbname_info = CONTACT_INFO;
    var $sdir;
    var $back = './contact.php';
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

    function get_info_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="contact.php">聯絡我們</a></li>                    
                    <li><span>聯絡資訊</span></li>
                </ul>';

        return $crumb;
    }

    function get_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="product_bcatalog.php">聯絡我們</a></li>                    
                    <li><span>客服列表</span></li>
                    </ul>';

        return $crumb;
    }

    function get_detail_crumb_html()
    {
        $crumb = '<ul class="crumb">
                    <li><a href="index.php" class="home">&nbsp;</a></li>
                    <li><a href="contact.php">聯絡我們</a></li>                    
                    <li><span>客服列表</span></li>
                </ul>';

        return $crumb;
    }

    function get_info_toolbar_html()
    {
        $toolbar = '<ul class="group">
                        <li><a href="about_detail.php" class="file-add">新增內容</a></li>
                    </ul>
                    <ul class="group">
                        <li><a onclick="return del();" href="#" class="file-delete">批次刪除</a></li>
                    </ul>';

        return $toolbar;
    }

    function get_toolbar_html()
    {
        $toolbar = '<ul class="group">
                        <li><a href="#" onclick="return del();" class="file-delete">批次刪除</a></li>
                    </ul>';

        return $toolbar;
    }

    function get_all()
    {
        $this->list_this = "SELECT * FROM " . $this->tbname . " ORDER BY `dates` DESC";
        return parent::get_list($this->list_this);
    }

    function get_info_detail()
    {
        $this->detail_this = "SELECT * FROM " . $this->tbname_info . " WHERE " . $this->PK . "= 1";

        return parent::get_list($this->detail_this, 1);
    }

    function get_detail($pk = '')
    {
        $pk = (is_numeric($pk)) ? $pk : $this->detail_id;
        $this->detail_this = "SELECT * FROM " . $this->tbname . " WHERE " . $this->PK . "= " . $pk;

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
    
    function get_info_detail_front()
    {
        $this->detail_this = "SELECT * FROM " . $this->tbname_info . " WHERE " . $this->PK . "= 1";
        
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
            $sql = "UPDATE " . $this->tbname . " set sale='" . $this->post_arr['sale'] . "' WHERE " . $this->PK . "=" . $k;
            //echo $sql;
            if (!$this->qry($sql))
            {
                $this->alert = "更新失敗";
                break;
            }
        }
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

    function renew_info()
    {
        $this->set_field($this->tbname_info);
        self::set_back("contact_info.php");
        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->s_size);
    }

}