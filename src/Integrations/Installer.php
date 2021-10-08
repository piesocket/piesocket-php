<?php
namespace PieSocket\Integrations;

class Installer{

  public static function scanDirectories($rootDir, $allData=array()) {
    // set filenames invisible if you want
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    // run through content of root directory
    $dirContent = scandir($rootDir);
    foreach($dirContent as $key => $content) {
        // filter all files not accessible
        $path = $rootDir.'/'.$content;
        if(!in_array($content, $invisibleFileNames)) {
            // if content is file & readable, add to array
            if(is_file($path) && is_readable($path)) {
                // save file name with path
                $allData[] = $path;
            // if content is a directory and readable, add path and name
            }elseif(is_dir($path) && is_readable($path)) {
                // recursive callback to open new directory
                $allData = self::scanDirectories($path, $allData);
            }
        }
    }

    return $allData;
  }

  public static function setupLaravel(){
    $cwd = getcwd();

    $integrationDir = __DIR__.'/Laravel';
    $files = self::scanDirectories($integrationDir);

    foreach($files as $source) {
      if ($source == '.' || $source == '..') {
        continue;
      }

      $target = $cwd."/vendor/laravel/framework/src/Illuminate/Broadcasting/".\str_replace($integrationDir."/","", $source); 
      copy(
        $source,
        $target
      );
    }
  }

}
?>