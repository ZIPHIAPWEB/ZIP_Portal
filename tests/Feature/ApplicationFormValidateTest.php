<?php

namespace Tests\Feature;

use App\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApplicationFormValidateTest extends TestCase
{
    private function actingAsSanctumUser(): void
    {
        // Use an in-memory user instance to avoid DB dependency
        $user = new User([ 'name' => 'Tester', 'email' => 'tester@example.com' ]);
        Sanctum::actingAs($user);
    }

    public function test_requires_authentication()
    {
        $resp = $this->postJson('api/application-forms/validate?step=1', []);
        $resp->assertStatus(401);
    }

    public function test_step1_validation_success()
    {
        $this->actingAsSanctumUser();

        $payload = [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'birthDate' => '2000-01-01',
            'gender' => 'Male',
            'permanentAddress' => '123 Main St',
            'provincialAddress' => 'Some Province',
            'homeNumber' => '1234567',
            'mobileNumber' => '09171234567',
            'skypeId' => 'john.alt@example.com',
            'fbLink' => 'https://facebook.com/john',
        ];

    $resp = $this->postJson('api/application-forms/validate?step=1', $payload);
    $resp->assertStatus(200);
    $this->assertSame('true', $resp->getContent());
    }

    public function test_step1_validation_fails_when_missing_required()
    {
        $this->actingAsSanctumUser();

        $payload = [
            // 'firstName' missing
            'lastName' => 'Doe',
            'birthDate' => '2000-01-01',
            'gender' => 'Male',
            'permanentAddress' => '123 Main St',
            'provincialAddress' => 'Some Province',
            'homeNumber' => '1234567',
            'mobileNumber' => '09171234567',
            'skypeId' => 'john.alt@example.com',
            'fbLink' => 'https://facebook.com/john',
        ];

        $resp = $this->postJson('api/application-forms/validate?step=1', $payload);
        $resp->assertStatus(422)->assertJsonValidationErrors(['firstName']);
    }

    public function test_step2_validation_success()
    {
        $this->actingAsSanctumUser();

        $payload = [
            'schoolId' => 1,
            'degree' => 'BSCS',
            'address' => 'Campus Ave',
            'startDate' => '2020-06-01',
            'yearLevel' => 'Third Year',
            'dateGraduated' => '2024-05-31',
            'secondarySchool' => 'Some High School',
            'secondaryAddress' => 'HS Address',
            'secondaryStartDate' => '2014-06-01',
            'secondaryEndDate' => '2018-03-31',
        ];

    $resp = $this->postJson('api/application-forms/validate?step=2', $payload);
    $resp->assertStatus(200);
    $this->assertSame('true', $resp->getContent());
    }

    public function test_step2_validation_fails_when_secondary_missing()
    {
        $this->actingAsSanctumUser();

        $payload = [
            'schoolId' => 1,
            'degree' => 'BSCS',
            'address' => 'Campus Ave',
            'startDate' => '2020-06-01',
            'yearLevel' => 'Third Year',
            // secondary fields missing
        ];

        $resp = $this->postJson('api/application-forms/validate?step=2', $payload);
        $resp->assertStatus(422)->assertJsonValidationErrors([
            'secondarySchool', 'secondaryAddress', 'secondaryStartDate', 'secondaryEndDate'
        ]);
    }

    public function test_step3_accepts_nullable_parent_fields()
    {
        $this->actingAsSanctumUser();

        // Empty body should pass because all are nullable
    $resp = $this->postJson('api/application-forms/validate?step=3', []);
    $resp->assertStatus(200);
    $this->assertSame('true', $resp->getContent());
    }

    public function test_step4_validates_work_experience_array_success()
    {
        $this->actingAsSanctumUser();

        $payload = [
            [
                'companyName' => 'ABC Corp',
                'companyAddress' => '123 Biz St',
                'startDate' => '2022-01-01',
                'endDate' => '2022-06-01',
                'jobDescription' => 'Internship',
            ],
            [
                'companyName' => 'XYZ Inc',
                'companyAddress' => '789 Work Rd',
                'startDate' => '2023-02-01',
                'endDate' => '2023-05-01',
                'jobDescription' => 'Part-time',
            ],
        ];

    $resp = $this->postJson('api/application-forms/validate?step=4', $payload);
    $resp->assertStatus(200);
    $this->assertSame('true', $resp->getContent());
    }

    public function test_step4_fails_when_enddate_before_startdate()
    {
        $this->actingAsSanctumUser();

        $payload = [
            [
                'companyName' => 'ABC Corp',
                'companyAddress' => '123 Biz St',
                'startDate' => '2022-06-01',
                'endDate' => '2022-01-01',
                'jobDescription' => 'Internship',
            ],
        ];

        $resp = $this->postJson('api/application-forms/validate?step=4', $payload);
        $resp->assertStatus(422)->assertJsonValidationErrors(['0.endDate']);
    }
}
