<?php

function setActive($path){
  return Request::is($path) ? "is-active": "nav-link" ;
}