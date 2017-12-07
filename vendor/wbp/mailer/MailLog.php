<?php

namespace wbp\mailer;

use common\models\WbpActiveRecord;

class MailLog extends WbpActiveRecord{

    public static function tableName(){
        return '{{%mail_log}}';
    }

    public function rules()
    {
        return [
            [
                [
                    'from_email',
                    'from_name',
                    'to_email',
                    'to_name',
                    'subject',
                    'message',
                    'template_id',
                    'sentUrl',
                    'raw'
                ], 'safe'
            ]
        ];
    }

}
