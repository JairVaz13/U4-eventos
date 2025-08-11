<?php

namespace Tests\Feature;

use App\Models\Evento;
use App\Models\Asistente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventoTest extends TestCase
{
    use RefreshDatabase; // Limpia la base de datos después de cada test

    public function testCreacionEvento()
    {
        $evento = Evento::factory()->create();
        $this->assertDatabaseHas('eventos', ['id' => $evento->id]);
    }

    public function testRelacionAsistentesEvento()
    {
        $evento = Evento::factory()->create();
        $asistente = Asistente::factory()->create(['evento_id' => $evento->id]);
        $this->assertEquals($evento->id, $asistente->evento_id);
    }
}