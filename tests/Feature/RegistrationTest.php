<?php

use App\Models\User;

it('Registration Http Check', function () {

    $response = $this->get('/registration');
    $this->get(route('registration'))->assertOk();
    $response->assertStatus(200);
});


it('Registration correct view', function() {
    // Act & Assert
    $this->get(route('registration'))
        ->assertOk()
        ->assertViewIs('pages.registration.create');
});

/*
|--------------------------------------------------------------------------
| During Store
|--------------------------------------------------------------------------
|
*/

// Validation
it('requires the name', function () {
    // $this->withoutExceptionHandling();
    $this->post(route('registration'), array_merge(userData(), ['name' =>'']))
        ->assertInvalid(['name' => 'required']);
});




