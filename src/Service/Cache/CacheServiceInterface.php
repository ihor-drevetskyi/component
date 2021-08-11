<?php

namespace ComponentBundle\Service\Cache;

use Psr\Cache\CacheException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use ComponentBundle\Entity\Translatable\AbstractEntityElementInterface;

/**
 * Interface CacheServiceInterface
 * @package ComponentBundle\Service\Cache
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
interface CacheServiceInterface
{
    /**
     * @param Response $response
     * @param AbstractEntityElementInterface $element
     * @param array $cache_tags
     * @throws CacheException
     * @throws InvalidArgumentException
     */
    public function setCachedResponseForItemAction(
        Response                       $response,
        AbstractEntityElementInterface $element,
        array                          $cache_tags = []
    ): void;

    /**
     * @return Response|null
     */
    public function getCachedResponseForAction(): ?Response;

    /**
     * @param Response $response
     * @param array $cache_tags
     * @throws CacheException
     * @throws InvalidArgumentException
     */
    public function setCachedResponseForListAction(Response $response, array $cache_tags = []): void;
}
