<?php

namespace ComponentBundle\Dto\Traits\Date\VerifiedAt;

use DateTime;

/**
 * Interface VerifiedAtMethodsInterface
 * @package ComponentBundle\Dto\Traits\Date\VerifiedAt
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
interface VerifiedAtMethodsInterface
{
    /**
     * @return bool
     */
    public function isVerified(): bool;

    /**
     * Get verifiedAt
     * @return DateTime
     */
    public function getVerifiedAt(): DateTime;

    /**
     * @param DateTime|null $verified_at
     */
    public function setVerifiedAt(?DateTime $verified_at = null): void;
}
