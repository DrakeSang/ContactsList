<?php

spl_autoload_register();

$entryPointFileName = basename(__FILE__); // getting the base name of the file which is
// index.php

$self = $_SERVER['PHP_SELF']; // getting the url of index.php which is the name of the project
// and index.php. In my case it returns ContactsList/index.php

$junk = str_replace($entryPointFileName, '', $self); // I replace index.php with empty
// string in ContactsList/index.php and returns only ContactsList. I consider this junk,
// because later i do not need it. I need only the name of the controller and the action.

$uri = $_SERVER['REQUEST_URI']; // returns the url(for example it returns ContactsList/contact
//add).That way i can easily replace ContactsList with empty string and my controller name
//will be ContactController adn teh action will be add.

$significantUri = str_replace($junk, '', $uri); // Taking only the significant part
// of the url. For example if the url is ContactsList/contact/add i get only contact and add.

$significantUri = str_replace([$_SERVER['QUERY_STRING'], '?'], '', $significantUri);
//If user tries to type the url by himself and he uses query string or ? i need to replace
// them again with empty string to be sure i will use teh correct controller and action.

$uriParts = explode('/', $significantUri); // Splitting the significant url by / and
// keep them in array. On first index is my controller name on second is action name.

if($uriParts[0] == "" || count($uriParts) == 1){
    $controllerName = "home";
    $actionName = "index";
}else {
    $controllerName = array_shift($uriParts); // deleting the first element of array
    // adn keep it in another variable
    $actionName = array_shift($uriParts);
} // checking if user is on the main page or he type himself the url and he only writes the
// the controller name i set the controller name to be home and action name to be index.

$arguments = $uriParts; // if the url is contact/show/6 i keep in array the number 6 which
// maybe it represents the id of the contact, which i need to show to the user.

$app = new \Core\Application($controllerName, $actionName, $arguments); // creating new
// instance of the Core class

echo '<pre>';
print_r($app);
echo '</pre>';

$app->addInstance(\Driver\DatabaseInterface::class,
    new \Driver\PDODatabase('localhost', 'root', '', 'contact_list'));

try {
    $app->start();
} catch (ReflectionException $e) {
} catch (Exception $e) {
    echo $e->getMessage();
}