<?php

namespace ComponentBundle\Service\Cache;

use Psr\Cache\CacheException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\ItemInterface;
use ComponentBundle\Service\MobileDetector;
use Symfony\Component\HttpFoundation\Response;
use ComponentBundle\Helper\RequestHelperInterface;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use ComponentBundle\Entity\Translatable\AbstractEntityElementInterface;

/**
 * Class CacheService
 * @package ComponentBundle\Service\Cache
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
class CacheService implements CacheServiceInterface
{
    protected const EXPIRES_AFTER = 3600;

    /**
     * @var TagAwareCacheInterface
     */
    protected TagAwareCacheInterface $cache;

    /**
     * @var MobileDetector
     */
    protected MobileDetector $mobile_detector;

    /**
     * @var RequestHelperInterface
     */
    protected RequestHelperInterface $request_helper;

    /**
     * CacheService constructor.
     * @param TagAwareCacheInterface $cache
     * @param MobileDetector $mobile_detector
     * @param RequestHelperInterface $request_helper
     */
    public function __construct(
        TagAwareCacheInterface $cache,
        MobileDetector         $mobile_detector,
        RequestHelperInterface $request_helper
    )
    {
        $this->cache = $cache;
        $this->request_helper = $request_helper;
        $this->mobile_detector = $mobile_detector;
    }

    /**
     * @return array
     */
    protected function getPageCacheTags(): array
    {
        $tags = [];
        $route = $this->request_helper->getRoute();
        if ($route) {
            $tags[] = $route;
        }

        $tags[] = $this->request_helper->getLocale();

        if ($this->mobile_detector->isMobile()) {
            $tags[] = 'mobile';
        }

        if ($this->request_helper->hasIdInAttributes()) {
            $tags[] = $route . '-' . $this->request_helper->getIdFromAttributes();
        }

        return $tags;
    }


    /**
     * @return string
     */
    protected function getPageCacheKey(): string
    {
        $parts = [
            $this->request_helper->getLocale(),
        ];

        $route = $this->request_helper->getRoute();
        if ($route) {
            $parts[] = $route;
        }

        if ($this->request_helper->hasIdInAttributes()) {
            $parts[] = $this->request_helper->getIdFromAttributes();
        }

        $parts[] = md5($this->request_helper->getCurrentUrlWithQueryString());

        if ($this->mobile_detector->isMobile()) {
            $parts[] = 'mobile';
        }

        return implode('_', $parts);
    }

    /**
     * @return ItemInterface
     */
    protected function getPageCacheItem(): ItemInterface
    {
        return $this->cache->getItem($this->getPageCacheKey());
    }

    /**
     * @return Response|null
     */
    public function getCachedResponseForAction(): ?Response
    {
        $cached_item = $this->getPageCacheItem();

        if ($cached_item->isHit()) {
            return $cached_item->get();
        }

        return null;
    }

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
    ): void
    {
        foreach ($cache_tags as $key => $cache_tag) {
            if (strpos($cache_tag, '_id') !== false) {
                $cache_tags[$key] = str_replace('_id', '_' . $element->getId(), $cache_tag);
            }
        }

        $cached_item = $this->getPageCacheItem();
        $cached_item->set($response);
        $cached_item->tag(array_merge($this->getPageCacheTags(), $cache_tags));
        $cached_item->expiresAfter(self::EXPIRES_AFTER);
        $this->cache->save($cached_item);
    }

    /**
     * @param Response $response
     * @param array $cache_tags
     * @throws CacheException
     * @throws InvalidArgumentException
     */
    public function setCachedResponseForListAction(Response $response, array $cache_tags = []): void
    {
        $cached_item = $this->getPageCacheItem();
        $cached_item->set($response);
        $cached_item->tag(array_merge($this->getPageCacheTags(), $cache_tags));
        $cached_item->expiresAfter(self::EXPIRES_AFTER);
        $this->cache->save($cached_item);
    }
}
