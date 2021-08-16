<?php

namespace App\Repositories;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function paginateSortedDatetime($perPage = 10);
}