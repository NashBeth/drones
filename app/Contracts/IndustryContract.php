<?php

namespace App\Contracts;

/**
 * Interface IndustryContract
 * @package App\Contracts
 */
interface IndustryContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listIndustries(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findIndustryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createIndustry(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateIndustry(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteIndustry($id);
}
