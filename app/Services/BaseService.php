<?php

namespace Keikaku\Services;

use Illuminate\Database\Eloquent\Model;
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
     * @param string $message
     * @return bool
     */
    protected function setBadRequest(string $message): bool
    {
        $this
            ->setError('bad_request')
            ->setErrorCode(400)
            ->setErrorDescription($message);

        return false;
    }

    /**
     * @param BaseService $service
     * @return bool
     */
    public function setErrorFromService(BaseService $service)
    {
        $this->setErrorCode($service->getErrorCode())
            ->setError($service->getError())
            ->setErrorDescription($service->getErrorDescription());
        return false;
    }

    /**
     * @param Model $entity
     * @return bool
     */
    protected function saveEntity(Model $entity): bool
    {
        try {
            return $entity->save();
        } catch (\PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                $this
                    ->setError('conflict')
                    ->setErrorCode(409)
                    ->setErrorDescription($e->getMessage());
            } else {
                $this
                    ->setError('database_error')
                    ->setErrorCode(500)
                    ->setErrorDescription($e->getMessage());
            }

            return false;
        }
    }

    /**
     * @param Model $entity
     * @return bool
     */
    protected function deleteEntity(Model $entity): bool
    {
        try {
            return $entity->delete();
        } catch (\PDOException $e) {
            $this
                ->setError('database_error')
                ->setErrorCode(500)
                ->setErrorDescription($e->getMessage());

            return false;
        }
    }

    /**
     * @param BelongsToMany $relationship
     * @param Model $toBeAttached
     * @return bool
     */
    public function attachEntities(BelongsToMany $relationship, Model $toBeAttached)
    {
        try {
            $relationship->attach($toBeAttached);
            return true;
        } catch (\Exception $e) {
            $this
                ->setError('database_error')
                ->setErrorCode(500)
                ->setErrorDescription($e->getMessage());

            return false;
        }
    }

    /**
     * @param BelongsToMany $relationship
     * @param Model $toBeDetached
     * @return bool
     */
    public function detachEntities(BelongsToMany $relationship, Model $toBeDetached)
    {
        try {
            $relationship->detach($toBeDetached);
            return true;
        } catch (\Exception $e) {
            $this
                ->setError('database_error')
                ->setErrorCode(500)
                ->setErrorDescription($e->getMessage());

            return false;
        }
    }
}