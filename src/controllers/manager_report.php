<?php

session_start();
requireValidSession();


$activeUserCount = User::getActiveUsersCount();
$absentUsers = WorkingHours::getAbsentUsers();

$yearAndMonth = (new DateTime())->format('Y-m');
$seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);

$hoursInMonth = explode(':', getTimeStringFromSeconds($seconds))[0]; // Pegar apenas o primeiro elemento do array, que serão as horas

loadTemplateView(
    'manager_report',
    [
        'activeUserCount' => $activeUserCount,
        'absentUsers' => $absentUsers,
        'hoursInMonth' => $hoursInMonth,
    ]
);
