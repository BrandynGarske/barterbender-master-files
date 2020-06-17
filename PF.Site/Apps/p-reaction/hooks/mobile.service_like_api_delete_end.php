<?php

if(Phpfox::isAppActive('P_Reaction')) {
    $reactions = [];
    if (!empty($like['most_reactions'])) {
        foreach ($like['most_reactions'] as $most_reaction) {
            $reactions[] = Apps\P_Reaction\Api\Resource\PReactionResource::populate($most_reaction)->displayShortFields()->toArray();
        }
    }
    $response['most_reactions'] = $reactions;
    $response['user_reacted'] = null;
}

