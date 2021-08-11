<?php

namespace ComponentBundle\Dto\Traits\Date\OrderAt;

use DateTime;

/**
 * Trait OrderAtMethodsTrait
 * @package ComponentBundle\Dto\Traits\Date\OrderAt
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait OrderAtMethodsTrait
{
    /**
     * @return DateTime
     */
    public function getOrderAt(): DateTime
    {
        if (!$this->orderAt) {
            self::setOrderAt();
        }

        return $this->orderAt;
    }

    /**
     * @param DateTime|null $order_at
     */
    public function setOrderAt(DateTime $order_at = null): void
    {
        if (!$order_at) {
            $this->orderAt = new DateTime();
        } else {
            $this->orderAt = $order_at;
        }
    }
}
