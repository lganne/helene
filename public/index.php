<?php
include_once '../bootstrap.php';


if ('/helene/public/index.php' == URI || '/helene/public/' == URI) {
 
    $manager = new ContenuManager($pdo);
    $contenu = $manager->page('home');
    include __DIR__ . './../src/view/home.php';
    
} elseif (preg_match('/\/post\/(?P<id>[0-9][1-9]*)/', URI, $m)) {

    $postmanager = new ContenuManager($pdo);
    $contenu = $postmanager->find($m['id']);
    include __DIR__ . '/../src/views/single.php';
    
} else {

    header('Status: 404 Not Found');
    echo '<html><head><meta charset="UTF-8"></head><body><h1>La page n\'a pas été trouvé</h1></body></html>';
    
}