<?php

App::uses('AppController', 'Controller');
App::uses('User', 'Model');



class EventController extends AppController
{
    public $components = array('Flash');

    public $uses = array('User', 'ProfileDetails', 'ProfilePost','Posts', 'UserProfiles', 'Reactions', 'FriendsList', 'FriendsListNotification', 'Event');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    

}