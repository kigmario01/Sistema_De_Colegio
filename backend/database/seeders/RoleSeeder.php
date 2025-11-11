<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'admin',
            'docente',
            'estudiante',
        ];

        $permissions = [
            'view estudiantes', 'create estudiantes', 'update estudiantes', 'delete estudiantes',
            'view docentes', 'create docentes', 'update docentes', 'delete docentes',
            'view calificaciones', 'create calificaciones', 'update calificaciones',
            'view asistencias', 'create asistencias', 'update asistencias',
            'view aulas', 'create aulas', 'update aulas', 'delete aulas',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            if ($roleName === 'admin') {
                $role->givePermissionTo(Permission::all());
            }
            if ($roleName === 'docente') {
                $role->givePermissionTo([
                    'view estudiantes', 'view calificaciones', 'create calificaciones', 'update calificaciones',
                    'view asistencias', 'create asistencias', 'update asistencias',
                ]);
            }
        }
    }
}
