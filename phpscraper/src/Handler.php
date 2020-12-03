<?php

namespace App;

/**
 * Class Handler
 * @package App
 */
class Handler
{
    /**
     * @param $data
     * @return
     */
    public function handle($data)
    {
        $web = new \spekulatius\phpscraper();

        // Navigate to the test page - this one doesn't contain a title-tag.
        $web->go('https://test-pages.phpscraper.de/meta/lorem-ipsum.html');

        return $web->title;
    }
}
