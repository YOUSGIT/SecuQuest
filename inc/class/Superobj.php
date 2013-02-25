<?php

class Superobj extends DB
{

    protected $tbname;
    protected $field = array(); //所有欄位屬性
    protected $field_num; //欄位數
    protected $PK;
    public $_number = array("tinyint",
        "smallint",
        "mediumint",
        "int",
        "integer",
        "bigint",
        "float",
        "double",
        "double",
        "real",
        "decimal",
        "numeric");
    public $_date = array("date",
        "time",
        "datetime",
        "timestamp",
        "year");
    public $alert = "";
    public $back = "./";

    function __construct($debug = false, $tbname = "")
    {

        parent::__construct($debug);

        if (trim($tbname) != '')
            $this->set_field($tbname);
    }

    /*
      function is_table($tbname, $tb_list = "")
      {

      $tb_list = $this->list_tb();

      if (!in_array(trim($tbname), $tb_list))
      $this->tbname = false;
      else
      $this->tbname = trim($tbname);

      return $this->tbname;
      }
     */
    function set_field($tbname, $tb_list = "", $field_list = "")
    { //設定所有欄位屬性
        if (/* !$this->is_table($tbname, $tb_list) || */ trim($tbname) == '')
            return false;

        $tbname = add_field_quotes($tbname);
        $sql = sprintf("SHOW COLUMNS FROM %s", ($tbname));
        $field_list = self::get_list($sql);

        $this->field_num = count($field_list);
        $this->field = null;

        foreach ($field_list as $k => $v)
        {

            $Type = explode("(", $v['Type']);
            $this->field[$v['Field']]['Type'] = $Type[0];
            $this->field[$v['Field']]['Key'] = $v['Key'];

            if ($v['Key'] == 'PRI') //找到PK
                $this->PK = $v['Field'];
        }

        if ($this->field_num > 0)
            $this->tbname = $tbname;
        else
            return false;
        //print_r($this->field);
    }

    function resort($where = "", $sequ = "sequ", $tbname = "", $pk = "", $asc = "ASC")
    { //排序
        $tbname = (trim($tbname) == '') ? $this->tbname : $tbname;
        $pk = (trim($pk) == '') ? $this->PK : $pk;
        $where = "WHERE 1 " . ((trim($where) == '') ? $this->sort_where : $where);

        $sql = sprintf("SELECT " . add_field_quotes($pk) . " FROM %s %s ORDER BY `%s` %s;", $tbname, $where, $sequ, $asc); //目錄區重新編號

        if (!$ret = self::get_list($sql))
            return false;

        #for($i=0;$i<count($ret);$i++)
        foreach ($ret as $i => $v)
        {
            // $arr = array();
            $sql = sprintf("UPDATE %s SET `%s`=%d WHERE %s=%d", $tbname, $sequ, $this->quote($i + 1), $pk, $v[$pk]);
            // $arr[$sequ] = $i + 1;
            // $arr[$pk] = $v[$pk];

            // self::renew($arr);
            if (!$this->qry($sql))
            return false("排序失敗");
        }

        return true;
    }

    function sortable($where = "", $sequ = "sequ", $tbname = "", $pk = "", $asc = "asc")
    { //排序
        $tbname = (trim($tbname) == '') ? $this->tbname : $tbname;
        $pk = (trim($pk) == '') ? $this->PK : $pk;
        $where = "WHERE 1 " . ((trim($where) == '') ? $this->sort_where : $where);

        // $sort_arr = explode(',', $this->sort_arr);
        $sort_arr = $this->get_sort_arr();
        foreach ($sort_arr as $i => $v)
        {
            if (is_numeric($v))
            {
                // $sql = sprintf("UPDATE %s SET `%s`=%d WHERE %s=%d", $tbname, $sequ, $this->quote(($i + 1), $pk, $v);
                // $arr = array();
                $sql = sprintf("UPDATE %s SET `%s`=%d WHERE %s=%d", $tbname, $sequ, $this->quote($i + 1), $pk, $v);
                // $arr[$sequ] = $i + 1;
                // $arr[$pk] = $v;

                // self::renew($arr);
                if (!$this->qry($sql))
                return false("排序失敗");
            }
        }

        return true;
    }

