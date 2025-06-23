<?php

namespace App\Http\Controllers\Interfaces;

interface IGetModelEx
{

    const ERROR_INTERNAL_ERROR = 'Internal error';
    const ERROR_NOT_FOUND = 'Not found';

    const MSG_CREATE_OKAY = 'Created successfully';
    const MSG_DELETE_OKAY = 'Deleted successfully';
    const MSG_DESTROY_OKAY = 'Destroyed successfully';
    const MSG_DESTROY_FAILED = 'Not destroyable at this time, still referenced';
    const MSG_UPDATE_OKAY = 'Updated successfully';
    const MSG_SYNC_OKAY = 'Synced successfully';

    // public function getId(): string;
    //
    // public function getModel(): Model|HasOneOrMany|BelongsToRelationship|BelongsToMany;
    //
    // public function getResource(): string;
    //
    // public function getModelOrRelationship(): Model|HasOneOrMany|BelongsToRelationship|BelongsToMany;
}
