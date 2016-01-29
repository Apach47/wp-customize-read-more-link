<?php

/**
 *
 */
class RmlBindingLinkAttribute
{
    private $_list_attr;
    private $_base_plugin_directory;
    private $_deep_directory = 'core/attributes/';

    public function __construct($plugin_dir)
    {
        // Reset
        $this->_list_attr = array();

        $this->_base_plugin_directory = $plugin_dir;

        // Load

        $tmp = $this->load();
        var_dump($tmp);die;
    }


    /**
     * 
     */
    private function _full_path()
    {
        // Full path
        $full_path = $this->_base_plugin_directory . $this->_deep_directory;

        // Directory exist
        if (!file_exists($full_path) && !is_dir($full_path)) {
            throw new Exception(
                "Directory " . $full_path . " is not exist",
                1);

        }

        return $full_path;
    }

    // Autoload pre-processing
    private function _pre_autoload()
    {
        $path = $this->_full_path();

        // List of class
        $list_classes = array();

        // Load class
        $list_files = scandir($path);

        foreach ($list_files as $file_name) {
            // Skip current and parent dir
            if (($file_name === ".") || ($file_name === "..")) {
                continue;
            }

            // Remove extension ".php"
            $file_name_without_extension = str_replace(".php", "", $file_name);
            // Class not possible consist minus "-". Replace it on underscore "_"
            $class_name = str_replace("-", "_", $file_name_without_extension);
            // Full class name
            $list_classes[] = array(
                "class_name" => "rml_Link_attribute_" . $class_name,
                "file_name" => $file_name,
            );

        }

        return $list_classes;
    }

    // Load link attributes
    public function load()
    {
        $path = $this->_full_path();
        $classes = $this->_pre_autoload();

        if (!is_array($classes)) {
            throw new Exception("System wasn't loaded link attributes", 2);

        }

        foreach ($classes as $class_name) {
            var_dump($class_name);
            // Load bit of code
            require_once $path . $class_name['file_name'];
            $test = new $class_name['class_name']();
        }
    }
}
<?php

/**
 *
 */
class RmlBindingLinkAttribute
{
    /**
     * @var mixed
     */
    private $_list_attr;
    /**
     * @var mixed
     */
    private $_base_plugin_directory;
    /**
     * @var string
     */
    private $_deep_directory = 'core/attributes/';

    /**
     * @param $plugin_dir
     */
    public function __construct($plugin_dir)
    {
        // Reset
        $this->_list_attr = array();

        $this->_base_plugin_directory = $plugin_dir;

        // Load

        $tmp = $this->load();
        var_dump($tmp);die;
    }

    /**
     * @return mixed
     */
    private function _full_path()
    {
        // Full path
        $full_path = $this->_base_plugin_directory . $this->_deep_directory;

        // Directory exist
        if (!file_exists($full_path) && !is_dir($full_path)) {
            throw new Exception(
                "Directory " . $full_path . " is not exist",
                1);

        }

        return $full_path;
    }

    // Autoload pre-processing
    /**
     * @return mixed
     */
    private function _pre_autoload()
    {
        $path = $this->_full_path();

        // List of class
        $list_classes = array();

        // Load class
        $list_files = scandir($path);

        foreach ($list_files as $file_name) {
            // Skip current and parent dir
            if (($file_name === ".") || ($file_name === "..")) {
                continue;
            }

            // Remove extension ".php"
            $file_name_without_extension = str_replace(".php", "", $file_name);
            // Class not possible consist minus "-". Replace it on underscore "_"
            $class_name = str_replace("-", "_", $file_name_without_extension);
            // Full class name
            $list_classes[] = array(
                "class_name" => "rml_Link_attribute_" . $class_name,
                "file_name" => $file_name,
            );

        }

        return $list_classes;
    }

    // Load link attributes
    public function load()
    {
        $path = $this->_full_path();
        $classes = $this->_pre_autoload();

        if (!is_array($classes)) {
            throw new Exception("System wasn't loaded link attributes", 2);

        }

        foreach ($classes as $class_name) {
            var_dump($class_name);
            // Load bit of code
            require_once $path . $class_name['file_name'];
            $test = new $class_name['class_name']();
        }
    }
}
