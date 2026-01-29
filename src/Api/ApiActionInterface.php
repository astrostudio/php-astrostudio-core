<?php
namespace AstroStudio\Core\Api;

interface ApiActionInterface
{
    function execute(ApiQueryInterface $query,array $options=[]): mixed;
}
