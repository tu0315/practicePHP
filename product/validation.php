<?php

function validation($request){

    $error_msg = [];

    if(empty($request['name'])){
        $error_msg['name'] = "名前が入力されていません。";
    }
    if(empty($request['price'])){
        $error_msg['price'] = "価格が入力されていません。";
    }else if(!is_numeric($request['price'])){
        $error_msg['price'] = "価格は数値で入力してください。";
    }

    return $error_msg;
}

?>