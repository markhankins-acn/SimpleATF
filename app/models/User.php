<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $fillable = ['name', 'password', 'email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array $rules Rules for validation.
     */
    private $rules = [
        'name' => ['required', 'unique:users,username'],
        'email' => ['required', 'unique:users,email'],
        'password' => ['required', 'min:6']
    ];

    /**
     * Determine if the data provided is valid.
     *
     * @param $data
     *
     * @return mixed
     */
    public function isValid($data)
    {
        $valid = Validator::make($data, $this->rules);
        if (!$valid) {
            \Log::info($data);
        }
        return $valid;
    }

    /**
     * \Log::error("User data failed validation.");
     *
     * @param $data
     *
     * @return bool
     */
    public static function safeCreate($data)
    {
        $user = new User();
        if ($user->isValid($data)) {
            $data['password'] = \Hash::make($data['password']);
            try {
                $item = self::create($data);
                return $item;
            } catch (Exception $e) {
                $response = ['error' => $e->getMessage()];
                return $response;
            }
        } else {
            \Log::error("User data failed validation.");
            return false;
        }
    }
}
