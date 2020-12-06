<?php

namespace App;

/**
 * Class Handler
 * @package App
 */
class Handler
{
    /**
     * @param string $query
     * @return
     */
    public function handle($query)
    {
        // Parse the query
        parse_str($query, $data);
        if ($this->checkAccessKey($data)) {
            return json_encode([
                'status' => 'error',
                'message' => 'Invalid token',
            ]);
        }

        if ($this->checkURL($data)) {
            return json_encode([
                'status' => 'error',
                'message' => 'Invalid URL',
            ]);
        }

        // Use the scraper to what is needed
        $web = new \spekulatius\phpscraper();

        // Access the URL
        try {
            $web->go($data['url']);
        } catch (\Throwable $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

        $result = [
            'title' => $web->title,
        ];

        return json_encode($result);
    }

    /**
     * Check the key for this request
     */
    protected function checkAccessKey(array $data)
    {
        return
            !isset($data['token']) ||
            file_get_contents('/var/openfaas/secrets/phpscraper-api-token') !== $data['token'];
    }

    /**
     * Check if the given string starts with http
     */
    protected function checkURL(array $data)
    {
        return !isset($data['url']) || substr($data['url'], 0, 4) !== 'http';
    }
}
