<?php

use Behat\Behat\Context\ClosuredContextInterface,
	Behat\Behat\Context\TranslatedContextInterface,
	Behat\Behat\Context\BehatContext,
	Behat\Behat\Context\Step,
	Behat\Behat\Exception\PendingException,
	Behat\Behat\Event\ScenarioEvent;

use Behat\Gherkin\Node\PyStringNode,
	Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;


/**
 * Features context.
 */
class FeatureContext extends MinkContext {

	/**
	 * Take screenshot when step fails. Works only with Selenium2Driver.
	 * Screenshot is saved at [Date]/[Feature]/[Scenario]/[Step].png
	 *
	 * @TODO Add a check if WebDriver Session fully works.
	 *
	 * @AfterStep @javascript
	 */
	public function takeScreenshotAfterFailedStep(Behat\Behat\Event\StepEvent $event) {
		if ($event->getResult() === Behat\Behat\Event\StepEvent::FAILED) {
			$driver = $this->getSession()->getDriver();
			if ($driver instanceof Behat\Mink\Driver\Selenium2Driver) {
				$step = $event->getStep();
				$path = array(
					'date' => date("Ymd-Hi"),
					'feature' => $step->getParent()->getFeature()->getTitle(),
					'scenario' => $step->getParent()->getTitle(),
					'step' => $step->getType() . ' ' . $step->getText()
				);
				$path = preg_replace('/[^\-\.\w]/', '_', $path);
				$filename = '/tmp/behat-screenshots/' .  implode('/', $path) . '.png';

				// Create directories if needed
				if (!@is_dir(dirname($filename))) {
					@mkdir(dirname($filename), 0775, TRUE);
				}

				file_put_contents($filename, $driver->getScreenshot());
				#echo sprintf('[NOTICE] A screenshot was saved to %s %s', $filename, PHP_EOL);
			}
		}
	}
}
