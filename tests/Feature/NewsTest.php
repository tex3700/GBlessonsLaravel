<?php

namespace Tests\Feature;

use App\Models\News\Category;
use Tests\TestCase;

class NewsTest extends TestCase
{
    public function testItIndexReturnsSuccessfulResponse()
    {
        $response = $this->get('/news');

        $response->assertStatus(200);
    }

    public function testItSingleReturnsSuccessfulResponse()
    {
        $id = round(1, 20);
        $response = $this->get("/news/$id");

        $response->assertStatus(200);
    }

    public function testItCategoriesReturnsSuccessfulResponse()
    {
        $response = $this->get('/news/category');

        $response->assertStatus(200);
    }

    public function testItCategoryReturnsSuccessfulResponse()
    {
        $category = new Category();
        $slugArray = [];
        foreach ($category->getNewsCategories() as $value) {
            $slugArray[] = $value['slug'];
        }
        $slug = $slugArray[array_rand($slugArray)];
        $response = $this->get("/news/category/$slug");

        $response->assertStatus(200);
    }

    public function testItViewCanRendered()
    {
        $category = new Category();

        $view = $this->view('news.categories', ['categories' => $category->getNewsCategories()]);

        $view->assertSee('Новости политики');
    }

    public function testItTextCanRendered()
    {
        $response = $this->get('/news');
        $value = 'Новость политики 1';

        $response->assertSeeText($value, $escaped = true);
    }

}