    function renew($post_arr = "", $upload = "", $sdir = "", $s_size = "", $limit = 2, $upload_file = "", $is_image = false)
    {

        $flag = 1;
        $post_arr = (is_array($post_arr)) ? $post_arr : $this->post_arr;
        $upload = (is_array($upload)) ? $upload : $this->file_arr;
        $sdir = (trim($sdir) != '') ? $sdir : $this->sdir;
        $limit = (is_numeric($limit)) ? $limit : $this->limit;
        $s_size = (is_array($s_size)) ? $s_size : $this->s_size;
        $upload_file = (trim($upload_file) != '') ? $upload_file : $this->upload_file;
        $is_image = (isset($is_image)) ? $is_image : $this->is_image;

        // chmod($sdir, 0777);

        if (is_array($upload) && count($upload) > 0)
        {

            $prefix = explode("_", $this->tbname);

            foreach ($upload as $k => $v)
            {

                if (isset($upload[$k]['name']) && !empty($upload[$k]['tmp_name']))
                {

                    $oFile = $upload[$k]['tmp_name'];
                    $sFileName = $upload[$k]['name'];
                    $sExtension = Extension($sFileName);
                    $sFileName = $prefix[0] . '_' . date("U") . $sExtension;
                    $sFilePath = $sdir . $sFileName;

                    if (move_uploaded_file($oFile, $sFilePath) && round(filesize($sFilePath) / 1048576, 2) < $limit)
                    {

                        foreach ($s_size as $x => $z)
                        { //判斷指定大小數量決定縮圖張數
                            if ($x != "m")
                                resizeimage($sdir, $sFilePath, $s_size[$x]["w"], $s_size[$x]["h"], $sFileName, true, $x);
                            else
                                $sFileName = resizeimage($sdir, $sFilePath, $s_size["m"]["w"], $s_size["m"]["h"], $sFileName);

                            #$post_arr['image']=$sFileName;
                        }

                        $field_name = explode('_', $k);

                        $flag = 1;
                        $post_arr[$field_name[0]] = $sFileName;
                        #@unlink($sdir.$post_arr['image']);
                        #@unlink($sdir.'s_'.$post_arr['image']);
                        #@unlink($sdir.'m_'.$post_arr['image']);
                        #@unlink($sdir.'l_'.$post_arr['image']);
                        #@unlink($sdir.'ss_'.$post_arr['image']);
                        //$post_arr['files']=$sFileName;
                    }else
                    {

                        $flag = 0;
                        $this->alert = "上傳失敗";

                        if (round(filesize($sFilePath) / 1048576, 2) >= $limit)
                            $this->alert = "檔案請勿超過" . $limit . "MB!";

                        break;
                    }
                }
            }
        }

        if ($flag == 1)
        {
            $field_count = count($this->field);
            $field = null;
            $insert_value = null;
            $j = 1;
            // default action is insert
            $mode = "i";

            foreach ($this->field as $k => $v)
            {

                $is_time = 0;
                $is_number = 0;

                $d = '"'; //預設文字類型給予引號

                /* skip the unset field */
                if ($mode == 'u')
                    if (!isset($post_arr[$k]))
                        continue;

                foreach ($this->_number as $v)
                { //數值類型不給予引號
                    if (substr_count($this->field[$k]['Type'], $v) > 0)
                    {
                        $d = '';
                        $is_number = 1;
                        break;
                    }
                }
                foreach ($this->_date as $v)
                { //時間類型給予引號且標記
                    if (substr_count($this->field[$k]['Type'], $v) > 0)
                    {
                        $d = '"';
                        $is_time = 1;
                        break;
                    }
                }

                if ($is_time == 1 && strtotime($post_arr[$k]) == '')
                {
                    $d = '';
                    $post_arr[$k] = 'NOW()';
                }

                if ($is_number == 1 && $post_arr[$k] == '')
                {
                    $d = '';
                    $post_arr[$k] = 0;
                }

                if ($this->PK == $k)
                {
                    if ($post_arr[$k] == '')
                        $post_arr[$k] = 'null'; // set PK value
                    else
                    {
                        $PK_value = $d . $this->quote($post_arr[$k]) . $d;
                        /* the primary key value is not null, change to update mode */
                        $mode = "u";
                        continue;
                    }
                }

                /* bind fields and values to a variable */
                if (true)
                {
                    $field.="`" . $k . "`";
                    if ($mode == 'i')
                    {
                        // insert
                        #echo $k.'='.$post_arr[$k].'<br>';
                        $insert_value.=(trim($post_arr[$k]) != '') ? $d . $this->quote($post_arr[$k]) . $d : $d . $d;
                        #echo $insert_value.'<br>';
                    }
                    elseif ($mode == 'u')
                    {
                        // update
                        $field.=" = ";
                        $field.=$d . $this->quote($post_arr[$k]) . $d;
                    }

                    if ($j < $field_count)
                    {
                        $field.=",";
                        $insert_value.=",";
                    }
                }

                $j++;
            }
        }

        if ($mode == 'i')
            $sql = 'REPLACE INTO ' . $this->tbname . ' (' . $field . ')VALUES(' . $insert_value . ')';
        elseif ($mode == 'u')
        {
            $field.="`" . $this->PK . "` = " . $PK_value;
            $sql = "UPDATE " . $this->tbname . " SET " . $field . " WHERE `" . $this->PK . "` =" . $PK_value;
        }

        // exit($sql);
        #if(Debug)
        // echo $sql;

        $this->alert = '更新完成';

        if (!$this->qry($sql))
            $this->alert = '更新失敗';

        return $this->alert;
    }

