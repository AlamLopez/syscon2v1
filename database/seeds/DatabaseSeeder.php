<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DepartamentosSeeder::class);
        $this->call(MunicipiosSeeder::class);
        $this->call(GeneralidadesSeeder::class);
        $this->call(TipoActividadesSeeder::class);
        $this->call(SubActividadSeeder::class);
        $this->call(ActividadesSeeder::class);
        $this->call(TipoContratosSeeder::class);
        $this->call(ControlHorasSeeder::class);
        $this->call(AcronimoSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(UnidadAcademicaSeeder::class);
    }
}
