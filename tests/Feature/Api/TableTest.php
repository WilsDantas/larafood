<?php

namespace Tests\Feature\api;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Error Get Tables By Tenant
     *
     * @return void
     */
    public function testGetAllTablesError()
    {
        $response = $this->getJson('/api/v1/tables');

        $response->assertStatus(422);
    }

    /**
     * Get Tables By Tenant
     *
     * @return void
     */
    public function testGetAllTablesByTenant()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Error Get Table By Tenant
     *
     * @return void
     */
    public function testErrorGetTablesByTenant()
    {
        $tables = "fake_value";
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$tables}?token_company={$tenant->uuid}");

        $response->assertStatus(404);
    }

    /**
     * Error Get Tables
     *
     * @return void
     */
    public function testGetTablesByTenant()
    {
        $tables = factory(Table::class)->create();
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tables/{$tables->uuid}?token_company={$tenant->uuid}");

        $response->assertStatus(200);
    }
}
