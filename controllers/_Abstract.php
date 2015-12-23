<?php
namespace Controllers;

/**
 * Class Controller
 * @package Controllers
 */
abstract class _Abstract
{

    protected function render($view, $params = array()) {

        foreach($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
            require 'views/' . $view;
        $content = ob_get_clean();

        return $this->renderMain(array(
            'content' => $content,
        ));
    }

    private function renderMain($params = array()) {
        foreach($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
            require_once 'views/main.php';
        return ob_get_clean();
    }
}