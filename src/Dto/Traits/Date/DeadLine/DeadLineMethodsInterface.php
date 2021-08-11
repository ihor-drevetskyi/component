<?php

namespace ComponentBundle\Dto\Traits\Date\DeadLine;

use DateTime;

/**
 * Interface DeadLineMethodsInterface
 * @package ComponentBundle\Dto\Traits\Date\DeadLine
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
interface DeadLineMethodsInterface
{
    /**
     * Get deadLine
     * @return DateTime
     */
    public function getDeadLine(): DateTime;

    /**
     * @param DateTime|null $dead_line
     */
    public function setDeadLine(?DateTime $dead_line = null): void;
}
