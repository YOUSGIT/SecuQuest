<?php

class Site extends Superobj
{

    //var $Crumbs_local;
    var $crumbs = array();
    protected $post_arr = array();
    protected $file_arr = array();
    protected $del_arr;
    protected $limit = 2; //上傳檔案大小
    protected $sort_where;
    protected $tbname = ADM;
    var $sdir;
    var $back = './about.php';
    var $this_Page = this_Page;
    var $detail_id; //編輯細節ID
    var $is_sort = true;
    var $sort_arr = array();
    var $_lang = array('cht' => '正體中文', 'cn' => '簡體中文', 'en' => '英文');

    ####################################################################################
    function __construct($debug = Debug)
    {
        parent::__construct($debug);
        self::setTbname();
        if (trim($this->tbname) != '')
            $this->set_field($this->tbname);
    }

    function setTbname()
    {
        $this->tbname = "`Secuquest`." . $this->tbname;
    }

    function lang($lang = '')
    {
        if (isset($_GET['LANG']) && in_array($_GET['LANG'], $this->_lang))
            $_SESSION['LANG'] = $_GET['LANG'];


        if (trim($_SESSION['LANG']) == '')
            $_SESSION['LANG'] = 'cht';

        define('LANG', $_SESSION['LANG']);
    }

    function getLang($idx = '')
    {
        if ($idx != '')
            return $this->_lang[$idx];

        return $this->_lang;
    }

    function login()
    {
        $sql = "SELECT * FROM " . $this->tbname . " WHERE `userid` = '" . $this->quote($_POST['id']) . "' AND pw = '" . $this->quote(md5($_POST['pw'])) . "'";
        // exit($sql);
        return parent::get_list($sql, 1);
    }

    function setSession($ret)
    {
        if (!is_array($ret))
            return false;

        $lang = $_SESSION['LANG'];

        session_destroy();
        session_start();
        $_SESSION['AdmiN'] = ($ret['userid']);
        $_SESSION['sid'] = (session_id());
        $_SESSION['token'] = md5($ret['userid'] . $_SESSION['sid']);
        $_SESSION['loginObj'] = serialize($this);
        $_SESSION['LANG'] = $lang;

        return true;
    }

    static function checkLogin()
    {
        if ($_SESSION['AdmiN'])
            $AdmiN = $_SESSION['AdmiN'];

        $excludeArr = array("index.php", "logincheck.php", "logout.php");

        if ((!isset($AdmiN) || empty($AdmiN) || $_SESSION['token'] != md5($AdmiN . $_SESSION['sid'])) && file_exists("admin.admin"))
            if (!in_array(this_Page, $excludeArr))
                header("Location:  ./");
    }

}