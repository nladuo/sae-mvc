<?php
/**
 * Created by PhpStorm.
 * User: kalen
 * Date: 7/3/16
 * Time: 10:00 PM
 */

namespace App\Controller;

use Core\Controller;

class HomeController extends Controller
{
    function index()
    {
        $data = [
            'title' => 'sae-mvc',
            'content' => 'This is sae-mvc Default Site.'
        ];
        $this->render('home/home.php', $data);
    }
}