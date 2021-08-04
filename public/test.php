<?php

function getClasses($path, $classes)
{
    $dHandler = opendir($path);
    while (($file = readdir($dHandler)) !== false) {
        if ($file == "." || $file == "..") continue;
        if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
            $classes = getClasses($path . DIRECTORY_SEPARATOR . $file, $classes);
        } else {
            $class = str_replace(".php", "", $file);
            $namespace = getNameSpace($path . DIRECTORY_SEPARATOR . $file);
            $classes[] = [
                'name' => $class,
                'namespace' => $namespace,
            ];
        }
    }
    closedir($dHandler);
    return $classes;
}

function getNameSpace($file)
{
    $handle = fopen($file, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            if (strpos($line, "namespace") !== false) {
                return trim(str_replace(["namespace", ";"], "", $line));
            }
        }
        fclose($handle);
    }
}

function getDefaultNamespace($classes)
{
    $defaultNamespace = "";
    foreach ($classes as $class) {
        if ($class['name'] == "Controller") {
            $defaultNamespace = $class['namespace'];
        }
    }
    return $defaultNamespace;
}

function getNameAndFullClasses($classes, $default)
{
    $list = [];
    foreach ($classes as $class) {
        if ($class['name'] == "Controller") continue;
        $namespace = removeDefaultNamespace($class['namespace'], $default);
        $list[] = [
            'name' => changeDirectoryToDots($namespace) . "." . $class['name'],
            'fullClass' => $class["namespace"] . "\\" . $class['name']
        ];
    }
    return $list;
}

function removeDefaultNamespace($namespace, $default)
{
    return trim(str_replace($default . "\\", "", $namespace));
}

function changeDirectoryToDots($namespace)
{
    return str_replace("\\", ".", $namespace);
}

$path = __DIR__ . '/../app/Controllers/';
$classes = getClasses($path, []);
$default = getDefaultNamespace($classes);
print_r(getNameAndFullClasses($classes, $default));
