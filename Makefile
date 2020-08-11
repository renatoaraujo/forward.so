.PHONY: test
test:
	bin/phpunit --configuration ./phpunit.xml --bootstrap ./tests/bootstrap.php