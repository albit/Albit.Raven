<?php
namespace Albit\Raven\Error;

use TYPO3\Flow\Error\ProductionExceptionHandler;

/**
 * Description of SentryExceptionHandler
 *
 */
class SentryExceptionHandler extends ProductionExceptionHandler {

	/**
	 * @param \Exception $exception
	 * @return void
	 */
	protected function echoExceptionWeb(\Exception $exception) {
		if (isset($this->options['sentryDsn']) && strlen($this->options['sentryDsn']) > 0) {
			$ravenClient = new \Raven_Client($this->options['sentryDsn']);
			$ravenClient->captureException($exception);
		}
		parent::echoExceptionWeb($exception);
	}
}
