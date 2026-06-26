<?php

use App\Models\User;

test('env file is not accessible publicly', function () {
    $response = $this->get('/.env');
    
    // The web server should block this, but if it hits Laravel it should be 404
    $response->assertStatus(404);
});
