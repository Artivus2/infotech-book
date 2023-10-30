<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "viewsub"
        $viewSub = $auth->createPermission('ViewSub');
        $viewSub->description = 'View a sub';
        $auth->add($viewSub);

        // добавляем разрешение "createsub"
        $createSub = $auth->createPermission('createSub');
        $createSub->description = 'Create a sub';
        $auth->add($createSub);

        // добавляем разрешение "updatesub"
        $updateSub = $auth->createPermission('updateSub');
        $updateSub->description = 'Update sub';
        $auth->add($updateSub);

        // добавляем разрешение "removesub"
        $removeSub = $auth->createPermission('removeSub');
        $removeSub->description = 'Remove a sub';
        $auth->add($removeSub);



        // добавляем роль "guest" и даём роли разрешение "viewSub + CreateSub"
        $guest = $auth->createRole('guest');
        $auth->add($guest);
        $auth->addChild($guest, $viewSub);
        $auth->addChild($guest, $createSub);

        // добавляем роль "user" и даём роли разрешение "view, create, update, remove"
        // а также все разрешения роли "author"
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $viewSub);
        $auth->addChild($user, $updateSub);
        $auth->addChild($user, $createSub);
        $auth->addChild($user, $removeSub);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $viewSub);
        $auth->addChild($admin, $updateSub);
        $auth->addChild($admin, $createSub);
        $auth->addChild($admin, $removeSub);


        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        // $auth->assign($guest, 3);
        // $auth->assign($user, 2);
        // $auth->assign($admin, 1);
    }


}