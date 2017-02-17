<?php

use Illuminate\Database\Seeder;

use Ultraware\Roles\Models\Role;
use App\User;

class RolesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        
        $id = DB::table('users')->insertGetId(
            ['email' => 'juan@paracaballeros.co', 'password' => bcrypt('pcR4585ñspsd!'), 'created_at' => $date, 'updated_at' => $date]
        );
        
        $user = User::find($id);
        
        DB::table('caballeros')->insert(
            ['user_id' => $id, 'pais' => 'Colombia', 'nombre' => 'Juan Sebastian Rodríguez León', 'created_at' => $date, 'updated_at' => $date]
        );
        
        $adminRole = Role::create([
            'name' => 'Administrador',
            'slug' => 'administrador',
            'description' => '',
            'level' => 100,
        ]);

        $userRole = Role::create([
            'name' => 'Usuario',
            'slug' => 'usuario',
            'description' => '',
            'level' => 1,
        ]);

        $modRole = Role::create([
            'name' => 'Moderador',
            'slug' => 'moderador',
            'description' => '',
            'level' => 2,
        ]);

        $user -> attachRole($adminRole);
        
        $usuario = DB::table('users')->insertGetId(
            ['email' => 'Dummy@dummy.com', 'password' => bcrypt('dummy123'), 'created_at' => $date, 'updated_at' => $date]
        );
        
        $usuariouser = User::find($usuario);
        
        DB::table('caballeros')->insert(
            ['user_id' => $usuario, 'pais' => 'Colombia', 'nombre' => 'Dummy Gonzales', 'created_at' => $date, 'updated_at' => $date]
        );
        
        $usuariouser -> attachRole($userRole);

        $moderador = DB::table('users')->insertGetId(
            ['email' => 'Moderador@dummy.com', 'password' => bcrypt('ModEraDor4658we'), 'created_at' => $date, 'updated_at' => $date]
        );
        
        $moduser = User::find($moderador);
        
        DB::table('caballeros')->insert(
            ['user_id' => $moderador, 'pais' => 'Colombia', 'nombre' => 'Moderador Orales', 'created_at' => $date, 'updated_at' => $date]
        );

        $moduser -> attachRole($modRole);
    }
}
