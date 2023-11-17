<?php

$route = [
    '/' => ["GET" => "user/LoginController@showLoginPage"],
    '/login' => ["GET" => "user/LoginController@showLoginPage"],
    '/registration' => ["GET" => "user/RegistrationController@showRegistrationPage"],
    '/home' => ["GET" => "user/HomePageController@showHomePage"],
    '/search' => ["GET" => "search/SearchPageController@showSearchPage"],
    '/search/film' => ["GET" => "search/SearchPageController@fetchSearchResults"],
    '/watchlist' => ["GET" => "watchlist/WatchListPageController@showWatchListPage"],
    '/watch/:id' => ["GET" => "film/FilmController@showWatchFilmPage"],
    
    '/settings/:id' => ["GET" => "user/UserController@showProfileSettingsPage"],
    '/edit-profile/:id' => ["GET" => "user/UserController@showEditProfilePage"],
    '/update-profile' => ["POST" => "user/UserController@editProfile",],

    '/auth/register' => ["POST" => "user/RegistrationController@register"],
    '/auth/login' => ["POST" => "user/LoginController@login"],
    '/check/username/:username' => ["GET" => "user/UserController@checkUsername"],
    '/check/email/:email' => ["GET" => "user/UserController@checkEmail"],
    '/logout' => ["GET" => "user/LoginController@logout"],
    
    '/manage-user' => ["GET" => "user/UserController@showManageUserPage"],
    '/user-detail/:id' => ["GET" => "user/UserController@showUserDetailPage"],
    '/delete/user' => ["POST" => "user/UserController@deleteUser"],
    '/change-to-admin/:id' => ["POST" => "user/UserController@changeToAdmin"],
    '/change-to-user/:id' => ["POST" => "user/UserController@changeToUser"],
    
    '/manage-film' => ["GET" => "film/FilmController@showManageFilmPage"],
    '/detail-film/:id' => ["GET" => "film/FilmController@showDetailFilmPage"],
    
    '/add-film' => ["GET" => "film/FilmController@showAddFilmPage"],
    '/add/film' => ["POST" => "film/FilmController@addFilm"],
    '/check/filmname/:filmname' => ["GET" => "film/FilmController@checkFilmName"],

    '/manage-genre' => ["GET" => "film/GenreController@showManageGenrePage"],
    '/add-genre' => ["GET" => "film/GenreController@addGenrePage"],
    '/add/genre' => ["POST" => "film/GenreController@addGenre"],
    '/check/genre/:genre' => ["GET" => "film/GenreController@checkGenre"],
    '/delete/genre/:id' => ["POST" => "film/GenreController@deleteGenre"],

    '/edit/film/:id' => ["GET" => "film/FilmController@showEditFilmPage"],
    '/delete/film' => ["POST" => "film/FilmController@deleteFilm"],
    '/update/film' => ["POST" => "film/FilmController@editFilm"],

    '/page-not-found' => ["GET" => "conditional/NotFoundController@showNotFoundPage"],
    '/restrict' => ["GET" => "conditional/RestrictedController@showRestrictedPage"],
    '/restrictAdmin' => ["GET" => "conditional/RestrictedController@showAdminModePage"],

    '/check/watchlist/:film_id' => ["GET" => "watchlist/WatchListPageController@isFilmOnWatchList"],
    '/add/watchlist' => ["POST" => "watchlist/WatchListPageController@addToWatchList"],
    '/delete/watchlist' => ["POST" => "watchlist/WatchListPageController@removeFromWatchList"],

    '/add/like' => ["POST" => "film/FilmController@addLike"],
    '/delete/like' => ["POST" => "film/FilmController@deleteLike"],

    '/premium-film' => ["GET" => "user/PremiumPageController@showPremiumPage"],
    '/upgrade-premium' => ["GET" => "user/UserController@requestPremium"],
    '/watch-prem/:id' => ["GET" => "film/FilmController@showWatchPremiumPage"]
];