#
# Makefile for nosetests
#

all: collections core io xml	

collections:
	vendor/bin/phpunit --group collections --configuration=tests/configs/phpunit.xml

core:
	vendor/bin/phpunit --colors --group core --configuration=tests/configs/phpunit.xml

io:
	vendor/bin/phpunit --group io --configuration=tests/configs/phpunit.xml
	rm -rf /tmp/*

xml:
	vendor/bin/phpunit --group xml --configuration=tests/configs/phpunit.xml	
