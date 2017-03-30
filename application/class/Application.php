<?php

class Application {

    private $url_controller = null;
    private $url_action = null;
    private $url_params = array();

    private $controller_dir = 'application/controllers/';

    public function __construct() {
        $this->splitURL();

        # Graham L.:
        # If there was no path, go to the home page.
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
                # Graham L.:
                # If there is no action or the action does not exist in the
                # controller, fall back to the index action and pass the
                # action parameter as an argument.
                if (strlen($this->url_action) == 0) {
                    $this->url_controller->index();
                } else {
                    # Graham L.:
                    # Originally, if the action did not exist, the application
                    # would redirect you to the generic error page. This
                    # behavior was changed to implement categories for the item
                    # controller with cleaner URLs (/items/[category] instead 
                    # of /items/category/[category]).
                    $this->url_controller->index($this->url_action, $this->url_params);
                }
            }
        } else {
            $this->error_page();
        }
    }   

    # Graham L.:
    # This function takes the URL and splits it as if it were a '/' delimited 
    # list into an array.
    private function splitUrl() {
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
            # Graham L.
            # This removes all characters except 
            # '$-_.+!*'(),{}|\\^~[]`<>#%";/?:@&=.' from the URL.
            # http://php.net/manual/en/filter.filters.sanitize.php
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;

            unset($url[0], $url[1]);

            $this->url_params = array_values($url);

            # Graham L.:
            # Un-comment the following 3 (or 4) lines if you are trying to 
            # debug controller behavior.

            #echo '<br /> Controller ' . $this->url_controller . '<br />';
            #echo 'Action: ' . $this->url_action . '<br />';
            #echo 'Parameters ' . print_r($this->url_params, true) . '<br />';
            #var_dump($_POST);
        }
    }

    # Graham L.:
    # Originally, this class redirected to the error page in multiple places.
    # This function was created to abstract the error page code to adhere to
    # DRY programming principles, but is now only called once. It in theory
    # could be removed but we might benefit from making it a static function
    # and have it accept parameters to create a better error page.
    # Alternatively, each controller could have it's own error page which is
    # probably the better way to go about it.
    public function error_page() {
        header('location: ' . URL . 'pages/error');
    }

}
