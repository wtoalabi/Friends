<?php 
namespace App\Helpers\Presenters;

Trait StatusPresenter{
    public function createdAt (){
         return $this->created_at->diffForHumans();
    }
    public function collapsed(){
         return str_limit($this->body, 45);
    }

    public function latestStatus(){
        return $this->statuses()->latest()->first();
    }

    public function statusesCount(){
        $status =  str_plural("Status", $count = $this->statuses()->count());
        return "$status: $count";
    }
}