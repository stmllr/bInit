# bInit: A kickstarter package for a basic Behat/Mink environment

This packages serves to kickstart projects using Behat/Mink for your convenience.

## Getting started and installed

* Fetch this git repository:

		git clone git://github.com/t3node/bInit.git

* Install Behat+Mink with composer:

		curl http://getcomposer.org/installer | php
		php composer.phar install

* Set the URL to your web application in `base_url` of behat.yml
* Install PhantomJS from http://phantomjs.org/download.html if you want full headless support
* Optionally install a WebDriver instance (see below)
* Add your feature descriptions

## Executing the Behat scenarios

bInit comes with a basic feature example to demonstrate that it just works :)

On the command line, run

	bin/behat

If your web application demands JavaScript support, you need dedicated test clients as described in the following sections.


## Setting up browser test clients

### PhantomJS standalone example configuration

Start PhantomJS listening on a webdriver (ghostdriver) compatible interface:

	path/to/bin/phantomjs --webdriver=127.0.0.1:8910

### Selenium server example configurations

Download and install Selenium2 Server (WebDriver) from http://docs.seleniumhq.org/download/

#### Basic setup

Start a basic instance

	java -jar selenium-server-standalone-2.32.0.jar

#### Alternative grid setup

Start hub:

	java -jar selenium-server-standalone-2.32.0.jar -role hub

Start node for Chrome:

	java -jar selenium-server-standalone-2.32.0.jar -role node -port 5555 -browser browserName=chrome,version=26,maxInstances=1

Start node for Firefox:

	java -jar selenium-server-standalone-2.32.0.jar -role node -port 5556 -browser browserName=firefox,version=20,maxInstances=1

Start node for PhantomJS:

	path/to/bin/phantomjs --webdriver=127.0.0.1:8910 --webdriver-selenium-grid-hub=http://127.0.0.1:4444

Watch your grid setup at http://localhost:4444/grid/console

Now try again to execute Behat, by using one of the following profiles:

## Executing the Behat scenarios with alternative profiles

### Use PhantomJS standalone (you need to start PhantomJS standalone as described above)

	bin/behat --profile phantomjs-standalone

### Use a real browser via Selenium2 grid (you need to start Selenium2 grid and/or nodes as described above)

	bin/behat --profile firefox-via-webdriver
	bin/behat --profile chrome-via-webdriver

### Use a headless browser via Selenium2 grid (you need to start Selenium2 grid and PhantomJS node as described above)

	bin/behat --profile phantomjs-via-webdriver

### Use profile for running in a continuous integration environment (logs result to /tmp/junit)

	bin/behat --profile ci
