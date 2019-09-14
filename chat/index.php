<?php

require_once __DIR__ . '/function/general.php';


$page = getPage($_GET['page'] ?? $_GET['p'] ?? 'index', $pages);

$functionality = getFunctionality($page);

if(!is_null($functionality)){
 require_once $functionality;
}

$page_data = getTemplate('general', $page, $pages, ($page_params ?? []));


echo $page_data;