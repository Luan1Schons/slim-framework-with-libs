<?php

namespace SlimMonsterKit\Providers;

use DI\Container;

class RegisterControllers
{
    private $container;
    private $path;
    private $classes;
    private $default;

    public function __construct(Container $container, string $path = null)
    {
        $this->container = $container;
        $this->path = is_null($path) ? __DIR__ . '/../Controllers' : $path;
        $this->classes = [];
        $this->getClasses($this->path);
        $this->getDefaultNamespace();
    }

    private function getClasses($path)
    {
        $dHandler = opendir($path);
        while (($file = readdir($dHandler)) !== false) {
            if ($file == "." || $file == "..") continue;
            if (is_dir($path . DIRECTORY_SEPARATOR . $file)) {
                $this->getClasses($path . DIRECTORY_SEPARATOR . $file);
            } else {
                $class = str_replace(".php", "", $file);
                $namespace = $this->getNameSpace($path . DIRECTORY_SEPARATOR . $file);
                array_push($this->classes, [
                    'name' => $class,
                    'namespace' => $namespace,
                ]);
            }
        }
        closedir($dHandler);
    }

    private function getNameSpace($file)
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

    private function getDefaultNamespace()
    {
        foreach ($this->classes as $class) {
            if ($class['name'] == "Controller") {
                $this->default = $class['namespace'];
                break;
            }
        }
    }

    public function register()
    {
        foreach ($this->classes as $class) {
            if ($class['name'] == "Controller") continue;

            $nameClass = $this->getNameClass($class) . "." . $class['name'];
            $fullClass = $class["namespace"] . "\\" . $class['name'];

            $this->container->set(
                $nameClass,
                function ($c) use ($fullClass) {
                    return new $fullClass($c);
                }
            );
        }
    }

    private function removeDefaultNamespace($value)
    {
        return trim(str_replace($this->default . "\\", "", $value));
    }

    private function replaceSlashesToDots($value)
    {
        return str_replace("\\", ".", $value);
    }

    private function getNameClass($class)
    {
        return $this->replaceSlashesToDots($this->removeDefaultNamespace($class['namespace']));
    }
}
