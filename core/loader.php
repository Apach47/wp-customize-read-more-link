<?php

namespace RMLcustomizer\Core;

/**
 *
 */
abstract class Loader
{
    // List was loaded file
    private $_list_files_loaded = [];

    protected function __construct()
    {}

    /**
     * Start loading in modules: attr or content
     */
    abstract public function load();

    /**
     * Search and
     *
     * @folder string
     *
     * @return array
     */
    protected function _search($folder)
    {
        if (!is_dir($folder) && !file_exists($folder)) {
            throw new Exception("Invalid path", 1);

        }

        foreach (new \DirectoryIterator($folder) as $file) {
            if ($file->isDot()) {
                // Skip '.' and '..' folder
                continue;
            }

            // File name without .php extension
            $file_name = $file->getBasename('.php');

            // Convert file name to class name
            $class_name = strtoupper(substr($file_name, 0, 1)) . strtolower(substr($file_name, 1));
            $class_name = str_replace('-', '_', $class_name);

            // One file is one class
            $this->_list_files_loaded[$folder . $file->getBasename()] = $class_name;
        }

        if (empty($this->_list_files_loaded)) {
            return false;
            //throw new Exception("Not found file for loading", 1);

        }

        return true;
    }

    protected function _init($namespace_loaded, $basic_type)
    {
        $result = [];

        foreach ($this->_list_files_loaded as $class_name) {
            $full_class_name = $namespace_loaded . $class_name;
            $loaded_object = new $full_class_name;

            if ($loaded_object instanceof $basic_type) {
                $result[] = $loaded_object->get();
            }
        }

        return $result;
    }
}
