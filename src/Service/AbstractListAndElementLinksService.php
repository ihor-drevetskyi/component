<?php

namespace ComponentBundle\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use ComponentBundle\Entity\Translatable\AbstractEntityElementInterface;

/**
 * Class AbstractListAndElementLinksService
 * @package ComponentBundle\Service
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
abstract class AbstractListAndElementLinksService extends AbstractLinksService implements
    AbstractElementLinksServiceInterface
{
    /**
     * @param int|null $count
     * @param int|null $page
     * @return array|int[]
     */
    protected function generateParametersForListOrItemAction(?int $count = null, ?int $page = null): array
    {
        $parameters = [];
        if ($page && $count) {
            $parameters = ['page' => $page, 'count' => $count];
        }

        if ($this->request_helper->hasPageInQuery()) {
            $parameters['page'] = $this->request_helper->getPageFromQuery();
        }

        return $parameters;
    }

    /**
     * @param AbstractEntityElementInterface $element
     * @param int|null $count
     * @param int|null $page
     * @param array $parameters
     * @return string|RedirectResponse
     */
    public function getElementLinkForHelperForItemAction(
        AbstractEntityElementInterface $element,
        ?int                           $count = null,
        ?int                           $page = null,
        array                          $parameters = []
    )
    {
        $element_link = $this->getLink(
            $element,
            array_merge($parameters, $this->generateParametersForListOrItemAction($count, $page)),
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        if ($this->request_helper->getCurrentUrl() != $element_link) {
            return $this->redirect($element_link);
        }

        return $element_link;
    }

    /**
     * @param int|null $count
     * @param int|null $page
     * @return string|RedirectResponse
     */
    public function getListLinkForHelperForListAction(?int $count = null, ?int $page = 1)
    {
        $list_link = $this->getListLink(
            $this->generateParametersForListOrItemAction($count, $page),
            UrlGeneratorInterface::ABSOLUTE_URL
        );

        if ($this->request_helper->getCurrentUrl() != $list_link) {
            return $this->redirect($list_link);
        }

        return $list_link;
    }

    /**
     * @param int|null $page
     * @return array
     */
    public function responseLinkForListAction(?int $page = null): array
    {
        $links = [];
        $response = new Response();
        $locales = $this->container->getParameter('locales');

        if (!empty($locales)) {
            $response_link = '';
            foreach ($locales as $key => $locale) {
                $parameters['_locale'] = $locale;

                if ($page) {
                    $parameters['page'] = $page;
                }

                $link = $this->getListLink($parameters, UrlGeneratorInterface::ABSOLUTE_URL);

                $links[$locale] = $link;
                $response_link .= "<$link>; rel=\"alternate\"; hreflang=\"$locale\"";
                end($locales);

                if ($key !== key($locales)) {
                    $response_link .= ', ';
                }
            }

            $response->headers->set('Link', $response_link);
        }

        return [
            'links' => $links,
            'response' => $response
        ];
    }

    /**
     * @param AbstractEntityElementInterface $element
     * @param int|null $page
     * @return array
     */
    public function responseLinkForItemAction(AbstractEntityElementInterface $element, ?int $page = null): array
    {
        $links = [];
        $locales = [];
        $response = new Response();

        foreach ($element->getTranslations() as $locale => $translation) {
            if (
                (method_exists($translation, 'isShowOnWebsite') && $translation->isShowOnWebsite()) ||
                !method_exists($translation, 'isShowOnWebsite')
            ) {
                $locales[] = $locale;
            }
        }

        $default_locales = $this->container->getParameter('locales');

        if (!empty($locales)) {
            $response_link = '';
            foreach ($locales as $key => $locale) {
                if (!in_array($locale, $default_locales)) {
                    continue;
                }

                $parameters['_locale'] = $locale;

                if ($page) {
                    $parameters['page'] = $page;
                }

                $link = $this->getLink($element, $parameters, UrlGeneratorInterface::ABSOLUTE_URL);

                $links[$locale] = $link;
                $response_link .= "<$link>; rel=\"alternate\"; hreflang=\"$locale\"";
                end($locales);

                if ($key !== key($locales)) {
                    $response_link .= ', ';
                }
            }

            $response->headers->set('Link', $response_link);
        }

        return [
            'links' => $links,
            'response' => $response
        ];
    }
}
