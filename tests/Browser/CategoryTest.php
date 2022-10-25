<?php

namespace Tests\Browser;

use App\Models\News\Category;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Throwable;

class CategoryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     * @throws Throwable
     */
    public function testCreateForm(): void
    {
        $category = Category::factory()->create();

        $this->browse(static function (Browser $browser) use ($category) {
            $browser->visit('/admin/category/create')
                    ->type('title', $category->title)
                    ->type('slug', $category->slug)
                    ->press('Добавить категорию')
                    ->assertPathIs('/admin/category');
        });
    }
}
