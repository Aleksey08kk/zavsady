<?php

namespace app\models;

use SplFileInfo;
use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpLoad extends Model{

    public $image;

    public function rules(): array
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png,txt,xlsx,pdf,docx'] 
        ];
    }


    public function uploadFile(UploadedFile $file, $currentImage): string
    {
        $this->image = $file;

        if($this->validate())
        {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
        return $this->saveImage();
    }
    
    

    public function getFolder(): string
    {
        return Yii::getAlias('@webroot') . '/uploads/';  //для загрузки фото
    }
    public function getFolderTxt(): string
    {
        return Yii::getAlias('@webroot') . '/text/';  //для загрузки txt
    }

    public function generateFilename(): string
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }

    public function deleteCurrentImage($currentImage){
        if($this->fileExists($currentImage))
        {
            @unlink(Yii::getAlias('@webroot') . '/uploads/' . $currentImage);
        }
    }

    public function fileExists($currentImage): bool
    {
            return file_exists($this->getFolder() . $currentImage);
    }

    public function saveImage(): string
    {
        $filename = $this->generateFilename();
/*
        $info = new SplFileInfo($filename);
        if($info->getExtension() == "xlsx"){
            $this->image->saveAs($this->getFolderTxt() . $filename);
        }
        */
        $this->image->saveAs($this->getFolder() . $filename);
        return $filename;
    }
}

