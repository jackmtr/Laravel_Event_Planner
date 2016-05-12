<?php

function flash($message){

	session()->flash('message', $message);
}

function popupflash($message){

	session()->flash('popup', $message);
}