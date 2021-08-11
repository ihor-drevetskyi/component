<?php

namespace ComponentBundle\Helper;

use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface PaginatorHelperInterface
 * @package ComponentBundle\Helper
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
interface PaginatorHelperInterface
{
    /**
     * @param $results
     * @param int $page
     * @param int $limit
     * @return PaginationInterface
     */
    public function paginate($results, int $page, int $limit): PaginationInterface;
}
