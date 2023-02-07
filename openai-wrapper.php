<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class OpenAIWrapper
{
    private $api_key;

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
    }

    public function listModels()
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $ch = curl_init();
//	curl_setopt($ch, CURLOPT_VERBOSE, true);
//	curl_setopt($ch, CURLOPT_STDERR, fopen('php://stderr', 'w'));
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/models');
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function listModel($model)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/models/$model");
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function createCompletion($model,$prompt,$max_tokens,$temperature,$n)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $data = [
		'model' => "$model",
		'prompt' => "$prompt",
		'max_tokens' => $max_tokens,
		'temperature' => $temperature,
		'n' => $n
//		'suffix' => ''
//		'top_p' => ''
//		'stream' => ''
//		'logprobs' => ''
//		'echo' => ''
//		'stop' => ''
//		'presence_penalty' => '',
//		'frequency_penalty' => '',
//		'best_of' => '',
//		'logit_bias' => '',
//		'user' => ''
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function generateEdits($model,$input,$instruction,$n,$temperature)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $data = [
		'model' => "$model",
		'input' => "$input",
		'instruction' => "$instruction",
		'n' => $n,
		'temperature' => $temperature
//		'top_p' => $top_p
	];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/edits");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function generateImage($prompt,$n,$size,$response_format,$user)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

	$data = [
		'prompt' => "$prompt",
		'n' => $n,
		'size' => "$size",
		'response_format' => "$response_format",
		'user' => "$user"
	];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/images/generations");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function generateImageEdit($image,$mask,$prompt,$n,$size,$response_format,$user)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

	$data = [
		'image' => "$image",
		'mask' => "$mask",
		'prompt' => "$prompt",
		'n' => $n,
		'size' => $size,
		'response_format' => "$response_format",
		'user' => "$user"
	];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/images/edits");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function generateImageVariation($image,$n,$size,$response_format,$user)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

	$data = [
		'image' => "$image",
		'n' => $n,
		'size' => "$size",
		'response_format' => "$response_format",
		'user' => "$user"
	];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/variations");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function createEmbedding()
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

	$data = [
		'model' => "$model",
		'input' => "$input",
		'user' => "$user"
	];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/embeddings");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function listFiles()
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/files");
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function uploadFile($file,$purpose)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

	$data = [
		'file' => "$file",
		'purpose' => "$purpose"
	];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/edits");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function deleteFile($file_id)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

	$data = [
		'file_id' => "$file_id"
	];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/files/$file_id");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function retrieveFile($file_id)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/files/$file_id");
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function retrieveFileContent($file_id)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/files/$file_id/content");
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function fineTunes($training_file,$validation_file,$model,$n_epochs,$batch_size)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

	$data = [
		'training_file' => "$training_file",
		'validation_file' => "$validation_file",
		'model' => "$model",
		'n_epochs' => "$n_epochs",
		'batch_size' => "$batch_size",
//		'learning_rate_multiplier' => "$learning_rate_multiplier",
//		'prompt_loss_weight' => "$prompt_loss_weight",
//		'compute_classification_metrics' => "$compute_classification_metrics",
//		'classification_n_classes' => "$classification_n_classes",
//		'classification_positive_class' => "$classification_positive_class",
//		'classification_betas' => "$classification_betas",
//		'suffix' => "$suffix"
	];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/fine-tunes");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function listFineTunes()
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/");
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function retrieveFineTune($fine_tune_id)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/fine-tunes/$fine_tune_id");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function cancelFineTune($fine_tune_id)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

	$data = [
		'fine_tune_id' => "$fine_tune_id"
	];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/fine-tunes/$fine_tune_id/cancel");

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function listFineTuneEvents($fine_tune_id)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/fine-tunes/$fine_tune_id/events");
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function deleteFineTune($model_id)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/models/$model_id");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }
    public function moderations($input,$model)
    {
        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer '.$this->api_key
        ];

	$data = [
		'input' => "$input",
		'model' => "$model"
	];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/moderations");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response);
        return $result;
    }

}



$api_key = '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';
$openai = new OpenAIWrapper($api_key);

$model = 'text-davinci-003';
$prompt = 'What is the meaning of life?';

//$var = $openai->listModels();
//print_r($var);

//$var = $openai->listModel('text-davinci-003');
//print_r($var);

//$var = $openai->createCompletion('text-davinci-003', 'This is sample prompt text', 500, 0.7, 1);
//print_r($var);

//$var = $openai->listFiles();
//print_r($var);

// Examples Below
/**
    $models = $openai-> listModels();
    $model = $openai-> listModel('text-davinci-003');
    $completion = $openai-> createCompletion('text-davinci-003','Sample prompt',500,0.7,1);
    $edit = $openai-> generateEdits('text-davinci-003','input text','Instructions',1,0.7);
    $image = $openai-> generateImage('a picture of a rainbow',1,'256x256','url','Jackson.D');
    $imageEdit = $openai-> generateImageEdit('image.png','mask.png','a gold coin',1,'256x256','url','Jackson.D');
    $imageVariation = $openai-> generateImageVariation('image.png',1,'256x256','url','Jackson.D');
    $embedding = $openai-> createEmbedding();
    $files = $openai-> listFiles();
    $uploadFile = $openai-> uploadFile('file.json','search');
    $deleteFile = $openai-> deleteFile(5);
    $retrieveFile = $openai-> retrieveFile(4);
    $retrieveFileContent = $openai-> retrieveFileContent(3);
    $fineTunes = $openai-> fineTunes('training_file.json','validation_file.json','text-davinci-003',4,2);
    $listFineTunes = $openai-> listFineTunes();
    $retrieveFineTunes = $openai-> retrieveFineTune(3);
    $cancelFineTune = $openai-> cancelFineTune(2);
    $listFineTuneEvents = $openai-> listFineTuneEvents(6);
    $deleteFineTune = $openai-> deleteFineTune(5);
    $moderation = $openai-> moderations('sample text to moderate before sending to completion', 'text-davinci-003');



**/

# Written by Jackson.D, ironically with very little help from OpenAI.
