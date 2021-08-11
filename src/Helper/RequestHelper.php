<?php

namespace ComponentBundle\Helper;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class RequestHelper
 * @package ComponentBundle\Helper
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
class RequestHelper implements RequestHelperInterface
{
    /**
     * @var Request|null
     */
    protected ?Request $request;

    /**
     * RequestHelper constructor.
     * @param RequestStack $request_stack
     */
    public function __construct(RequestStack $request_stack)
    {
        $this->request = $request_stack->getCurrentRequest();
    }

    /**
     * @return string|null
     */
    public function getRoute(): ?string
    {
        return $this->request->attributes->get('_route');
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return $this->request->getLocale();
    }

    /**
     * @return bool
     */
    public function hasPageInQuery(): bool
    {
        return $this->request->query->has('page');
    }

    /**
     * Current URL WITHOUT query string
     */
    public function getCurrentUrl(): string
    {
        return strtok($this->request->getUri(), '?');
    }

    /**
     * @return bool
     */
    public function getPageFromQuery(): bool
    {
        return $this->request->query->get('page');
    }

    /**
     * @return bool
     */
    public function hasIdInAttributes(): bool
    {
        return $this->request->attributes->has('id');
    }

    /**
     * @return int|null
     */
    public function getIdFromAttributes(): ?int
    {
        return $this->request->attributes->get('id');
    }

    /**
     * Current URL INCLUDING query string
     */
    public function getCurrentUrlWithQueryString(): string
    {
        return $this->request->getUri();
    }
}
