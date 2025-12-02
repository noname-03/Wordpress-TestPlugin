<?php

function menu_admin() {
    add_menu_page('Test Plugin Settings', 'Test Plugin', 'manage_options', 'test-plugin-settings','testingFunction', 'dashicons-welcome-view-site');
    add_submenu_page('test-plugin-settings', 'Submenu Page', 'Submenu Page', 'manage_options', 'test-plugin-submenu', 'testingSubFunction');
    add_submenu_page('test-plugin-settings', 'Setting Whatsapp', 'Setting Whatsapp', 'manage_options', 'setting-whatsapp', 'settingWhatsAppFunction');
}

function testingFunction() {
    echo "<h1>Welcome to Test Plugin Settings Page</h1>
    <p>This is a simple settings page for the Test Plugin.</p>";
}

function testingSubFunction() {
    echo "<h1>Welcome to Test Plugin Submenu Page</h1>
    <p>This is a simple submenu page for the Test Plugin.</p>";
}

function settingWhatsAppFunction() {
    if (isset($_POST['testing_whatsapp_number']) && isset($_POST['testing_default_message']) && isset($_POST['testing_button_text']) && $_POST['testing_whatsapp_number'] != '' && $_POST['testing_default_message'] != '' && $_POST['testing_button_text'] != '') {
        update_option('testing_whatsapp_number', sanitize_text_field($_POST['testing_whatsapp_number']));
        update_option('testing_default_message', sanitize_text_field($_POST['testing_default_message']));
        update_option('testing_button_text', sanitize_text_field($_POST['testing_button_text']));
    }
    echo "<h1>Setting WhatsApp Page</h1>
    <p>Configure your WhatsApp settings here.</p>
    <form method='post' action=''>
    nomor WhatsApp: <input type='text' name='testing_whatsapp_number' value='" . get_option('testing_whatsapp_number') . "'><br><br>
    Button Text: <input type='text' name='testing_button_text' value='" . get_option('testing_button_text') . "'><br><br>
    Pesan Default: <textarea name='testing_default_message'>" . get_option('testing_default_message') . "</textarea><br><br>
    <input type='submit' name='save_settings' value='Save Settings'>
    ";
}

function codePlugin() {
    return "<div class='notice notice-success is-dismissible'>
        <p>This is text in plugin!</p>
    </div>";
}

function whatsAppLink($attribute) {
    $testing_whatsapp_number = get_option('testing_whatsapp_number') ?? 'Silakan isi nomor WhatsApp';
    $testing_default_message = get_option('testing_default_message') ?? 'Silakan isi pesan default';
    $testing_button_text = get_option('testing_button_text') ?? 'Chat via WhatsApp';

    $attr = shortcode_atts( array(
        'number' => $testing_whatsapp_number,
        'message' => $testing_default_message,
        'text' => $testing_button_text
    ), $attribute );

    return "<a href='https://wa.me/{$attr['number']}?text=" . urlencode($attr['message']) . "' target='_blank'>{$attr['text']}</a>";
}

add_action('admin_menu', 'menu_admin');
add_shortcode('testplugin', 'codePlugin');
add_shortcode('whatsapplink', 'whatsAppLink');
?>