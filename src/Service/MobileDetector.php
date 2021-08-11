<?php

namespace ComponentBundle\Service;

use ComponentBundle\Helper\DeviceView;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class MobileDetector
 * @package ComponentBundle\Service
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
class MobileDetector
{
    /**
     * @var object|\SunCat\MobileDetectBundle\DeviceDetector\MobileDetector|null
     */
    protected $mobile_detector;

    /**
     * @var DeviceView
     */
    protected DeviceView $device_view;

    /**
     * MobileDetector constructor.
     * @param ContainerInterface $container
     * @param DeviceView $device_view
     */
    public function __construct(
        ContainerInterface $container,
        DeviceView         $device_view
    )
    {
        $this->device_view = $device_view;
        $this->mobile_detector = $container->get(\SunCat\MobileDetectBundle\DeviceDetector\MobileDetector::class);
    }

    /**
     * Проверка является ли текущий ДЕВАЙС мобильным
     * не учитывает куку, для проверки куки, какой view, использовать isMobileView()
     * @return boolean
     */
    public function isMobile(): bool
    {
        $is_mobile = $this->device_view->isMobileView();
        if (!$is_mobile) {
            $is_mobile = $this->mobile_detector->isMobile();
        }

        return $is_mobile;
    }
}
