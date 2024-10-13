<?php

use App\Services\RegistrationService;

beforeEach(function () {
    // Set up the service before each test
    $this->registrationService = new RegistrationService();
});


it('return object data', function () {
    // $this->withoutExceptionHandling();
    $scheduleData = $this->registrationService->getAllVaccineCenterData();
    expect($scheduleData)->toBeObject();
})->skip();

it('return date', function () {
    $scheduleData = $this->registrationService->getScheduleDate(1);
    expect($scheduleData)->toBeString();
})->skip();

it('return date null', function () {
    $scheduleData = $this->registrationService->getScheduleDate(199);
    expect($scheduleData)->toBeNull();
})->skip();

// it('Display Schedule Data', function () {
//     $scheduleData = $this->registrationService->getNextAvailableDate('2024-10-09');
//     dd($scheduleData);
// });

it('Extend next date', function () {
    $scheduleData = $this->registrationService->getNextAvailableDate('2024-10-09'); //Wednesday
    expect($scheduleData)->toBe('2024-10-10'); //Thursday
});

it('Skip Friday and Saturday and expect sunday', function () {
    $scheduleData = $this->registrationService->getNextAvailableDate('2024-10-10'); //Thursday
    expect($scheduleData)->toBe('2024-10-13'); //Sunday
});





