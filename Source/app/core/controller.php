<?php
class Controller
{
        public function view($view, $data = [])
        {
                extract($data);
                if (file_exists("../app/views/" . $view . ".view.php")) {
                        require("../app/views/" . $view . ".view.php");
                } else {
                        require("../app/views/404.view.php");
                }
        }

        public function load_model($model)
        {
                if (file_exists("../app/models/" . ucfirst($model) . ".model.php")) {
                        require "../app/models/" . ucfirst($model) . ".model.php";
                        return $model = new $model();
                }
                return false;
        }

        public function redirect($link)
        {
                header("location: " . ROOT . trim($link, "/"));
                die;
        }
}
