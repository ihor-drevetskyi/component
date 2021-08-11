<?php

namespace ComponentBundle\Helper;

/**
 * Interface RequestHelperInterface
 * @package ComponentBundle\Helper
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
interface RequestHelperInterface
{
    /**
     * @return string|null
     */
    public function getRoute(): ?string;

    /**
     * @return string
     */
    public function getLocale(): string;

    /**
     * @return bool
     */
    public function hasPageInQuery(): bool;

    /**
     * Current URL WITHOUT query string
     */
    public function getCurrentUrl(): string;

    /**
     * @return bool
     */
    public function getPageFromQuery(): bool;

    /**
     * @return bool
     */
    public function hasIdInAttributes(): bool;

    /**
     * @return int|null
     */
    public function getIdFromAttributes(): ?int;

    /**
     * Current URL INCLUDING query string
     */
    public function getCurrentUrlWithQueryString(): string;
}
