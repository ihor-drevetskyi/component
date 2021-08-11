<?php

namespace ComponentBundle\Service;

use Throwable;
use Pagerfanta\Pagerfanta;
use Doctrine\ORM\QueryBuilder;
use ComponentBundle\Helper\RequestHelperInterface;
use ComponentBundle\Helper\PaginatorHelperInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ComponentBundle\Repository\AbstractElementRepositoryInterface;
use ComponentBundle\Entity\Translatable\AbstractEntityElementInterface;

/**
 * Class AbstractElementService
 * @package ComponentBundle\Service
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
abstract class AbstractElementService implements AbstractElementServiceInterface
{
    /**
     * @var TranslatorInterface
     */
    protected TranslatorInterface $translator;

    /**
     * @var RequestHelperInterface
     */
    protected RequestHelperInterface $request_helper;

    /**
     * @var PaginatorHelperInterface
     */
    protected PaginatorHelperInterface $paginator_helper;

    /**
     * @var AbstractElementRepositoryInterface
     */
    protected AbstractElementRepositoryInterface $element_repository;

    /**
     * AbstractElementService constructor.
     * @param TranslatorInterface $translator
     * @param RequestHelperInterface $request_helper
     * @param PaginatorHelperInterface $paginator_helper
     * @param AbstractElementRepositoryInterface $element_repository
     */
    public function __construct(
        TranslatorInterface                $translator,
        RequestHelperInterface             $request_helper,
        PaginatorHelperInterface           $paginator_helper,
        AbstractElementRepositoryInterface $element_repository
    )
    {
        $this->translator = $translator;
        $this->request_helper = $request_helper;
        $this->paginator_helper = $paginator_helper;
        $this->element_repository = $element_repository;
    }

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
    ): ?AbstractEntityElementInterface
    {
        /**
         * @var AbstractEntityElementInterface $element
         */
        if ($id) {
            $element = $this->findElement($id);
        } elseif ($category && $sub_category) {
            $element = $this->findElement($category, $sub_category);
        } else {
            $element = $this->findElement($category);
        }

        $this->checkIfExists($element);

        if (!isset($element->getTranslations()[$this->request_helper->getLocale()])) {
            $this->checkIfExists();
        }

        return $element;
    }

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
    ): array
    {
        $elements = $this->findList($count, $page, $locale);
        if ($elements instanceof Pagerfanta) {
            $results = $elements->getCurrentPageResults();
        } else {
            $results = $elements;
        }

        if ($check_if_exists) {
            if (
                (
                    !$elements ||
                    ($elements instanceof Pagerfanta && count($results) == 0) ||
                    ($elements instanceof PaginationInterface && $elements->count() == 0)
                ) &&
                $page > 1
            ) {
                $this->checkIfExists();
            }
        }

        return [
            'elements' => $results,
            'pagerfanta_pager' => $elements instanceof Pagerfanta ? $elements : null
        ];
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilderForElement(): QueryBuilder
    {
        return $this->element_repository->getQueryBuilderForElement();
    }

    /**
     * @param string|null $locale
     * @return QueryBuilder
     */
    public function getQueryBuilderForList(?string $locale = null): QueryBuilder
    {
        return $this->element_repository->getQueryBuilderForList($locale);
    }

    /**
     * @param int|null $limit
     * @param int|null $page
     * @param string|null $locale
     * @return PaginationInterface|mixed
     */
    public function findList(?int $limit = null, ?int $page = 1, ?string $locale = null)
    {
        return $this->paginator_helper->paginate(
            $this->getQueryBuilderForList($locale),
            $page,
            $limit
        );
    }

    /**
     * @param string $locale
     * @param int $count
     * @param int $page
     * @return array
     */
    public function getElementsForSitemap(string $locale, int $count, int $page = 1): array
    {
        return $this->getElementsForHelperForListAction($count, $page, false, $locale);
    }

    /**
     * Returns a NotFoundHttpException.
     * This will result in a 404 response code. Usage example:
     * throw $this->createNotFoundException('Page not found!');
     * @param string $message
     * @param Throwable|null $previous
     * @return NotFoundHttpException
     */
    protected function createNotFoundException(
        string    $message = 'Not Found',
        Throwable $previous = null
    ): NotFoundHttpException
    {
        return new NotFoundHttpException($message, $previous);
    }

    /**
     * 404 error if no object is selected
     * @param object object объект сущности
     * @throws NotFoundHttpException
     */
    protected function checkIfExists($object = null)
    {
        if (!$object) {
            throw $this->createNotFoundException(
                $this->translator->trans('ui.notFound', [], 'DashboardBundle')
            );
        }
    }
}
