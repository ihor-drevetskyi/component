<?php

namespace ComponentBundle\Helper;

use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Class PaginatorHelper
 * @package ComponentBundle\Helper
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
class PaginatorHelper implements PaginatorHelperInterface
{
    /**
     * @var PaginatorInterface
     */
    protected PaginatorInterface $paginator;

    /**
     * PaginatorHelper constructor.
     * @param PaginatorInterface $paginator
     */
    public function __construct(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @param $results
     * @param int $page
     * @param int $limit
     * @return PaginationInterface
     */
    public function paginate($results, int $page, int $limit): PaginationInterface
    {
        if ($results instanceof QueryBuilder) {
            return $this->paginator->paginate($results, $page, $limit, [
                'distinct' => true,
                'wrap-queries' => true
            ]);
        } else {
            return $this->paginator->paginate($results, $page, $limit);
        }
    }
}
