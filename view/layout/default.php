<?php

/**
 * This is the DEFAULT layout.
 * This file will call all subparts of the template in the correct order.
 * All subparts are placed in the frontend directory at the same level.
 *
 * Calling order:
 *   1 - header.php
 *   2 - top.php
 *   3 - main.php
 *   4 - bottom.php
 *   5 - footer.php
 *
 * @package BSmarty
 * @version 1.1
 */

require_once ROOT.DS.'view'.DS.'layout'.DS.'frontend'.DS.'header.php';
require_once ROOT.DS.'view'.DS.'layout'.DS.'frontend'.DS.'top.php';
require_once ROOT.DS.'view'.DS.'layout'.DS.'frontend'.DS.'main.php';
require_once ROOT.DS.'view'.DS.'layout'.DS.'frontend'.DS.'bottom.php';
require_once ROOT.DS.'view'.DS.'layout'.DS.'frontend'.DS.'footer.php';
