<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use \App\Notifications\TelegramNotification;

class Otp extends Model
{
    const EXPIRATION_TIME = 15; // minutes
    protected $fillable = [
        'code',
        'user_id',
        'used'
    ];
    public function __construct(array $attributes = [])
    {
        if (! isset($attributes['code'])) {
            $attributes['code'] = $this->generateCode();
        }
        parent::__construct($attributes);
    }
    /**
     * Generate a six digits code
     *
     * @param int $codeLength
     * @return string
     */
    public function generateCode($codeLength = 6)
    {
        $code = mt_rand(100000, 999999);
        return $code;
    }
    /**
     * User tokens relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Send code to user
     *
     * @return bool
     * @throws \Exception
     */
    public function sendCode()
    {
        session()->forget('code');
        if (!$this->user) {
            throw new \Exception("No user attached to this token.");
        }
        if (!$this->code) {
            $this->code = $this->generateCode();
        }
        try {
            session()->put("code", $this->code);
            $this->user->notify(new TelegramNotification());
        } catch (\Exception $ex) {
            return false; //enable to send SMS
        }
        return true;
    }
    /**
     * True if the token is not used nor expired
     *
     * @return bool
     */
    public function isValid()
    {
        return ! $this->isUsed() && ! $this->isExpired();
    }
    /**
     * Is the current token used
     *
     * @return bool
     */
    public function isUsed()
    {
        return $this->used;
    }
    /**
     * Is the current token expired
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->created_at->diffInMinutes(Carbon::now()) > static::EXPIRATION_TIME;
    }
}