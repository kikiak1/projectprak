<?php
namespace App\Validation;

use App\Models\Model_user;

class Userrules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new Model_user();
        $user = $model->where('email', $data['email'])
            ->first();

        if (!$user) {
            return false;
        }

        return password_verify($data['password'], $user['password']);
    }
}