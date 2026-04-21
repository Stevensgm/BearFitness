<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Categoria;
use App\Models\User;
use PHPUnit\Framework\Attributes\Test;

class CategoriaControllerTest extends TestCase
{
    /**
     * Este test prueba todas las funcionalidades del controlador categoriacontroller
     */
    use RefreshDatabase;

    // Configurar el entorno de pruebas antes de cada test
    protected function setUp(): void
    {
        parent::setUp();
        
        // Ejecutar los seeders para crear roles, permisos y usuarios en la base de datos de pruebas
        $this->seed(\Database\Seeders\DatabaseSeeder::class);
        

        // Elegir el usuario admin para autenticar las solicitudes
        $admin = User::where('email', 'admin@gmail.com')->first();

        // Autenticar como el usuario admin para todas las solicitudes en este test
        $this->actingAs($admin);

    }

    // Listar categorías de prueba
    #[Test]
    public function puede_listar_categorias() {

        // Crear algunas categorías de prueba
        Categoria::factory()->count(5)->create();

        // Realizar una solicitud GET a la ruta de index de categorías
        $response = $this->get(route('categoria.index'));

        // Verificar que la respuesta sea exitosa
        $response->assertStatus(200);

        // Verificar que se muestren las categorías en la vista
        $response->assertViewHas('categorias');
    }

    // Crear una categoría de prueba
    #[Test]
    public function puede_crear_una_categoria() {

    // Definir los datos de la nueva categoría
    $data=[
        'nombre' => 'Categoría de prueba',
        'descripcion' => 'Descripción de prueba',
        'status' => true,
    ];  

    // Realizar una solicitud POST a la ruta de store de categorías con los datos de la nueva categoría
    $response=$this->post(route('categoria.store'), $data);

    // Verificar que la solicitud sea exitosa y redirija a la ruta de index de categorías
    $response->assertRedirect(route('categoria.index'));

    // Verificar que la nueva categoría se haya guardado en la base de datos
    $this->assertDatabaseHas('categorias', [
        'nombre' => 'Categoría de prueba'
    ]);
    }

    // Actualizar una categoría de prueba
    #[Test]
    public function puede_actualizar_una_categoria() {

    // Crear una categoría de prueba
    $categoria=Categoria::factory()->create();

    // Definir los datos actualizados de la categoría
    $data=[
        'nombre' => 'Categoría actualizada',
        'descripcion' => 'Descripción actualizada',
        'status' => false,
    ];

    // Realizar una solicitud PUT a la ruta de update de categorías con los datos actualizados
    $response=$this->put(route('categoria.update', $categoria->id), $data);

    // Verificar que la solicitud sea exitosa y redirija a la ruta de index de categorías
    $response->assertRedirect(route('categoria.index'));

    // Verificar que la categoría se haya actualizado en la base de datos
    $this->assertDatabaseHas('categorias', [
        'id' => $categoria->id,
        'nombre' => 'Categoría actualizada'
    ]);
    }

    // Eliminar una categoría de prueba
    #[Test]
    public function puede_eliminar_una_categoria() {

    // Crear una categoría de prueba
    $categoria=Categoria::factory()->create();

    // Realizar una solicitud DELETE a la ruta de destroy de categorías
    $response=$this->delete(route('categoria.destroy', $categoria->id));

    // Verificar que la solicitud sea exitosa y redirija a la ruta de index de categorías
    $response->assertRedirect(route('categoria.index'));

    // Verificar que la categoría se haya eliminado de la base de datos
    $this->assertDatabaseMissing('categorias', [
        'id' => $categoria->id
    ]);
    }
}