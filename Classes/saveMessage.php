<?php
    require_once('../bootstrap.php');

    if( !empty($_POST) ) {
        $text = $_POST['text'];

        try {
            $c = new Message();
            $c->setText($text);
            $c->save();

            // success
            $result = [
                "status" => "success",
                "message" => "Comment was saved."
            ];

        } catch( Throwable $t ) {
            // error
            $result = [
                "status" => "error",
                "message" => "Something went wrong."
            ];
        }

        echo json_encode($result);

    }