<?php

namespace App\Controller;

require_once "app/Controller/AbstractBaseController.php";

class DefaultController extends AbstractBaseController
{
    public function index(): void
    {
        $this->jsonResponseMessage("true", "Product Feeder System", 200);
    }
}