# PHP Scraper as a Function

A simple [OpenFaaS](https://github.com/openfaas/faas)/[faasd](https://github.com/openfaas/faasd) wrapper around [PHP Scraper](https://github.com/spekulatius/PHPScraper). Essentially turning your scraper into a function.


## Usage

1. Fork and clone the fork.
2. Adjust the `stack.yml` file with your docker hub name.
3. Change the handler to your needs.
4. `faas-cli up --gateway http://faasd.somewhere.com:8080`.


## How to generate the secret?

1. Create a secret:

   ```bash
   echo $(head -c 16 /dev/urandom | shasum | cut -d "-" -f1) > token.txt
   ```

2. Store it on the server:

   ```bash
   faas-cli secret create phpscraper-token --from-file token.txt --gateway http://yourfaasd.somewhere.com:8080
   ```

3. Deploy as usual:

   ```bash
   faas-cli up --gateway http://yourfaasd.somewhere.com:8080
   ```


## How to develop with PHPScraper?

For more information on core functionality of PHPScraper check the [documentation](https://phpscraper.de). The tests and examples can also help understanding it better.
