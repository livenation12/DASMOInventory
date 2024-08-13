<?php

class App
{
        protected $controller = "home";
        protected $method = "index";
        protected $params = [];
        //identifying the controller/method and params requiring the files
        public function __construct()
        {
                $URL = $this->getURL();
                if (file_exists("../app/controllers/" . $URL[0] . ".ctlr.php")) {
                        $this->controller = ucfirst($URL[0]);
                        unset($URL[0]);
                }

                require "../app/controllers/" . $this->controller . ".ctlr.php";
                $this->controller = new $this->controller();

                if (isset($URL[1])) {
                        if (method_exists($this->controller, $URL[1])) {
                                $this->method = ucfirst($URL[1]);
                                unset($URL[1]);
                        }
                }
                $URL = array_values($URL);
                $this->params = $URL;
                call_user_func_array([$this->controller, $this->method], $this->params);
        }
        //getting the url and explod it.. url provided in htaccess file
        public static function getURL()
        {
                $url = isset($_GET["url"]) ? $_GET["url"] : "home";
                return explode("/", filter_var(trim($url, "/")), FILTER_SANITIZE_URL);
        }
}
