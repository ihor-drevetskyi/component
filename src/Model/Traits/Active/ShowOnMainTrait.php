<?php

namespace ComponentBundle\Model\Traits\Active;

use Doctrine\ORM\Mapping as ORM;
use ComponentBundle\Dto\Traits\YesOrNoInterface;
use ComponentBundle\Dto\Traits\Active\ShowOnMain\ShowOnMainMethodsTrait;

/**
 * Trait ShowOnMainTrait
 * @package ComponentBundle\Model\Traits\Active
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait ShowOnMainTrait
{
    use ShowOnMainMethodsTrait;

    /**
     * @var boolean
     * @ORM\Column(name="show_on_main", type="boolean", nullable=false, options={"default" : 0})
     */
    protected bool $showOnMain = YesOrNoInterface::NO;
}
