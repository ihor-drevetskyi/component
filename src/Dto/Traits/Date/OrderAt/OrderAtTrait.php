<?php

namespace ComponentBundle\Dto\Traits\Date\OrderAt;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait OrderAtTrait
 * @package ComponentBundle\Dto\Traits\Date\OrderAt
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait OrderAtTrait
{
    use OrderAtMethodsTrait;

    /**
     * @var DateTime
     * @Assert\DateTime()
     */
    protected DateTime $orderAt;
}
