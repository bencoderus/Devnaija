<?php
/*
Custom Helpers For Forum
Author: Benart
*/
if(!function_exists('checklevel'))
{
function checklevel($level)
{
if($level == 1)
{
return "Member";
}
elseif($level==2) {
return "Moderator";
}
elseif($level ==3)
{
return "Admin";
}
}
}
//check for user avatar
if(!function_exists('mydp'))
{
function mydp($name)
{
$photo=App\User::where('name', $name)->value('photo');
if(isset($photo))
{
return $photo;
}
else{
return "avatar.png";
}
}
}

if(!function_exists('myphoto'))
{
function myphoto($name)
{
$photo=App\User::where('name', $name)->value('photo');
if(isset($photo))
{
return '<img src="/storage/usersphoto/$photo" alt="avatar" class="rounded-circle" style="width: 20%">';
return $photo;
}
else{
return '<img src="/storage/usersphoto/nophoto.png" alt="avatar" class="rounded-circle" style="width: 20%">';

}
}
}
if(!function_exists('getslug'))
{
function getslug($title)
{
$slug = str_slug($title);
$num = rand(111,999);
$result = $slug ."-" .$num;
return $result;
}
}
if(!function_exists('forumslug'))
{
function forumslug($title)
{
$slug = str_slug($title);
$result = $slug;
return $result;
}
}
