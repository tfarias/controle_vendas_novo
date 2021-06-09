<?php

namespace Tests\Tray;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Migration Test
 * - On this test we will check if you know how to:
 *
 * 1. Create migration
 * 2. Setup Columns
 * 3. Create Relationships and Indexes
 *
 * @package Tests\Feature\Cart
 */
class MigrationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create tipo_pessoa table
     *
     * @test
    */
    public function create_tipo_pessoa_table()
    {
        $this->assertTrue(
            Schema::hasTable('vendedor')
        );
    }

    /**
     * @test
     */
    public function create_columns_vendedor()
    {
        $this->assertTrue(
            Schema::hasColumns('vendedor', [
                'id',
                'nome',
                'email',
                'created_at',
                'updated_at',
                'deleted_at'
            ])
        );
    }

    /**
     * Create venda table
     *
     * @test
     */
    public function create_venda_table()
    {
        $this->assertTrue(
            Schema::hasTable('venda')
        );
    }

    /**
     * @test
     */
    public function create_columns_venda()
    {
        $this->assertTrue(
            Schema::hasColumns('venda', [
                'id',
                'vendedor_id',
                'valor',
                'data',
                'created_at',
                'updated_at',
                'deleted_at'
            ])
        );
    }

}
