<?php


namespace fw\widgets\menu;

use fw\libs\Cache;
use fw\libs\Helper;

class Menu
{
    protected $data = [];
    protected $tree;
    protected $menuHtml;
    protected $tpl;
    protected $container = 'ul';
    protected $class = 'menu';
    protected $table = 'user';
    protected $cache = 3600;
    protected $cacheKey = 'fw_menu';


    public function __construct($options = [])
    {
        $this->tpl =  __DIR__ . DIRECTORY_SEPARATOR . 'menu_tpl' . DIRECTORY_SEPARATOR . 'menu.php';
//        $this->tpl = __DIR__ . DIRECTORY_SEPARATOR;
        $this->getOptions($options);
        $this->run();
    }

    /**
     * set custom options.
     *
     * @param $options
     */
    protected function getOptions($options)
    {
        foreach($options as $k => $option) {
            if(property_exists($this, $k)) {
                $this->$k = $option;
            }
        }
    }

    /**
     * output html code with menu.
     */
    public function output()
    {
        echo "<{$this->container} class='{$this->class}'>";
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    /**
     * run all methods to building menu tree.
     *
     */
    public function run()
    {
        $cache = new Cache();
        $this->menuHtml = $cache->get($this->cacheKey);
        if( ! $this->menuHtml) {
            $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);

            $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
        }
        $this->output();
    }

    /**
     * get tree of all categories.
     *
     * @return array
     */
    protected function getTree()
    {
        $tree = [];
        // copy of '$this->data'.
        $data = $this->data;
//        return Helper::debug($data);
//        die();

        foreach($data as $id => &$node) {
            if( $node['parent'] == 0 ) {
                 $tree[$id] = &$node;
            } else {
                $data[$node['parent']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }


    /**
     * get html menu.
     *
     * @param $tree
     * @param string $tab
     * @return string
     */
    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach($tree as $id => $category) {
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    /**
     * send one category to html template.
     *
     * @param $category
     * @param $tab
     * @param $id
     * @return string
     */
    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }


}