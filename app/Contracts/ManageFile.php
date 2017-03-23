<?php
namespace App\Contracts;

interface ManageFile
{
    public function store($request, $name, $destinationPath, $oldFile);
    public function delete($destinationPath, $file);

}