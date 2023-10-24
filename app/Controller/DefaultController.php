<?php

namespace PtteM\Controller;

class DefaultController extends AbstractBaseController
{
    public function index(): void
    {
        $this->jsonResponseMessage("true", "Product Feeder System", 200);
    }
}