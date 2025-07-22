<?php
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function is_valid_username($name) {
    return (strlen($name) >= 3 && preg_match('/^[a-zA-Z0-9_]+$/', $name));
}

function is_valid_password($pass) {
    return strlen($pass) >= 6;
}