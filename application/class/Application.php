<?php

class Application {

    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();

    private $controller_dir = 'application/controllers/';

    public function __construct() {
        $this->splitURL();

        if (!$this->url_controller) {
            require $this->controller_dir . 'pages_controller.php';
            $page = new Pages();
            $page->index();
        } elseif (file_exists($this->controller_dir . $this->url_controller . '_controller.php')) {
            require $this->controller_dir . $this->url_controller . '_controller.php';
            $this->url_controller = new $this->url_controller();

            if (method_exists($this->url_controller, $this->url_action)) {
                if (!empty($this->url_params)) {
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } else {
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                if (strlen($this->url_action) == 0) {
                    $this->url_controller->index();
                } else {
                    #header('location: ' . URL . 'pages/error');
                    $this->error_page();
                }
            }
        } else {
            #header('location: ' . URL . 'pages/error');
            $this->error_page();
        }
    }   

    private function splitUrl() {
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            $this->url_params = array_values($url);

            #echo 'Controller ' . $this->url_controller . '<br />';
            #echo 'Action: ' . $this->url_action . '<br />';
            #echo 'Parameters ' . print_r($this->url_params, true) . '<br />';
        }
    }

    public function error_page() {
        header('location: ' . URL . 'pages/error');
    }

}
