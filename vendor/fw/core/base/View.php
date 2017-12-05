<?php


namespace fw\core\base;


class View
{
    const LAYOUT = 'default';

    /**
     * current route.
     * @var string
     */
    public $route;

    /**
     * current view.
     * @var string
     */
    public $view;

    /**
     * current template.
     * @var string
     */
    public $layout;

    /**
     * custom scripts.
     * @var array
     */
    public $scripts = [];

    public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];


    public function __construct($route, $layout = '', $view = '' )
    {
        $this->route = $route;

        if($layout === FALSE) {
            $this->layout = FALSE;
        } else {
            $this->layout = $layout ?: self::LAYOUT;
        }

        $this->view = $view;
    }


    /**
     * render view.
     *
     * @param $vars
     * @throws \Exception
     */
    public function render($vars)
    {
//        $this->prefix = str_replace('\\', '/', $this->prefix);
        // get values of vars.
        if(is_array($vars)) extract($vars);
        $this->route['prefix'] = str_replace('\\', DS, $this->route['prefix']);
        $file_view = VIEWS . DIRECTORY_SEPARATOR . $this->route['prefix'] . $this->route['controller'] . DIRECTORY_SEPARATOR . $this->view . '.php';

        // start buffer.
        ob_start();

        if(is_file($file_view)) {
            require $file_view;
        } else {
            throw new \Exception("<p>view not found <b>{$file_view}</b></p>", 404);
//            echo "<p>view not found <b>{$file_view}</b></p>";
        }

        // clean buffer and write to var.
        $content = ob_get_clean();

        // if we have layout - include them.
        if (FALSE !== $this->layout) {
            $file_layout = LAYOUTS . DIRECTORY_SEPARATOR . $this->layout . '.php';
            if (is_file($file_layout)) {
                $content = $this->getScripts($content);
                $scripts = [];
                if ( ! empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }

                require $file_layout;
            } else {
                throw new \Exception("<p>layout not found <b>{$file_layout}</b></p>", 404);
//                echo "<p>layout not found</p>";
            }
        }

    }

    /**
     * find <script> and cut them all.
     *
     * @param $content
     * @return mixed
     */
    protected function getScripts($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);

        if( ! empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }

        return $content;
    }

    /**
     * get meta data with html.
     *
     */
    public static function getMeta()
    {
        echo '<title>'
            . self::$meta['title'] .
            '</title><meta name="description" content="'
            . self::$meta['desc'] .
            '"><meta name="keywords" content="'
            . self::$meta['keywords'] .
            '">';
    }

    /**
     * set meta data.
     *
     * @param string $title
     * @param string $desc
     * @param string $keywords
     */
    public static function setMeta($title = '', $desc = '', $keywords = '')
    {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }

}