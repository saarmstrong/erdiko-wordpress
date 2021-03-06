<?php
/**
 * Content Controller
 * A simple way to get wordpress content into your site
 * @note this is a work in progress.  It is however a good starting point for running headless
 *
 * @category    erdiko
 * @package     wordpress
 * @copyright   Copyright (c) 2016, Arroyo Labs, www.arroyolabs.com
 * @author      John Arroyo, john@arroyolabs.com
 * @author      Fangxiang Wang
 */
namespace erdiko\wordpress\controllers;


class Content extends \erdiko\core\Controller
{
    /** Before */
    public function _before()
    {
        $this->setThemeName('clean-blog');
        $this->prepareTheme();
    }

    /**
     * Get
     *
     * @param mixed $var
     * @return mixed
     */
    public function get($args = null)
    {
        $model = new \erdiko\wordpress\models\Content;
        $post = $model->getPost($args);
        $renderedData = $model->themeData($post);

        // $content = $this->getView('post_detail', $renderedData, $model->getViewPath());
        $view = new \erdiko\wordpress\View('post_detail', $renderedData, $model->getViewPath());
        $this->setContent($view);

        $this->addWpThemeExtras();
    }

    private function addWpThemeExtras()
    {
      // Add Css
      $this->getResponse()->getTheme()->addCss('/themes/wordpress/css/slick.css');
      $this->getResponse()->getTheme()->addCss('/themes/wordpress/css/slick-theme.css');
      $this->getResponse()->getTheme()->addCss('/themes/wordpress/css/slickstyle.css');
      // Add Js
      $this->getResponse()->getTheme()->addJs('/themes/wordpress/js/slick.min.js');
      $this->getResponse()->getTheme()->addJs('/themes/wordpress/js/slickstyle.js');
      $this->getResponse()->getTheme()->addJs('/themes/wordpress/js/audioplaylist.js');
      $this->getResponse()->getTheme()->addJs('/themes/wordpress/js/videoplaylist.js');
    }
}
