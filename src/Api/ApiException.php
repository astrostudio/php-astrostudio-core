<?php
namespace AstroStudio\Core\Api;

use Exception;
use Throwable;

class ApiException extends Exception
{
    protected ApiInterface $api;

    public function __construct(ApiInterface $api,$message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);

        $this->api=$api;
    }

    public function getApi():ApiInterface
    {
        return($this->api);
    }
}
