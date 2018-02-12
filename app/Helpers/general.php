<?php

function setActive($path){
  return Request::is($path) ? "active nav-link": "nav-link" ;
}