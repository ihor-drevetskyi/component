<?php

namespace ComponentBundle\Service;

use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\Pagination\PaginationInterface;
use ComponentBundle\Entity\Translatable\AbstractEntityElementInterface;

/**
 * Interface AbstractElementServiceInterface
 * @package ComponentBundle\Service
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
interface AbstractElementServiceInterface
{
    /**
     * @param $id
     * @param string|null $category
     * @param string|null $sub_category
     * @return AbstractEntityElementInterface|null
     */
    public function getElementForHelperForItemAction(
        $id,
        ?string $category = null,
        ?string $sub_category = null
    ): ?AbstractEntityElementInterface;

    /**
     * @param int|null $count
     * @param int|null $page
     * @param bool $check_if_exists
     * @param string|null $locale
     * @return array
     */
    public function getElementsForHelperForListAction(
        ?int    $count = null,
        ?int    $page = 1,
        bool    $check_if_exists = true,
        ?string $locale = null
    ): array;

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilderForElement(): QueryBuilder;

    /**
     * @param string|null $locale
     * @return QueryBuilder
     */
    public function getQueryBuilderForList(?string $locale = null): QueryBuilder;

    /**
     * @param int|null $limit
     * @param int|null $page
     * @param string|null $locale
     * @return PaginationInterface|mixed
     */
    public function findList(?int $limit = null, ?int $page = 1, ?string $locale = null);

    /**
     * @param $first
     * @param null $second
     * @return AbstractEntityElementInterface|null
     */
    public function findElement($first, $second = null): ?AbstractEntityElementInterface;

    /**
     * @param string $locale
     * @param int $count
     * @param int $page
     * @return array
     */
    public function getElementsForSitemap(string $locale, int $count, int $page = 1): array;
}
