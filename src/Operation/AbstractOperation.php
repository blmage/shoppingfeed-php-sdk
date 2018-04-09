<?php
namespace ShoppingFeed\Sdk\Operation;

use Jsor\HalClient\HalLink;
use Jsor\HalClient\HalResource;

abstract class AbstractOperation
{
    /**
     * @param HalLink $link
     *
     * @return mixed
     */
    abstract public function execute(HalLink $link);

    /**
     * @return string
     */
    abstract public function getRelatedResource(): string;

    /**
     * @param HalResource $resource
     *
     * @return HalResource[]
     */
    protected function getRelated(HalResource $resource): array
    {
        return $resource->getResource($this->getRelatedResource());
    }

    /**
     * @param mixed $data
     *
     * @return array
     */
    protected function createHttpBody($data): array
    {
        return ['body' => [$this->getRelatedResource() => $data]];
    }
}