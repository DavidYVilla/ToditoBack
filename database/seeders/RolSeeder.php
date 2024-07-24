<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Cajero']);


        Permission::create(['name' => 'dashboard'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.update'])->syncRoles([$role1]);

        Permission::create(['name' => 'categorias.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'categorias.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'categorias.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'categorias.estado'])->syncRoles([$role1]);

        Permission::create(['name' => 'productos.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'productos.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'productos.estado'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'clientes.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clientes.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'clientes.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'clientes.estado'])->syncRoles([$role1]);

        Permission::create(['name' => 'proovedor.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'proovedor.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'proovedor.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'proovedor.estado'])->syncRoles([$role1]);

        Permission::create(['name' => 'compra.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'compra.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'compra.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'compra.estado'])->syncRoles([$role1]);

        Permission::create(['name' => 'venta.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'venta.create'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'venta.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'venta.estado'])->syncRoles([$role1]);




    }
}
