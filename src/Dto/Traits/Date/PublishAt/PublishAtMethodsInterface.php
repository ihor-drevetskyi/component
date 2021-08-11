<?php

namespace ComponentBundle\Dto\Traits\Date\PublishAt;

use DateTime;

/**
 * Interface PublishAtMethodsInterface
 * @package ComponentBundle\Dto\Traits\Date\PublishAt
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
interface PublishAtMethodsInterface
{
    /**
     * @return DateTime
     */
    public function getPublishAt(): DateTime;

    /**
     * @param DateTime|null $publish_at
     */
    public function setPublishAt(?DateTime $publish_at = null): void;
}
