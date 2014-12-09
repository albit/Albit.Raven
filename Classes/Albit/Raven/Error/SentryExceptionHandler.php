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
		if ($exception instanceof \TYPO3\Flow\Exception) {
			$statusCode = $exception->getStatusCode();
		}
		if ($statusCode !== 404) {
			if (isset($this->options['sentryDsn']) && strlen($this->options['sentryDsn']) > 0) {
				$ravenClient = new \Raven_Client($this->options['sentryDsn']);
				$ravenClient->captureException($exception);
			}
		}
		parent::echoExceptionWeb($exception);
	}

	/**
	 * @param \Exception $exception
	 * @return void
	 */
	protected function echoExceptionCli(\Exception $exception) {
		if (isset($this->options['sentryDsn']) && strlen($this->options['sentryDsn']) > 0) {
			$ravenClient = new \Raven_Client($this->options['sentryDsn']);
			$ravenClient->captureException($exception);
		}
		parent::echoExceptionCli($exception);
	}
}
