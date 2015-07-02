#
# Use gedit or notepad++
# Don't touch this with PhpStorm
# Linux: call make in terminal :)
#
install:
	composer install
	make test

test:
	bin/phpunit --coverage-html=./web/coverage/
base:
