<?php
abstract class BaseController
{
    protected function render($view, $data = [])
    {
        extract($data);
        include __DIR__ . "/../views/layout.php";
    }
}
