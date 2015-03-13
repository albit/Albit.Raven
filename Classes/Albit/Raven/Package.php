<?php
namespace Albit\Raven;

use TYPO3\Flow\Package\Package as BasePackage;
use TYPO3\Flow\Utility\Files as Files;

/**
 * The Albit.Raven Package
 *
 */
class Package extends BasePackage {

        /**
        * Invokes custom PHP code directly after the package manager has been initialized.
        *
        * @param \TYPO3\Flow\Core\Bootstrap $bootstrap The current bootstrap
        * @return void
        */
        public function boot(\TYPO3\Flow\Core\Bootstrap $bootstrap) {
                include_once Files::concatenatePaths(array(FLOW_PATH_PACKAGES, 'Libraries/raven/raven/lib/Raven/Autoloader.php'));
                \Raven_Autoloader::register();
        }
}
