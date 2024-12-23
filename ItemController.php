<?php
require_once '../app/models/Item.php';
require_once '../app/controllers/BaseController.php';

class ItemController extends BaseController
{
    private $itemModel;

    public function __construct()
    {
        $this->itemModel = new Item();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->itemModel->addItem($_POST['name'], $_POST['price']);
            header('Location: /phpProject/public');
        }
        $this->render('items/add.php');
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->itemModel->deleteItem($_POST['id']);
            header('Location: /phpProject/public');
        }
        $this->render('items/delete.php');
    }
}
