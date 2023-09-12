<?php

class PluginRssfeedConfig extends CommonDBTM {

    /**
     * getMenuContent
     *
     * @return array
     */
    static function getMenuContent() : array {
        $menu = array();

        $menu['title'] = __("RSS feeds", 'rssfeed');
        $menu['page'] = "/plugins/rssfeed/front/rssfeed.php";
        $menu['icon']  = "fas fa-rss";

        return $menu;
    }
}