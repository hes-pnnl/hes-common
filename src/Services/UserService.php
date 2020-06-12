<?php


namespace HESCommon\Services;


class UserService extends Service
{
    /**
     * ROLE_* constants represent roles that a user can have assigned to them.
     * These must also be present in the Admin DB's `role` table.
     */
    const ROLE_ASSESSOR = 'assessor';
    const ROLE_ADMIN = 'administrator';
    const ROLE_PARTNER = 'partner';
    const ROLE_MENTOR = 'mentor';
    const ROLE_QA = 'qa';
    const ROLE_TRAINING_ADMIN = 'training_administrator';

    /**
     * These roles are special roles assigned to assessors, and are determined
     * based on an assessor's training status and the time since the assessor
     * last assessed an official home. They are not in the `role` table, but are
     * instead calculated automatically by the users_roles_and_statuses view.
     */
    const ROLE_CANDIDATE_ASSESSOR = 'candidate_assessor';
    const ROLE_TRAINEE_ASSESSOR = 'trainee_assessor';
    const ROLE_LAPSED_ASSESSOR = 'lapsed_assessor';
    const ROLE_INACTIVE_ASSESSOR = 'inactive_assessor';
    const ROLE_MENTEE = 'mentee_assessor';

    /**
     * Roles that can be assigned to an assessor - depending on their training
     * status and the time since they last assessed a home, a user assigned the
     * "Assessor" role in the GUI will actually be assigned one of these roles.
     */
    const ASSESSOR_ROLES = [
        self::ROLE_ASSESSOR,
        self::ROLE_CANDIDATE_ASSESSOR,
        self::ROLE_TRAINEE_ASSESSOR,
        self::ROLE_MENTEE,
        self::ROLE_INACTIVE_ASSESSOR,
        self::ROLE_LAPSED_ASSESSOR
    ];
}