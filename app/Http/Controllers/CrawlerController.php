<?php

namespace App\Http\Controllers;

use App\Book;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlerController extends Controller
{
    public function crawler()
    {
        $client = new Client();
        //  Hackery to allow HTTPS
        $guzzleclient = new \GuzzleHttp\Client([
            'timeout' => 60,
            'verify' => false,
        ]);

        for ($i = 1; $i < 17; $i++) {
            $html = file_get_html("http://www.allitebooks.com/web-development/php/page/" . $i);
            foreach ($html->find('.entry-title a') as $element) {
                $detail_html = file_get_html($element->href);
                // foreach ($detail_html->find('.main-content-inner') as $book) {
                //     echo $book->innertext;
                // }
                $title = $detail_html->find('header.entry-header h1.single-title', 0)->plaintext;
                $img = $detail_html->find('img.attachment-post-thumbnail', 0)->src;
                $content = $detail_html->find('.entry-content', 0)->innertext;
                $download_link = $detail_html->find('.download-links a', 0)->href;

                $book = new Book;
                $book->title = $title;
                $book->content = $content;
                $book->image = $img;
                $book->download_link = $download_link;

                $book->save();
            }
        }
    }

    public function crawlerDHKT()
    {
        $client = new Client();
        //  Hackery to allow HTTPS
        $guzzleclient = new \GuzzleHttp\Client([
            'timeout' => 60,
            'verify' => false,
        ]);

        for ($i = 1; $i < 17; $i++) {
            $html = file_get_html("http://www.allitebooks.com/web-development/php/page/" . $i);
            foreach ($html->find('.entry-title a') as $element) {
                $detail_html = file_get_html($element->href);
                // foreach ($detail_html->find('.main-content-inner') as $book) {
                //     echo $book->innertext;
                // }
                $title = $detail_html->find('header.entry-header h1.single-title', 0)->plaintext;
                $img = $detail_html->find('img.attachment-post-thumbnail', 0)->src;
                $content = $detail_html->find('.entry-content', 0)->innertext;
                $download_link = $detail_html->find('.download-links a', 0)->href;

                $book = new Book;
                $book->title = $title;
                $book->content = $content;
                $book->image = $img;
                $book->download_link = $download_link;

                $book->save();
            }
        }
    }
}
