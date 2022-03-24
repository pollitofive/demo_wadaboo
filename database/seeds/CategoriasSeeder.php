<?php
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriasSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Categoria::create(['nombre' => 'Agricultura','slug' => Str::slug('Agricultura'), 'icon' => 'categorias/agricultura.png']);
        Categoria::create(['nombre' => 'Alimentacion y Bebidas','slug' => Str::slug('Alimentacion y Bebidas'), 'icon' => 'categorias/refrigerador.png']);
        Categoria::create(['nombre' => 'Regalos, Deportes y Juguetes','slug' => Str::slug('Regalos, Deportes y Juguetes'), 'icon' => 'categorias/deportes.png']);
        Categoria::create(['nombre' => 'Electrónica, electrodmésticos y telecomunicaciones','slug' => Str::slug('Electrónica, electrodmésticos y telecomunicaciones'), 'icon' => 'categorias/robotica.png']);
        Categoria::create(['nombre' => 'Hogar, muebles y jardín','slug' => Str::slug('Hogar, muebles y jardín'), 'icon' => 'categorias/casa.png']);
        Categoria::create(['nombre' => 'Ropa, textiles y accesorios','slug' => Str::slug('Ropa, textiles y accesorios'), 'icon' => 'categorias/camisetas.png']);
        Categoria::create(['nombre' => 'Informática y tecnología','slug' => Str::slug('Informática y tecnología'), 'icon' => 'categorias/tecnologia.png']);
        Categoria::create(['nombre' => 'Industrias y Oficinas','slug' => Str::slug('Industrias y Oficinas'), 'icon' => 'categorias/escritorio.png']);
        Categoria::create(['nombre' => 'Materiales, herramientas y construcción','slug' => Str::slug('Materiales, herramientas y construcción'), 'icon' => 'categorias/pared.png']);
        Categoria::create(['nombre' => 'Salud e Higiene','slug' => Str::slug('Salud e Higiene'), 'icon' => 'categorias/saludable.png']);
        Categoria::create(['nombre' => 'Servicios','slug' => Str::slug('Servicios'), 'icon' => 'categorias/comunicacion.png']);
        Categoria::create(['nombre' => 'Vehiculos','slug' => Str::slug('Vehiculos'), 'icon' => 'categorias/coche.png']);
        Categoria::create(['nombre' => 'Industria Metalmecánica','slug' => Str::slug('Industria Metalmecánica'), 'icon' => 'categorias/robotica.png']);
    }

}
