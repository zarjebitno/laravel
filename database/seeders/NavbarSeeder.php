<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $routeArray = array(
        [
            'name' => 'Home',
            'route' => 'home',
            'isAdmin' => 0
        ],
        [
            'name' => 'About',
            'route' => 'about',
            'isAdmin' => 0
        ],
        [
            'name' => 'Contact',
            'route' => 'contact',
            'isAdmin' => 0
        ],  
        [
            'name' => 'Admin Panel',
            'route' => 'admin.index',
            'isAdmin' => 1
        ],
    );

    public function run()
    {
        foreach($this->routeArray as $route) {
            \DB::table('navbar')->insert([
                'route_name' => $route['name'],
                'route_href' => $route['route'],
                'isAdmin' => $route['isAdmin']
            ]);
        }
    }
}
