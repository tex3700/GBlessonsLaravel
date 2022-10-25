<?php

namespace App\Services;

use App\Models\News\Category;
use App\Models\News\News;
use App\Services\Contracts\Parser;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{

    private string $link;

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getParseData(): array
    {
        $xml = XmlParser::load($this->link);

        return $xml->parse([
            'title' => [
                'uses' => 'channel.title'
            ],
            'link' => [
                'uses' => 'channel.link'
            ],
            'description' => [
                'uses' => 'channel.description'
            ],
            'image' => [
                'uses' => 'channel.image.url'
            ],
            'news' => [
                'uses' => 'channel.item[category,title,link,guid,description,pubDate,enclosure::url]'
            ]
        ]);
    }

    public function updateOrCreateNews(array $load): string
    {
        foreach ($load['news'] as $arrayNews) {

                $category = Category::updateOrCreate([
                    'title' => $arrayNews['category']
                ], [
                    'title' => empty($arrayNews['category']) ? 'no category' : $arrayNews['category'],
                    'slug' => Str::slug($arrayNews['category'], '-'),
                ]);

                News::updateOrCreate([
                    'title' => $arrayNews['title']
                ], [
                    'category_id' => $category->id,
                    'title' => $arrayNews['title'],
                    'text' => $arrayNews['description'],
                    'isPrivate' => '0',
                    'image' => $arrayNews['enclosure::url'],
                    'link' => $arrayNews['link'],
                    'pubDate' => $arrayNews['pubDate'],
                ]);
        }

        return route('admin.news.index', [
            'success' => __('messages.admin.news.update.success'),
        ]);
    }
}
