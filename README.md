#OpenAI-php

PHP client for https://beta.openai.com/docs/api-reference

- Guzzle client. Check examples to parse response as you wish.

Simply call composer 

``composer require omeratagunn/openai``

#Example Usage

````
$test = new OpenAI('your-key');  

// default davinci, to see other engines please visit openAI documentation//
$test->setEngineId('davinci');

try {
    $a = $test->postCompletions([
        'prompt' => "I wish i had a flying fish",
        'max_tokens' => 5,
        'temperature' => 1,
        'top_p' => 1,
        'n' => 1,
        'stream' => false,
        'logprobs' => null,
        'stop' => "\n"
    ]);

    $response = $a->getBody()->getContents();

} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    $e->getMessage();
}

try {
    $b = $test->search([
        'documents' => [
            'white house',
            'hospital',
            'school'
        ],
        'query' => "the president"
    ]);

    $response = $b->getBody()->getContents();

} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    $e->getMessage();
}



````

#License
Published under the MIT License
