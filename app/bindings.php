<?php

App::bind('NpmWeb\Login\LoginInterface', 'NpmWeb\Login\MockLogin');
App::bind('NpmWeb\ClientValidationGenerator\ClientValidationGeneratorInterface',
	'NpmWeb\ClientValidationGenerator\Laravel\JqueryValidationGenerator');
