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
    public function commentsCount(){
        $comment =  str_plural("Comment", $count = $this->comments_count);
        return "$count $comment";
    }
    public function getSize ($count){
         if($count == 2 ||$count ==4 ){
             return 4;
         }
            elseif($count ==3||$count ==5||$count ==8){
                return 3;
                }
            elseif($count == 6||$count ==7||$count ==10){
             return 4;
            }
            elseif($count ==9){
                return 5;
            }
            return 1;
    }
}