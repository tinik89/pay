<?php
/**
 * Created by IDEA.
 * User: TIN
 * Date: 30.07.2018
 * Time: 23:09:40
 * To change this template use File | Settings | File Templates.
 */
namespace app\assets;

    use yii\web\AssetBundle;
    class IeAsset extends AssetBundle{
        public $js = [
            'http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js',
            'http://html5shim.googlecode.com/svn/trunk/html5.js',
        ];
    public $jsOptions = ['condition' => 'lte IE9',
        'position'=> \yii\web\View::POS_HEAD
    ];
}
