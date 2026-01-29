<?php
namespace AstroStudio\Core\Api;

class RenameApi extends ProxyApi
{
    protected array $names;

    public function __construct(ApiInterface $api,array $names=[],array $options=[])
    {
        parent::__construct($api, $options);

        $this->names=$names;
    }

    public function execute(string $name, ApiQueryInterface $query, array $options = []): mixed
    {
        return parent::execute($this->names[$name]??$name, $query, $options);
    }
}
