<?php
namespace AstroStudio\Core\Api;

interface ApiInterface
{
    function execute(string $name,ApiQueryInterface $query,array $options=[]): mixed;
}
