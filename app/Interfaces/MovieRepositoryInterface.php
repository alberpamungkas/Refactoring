<?php

namespace App\Interfaces;

interface MovieRepositoryInterface
{
    public function create(array $data);
    public function update($id, array $data);
    public function getAll($search = null);
    public function findById($id);
    public function delete($id);
}
