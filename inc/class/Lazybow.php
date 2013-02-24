<?php

class Lazybow extends Superobj
{

    //var $Crumbs_local;
    var $crumbs = array();
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    protected $limit = 200; //上傳檔案大小
    protected $sort_where = null;
    protected $tbname = LAZY;
    protected $tbname2 = LAZY;
    protected $tbname_log = CLICKS;
    protected $tbname_log2 = CLICKS2;
    protected $tbname_search = SEARCH;
    var $sdir = LAZY_Image;
    var $back = './data_res.php';
    var $s_size = array("m" => array("w" => 400, "h" => 250), "s" => array("w" => 150, "h" => 2000));
    var $is_image = false;
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

    function get_all()
    {

        $this->list_this = "select id,title,see from " . $this->tbname . " order by ctime desc";
        return parent::get_list($this->list_this);
    }

    function get_type()
    {

        $this->list_this = "select distinct(`type`) from " . $this->tbname . " where TRIM(`type`)!=''  order by `type` asc";
        #echo $this->list_this;
        return parent::get_list($this->list_this);
    }

    function get_clicks($pk)
    {

        #$this->clicks = "select id from " . $this->tbname_log . " where lid=" . $pk . " group by sid";
        #parent::get_list($this->clicks, 1);
        #$clicks = parent::num_row();
        $this->clicks = "select clicks from " . $this->tbname_log2 . " where lid=" . $pk;

        $ret = parent::get_list($this->clicks, 1);
        return $ret['clicks'];
    }

    function get_detail($pk)
    {

        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '')
        {

            $this->detail_this = "select * from " . $this->tbname . " where " . $this->PK . "=" . $pk;

            $clicks = self::get_clicks($pk);
        }
        $ret = parent::get_list($this->detail_this, 1);
        $ret['clicks'] = (int) $clicks;

