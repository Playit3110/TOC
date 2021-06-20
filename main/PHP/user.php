<?php
function addUser($user) {
    global $FILE;
    if(($h = fopen($FILE["user"], "a")) !== false) {
        $user = json_encode($user, true);
        fwrite($h, $user);
        fclose($h);
    }
}

function getColor() {
	$c = "";
	for($i = 0; $i < 3; $i++) {
		$c .= dechex(random_int(0, 255));
	}
	return $c;
}

function getUsers($ui = false) {
    global $FILE;
    $users = [];
    if(($h = fopen($FILE["user"], "r")) !== false) {
        while(($user = fgets($h)) !== false) {
            $user = json_decode($user, true);
            if(in_array($ui, $user) || $ui == false) {
                $users[] = $user;
            }
        }
        fclose($h);
    }
    // var_dump($users);
    return $users;
}

function checkUser($ui) {
    return !exists(getUsers($ui));
}

function removeUser($ui) {
    global $FILE;
    $users = [];
    if(($h = fopen($FILE["user"], "r")) !== false) {
        while(($user = fgets($h)) !== false) {
            $user = json_decode($user, true);
            if(!in_array($ui, $user)) {
                $users[] = $user;
            }
        }
        fclose($h);
    }
    $users = implode("\n", $users);
    file_put_contents($FILE["user"], $users);
}
?>