    function killu($del_arr, $is_image = false, $sdir = "")
    {

        $del_arr = (is_array($del_arr)) ? $del_arr : $this->del_arr;
        $is_image = (isset($is_image)) ? $is_image : $this->is_image;
        $sdir = (trim($sdir) != '') ? $sdir : $this->sdir;
        $tbname = (trim($tbname) != '') ? $tbname : $this->tbname;
        $this->alert = "刪除成功";

        if (!is_array($del_arr))
            $arr[$del_arr] = $del_arr;
        else
            $arr = $del_arr;

        //print_r($arr);

        foreach ($arr as $k)
        {

            if (is_numeric($k))
            {

                if (
                        false//$is_image=false
                )
                {//**********
                    $sql = "SELECT image FROM " . $tbname . ' WHERE ' . $this->PK . '=' . $k;
                    $ret = self::get_list($sql, 1);

                    @unlink($sdir . $ret['image']);
                    @unlink($sdir . 's_' . $ret['image']);
                    @unlink($sdir . 'm_' . $ret['image']);
                    @unlink($sdir . 'l_' . $ret['image']);
                    @unlink($sdir . 'ss_' . $ret['image']);
                }

                $sql = 'DELETE FROM ' . $tbname . ' WHERE ' . $this->PK . '=' . $k;

                if (!$this->qry($sql))
                {
                    $this->alert = "刪除失敗";
                    break;
                }
            }
        }

        return $this->alert;
    }

    function crumbs($name)
    {

        $name = (trim($name) != '') ? $name : $this->this_Page;
        return Crumbs($this->crumbs[$name]);
    }

    /*
      function move_sequ($sequid, $move, $c='',$table="", $obj_f="sequ" ){//改變順序

      $table  =	(trim($table)=='')	?	$this->tbname	:	$table;
      $sql2	=	(trim($c)!='')		?	' and '.$c		:	'';
      $sequid_move	=	($move=='up')	?	((int)$sequid-1)	:	((int)$sequid+1);

      $up_sql="update ".$table." set ".$obj_f."=0 where ".$obj_f."=".$sequid; //--編號-1
      $up_sql.=$sql2;
      if(!$this->qry($up_sql))
      return false;

      $up_sql="update ".$table." set ".$obj_f."=".mysql_real_escape_string($sequid)." where ".$obj_f."=".$sequid_move;
      $up_sql.=$sql2;
      if(!$this->qry($up_sql))
      return false;

      $up_sql="update ".$table." set ".$obj_f."=".mysql_real_escape_string($sequid_move)." where ".$obj_f."=0";
      $up_sql.=$sql2;
      if(!$this->qry($up_sql))
      return false;
      }
     */
    function goback($url = "", $title = "", $sec = 0)
    {

        $url = trim($this->back);
        $title = trim($this->alert);
        $str = null;

        $str.= '<script type="text/javascript">';

        if ($title != '')
            $str.= 'alert(\'' . trim($title) . '\');';
        $str.= 'window.location="' . $url . '";';
        $str.= '</script>';
        $str.= '<noscript>';
        $str.= '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        $str.= '</noscript>';

        echo $str;

        exit;
    }

}

