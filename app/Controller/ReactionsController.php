<?php

class ReactionsController extends AppController
{
    public $uses = ['Reactions', 'User', 'ProfilePost', 'Notification'];

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function saveReaction()
    {
        $this->autoRender = false;
        $this->response->type('json');

        if ($this->request->is('post')) {
            $data = $this->request->input('json_decode', true);
            if (!empty($data['user_id']) && !empty($data['profile_post_id']) && !empty($data['reaction_type'])) {
                $existingReaction = $this->Reactions->find('first', [
                    'conditions' => [
                        'Reactions.user_id' => $data['user_id'],
                        'Reactions.profile_post_id' => $data['profile_post_id']
                    ]
                ]);
                $findPostAuthor = $this->ProfilePost->find('first', [
                    'conditions' => [
                        'ProfilePost.id' => $data['profile_post_id']
                    ],
                    'fields' => [
                        'ProfilePost.sharer_id', 
                        'ProfilePost.user_id'    
                    ]
                ]);
                
                $authorId = !empty($findPostAuthor['ProfilePost']['sharer_id']) 
                    ? $findPostAuthor['ProfilePost']['sharer_id'] 
                    : $findPostAuthor['ProfilePost']['user_id'];
                
                if ($existingReaction) {
                    
                    if($existingReaction['Reactions']['reaction_type'] == $data['reaction_type']){

                        $reaction = [
                            'Reactions' => [
                                'user_id' => $data['user_id'],
                                'profile_post_id' => $data['profile_post_id'],
                                'reaction_type' => 0
                            ]
                        ];
                        $this->Reactions->delete($existingReaction['Reactions']['id']);
                        $this->updateReactionCount($reaction);
                        return $this->response->body(json_encode(['success' => true, 'message' => 'Reaction updated successfully.']));
                    }

                    $existingReaction['Reactions']['reaction_type'] = $data['reaction_type'];
                 
                    if ($this->Reactions->save($existingReaction)) {
                        $reaction = [
                            'Reactions' => [
                                'user_id' => $data['user_id'],
                                'profile_post_id' => $data['profile_post_id'],
                                'reaction_type' => $data['reaction_type']
                            ]
                        ];
                        $this->updateReactionCount($reaction);
                        return $this->response->body(json_encode(['success' => true, 'message' => 'Reaction Updated successfully.']));
                    }
                } else {
                    $reaction = [
                        'Reactions' => [
                            'user_id' => $data['user_id'],
                            'profile_post_id' => $data['profile_post_id'],
                            'reaction_type' => $data['reaction_type'],
                            'created' => date('Y-m-d H:i:s'),
                        ]
                    ];
                    if ($this->Reactions->save($reaction)) {
                        $this->updateReactionCount($reaction);
                        $type = 'reaction';
                        $this->saveToNotification($reaction, $type, $authorId);
                        return $this->response->body(json_encode(['success' => true, 'message' => 'Reaction saved successfully.']));
                    }
                }
            }

            return $this->response->body(json_encode(['success' => false, 'message' => 'Invalid data.']));
        }
    }

    private function updateReactionCount($reaction)
    {

        $post = $this->ProfilePost->find('first', [
            'conditions' => [
                'ProfilePost.id' => $reaction['Reactions']['profile_post_id']
            ]
        ]);

        if ($post) {
            $reactionCounts = json_decode($post['ProfilePost']['react'], true);

            $reactionMap = [
                1 => "Like",
                2 => "Love",
                3 => "Care",
                4 => "Haha",
                5 => "Wow",
                6 => "Sad",
                7 => "Angry"
            ];
            
            $reactionTypes = [1, 2, 3, 4, 5, 6, 7];
            $reactionCounts = array_fill_keys($reactionTypes, 0);

            $reactionQuery = $this->Reactions->find('all', [
                'fields' => [
                    'Reactions.reaction_type',
                    'count' => 'COUNT(*)'
                ],
                'conditions' => [
                    'Reactions.profile_post_id' => $reaction['Reactions']['profile_post_id'],
                    'Reactions.reaction_type IN' => $reactionTypes
                ],
                'group' => 'Reactions.reaction_type'
            ]);
            foreach ($reactionQuery as $reaction) {
                $reactionType = $reaction['Reactions']['reaction_type'];
                $count = $reaction[0]['COUNT(*)'];
                $reactionCounts[$reactionType] = $count;
            }
            $transformedReactions = [];
            foreach ($reactionCounts as $reactionType => $count) {
                if (isset($reactionMap[$reactionType])) {
                    $reactionName = $reactionMap[$reactionType];
                    $transformedReactions[$reactionName] = $count;
                }
            }
            // Save the updated reaction counts back to the 'react' field in the ProfilePost
            $setArr = array(
                'react' => json_encode($transformedReactions),
                'id' => $post['ProfilePost']['id']
            );
            if ($this->ProfilePost->save($setArr)) {
                $this->response->body(json_encode(['success' => true, 'message' => 'Reaction saved successfully.']));
            }
        }
    }


    private function saveToNotification($reaction, $type, $authorId){
        $notification = [
            'Notification' => [
                'user_id' => $reaction['Reactions']['user_id'],
                'profile_post_id' => $reaction['Reactions']['profile_post_id'],
                'created' => date('Y-m-d H:i:s'), 
                'author' => $authorId
            ]
        ];

      if($type == 'reaction'){
            $notification['Notification']['type'] = 1;
            $notification['Notification']['description'] = 
            $reaction['Reactions']['reaction_type'] == 1 ? 'Like to your Post' :
            ($reaction['Reactions']['reaction_type'] == 2 ? 'Reacted Heart to your Post' :
            ($reaction['Reactions']['reaction_type'] == 3 ? 'Reacted Care to your Post' :
            ($reaction['Reactions']['reaction_type'] == 4 ? 'Reacted Haha to your Post' :
            ($reaction['Reactions']['reaction_type'] == 5 ? 'Reacted Wow to your Post' :
            ($reaction['Reactions']['reaction_type'] == 6 ? 'Reacted Sad to your Post' :
            ($reaction['Reactions']['reaction_type'] == 7 ? 'Reacted Angry to your Post' :
            'Reacted to your Post'))))));

      }else{
        $notification['Notification']['type'] = 2;
      }
     
      if($this->Notification->save($notification)){
        $this->response->body(json_encode(['success' => true, 'message' => 'Notification saved successfully.']));
      }
    }


    public function getReactions($postId)
    {
        $this->autoRender = false; 

        $reactions = $this->Reactions->find('all', [
            'conditions' => ['Reactions.profile_post_id' => $postId], 
        ]);
        $this->log(print_r($reactions, true), 'error');

        $reactionData = [];
        foreach ($reactions as $reaction) {
            $findName = $this->User->find('first', [
                'fields' => ['User.full_name'],
                'conditions' => ['User.user_id' => $reaction['Reactions']['user_id']]
            ]);
            $findSharerImage = $this->Posts->find('first', [
                'fields' => ['Posts.id', 'Posts.path'],
                'conditions' => ['Posts.id' => $reaction['Reactions']['user_id']]
            ]);
            $reactionData[] = [
                'type' => $reaction['Reactions']['reaction_type'], 
                'user' => [
                    'name' => $findName['User']['full_name'],
                    'profile_pic' => $findSharerImage['Posts']['path']
                ]
            ];
        }
        echo json_encode(['success' => true, 'reactions' => $reactionData]);
    }

}
