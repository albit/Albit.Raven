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
	 * Test the sentry configuration
	 */
	public function testConfigurationCommand() {
		$this->response->setOutputFormat(\TYPO3\Flow\Cli\Response::OUTPUTFORMAT_STYLED);
		if (isset($this->sentryDsn) && strlen($this->sentryDsn) > 0) {
			$this->response->appendContent('<p>Used Sentry DSN: ' . $this->sentryDsn . '</p>');
		} else {
			$this->response->appendContent('<p>No Sentry DSN configured</p>');
		}
	}

	/**
	 * Test the sentry exception handling
	 *
	 * @throws \Exception
	 */
	public function testExceptionCommand() {
		throw new \Exception('Sentry Test');
	}

}
