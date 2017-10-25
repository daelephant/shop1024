<?php
/**
 * Created by PhpStorm.
 * User: cyx
 * Date: 2017-10-25
 * Time: 14:30
 */
namespace Back\Controller;
use Think\Controller;
class IndexController extends Controller{
    public function head(){
        $this->display();
    }
    public function left(){
        $this->display();
    }
    public function right(){
        $this->display();
    }
    public function index(){
        $this->display();
    }
}