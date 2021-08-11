<?php

namespace ComponentBundle\Dto\Traits\Active\ShowOnMain;

/**
 * Trait ShowOnMainMethodsTrait
 * @package ComponentBundle\Dto\Traits\Active\ShowOnMain
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait ShowOnMainMethodsTrait
{
    /**
     * @return bool
     */
    public function isShowOnMain(): bool
    {
        return $this->showOnMain;
    }

    /**
     * @param bool $showOnMain
     */
    public function setShowOnMain(bool $showOnMain): void
    {
        $this->showOnMain = $showOnMain;
    }
}
