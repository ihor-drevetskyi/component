<?php

namespace ComponentBundle\Dto\Traits\Date\PublishAt;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait PublishAtTrait
 * @package ComponentBundle\Dto\Traits\Date\PublishAt
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait PublishAtTrait
{
    use PublishAtMethodsTrait;

    /**
     * @var DateTime
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    protected DateTime $publishAt;
}
