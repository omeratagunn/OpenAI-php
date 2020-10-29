<?php
$test = new OpenAI('your-key');
$test->setEngineId('davinci');

try {
    $test->retrieveEngine();
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    $e->getMessage();
}
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
$b = $test->search([
    'documents' => [
        'white house',
        'hospital',
        'school'
    ],
    'query' => "the president"
]);
$response = $a->getBody()->getContents();
$response = $b->getBody()->getContents();
