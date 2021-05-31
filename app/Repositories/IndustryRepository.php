<?php

namespace App\Repositories;

use App\Models\Industry;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;
use App\Contracts\IndustryContract;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

/**
 * Class CategoryRepository
 *
 * @package \App\Repositories
 */
class IndustryRepository extends BaseRepository implements IndustryContract
{
    use UploadAble;

    /**
     * CategoryRepository constructor.
     * @param Industry $model
     */
    public function __construct(Industry $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listIndustries(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * @param int $id
     * @return mixed
     * @throws ModelNotFoundException
     */
    public function findIndustryById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    /**
     * @param array $params
     * @return Industry|mixed
     */
    public function createIndustry(array $params)
    {
        try {
            $collection = collect($params);

            $logo = null;

            if ($collection->has('logo') && ($params['logo'] instanceof UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], 'industries');
            }

            $merge = $collection->merge(compact('logo'));

            $industry = new Industry($merge->all());

            $industry->save();

            return $industry;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateIndustry(array $params)
    {
        $industry = $this->findIndustryById($params['id']);

        $collection = collect($params)->except('_token');

        if ($collection->has('logo') && ($params['logo'] instanceof UploadedFile)) {

            if ($industry->logo != null) {
                $this->deleteOne($industry->logo);
            }

            $logo = $this->uploadOne($params['logo'], 'industries');
        }

        $merge = $collection->merge(compact('logo'));

        $industry->update($merge->all());

        return $industry;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function deleteIndustry($id)
    {
        $industry = $this->findIndustryById($id);

        if ($industry->logo != null) {
            $this->deleteOne($industry->logo);
        }

        $industry->delete();

        return $industry;
    }
}
