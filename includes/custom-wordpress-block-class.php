<?php

/**
 * CustomWordPressBlock class for creating custom WordPress Gutenberg blocks.
 */
class CustomWordPressBlock
{
    /**
     * CustomWordPressBlock constructor.
     *
     * @param string        $name          The block name.
     * @param callable|null $renderCallback The render callback function. Default is null.
     * @param array|null    $data          The data to localize the script with. Default is null.
     * @param array         $options       Additional options for the block type registration. Default is an empty array.
     */
    function __construct($name, $renderCallback = null, $data = null, $options = [])
    {
        $this->name = $name; // Add this line to define the $name property
        $this->data = $data;
        $this->dir = $name;
        $this->renderCallback = $renderCallback;
        $this->options = $options;
        add_action('init', [$this, 'onInit']);
    }

    /**
     * Custom render callback for the block.
     *
     * @param array  $attributes The block attributes.
     * @param string $content    The block content.
     *
     * @return string The rendered content.
     */
    function ourRenderCallback($attributes, $content)
    {
        ob_start();
        require_once plugin_dir_path(dirname(__FILE__)) . "src/blocks/{$this->dir}/block.php";
        return ob_get_clean();
    }

    /**
     * Handles the 'init' hook for WordPress.
     */
    function onInit()
    {
        wp_register_script($this->name, plugin_dir_url(dirname(__FILE__)) . "build/blocks/{$this->dir}/index.js", array('wp-blocks', 'wp-editor'), false, true);

        if ($this->data) {
            wp_localize_script($this->name, $this->name, $this->data);
        }

        $ourArgs = array_merge([
            'editor_script' => $this->name
        ], $this->options);

        if ($this->renderCallback) {
            $ourArgs['render_callback'] = [$this, 'ourRenderCallback'];
        }
        register_block_type("custom-blocks/{$this->name}", $ourArgs);
    }
}
