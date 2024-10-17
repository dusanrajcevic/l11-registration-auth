<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\LoginRequest;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginRequestTest extends TestCase
{
    use RefreshDatabase;

    // Required
    #[TestWith(['login'])]
    // Required
    #[TestWith(['password'])]
    public function test_validation_fails_if_not_provided(string $field): void
    {
        $validator = $this->getRequiredValidator($field);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey($field, $validator->errors()->toArray());
    }

    public function test_validation_passes_for_provided_values(): void
    {
        $validator = $this->getRequiredValidator();

        $this->assertFalse($validator->fails());
    }
    private function getRequiredValidator(string $field = '', string $value = ''): \Illuminate\Validation\Validator
    {
        $request = new LoginRequest();
        $request->merge([
            'login' => $field === 'login' ? $value : 'someusername',
            'password' => $field === 'password' ? $value : 'A3dkO@PlnkUv',
        ]);

        return Validator::make($request->all(), $request->rules());
    }
}
