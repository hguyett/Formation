<?php
namespace FormBuilder;
use OCFram\FormBuilder;
use OCFram\StringField;
use OCFram\TextField;
use OCFram\NotNullValidator;
use OCFram\MaxLengthValidator;

/**
 *
 */
class CommentFormBuilder extends FormBuilder
{

    public function build()
    {
        $authorField = new StringField;
        $authorField->setLabel('Auteur')->setName('author')->setMaxLength(50);
        $authorField->addValidator(new NotNullValidator('L\'auteur doit être indiqué'));
        $authorField->addValidator(new MaxLengthValidator('Le nom de l\'auteur ne peut pas excéder 50 caractères.', 50));

        $this->form->add($authorField);

        $contentField = new TextField;
        $contentField->setLabel('Contenu')->setName('content')->setCols(7)->setCols(50);
        $contentField->addValidator(new NotNullValidator('Le contenu ne peut être vide.'));

        $this->form->add($contentField);
    }
}
