<?php

namespace ComponentBundle\Dto\Traits\Date\VerifiedAt;

use DateTime;

/**
 * Trait VerifiedAtMethodsTrait
 * @package ComponentBundle\Dto\Traits\Date\VerifiedAt
 * @author Ihor Drevetskyi <ihor.drevetskyi@gmail.com>
 */
trait VerifiedAtMethodsTrait
{
    /**
     * @return bool
     */
    public function isVerified(): bool
    {
        return null !== $this->verifiedAt;
    }

    /**
     * @return DateTime
     */
    public function getVerifiedAt(): DateTime
    {
        if (!$this->verifiedAt) {
            self::setVerifiedAt();
        }

        return $this->verifiedAt;
    }

    /**
     * @param DateTime|null $verified_at
     */
    public function setVerifiedAt(?DateTime $verified_at = null): void
    {
        if (!$verified_at) {
            $this->verifiedAt = new DateTime();
        } else {
            $this->verifiedAt = $verified_at;
        }
    }
}
