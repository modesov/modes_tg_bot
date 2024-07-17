<?php

namespace App;

use App\SourceInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RzhuSource implements SourceInterface
{
    private string $url;

    private const CATEGORIES = [
        'anecdote' => 1
    ];

    public function __construct(
        private HttpClientInterface $httpClient,
        private string $category
    )
    {
        $categoryId = self::CATEGORIES[$this->category];
        $this->url = 'http://rzhunemogu.ru/RandJSON.aspx?CType=' . $categoryId;
    }

    public function getPost(): string
    {
        while (empty($joke)) {
            $response = $this->httpClient->request('GET', $this->url);
            $content = str_replace("\r\n", '<br>', mb_convert_encoding($response->getContent(), "utf-8", "windows-1251"));
            $joke = json_decode(preg_replace('/[\x{3164}]/u', '', $content), true)['content'];
            $joke = str_replace('<br>', "\n", $joke);
            if (empty($joke)) {
                sleep(3);
            }
        }

        return $joke . "\n\n 🤡🙃😆😂";
    }
}