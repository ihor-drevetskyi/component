<?php

namespace ComponentBundle\Dto\Traits\Date\DeadLine;

use DateTime;

/**
 * Trait DeadLineMethodsTrait
 * @package ComponentBundle\Dto\Traits\Date\DeadLine
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait DeadLineMethodsTrait
{
    /**
     * Get deadLine
     * @return DateTime
     */
    public function getDeadLine(): DateTime
    {
        if (!$this->deadLine) {
            self::setDeadLine();
        }

        return $this->deadLine;
    }

    /**
     * @param DateTime|null $dead_line
     */
    public function setDeadLine(?DateTime $dead_line = null): void
    {
        if (!$dead_line) {
            $this->deadLine = new DateTime();
        } else {
            $this->deadLine = $dead_line;
        }
    }
}
