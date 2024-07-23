<?PHP

use PHPMailer\PHPMailer\Db;
use PHPMailer\PHPMailer\Game;

session_start();

$database = new Db();
// geeft $_SESSION['game'] terug als die bestaat, anders een nieuwe Game
$game = $_SESSION['game'] ?? new Game();
$action = $_GET['action'] ?? null;

$template = new Smarty();
$template->setTemplateDir('templates');
$template->clearCompiledTemplate();
$template->clearAllCache();


