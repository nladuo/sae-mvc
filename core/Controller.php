<?php
/**
 * Created by PhpStorm.
 * User: kalen
 * Date: 7/3/16
 * Time: 9:14 PM
 */

namespace Core;


class Controller
{
    protected function render($file, $data = array())
    {

        if (is_array($data) && count($data) != 0){
            extract($data);
        }
        $path = BASE_DIR . '/app/views/' . $file;
        if (!file_exists($path)){
            echo $path . " Not Found";die();
        }
        include $path;
    }

    protected function redirect($url){
        echo "<script language=\"javascript\">";
        echo "location.href=\"$url\"";
        echo "</script>";
        exit();
    }

}