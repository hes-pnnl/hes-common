<?php


namespace HESCommon\Services;


class UserService extends Service
{
    /**
     * ROLE_* constants represent roles that a user can have assigned to them. These must also be present in the
     * Admin DB's `role` table.
     */
    const ROLE_ASSESSOR = 'assessor';
    const ROLE_ADMIN = 'administrator';
    const ROLE_PARTNER = 'partner';
    const ROLE_MENTOR = 'mentor';
    const ROLE_MENTEE = 'mentee_assessor';
    const ROLE_QA = 'qa';
    const ROLE_TRAINING_ADMIN = 'training_administrator';

    /**
     * @return array
     */
    public function getValidRoles() : array
    {
        return [
            self::ROLE_ASSESSOR,
            self::ROLE_ADMIN,
            self::ROLE_PARTNER,
            self::ROLE_MENTOR,
            self::ROLE_MENTEE,
            self::ROLE_QA,
            self::ROLE_TRAINING_ADMIN
        ];
    }
}