<?php

namespace App\Constants;

class Permissions
{
    // Permissões de jobs
    public const VIEW_JOB      = 'view_job';
    public const CREATE_JOB    = 'create_job';
    public const EDIT_JOB      = 'edit_job';
    public const DELETE_JOB    = 'delete_job';
    public const MOVE_JOB      = 'move_job';
    public const ARCHIVE_JOB   = 'archive_job';

    // Permissões de usuários
    public const VIEW_USER     = 'view_user';
    public const CREATE_USER   = 'create_user';
    public const EDIT_USER     = 'edit_user';
    public const DELETE_USER   = 'delete_user';

    // Permissões de clientes
    public const VIEW_CLIENT   = 'view_client';
    public const CREATE_CLIENT = 'create_client';
    public const EDIT_CLIENT   = 'edit_client';
    public const DELETE_CLIENT = 'delete_client';

    // Permissões de cargos
    public const VIEW_ROLE     = 'view_role';
    public const CREATE_ROLE   = 'create_role';
    public const EDIT_ROLE     = 'edit_role';
    public const DELETE_ROLE   = 'delete_role';
}
