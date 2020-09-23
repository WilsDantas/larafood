<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    /**
     * Test Get All Tenants
     *
     * @return void
     */
    public function testGetAllTenants()
    {
        factory(Tenant::class, 10)->create();

        $response = $this->getJson('/api/v1/tenants');

        // $response->dump();

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    /**
     * Test Get Error Single Tenants
     *
     * @return void
     */
    public function testErrorGetTenant()
    {
        // factory(Tenant::class, 10)->create();

        $tenant = 'fake_value';

        $response = $this->getJson("/api/v1/tenants/{$tenant}");

        // $response->dump();

        $response->assertStatus(404);
    }

    /**
     * Test Get Single Tenants
     *
     * @return void
     */
    public function testgetTenantByIdentify()
    {
        $tenant = factory(Tenant::class)->create();

        $response = $this->getJson("/api/v1/tenants/{$tenant->uuid}");

        // $response->dump();

        $response->assertStatus(200);
    }


}
