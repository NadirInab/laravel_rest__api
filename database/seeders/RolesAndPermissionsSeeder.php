<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // reset cached roles and permission .
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions :
        
        // define permission variable . 
        $addBook = "add Book" ;
        $updateBook = "update Book" ;
        $deleteBook = "delete Book" ;
        $viewBooks = "view Books" ;
        $viewBook = "view Book" ;
        $searchBook = "search books" ;
        $searchAuthor = "search by Author" ;

        $addGenre = "add Genre" ;
        $updateGenre = "update Genre" ;
        $deleteGenre = "delete Genre" ;

        // Book Permissions .
        Permission::create(["name" => $addBook]);
        Permission::create(["name" => $updateBook]);
        Permission::create(["name" => $deleteBook]) ;
        Permission::create(["name" => $searchAuthor]) ;
        Permission::create(["name" => $searchBook]) ;
        Permission::create(["name" => $viewBook]) ;
        Permission::create(["name" => $viewBooks]) ;

        // Genre Permissions .
        Permission::create(["name" => $addGenre]) ;
        Permission::create(["name" => $updateGenre]) ;
        Permission::create(["name" => $deleteGenre]) ;
        
        // define roles && asign role :
        // Admin
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

        // User
        Role::create(["name" => "user"])->givePermissionTo([
            $viewBooks, 
            $viewBook, 
            $searchAuthor, 
            $searchBook, 
        ]) ;

        Role::create(["name" => "receptionnist"])->givePermissionTo([
            $addBook, 
            $updateBook
        ]) ;

    }
}
