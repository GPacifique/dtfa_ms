<?php return array (
  'App\\Providers\\EventServiceProvider' => 
  array (
    'Illuminate\\Auth\\Events\\Registered' => 
    array (
      0 => 'App\\Listeners\\AssignRoleByBranch',
    ),
    'Illuminate\\Auth\\Events\\Verified' => 
    array (
      0 => 'App\\Listeners\\SendAccountVerifiedNotification',
    ),
  ),
  'Illuminate\\Foundation\\Support\\Providers\\EventServiceProvider' => 
  array (
    'Illuminate\\Auth\\Events\\Registered' => 
    array (
      0 => 'App\\Listeners\\AssignRoleByBranch@handle',
    ),
    'Illuminate\\Auth\\Events\\Verified' => 
    array (
      0 => 'App\\Listeners\\SendAccountVerifiedNotification@handle',
    ),
  ),
);