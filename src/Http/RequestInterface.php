<?php
declare(strict_types=1);

namespace \Learn\Http;

interface RequestInterface{

    public function getRequestTarget() :string;

    public function getRequestMethod() :string;

    public function getRequestBody() :string;
}