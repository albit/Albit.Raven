<?php

namespace Albit\Raven\Command;

use TYPO3\Flow\Annotations as Flow;

/**
 * @Flow\Scope("singleton")
 */
class SentryCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * Configuration settings
	 *
	 * @var string
	 * @Flow\Inject(setting="error.exceptionHandler.sentryDsn", package="TYPO3.Flow")
	 */
	protected $sentryDsn;

	/**
	 * SentryExceptionHandler
	 *
	 * @var \Albit\Raven\Error\SentryExceptionHandler
	 * @Flow\Inject
	 */
	protected $sentryExceptionHandler;

	/**
	 * Test the sentry configuration
	 */
	public function testConfigurationCommand() {
		$this->response->setOutputFormat(\TYPO3\Flow\Cli\Response::OUTPUTFORMAT_STYLED);
		if (isset($this->sentryDsn) && strlen($this->sentryDsn) > 0) {
			$this->response->appendContent('Used Sentry DSN: ' . $this->sentryDsn . PHP_EOL);
		} else {
			$this->response->appendContent('No Sentry DSN configured' . PHP_EOL);
		}
	}

	/**
	 * Test the sentry capture
	 */
	public function testCaptureCommand() {
		if (isset($this->sentryDsn) && strlen($this->sentryDsn) > 0) {
			$ravenClient = new \Raven_Client($this->sentryDsn);
			$ravenClient->captureMessage('Sentry Test');
			$this->response->appendContent('Sentry "captureMessage" executed' . PHP_EOL);
		} else {
			$this->response->appendContent('Sentry "captureMessage" NOT executed' . PHP_EOL);
		}
	}

}
