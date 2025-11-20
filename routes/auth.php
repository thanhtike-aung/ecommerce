<?php

// This file is now split into separate auth files for admin and customer
// See routes/auth/admin.php and routes/auth/customer.php

// Include the admin auth routes
require __DIR__.'/auth/admin.php';

// Include the customer auth routes
require __DIR__.'/auth/customer.php';
