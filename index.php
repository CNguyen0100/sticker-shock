<?php
# Graham L.:
# I researched various implementations of MVC patterns in PHP and eventually
# came across this GitHub repo: https://github.com/panique/mini
# It was, as it purported to be, a barebones application that implemented the
# design pattern fairly well.

# Graham L.:
# This currently only has the database connection string.
require './application/conf/config.php';

# Graham L.:
# All super classes should be required here. Trying to declare a class twice
# will throw an error so it's better to marginally increase overhead by just
# requiring them all up front and not have to worry about potential conflicts
# down the road.
require './application/class/Application.php';
require './application/class/Controller.php';
require './application/class/Model.php';
require './application/class/Enum.php';

$app = new Application();
