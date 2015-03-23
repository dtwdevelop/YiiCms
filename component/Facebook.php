<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Facebook
 *
 * @author hide
 */
namespace app\component;
use yii\authclient\clients\Facebook;
class Facebook  extends Facebook{
    protected function defaultViewOptions()
{
    return [
        'popupWidth' => 800,
        'popupHeight' => 500,
    ];
}
}
