<?php

namespace ComponentBundle\EventListener;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ResponseListener
 * @package WeatherBundle\EventListener
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
final class ResponseListener implements EventSubscriberInterface
{
    /**
     * @return string[][]
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse']
        ];
    }

    /**
     * @param ResponseEvent $event
     */
    public function onKernelResponse(ResponseEvent $event)
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $response = $event->getResponse();
        $response->headers->add(['Vary' => 'User-Agent']);
    }
}
