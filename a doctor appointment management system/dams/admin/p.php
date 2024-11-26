<?php
echo password_hash('admin123', PASSWORD_BCRYPT);
?>
UPDATE admin
SET password_hash = '$2y$10$f3pgknWv7/UHWg5GQP.ko.7b5E/9Bs1MPddYvs2HStXXRI4TXT7mu'
WHERE admin_id = 1;
