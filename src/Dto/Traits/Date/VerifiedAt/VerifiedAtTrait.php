<?php

namespace ComponentBundle\Dto\Traits\Date\VerifiedAt;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait VerifiedAtTrait
 * @package ComponentBundle\Dto\Traits\Date\VerifiedAt
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait VerifiedAtTrait
{
    use VerifiedAtMethodsTrait;

    /**
     * @var DateTime
     * @Assert\DateTime()
     */
    protected DateTime $verifiedAt;
}
