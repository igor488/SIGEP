<?php
function formatDate($date) {
    return !empty($date) ? date('d/m/Y', strtotime($date)) : '-';
}

function sanitizeInput($value) {
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}
?>
