<?php

use Timber\Timber;

$context = Timber::context([]);
Timber::render('pages/index.twig', $context);
