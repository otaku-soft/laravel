<?php
namespace App\Routes;
class UrlBuilder
{
    public string $baseUrl = "";
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }
    public function url($pageUrl)
    {
        return $this->baseUrl.$pageUrl;
    }
}
