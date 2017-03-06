<?php

namespace AppBundle\Enum;


abstract class RoleType extends BaseEnum
{

    const AGENCY_MANAGER = "ROLE_RESPONSABLE_AGENCE";
    const ADMIN          = "ROLE_ADMIN";
    const SUPER_ADMIN    = "ROLE_SUPER_ADMIN";
}