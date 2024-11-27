<?php 

class ProfilePost extends AppModel
{
    public $useTable = 'profile_posts';
    public $name = 'ProfilePost';
    public $primaryKey = 'id';

    // public $belongsTo = array(
    //     'ProfilePost' => array(
    //         'foreignKey' => 'user_id'
    //     )
    // );
}
?>
