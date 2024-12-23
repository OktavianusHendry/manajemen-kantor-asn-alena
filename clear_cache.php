<?php
// Create a file named clear_cache.php in public_html
echo shell_exec('php manajemen.oktavianus.xyz/artisan config:clear');
echo shell_exec('php manajemen.oktavianus.xyz/artisan cache:clear');
echo shell_exec('php manajemen.oktavianus.xyz/artisan view:clear');
echo shell_exec('php manajemen.oktavianus.xyz/artisan route:clear');
?>
