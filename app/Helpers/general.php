<?php

function setActive($path){
    if(url()->current() == $path){
        return "is-active";
    }  
    else{
        return '';
    }
}