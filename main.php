<?php
    $user = '';
    $passwords = array(
        'hunter2',
        '123456',
        'Joshua',
        'rosebud',
        'letmein',
        'xyzzy',
        'password',
        'iloveyou',
        'abc123',
        'mellon',
        'chair'
    );
    $password = array_rand( $passwords );
    $host = gethostbyaddr( $_SERVER['REMOTE_ADDR'] );
    $host = explode( '.', $host );
    $onstunet = false;
    if ( $host[1] == 'pip' ) {
        $onstunet = true;
        $user = $host[0];
    } else {
        $foo = 1;
        while ( $foo < 4 ) {
            $letter = chr( 97 + mt_rand( 0, 25 ) );
            $user .= $letter;
            $foo++;
        }
        $user .= rand( 2, 15 );
    }
