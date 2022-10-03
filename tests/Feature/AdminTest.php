<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminTest extends TestCase
{
    public function testItIndexReturnsSuccessfulResponse()
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }

    public function testItCreateReturnsSuccessfulResponse()
    {
        $response = $this->get('/admin/create');

        $response->assertStatus(200);
    }

    public function testItExportReturnsSuccessfulResponse()
    {
        $response = $this->get('/admin/export');

        $response->assertStatus(200);
    }

}
