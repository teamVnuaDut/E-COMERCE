@php
    // Using custom helper method (now works!)
    $auth = app()->getDataUser();
    
    // Alternative methods:
    $user = Auth::user();
    $isAuthenticated = app()->isUserAuthenticated();
    $userId = app()->getUserId();
@endphp