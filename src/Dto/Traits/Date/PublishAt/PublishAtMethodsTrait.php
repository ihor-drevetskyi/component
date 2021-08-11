<?php

namespace ComponentBundle\Dto\Traits\Date\PublishAt;

use DateTime;

/**
 * Trait PublishAtMethodsTrait
 * @package ComponentBundle\Dto\Traits\Date\PublishAt
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait PublishAtMethodsTrait
{
    /**
     * @return DateTime
     */
    public function getPublishAt(): DateTime
    {
        if (!$this->publishAt) {
            self::setPublishAt();
        }

        return $this->publishAt;
    }

    /**
     * @param DateTime|null $publish_at
     */
    public function setPublishAt(?DateTime $publish_at = null): void
    {
        if (!$publish_at) {
            $this->publishAt = new DateTime();
        } else {
            $this->publishAt = $publish_at;
        }
    }
}
