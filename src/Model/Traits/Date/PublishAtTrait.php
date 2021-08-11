<?php

namespace ComponentBundle\Model\Traits\Date;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ComponentBundle\Dto\Traits\Date\PublishAt\PublishAtMethodsTrait;

/**
 * Trait PublishAtTrait
 * @package ComponentBundle\Model\Traits\Date
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait PublishAtTrait
{
    use PublishAtMethodsTrait;

    /**
     * @var DateTime
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @ORM\Column(name="publish_at", type="datetime", nullable=false)
     */
    protected DateTime $publishAt;
}
