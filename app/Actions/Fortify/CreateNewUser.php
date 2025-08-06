<?php

namespace App\Actions\Fortify;

 
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Exception;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array<string, string> $input
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function create(array $input): User
    {
        try {
            Validator::make($input, [
                'name'  => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),

            ])->validate();

           
            $user = DB::transaction(function () use ($input) {
                return tap(User::create([
                    'name'     => $input['name'],
                    'email'    => $input['email'],
                    'password' => Hash::make($input['password']),
                ]), function (User $user) use ($input) {
                     
                    $user->assignRole('buyer');
                });
            });

    
            return $user;
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('User creation validation failed', [
                'errors' => $e->errors(),
                'input' => array_diff_key($input, array_flip(['password'])),
            ]);
            throw $e;
        } catch (\Illuminate\Database\QueryException $e) {
            Log::error('Database error during user creation', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
            ]);
            throw new Exception($this->getDatabaseErrorMessage($e));
        } catch (\Spatie\Permission\Exceptions\RoleDoesNotExist $e) {
            Log::error('Invalid role specified during user creation', [

                'message' => $e->getMessage(),
            ]);
            throw new Exception('Invalid role specified. Please choose a valid role.');
        } catch (Exception $e) {
            Log::error('Unexpected error during user creation', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'exception_class' => get_class($e),
            ]);
            throw new Exception('An unexpected error occurred. Please try again later.');
        }
    }
    
    private function getDatabaseErrorMessage(\Illuminate\Database\QueryException $e): string
    {
        $errorCode = $e->getCode();
        $errorMessage = $e->getMessage();
    
        if (strpos($errorMessage, 'Duplicate entry') !== false) {
            return 'A user with this email already exists. Please use a different email address.';
        } elseif ($errorCode == 1045) {
            return 'Database access denied. Please contact the administrator.';
        } elseif ($errorCode == 2002) {
            return 'Unable to connect to the database. Please try again later.';
        } else {
            return 'A database error occurred. Please try again later. Error code: ' . $errorCode;
        }
    }

 
}