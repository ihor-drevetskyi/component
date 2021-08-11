<?php

namespace ComponentBundle\Model\Traits\Date;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ComponentBundle\Dto\Traits\Date\VerifiedAt\VerifiedAtMethodsTrait;

/**
 * Trait VerifiedAtTrait
 * @package ComponentBundle\Model\Traits\Date
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait VerifiedAtTrait
{
    use VerifiedAtMethodsTrait;

    /**
     * @var DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="verified_at",type="datetime", nullable=true)
     */
    protected DateTime $verifiedAt;
}
