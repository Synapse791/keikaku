<?php

namespace Keikaku\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Keikaku\Contracts\Services\ServiceErrors;

class BaseService implements ServiceErrors
{
    /** @var string */
    private $error;

    /** @var string */
    private $errorDescription;

    /** @var integer */
    private $errorCode;

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     * @return $this
     */
    protected function setError(string $error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return string
     */
    public function getErrorDescription(): string
    {
        return $this->errorDescription;
    }

    /**
     * @param string $errorDescription
     * @return $this
     */
    protected function setErrorDescription(string $errorDescription)
    {
        $this->errorDescription = $errorDescription;

        return $this;
    }

    /**
     * @return int
     */
    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     * @return $this
     */
    protected function setErrorCode(int $errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * Shortcut to set 400 Bad Request error
     *
     * @param string|array $message
     * @return bool
     */
    public function setBadRequestError($message)
    {
        $this
            ->setError('bad_request')
            ->setErrorCode(400)
            ->setErrorDescription($message);
        return false;
    }

    /**
     * Shortcut to set 404 Not Found error
     *
     * @param string|array $message
     * @return bool
     */
    public function setNotFoundError($message)
    {
        $this
            ->setError('not_found')
            ->setErrorCode(404)
            ->setErrorDescription($message);
        return false;
    }

    /**
     * Shortcut to set 409 Conflict error
     *
     * @param string|array $message
     * @return bool
     */
    public function setConflictError($message)
    {
        $this
            ->setError('conflict')
            ->setErrorCode(409)
            ->setErrorDescription($message);
        return false;
    }

    /**
     * Shortcut to set 500 Internal Server error
     *
     * @param string|array $message
     * @return bool
     */
    public function setInternalServerError($message)
    {
        $this
            ->setError('internal_server_error')
            ->setErrorCode(500)
            ->setErrorDescription($message);
        return false;
    }

    /**
     * Tries to save an entity
     *
     * @param Model $entity
     * @param null $conflictMessage
     * @return bool
     */
    public function saveEntity($entity, $conflictMessage = null)
    {
        try {
            $entity->save();
            return true;
        } catch (\PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate entry'))
                return is_null($conflictMessage)
                    ? $this->setConflictError(get_class($entity) . ' already exists')
                    : $this->setConflictError($conflictMessage);
            return $this->setInternalServerError($e->getMessage());
        }
    }

    /**
     * Tries to delete an entity
     *
     * @param Model $entity
     * @return bool
     */
    public function deleteEntity($entity)
    {
        try {
            $entity->delete();
            return true;
        } catch (\PDOException $e) {
            return $this->setInternalServerError($e->getMessage());
        }
    }

    /**
     * Tries to associate an entity with a relationship
     *
     * @param BelongsTo $relationship
     * @param Model $entity
     * @return bool
     */
    public function associateEntities(BelongsTo $relationship, Model $entity)
    {
        try {
            $relationship->associate($entity);
            return true;
        } catch (\PDOException $e) {
            return $this->setInternalServerError($e->getMessage());
        }
    }

    /**
     * Tries to dissociate a relationship
     *
     * @param BelongsTo $relationship
     * @return bool
     */
    public function dissociateEntities(BelongsTo $relationship)
    {
        try {
            $relationship->dissociate();
            return true;
        } catch (\PDOException $e) {
            return $this->setInternalServerError($e->getMessage());
        }
    }

    /**
     * Tries to attach an entity to a relationship
     *
     * @param BelongsToMany $relationship
     * @param Model $entity
     * @return bool
     */
    public function attachEntities(BelongsToMany $relationship, Model $entity)
    {
        try {
            $relationship->attach($entity);
            return true;
        } catch (\PDOException $e) {
            return $this->setInternalServerError($e->getMessage());
        }
    }
    
    /**
     * Tries to detach an entity to a relationship
     *
     * @param BelongsToMany $relationship
     * @param Model $entity
     * @return bool
     */
    public function detachEntities(BelongsToMany $relationship, Model $entity)
    {
        try {
            $relationship->detach($entity);
            return true;
        } catch (\PDOException $e) {
            return $this->setInternalServerError($e->getMessage());
        }
    }
}