        return $ret;
    }

    #############################################################################
    function cron_clicks()
    {

        $sql = "SELECT id FROM " . $this->tbname;
        $ret = parent::get_list($sql);

        foreach ($ret as $k => $v)
        {

            $sql = "SELECT `lid`, `id`  FROM " . $this->tbname_log . " WHERE `lid`=" . $ret[$k]['id'] . " AND `check` = 0 GROUP BY `sid` ";
            $ret2 = parent::get_list($sql);
            $clicks = parent::num_row();
            // $this->post_arr = array();
            // $this->post_arr['lid'] = $ret2[0]['lid'];
            // $this->post_arr['clicks'] = $clicks;

            $this->set_field($this->tbname_log2);
            $sql = "UPDATE " . $this->tbname_log2 . " SET `clicks` = (`clicks` + " . $clicks . ") WHERE `lid` = " . $ret2[0]['lid'];
            $this->qry($sql);

            $this->set_field($this->tbname_log);
            foreach ($ret2 as $v):
                $sql = "UPDATE " . $this->tbname_log . " SET `check` = 1 WHERE `id` = " . $v['id'];
                $this->qry($sql);
            endforeach;
        }
    }

    function get_side_hot()
    {

        $this->list_this = "SELECT b.id as id, b.title as title, b.image as image FROM " . $this->tbname_log2 . " as a left join " . $this->tbname . " as b on a.lid=b.id and b.`see`=1   where b.id is not null  ORDER BY `a`.`clicks`  DESC limit 10";

        return parent::get_list($this->list_this);
    }

    function get_side_born()
    {

        $this->list_this = "select id,image,title from " . $this->tbname . " where see='1' order by ctime desc limit 10";
        return parent::get_list($this->list_this);
    }

    function get_all_front()
    {

        $this->list_this = "select see from " . $this->tbname . " where see='1' order by dates desc";
        return parent::get_list($this->list_this);
    }

    function get_all_index()
    {

        $this->list_this = "select id,title,image,content,dates from " . $this->tbname . " where see='1' order by dates desc";
        return parent::get_list($this->list_this);
    }

    function get_keywords()
    {

        $sql = "select keyword, count(*) as t from " . $this->tbname_search . " where LENGTH(keyword)>2 group by keyword order by t desc limit 6";
        return parent::get_list($sql);

        #$ids=null;
    }

    function get_search_page()
    {

        $count = Allp;
        $page = ($_POST['page'] > 0) ? $_POST['page'] : 0;
        $start = $page * $count;
        $KEYWORD = mysql_real_escape_string(urldecode($_REQUEST['keyword']));

        $this->list_this = "select * from " . $this->tbname . " where  see='1' and title like '%" . $KEYWORD . "%' order by dates desc limit " . $start . ", " . $count;
        return parent::get_list($this->list_this);
    }

    function get_all_page()
    {

        $count = Allp;
        $page = ($_POST['page'] > 0) ? $_POST['page'] : 0;
        $start = $page * $count;

        $this->list_this = "select id,title,content,image,dates from " . $this->tbname . " where see='1' order by dates desc limit " . $start . ", " . $count;

        return parent::get_list($this->list_this);
    }

    function get_detail_front($pk)
    {

        $pk = (trim($pk) != '') ? $pk : $this->detail_id;

        if (trim($pk) != '')
            $this->detail_this = "select * from " . $this->tbname . " where  see='1' and " . $this->PK . "=" . $pk;

        return parent::get_list($this->detail_this, 1);
    }

    function get_latest_front($pk)
    {


        $this->detail_this = "select id,title from " . $this->tbname . " where see='1' order by dates desc limit 1";

        return parent::get_list($this->detail_this, 1);
    }

    function get_fate_front($pk)
    {


        $this->detail_this = "select id from " . $this->tbname . " where see='1' order by RAND()";

        return parent::get_list($this->detail_this);
    }

    function get_hot_front($pk)
    {

        $sql = "select id from " . $this->tbname . " where see = '0'";
        $ret = parent::get_list($sql);
        $ids = null;

        foreach ($ret as $k => $v)
            $ids.="'" . $ret[$k]['id'] . "',";

        $sql = "select HIGH_PRIORITY lid, count(*) as t from " . $this->tbname_log . " where LEFT(ctime,10)='" . date('Y-m-d') . "' and lid not in (" . $ids . "'" . $ret[$k]['id'] . "')  group by lid order by t desc limit 1";

#		echo $sql; exit;
        $ret = parent::get_list($sql, 1);
        $pk = (trim($pk) != '') ? $pk : $this->detail_id;
        $pk = $ret['lid'];


        if (trim($pk) != '')
            $this->detail_this = "select id,title from " . $this->tbname . " where  see='1' and " . $this->PK . "=" . $pk;


        return parent::get_list($this->detail_this, 1);
    }

    function clicks_log()
    {

        if (is_numeric($_GET['id']))
        {

            $this->post_arr = array();

            $this->post_arr['lid'] = $_GET['id'];
            $this->post_arr['sid'] = session_id();
            #print_r($this->post_arr);

            $this->set_field($this->tbname_log);
            self::renew();
            $this->set_field($this->tbname2);
        }
    }

    function rside_clicks_log()
    {

        if (is_numeric($_POST['id']))
        {

            $this->post_arr = array();

            $this->post_arr['lid'] = '990' . $_POST['id'];
            $this->post_arr['sid'] = session_id();
            #print_r($this->port_arr);
            $this->set_field($this->tbname_log);
            self::renew();
            $this->set_field($this->tbname2);
        }
    }

    function search_log()
    {

        if ($_POST['keyword'] != '')
        {

            $this->post_arr = array();

            $this->post_arr['keyword'] = $_POST['keyword'];
            $this->post_arr['sid'] = session_id();

            $this->set_field($this->tbname_search);
            self::renew();
            $this->set_field($this->tbname2);
        }
    }

    function index_show()
    {

        $order = mt_rand(1, 7);
        $ascdesc = mt_rand(0, 1);
        $ascdesc = ($ascdesc == 1) ? 'desc' : 'asc';

        $this->list_this = "select * from " . $this->tbname . " where see='1' order by " . $order . " " . $ascdesc . " limit 3";
        return parent::get_list($this->list_this);
    }

    ############################################################################
    function renew()
    {
        parent::renew($this->post_arr, $this->file_arr, $this->sdir, $this->s_size, '', $this->limit);
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

    function see()
    {

        $this->back .= $this->myParent;

        foreach ($this->del_arr as $k => $v)
        {
            $sql = "update " . $this->tbname . " set see='" . $this->post_arr['see'] . "' where " . $this->PK . "=" . $k;
            //echo $sql;
            if (!$this->qry($sql))
            {
                $this->alert = "更新失敗";
                break;
            }
        }
    }

}