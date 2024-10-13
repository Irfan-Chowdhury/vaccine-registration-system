<?php

use App\Services\RegistrationService;

beforeEach(function () {
    // Set up the service before each test
    $this->registrationService = new RegistrationService();
});


it('return object data', function () {
    $scheduleData = $this->registrationService->getAllVaccineCenterData();
    expect($scheduleData)->toBeObject();
});

it('return string date', function () {
    $scheduleData = $this->registrationService->getScheduleDate(1);
    expect($scheduleData)->toBeString();
});
it('return null', function () {
    $scheduleData = $this->registrationService->getScheduleDate(1234234);
    expect($scheduleData)->toBeNull();
});
test('Expect today if not today is Friday or Saturday', function () {
    $date = $this->registrationService->getScheduleDate(1);
    expect($date)->toBe(date('Y-m-d'));
});

it('Extend next date', function () {
    $scheduleData = $this->registrationService->getNextAvailableDate('2024-10-09'); //Wednesday
    expect($scheduleData)->toBe('2024-10-10'); //Thursday
});

it('Skip Friday and Saturday and expect sunday', function () {
    $scheduleData = $this->registrationService->getNextAvailableDate('2024-10-10'); //Thursday
    expect($scheduleData)->toBe('2024-10-13'); //Sunday
});









