<?php
class Home_controllers{
    public function index($page)
    {
        if ($page==='Home'){
            include 'Views/user/'. $page . '.php';
        }else{
            include 'Views/'. $page .'.php';
        }
    }
}