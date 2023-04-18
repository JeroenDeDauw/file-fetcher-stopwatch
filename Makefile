.PHONY: ci test phpunit cs stan

DEFAULT_GOAL := ci

ci: test cs

test: phpunit

cs: phpcs stan

phpunit:
	./vendor/bin/phpunit

phpcs:
	./vendor/bin/phpcs -p -s

stan:
	./vendor/bin/phpstan analyse --level=1 --no-progress src/ tests/

