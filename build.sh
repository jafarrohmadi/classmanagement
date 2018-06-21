#!/bin/sh
./vendor/bin/phpmd app html ruleset.xml > ./storage/build_results/phpmd.html
./vendor/bin/phpcs app --standard=PSR1,PSR2 --report-width=120 --report-file=./storage/build_results/phpcs.txt
