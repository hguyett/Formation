<?php

//////////////////////
// global variables //
//////////////////////

/**
 * @var array $warnings This array is used to print messages at the end of the body.
 */
global $warnings;
$warnings = array();

if (!isset($_GET['page'])) $_GET['page'] = 'home';

///////////////
// Functions //
///////////////

function classAutoLoader(String $className)
{
    $classFileName = 'lib/' . $className . '.class.php';
    if (file_exists($classFileName)) include $classFileName;
}

/**
 * Check if a news exists with this id and return a news. If no news is found with this ID, return false.
 * @param  int  $id
 * @return mixed     Return a news object corresponding to the id or return false.
 */
function getNews($id)
{
    if (isset($id)) {
        if (is_numeric($id)) {
            $newsManager = DBFactory::getMysqlConnectionWithPDO();
            try {
                $news = $newsManager->get($id);
            } catch (NotFoundException $e) {
                $warnings[] = 'L\'article n°' . $id . ' n\'existe pas.';
                $news = false;
            } finally {
                return $news;
            }
        }
    }
    return false;
}


/*******************************
 *                             *
 * ---------- Main ----------  *
 *                             *
 *******************************/

// Load class dynamicly

spl_autoload_register('classAutoLoader');

date_default_timezone_set('Europe/Brussels');
setlocale(LC_ALL, 'fr');

// Admin Page management

if ($_GET['page'] == 'admin') {
    if (isset($_POST['save_news'])) {
        if (isset($_POST['id'])) {
            /**
             * @var News $news
             */
            if (!$news = getNews($_POST['id'])) $news = new News();
            $news->setAuthor($_POST['author']);
            $news->setTitle($_POST['title']);
            $news->setContent($_POST['content']);
            $newsManager = DBFactory::getMysqlConnectionWithPDO();
            if (!$newsManager->save($news)) {
                $warnings[] = 'L\'article n\'a pas pû être modifié.';
            };
        }
    }
    if (isset($_GET['delete'])) {
        if ($news = getNews($_GET['delete'])) {
            $newsManager = DBFactory::getMysqlConnectionWithPDO();
            $newsManager->delete($news);
        } else {
            $warnings[]= 'L\'article spécifié n\'existe pas.';
        }
    }
}


/////////////////////
// Displaying page //
/////////////////////

// Printing page

switch ($_GET['page']) {
    case 'admin':
        include 'src/admin.php';
        break;

    case 'home':
        //no break

    default:
        include 'src/header.php';
        include 'src/welcome.php';
        break;
}

// Printing warnings
foreach ($warnings as $key => $warning) {
    echo PHP_EOL;
    echo '<p class="warning">' . $warning . '</p>';
}
