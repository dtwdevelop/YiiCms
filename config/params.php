<?php
$inside =false;
if($inside == true){
return [
    'adminEmail' => 'dtwdevelop@gmail.com',
    'site' =>'http://inside.centerpc.co.uk',
    'bigFoto'=>'uploads/big/',
    'smallFoto'=>'uploads/small/',
    'index'=>'data/index',
];
}
else{
    
    return [
    'adminEmail' => 'site@localhost',
    'site' =>'http://sitedev.lv',
    'bigFoto'=>'uploads/big/',
    'smallFoto'=>'uploads/small/',
    'index'=>'data/index',
];
    
}
