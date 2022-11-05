<?php

class User extends Model {
    protected static $tableName = 'users';
    protected static $columns = [
        'id',
        'user_id',
        'work_date',
        'time1',
        'time2',
        'time3',
        'time4',
        'worked_time',
    ]; 

    public static function  getActiveUsersCount() {
        return static::getCount(['raw' => 'end_date IS NULL']);
    }
}