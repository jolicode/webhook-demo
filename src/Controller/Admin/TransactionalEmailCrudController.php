<?php

namespace App\Controller\Admin;

use App\Entity\TransactionalEmail;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TransactionalEmailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TransactionalEmail::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
