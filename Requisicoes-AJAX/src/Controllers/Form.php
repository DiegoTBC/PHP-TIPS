<?php


namespace Src\Controllers;

use League\Plates\Engine;
use Src\Models\User;

class Form
{
    /** @var Engine $view */
    private $view;

    public function __construct($router)
    {
        $this->view = new Engine("view", "php");
        $this->view->addData(["router" => $router]);
    }

    public function home(): void
    {
        echo $this->view->render("home", [
            "users" => (new User())->find()->order("first_name")->fetch(true)
        ]);
    }

    public function create(array $data): void
    {
        $userData = filter_var_array($data, FILTER_SANITIZE_STRING);
        if (in_array("", $userData)){
            $callback['message'] = message("Informe o nome e o sobrenome", 'error');
            echo json_encode($callback);
            return;
        }

        $user = new User();
        $user->first_name = $userData['first_name'];
        $user->last_name = $userData['last_name'];
        $user->save();

        $callback['message'] = message("Usuário cadastrado !", 'success');
        $callback['user'] = $this->view->render("user", ["user" => $user]);
        echo json_encode($callback);
    }

    public function delete(array $data): void
    {
        if (empty($data['id'])){
            return;
        }

        $id = filter_var($data['id'], FILTER_VALIDATE_INT);
        $user = (new User())->findById($id);
        if ($user) {
            $user->destroy();
        }

        $callback["remove"] = true;
        echo json_encode($callback);
    }
}