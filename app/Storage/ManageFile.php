<?php

namespace App\Storage;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Contracts\ManageFile as ManageFileInterface;

class ManageFile implements ManageFileInterface
{
	public function store($file, $name, $destinationPath, $oldFile)
	{
		$filename = '';

        if(!empty($oldFile)){
            $this->delete($destinationPath, $oldFile);
        }

        $extension = $file->file->extension();
        $filename = str_slug($name).'.'.$extension;
        $file->file->storeAs($destinationPath, $filename);           
        
        return $filename;
	}

    public function delete($destinationPath, $file)
    {
    	if(File::exists($destinationPath.'/'.$file)){
            File::delete($destinationPath.'/'.$file);
        }
    }
}	