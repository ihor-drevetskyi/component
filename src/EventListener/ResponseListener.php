<?php

namespace ComponentBundle\EventListener;

use Symfony\Component\HttpKernel\Kernel;
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
        if (strpos(Kernel::VERSION, '4.4') === false) {
            if (!$event->isMainRequest()) {
                return;
            }
        } else {
            if (!$event->isMasterRequest()) {
                return;
            }
        }

        $response = $event->getResponse();
        $response->headers->add(['Vary' => 'User-Agent']);
    }
}
