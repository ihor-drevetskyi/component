<?php

namespace ComponentBundle\Dto\Traits\Date\DeadLine;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait DeadLineTrait
 * @package ComponentBundle\Dto\Traits\Date\DeadLine
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait DeadLineTrait
{
    use DeadLineMethodsTrait;

    /**
     * @var DateTime
     * @Assert\DateTime()
     */
    protected DateTime $deadLine;
}
