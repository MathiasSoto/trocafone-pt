<?php


namespace app\lib;


interface RepositoryInterface
{
    public function create($object);

    public function update($object);

    public function delete($object);

    public function findById($id);
}