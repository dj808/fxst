<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/28
 * Time: 16:07
 */

namespace App\Observer;


use App\Zhenggg\Auth\Database\Menu;
use App\Zhenggg\Auth\Database\Permission;

class MenuObserver
{
//    public function saved()
//    {
//        $menus = Menu::all();
//        Permission::truncate();
//        $menus->each(function ($menu, $key) {
//            Permission::create([
//                'id'  => $menu->id,
//                'name'  => $menu->title,
//                'order'  => $menu->order,
//                'slug'  => $menu->uri,
//                'parent_id'  => $menu->parent_id,
//                'user_id'  => \Front::user()->user_id,
//            ]);
//        });
//
//    }
}