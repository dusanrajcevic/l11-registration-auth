<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationRequestTest extends TestCase
{
    use RefreshDatabase;

    // Required
    #[TestWith(['username'])]
    // Min 3 characters
    #[TestWith(['username', 'ss'])]
    // Max 255 characters
    #[TestWith(['username', 'jZZgOlO7NHg4ULqYeQh6TOqlw9MAJyxdeueuSRDHjc4vnkOGsEABzFJzSXkUXv5Ggk4EOA4XYK3mpCkzhxgeD0S2sWLmCHk4Ody5El8276JIE4si2rinRSn3u3L6aBJYHEZEOrIOeQXXisuKvulIb25T97xNwB6kWIBg51Wmo2maXxatQklw17KJSj8Ci2rKJOeQgABfWpBJbPpjWOHwigxTIssnkKP67SSvX3wZ63wrETsNDMMvAsLKUayO10s2'])]
    // Required
    #[TestWith(['email'])]
    // Wrong e-mail
    #[TestWith(['email', 'wrongemail'])]
    // Required
    #[TestWith(['password'])]
    // Minimum 8 characters
    #[TestWith(['password', 'passwor'])]
    // Mixed case
    #[TestWith(['password', 'password'])]
    // Numbers
    #[TestWith(['password', 'Password'])]
    // Symbols
    #[TestWith(['password', 'Password123'])]
    // Uncompromised
    #[TestWith(['password', 'Password.123'])]
    // Required
    #[TestWith(['password_confirmation'])]
    // Not confirmed
    #[TestWith(['password_confirmation', 'somepassword1234'])]
    // Required
    #[TestWith(['agreement'])]
    // Must be 1
    #[TestWith(['agreement', '1.2'])]
    // Minimum 0
    #[TestWith(['agreement', '-1'])]
    // Maximum 1
    #[TestWith(['agreement', '2'])]
    public function test_validation_fails_for_invalid_value(string $field, string $value = ''): void
    {
        [$field, $validator] = $this->getRequiredValidator($field, $value);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey($field, $validator->errors()->toArray());
    }

    #[TestWith(['username'])]
    #[TestWith(['email'])]
    public function test_validation_fails_if_exists(string $field): void
    {
        $user = User::factory()->create([
            'username' => 'existing',
            'email' => 'existing@example.com',
        ]);
        [$field, $validator] = $this->getRequiredValidator($field, $user->{$field});

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey($field, $validator->errors()->toArray());
    }

    public function test_validation_passes_for_valid_values(): void
    {
        [$field, $validator] = $this->getRequiredValidator();

        $this->assertFalse($validator->fails());
    }

    private function getRequiredValidator(string $field = '', string $value = ''): array
    {
        $request = new RegistrationRequest();
        $request->merge([
            'username' => $field === 'username' ? $value : 'someusername',
            'email' => $field === 'email' ? $value : 'test@example.com',
            'password' => $field === 'password' ? $value : 'A3dkO@PlnkUv',
            'password_confirmation' => $field === 'password_confirmation' ? $value : 'A3dkO@PlnkUv',
            'agreement' => $field === 'agreement' ? $value : '1',
        ]);

        return [
            $field === 'password_confirmation' ? 'password' : $field,
            Validator::make($request->all(), $request->rules())
        ];
    }
}
