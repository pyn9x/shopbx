<?php

namespace App\Lib;

class Response
{
	protected $code = 200;
	protected $reason = "";
	protected $headers = [];
	protected $body = "";

	public static function error(int $code, string $reason)
	{
		$instance = new static();
		$instance->code = $code;
		$instance->reason = $reason;
		return $instance;
	}

	public static function text(string $text): Response
	{
		$instance = new static();
		$instance->body = $text;
		return $instance;
	}

	public static function json(array $data): Response
	{
		$instance = new static();
		$instance->body = json_encode($data);
		$instance->headers['Content-Type'] = 'application/json';
		return $instance;
	}

	public function flush()
	{
		$this->writeHeaders();
		$this->writeResponseBody();
	}

	protected function writeHeaders()
	{
		if ($this->code != 200)
		{
			header("HTTP/1.1 {$this->code} {$this->reason}");
		}
		foreach ($this->headers as $header => $value)
		{
			header("{$header}: $value");
		}
	}

	protected function writeResponseBody()
	{
		echo $this->body;
	}
}
