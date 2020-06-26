<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Pjax\Middleware\FilterIfPjax;
use Symfony\Component\DomCrawler\Crawler;

class Pjax extends FilterIfPjax
{

     /**
     * @param \Illuminate\Http\Response $response
     * @param string                    $container
     *
     * @return $this
     */
    protected function filterResponse(Response $response, $container)
    {
        $crawler = $this->getCrawler($response);

        $response->setContent(
            $this->makeTitle($crawler).
            $this->fetchContainer($crawler, $container)
            //.$this->fetchScripts($crawler)
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     *
     * @return string
     */
    protected function fetchScripts(Crawler $crawler)
    {
        $html = '';
        $content = $crawler->filter('script');
        $content->each(function($node, $i) use($html){
            $html .= dd($node);
        });
//dd($content->count());
        return $content->html();
    }

}
