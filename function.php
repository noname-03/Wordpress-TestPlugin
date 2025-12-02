<?php

function menu_admin() {
    add_menu_page('Test Plugin Settings', 'Test Plugin', 'manage_options', 'test-plugin-settings','testingFunction', 'dashicons-welcome-view-site');
    add_submenu_page('test-plugin-settings', 'Submenu Page', 'Submenu Page', 'manage_options', 'test-plugin-submenu', 'testingSubFunction');
}

function testingFunction() {
    echo "<h1>Welcome to Test Plugin Settings Page</h1>
    <p>This is a simple settings page for the Test Plugin.</p>";
}

function testingSubFunction() {
    echo "<h1>Welcome to Test Plugin Submenu Page</h1>
    <p>This is a simple submenu page for the Test Plugin.</p>";
}

function codePlugin() {
    return "<div class='notice notice-success is-dismissible'>
        <p>This is text in plugin!</p>
    </div>";
}

function whatsAppLink($attribute) {
    $attr = shortcode_atts( array(
        'number' => '628123456789',
        'message' => 'Hai ini default message dari plugin',
        'text' => 'Chat via WhatsApp'
    ), $attribute );

    return "<a href='https://wa.me/{$attr['number']}?text=" . urlencode($attr['message']) . "' target='_blank'>{$attr['text']}</a>";
}

add_action('admin_menu', 'menu_admin');
add_shortcode('testplugin', 'codePlugin');
add_shortcode('whatsapplink', 'whatsAppLink');
?>