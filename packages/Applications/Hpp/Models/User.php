<?php

namespace Hpp\Models;

use System\Models\User as SystemUser;

class User extends SystemUser
{
    public function Attendances()
    {
    	return $this->hasMany(Attendance::class);
    }

    public function markAttendance()
    {
    	return $this->hasMany(Attendance::class,'cordinator_id'); 
    }
}