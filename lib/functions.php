<?php

function parse_arguments(&$argv) {
  // Default options
  $defaults = array(
    'h'      => 'localhost',
    'p'      => '',
    "u"      => "root",
    "d"      => "wordpress",
    "tables" => "",
  );


  $optparser = new OptionParser;

  $optparser->addRule('help');
  $optparser->addRule('h::');
  $optparser->addRule('p::');
  $optparser->addRule('d::');
  $optparser->addRule('u::');
  $optparser->addRule('tables::');
  $optparser->addRule('help');

  try{
    $argv = $optparser->parse();
  }
  catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n\n";
    usage();

    exit(0);
  }

  if(count($argv) < 2) {
    echo "Error: missing search and replace values\n\n";
    usage();
  }

  $arguments = $optparser->getAllOptions();

  return array_merge($defaults, $arguments);
}

/**
 * Display usage information.
 */
function usage() {
?>
SRDB is a command-line tool for searching and replacing values within a database, designed
not to damage serialised objects. It is intended for use when migrating WordPress databases
but is suitable for any similar problem.

This command-line tool is almost entirely based on interconnect/it's excellent search & replace
tool:

  http://interconnectit.com/products/search-and-replace-for-wordpress-databases/

We just wanted something to run on the command-line, so we modified it.

Usage: 
  srdb [options] <search> <replace>

Arguments:

  search	          String to look for
  replace	          String to replace matches with

Options:

  -h <host> 	 	  MySQL server hostname. (Default: localhost)
  -p <password>           MySQL user's password
  -u <username>           MySQL account name (Default: root)
  -d <database>           MySQL database (Default: wordpress)
  --tables <tables>       Comma-separated list of tables to search within (Default: all tables)

<?php

  exit(0);
}
