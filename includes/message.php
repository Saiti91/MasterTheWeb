<?php
if (isset($_GET['message']) && !empty('message') && isset($_GET['type']) && !empty('type')) {
    echo '<div class="alert alert-' . htmlspecialchars($_GET['type']) . ' alert-dismissible fade show" role="alert">' . htmlspecialchars($_GET['message']) . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
?>