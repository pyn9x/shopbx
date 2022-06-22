<?php

namespace App\Logger;

use App\Logger\LogLevel;

class Logger implements LoggerInterface
{

	private $options =[
		"dateFormat" => 'Y-m-d H:i:s',
		"extension" => 'txt',
		"filename"=> 'log',
		"path" => '/',
	];



	/**
	 * @inheritDoc
	 */
	public function emergency($message, array $context = [])
	{
		$this->log(LogLevel::EMERGENCY,$message,$context);
	}

	/**
	 * @inheritDoc
	 */
	public function alert($message, array $context = [])
	{
		$this->log(LogLevel::ALERT,$message,$context);
	}

	/**
	 * @inheritDoc
	 */
	public function critical($message, array $context = [])
	{
		$this->log(LogLevel::CRITICAL,$message,$context);
	}

	/**
	 * @inheritDoc
	 */
	public function error($message, array $context = [])
	{
		$this->log(LogLevel::ERROR,$message,$context);
	}

	/**
	 * @inheritDoc
	 */
	public function warning($message, array $context = [])
	{
		$this->log(LogLevel::WARNING,$message,$context);
	}

	/**
	 * @inheritDoc
	 */
	public function notice($message, array $context = [])
	{
		$this->log(LogLevel::NOTICE,$message,$context);
	}

	/**
	 * @inheritDoc
	 */
	public function info($message, array $context = array())
	{
		$this->log(LogLevel::INFO,$message,$context);
	}

	/**
	 * @inheritDoc
	 */
	public function debug($message, array $context = array())
	{
		$this->log(LogLevel::DEBUG,$message,$context);
	}

	/**
	 * @inheritDoc
	 */
	public function log($level, $message, array $context = array())
	{
		$filename =$this->options['filename'];
		$extension = $this->options['extension'];
		$dateFormat = $this->options['dateFormat'];
		$path = __DIR__.$this->options['path'];


		$dateFormatted = (new \DateTime())->format($dateFormat);


		$contextString = json_encode($context);

		$message = sprintf(
			'[%s] %s: %s %s%s',
			$dateFormatted,
			$level,
			$message,
			$contextString,
			PHP_EOL
		);

		file_put_contents($path.$filename.'.'.$extension, $message, FILE_APPEND);
	}
}